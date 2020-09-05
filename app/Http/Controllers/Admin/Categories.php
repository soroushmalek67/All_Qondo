<?php
namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Support\Facades\File;
//use App\Categories;
//use Carbon;

class Categories extends Controller {

    public function Index() {
        $formAction = url('admin-panel/categories/save');
        $sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, "
                ."c1.parent_id, if (c1.status = 1, 'Enabled', 'Disabled') catStatus FROM category_path cp LEFT JOIN category c1 ON  "
                ."(cp.category_id = c1.id) LEFT JOIN category c2 ON (cp.path_id = c2.id) LEFT JOIN category_description cd1 ON "
                ."(cp.path_id = cd1.category_id) LEFT JOIN category_description cd2 ON (cp.category_id = cd2.category_id) GROUP BY cp.category_id "
                . "ORDER BY name, c1.id";
        $categories = DB::select($sql);
        
        return view("admin.categories_list", compact("categories", "formAction"));
    }
    
    public function Add() {
        $formAction = url('admin-panel/categories/update');
        $categoriesList = DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
                            ->select("c.id", "cd.name")->where('c.parent_id', 0)->get();
        $categoryDetail = (object) array("id" => "", 'image' => "", 'home_icon' => "", 'category_icon' => "", "parent_id" => "", "status" => "", 
                                "name" => '', "description" => '', "featured" => "", "meta_title" => "", "meta_keywords" => "", "meta_description" => "");
        return view("admin.categories_add", compact('categoryDetail', "categoriesList", "formAction"));
    }
    
    public function Edit($id) {
        $categoriesList = DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
                            ->select("c.id", "cd.name")->where('c.id', "!=", $id)->where('c.parent_id', 0)->get();
        $categoryDetail = DB::table('category')->leftJoin('category_description', 'category.id', '=', 'category_description.category_id')
                            ->select("id", 'image', "parent_id", "category_icon", "featured", "status", "name", "description", "meta_title", 
                            "meta_keywords", "meta_description")->where('category.id', $id)->first();
        return view("admin.categories_add", compact('categoryDetail', "categoriesList"));
    }
    
    public function Save (CategoryRequest $request) {
        $catid = $request->get('catid');
        $catOldImg = $request->get('catOldImg');
        $oldHomeIcon = $request->get('oldHomeIcon');
        $oldCategoryIcon = $request->get('oldCategoryIcon');
        $name = $request->get('categoryName');
        $description = $request->get('categoryDescription');
        $parentid = $request->get('categoryParent');
        $status = $request->get('categoryStatus');
        $featured = ($request->get('featured')) ? 1 : 0;
        $date = \Carbon\Carbon::now()->toDateTimeString();
        $fileName = "";
        $slug = makeSlug($name);
        
        $metaTitle = $request->get('meta_title');
        $metaKeywords = $request->get('meta_keywords');
        $metaDescription = $request->get('meta_description');
        
        if (empty($catid)) {
            $totalSlugs = DB::table('category')->select(DB::raw("COUNT(id) as totalSlugs"))->where('slug', $slug)->get();
            if ($totalSlugs[0]->totalSlugs > 0) {
                $slug =  $slug."-".($totalSlugs[0]->totalSlugs + 1);
            }
            
            $catid = DB::table('category')->insertGetId(
                ['image' => $fileName, 'parent_id' => $parentid, 'slug' => $slug, 'featured' => $featured, 'status' => $status, 'date_created' => $date, 
                    'date_modified' => $date, 'meta_title' => $metaTitle, 'meta_keywords' => $metaKeywords, 'meta_description' => $metaDescription]
            );

            DB::table('category_description')->insert(
                ['category_id' => $catid, 'name' => $name, 'description' => $description]
            );

            $level = 0;
            $categoryPaths = DB::table('category_path')->where('category_id', $parentid)->orderBy('level', 'ASC')->get();
            foreach ($categoryPaths as $categoryPath) {
                DB::table('category_path')->insert(
                    ['category_id' => $catid, 'path_id' => $categoryPath->path_id, 'level' => $level]
                );
                $level++;
            }
            DB::table('category_path')->insert(
                ['category_id' => $catid, 'path_id' => $catid, 'level' => $level]
            );
        } else {
            DB::table('category')->where('id', $catid)->update(
                ['parent_id' => $parentid, 'slug' => $slug, 'featured' => $featured, 'status' => $status, 'date_modified' => $date, 'meta_title' => $metaTitle, 
                    'meta_keywords' => $metaKeywords, 'meta_description' => $metaDescription]
            );
            
            DB::table('category_description')->where('category_id', $catid)->update(
                ['name' => $name, 'description' => $description]
            );
            
            $categoryChilds = DB::table('category_path')->where('path_id', "=", $catid)->orderBy('level', 'ASC')->get();

            if ($categoryChilds) {
                foreach ($categoryChilds as $category_path) {
                    // Delete the path below the current one
                    DB::table('category_path')->where('category_id',  (int)$category_path->category_id)
                            ->where('level', "<",  (int)$category_path->level)->delete();

                    $path = array();

                    // Get the nodes new parents
                    $parentCategoryParents = DB::table('category_path')->where('category_id', "=", $parentid)->orderBy('level', 'ASC')->get();

                    foreach ($parentCategoryParents as $result) {
                        $path[] = $result->path_id;
                    }

                    // Get whats left of the nodes current path
                    $categoryParents2 = DB::table('category_path')->where('category_id', "=", $catid)->orderBy('level', 'ASC')->get();

                    foreach ($categoryParents2 as $result) {
                        $path[] = $result->path_id;
                    }

                    // Combine the paths with a new level
                    $level = 0;

                    foreach ($path as $path_id) {
//                        DB::updateOrCreate("REPLACE INTO `category_path` SET category_id = '" . (int)$category_path->category_id. "', `path_id` = '" 
//                        . (int)$path_id . "', level = '" . (int)$level . "'");
                        DB::statement("REPLACE INTO `category_path` SET category_id = '" . (int)$category_path->category_id. "', `path_id` = '"
                                .(int)$path_id."', level = '".(int)$level."'");
                        $level++;
                    }
                }
            } else {
                // Delete the path below the current one
                DB::table('category_path')->where('category_id',  (int)$catid)->delete();

                // Fix for records with no paths
                $level = 0;

                $categoryParents2 = DB::table('category_path')->where('category_id', "=", $parentid)->orderBy('level', 'ASC')->get();

                foreach ($categoryParents2 as $result) {
                    DB::table('category_path')->insert(
                        ['category_id' => $catid, 'path_id' => $result['path_id'], 'level' => $level]
                    );

                    $level++;
                }

                DB::statement("REPLACE INTO `category_path` SET category_id = '".(int)$catid."', `path_id` = '".(int)$catid."', level = '".(int)$level."'");
            }
        }
        
        if ($request->has('removeCatImage')) {
            $imgName = $request->get('removeCatImage');
            if (File::exists(public_path("img/category/$imgName"))) {
                File::delete("img/category/$imgName");
                DB::table('category')->where('id', $catid)->update(['image' => '']);
            }
        }
        
        if ($request->has('removeCatIcon')) {
            $imgName = $request->get('removeCatIcon');
            if (File::exists(public_path("img/category/category_icons/$imgName"))) {
                File::delete("img/category/category_icons/$imgName");
                DB::table('category')->where('id', $catid)->update(['category_icon' => '']);
            }
        }
        
        if ($request->file('categoryImage') != null) {
            $fileName = saveOrReplaceFile("img/category", $request->file('categoryImage'), $catOldImg, $catid);
            DB::table('category')->where('id', $catid)->update(['image' => $fileName]);
            
            compress_file_from_TinyPNG ("img/category/$fileName");
        }
        
        if ($request->file('category_icon') != null) {
            $fileName = saveOrReplaceFile("img/category/category_icons", $request->file('category_icon'), $oldCategoryIcon, $catid);
            DB::table('category')->where('id', $catid)->update(['category_icon' => $fileName]);
            
            compress_file_from_TinyPNG ("img/category/category_icons/$fileName");
        }
        
        return redirect("/admin-panel/categories/edit/$catid"); 
    }
    
    public function Delete ($id) {
        $this->DeleteCategory($id);
        return redirect("/admin-panel/categories")->with("message", "Category has been deleted"); 
    }
    
    public function DeleteCategory ($id) {
        $subCategories = DB::table('category_path')->where('path_id', $id)->where('category_id', '!=', $id)->get();
        
        $catImgs = DB::table('category')->select('image', "category_icon")->where('id', $id)->first();
        
        if (File::exists(public_path("img/category/".$catImgs->image))) {
            File::delete("img/category/".$catImgs->image);
        }
        if (File::exists(public_path("img/category/category_icons/".$catImgs->category_icon))) {
            File::delete("img/category/category_icons/".$catImgs->category_icon);
        }
        
        foreach ($subCategories as $result) {
                $this->DeleteCategory($result->category_id);
        }

        DB::table('category_path')->where('category_id',  (int)$id)->delete();
        DB::table('category')->where('id',  (int)$id)->delete();
        DB::table('category_description')->where('category_id',  (int)$id)->delete();
		
		DB::table('request_service')->where('main_categories', (int)$id)->delete();
    }
        
}