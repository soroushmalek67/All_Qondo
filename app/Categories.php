<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Categories extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = array('category');

    public static function getMainCategories () {
        return DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
                            ->select("c.id", "cd.name")->where('c.parent_id', 0)->orderBy('cd.name', 'ASC')->get();
    }
    
    public static function getMainCategoriesByids ($ids = "") {
        return DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
                            ->select("c.id", "cd.name")->where('c.parent_id', 0)->whereIn('id', $ids)->orderBy('cd.name', 'ASC')->get();
    }

    public static function getSubCategories () {
        $sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, "
                ."cd2.name as catName, c1.parent_id, if (c1.status = 1, 'Enabled', 'Disabled') catStatus, cd2.description, c1.category_icon FROM category_path cp LEFT JOIN category c1 ON  "
                ."(cp.category_id = c1.id) LEFT JOIN category c2 ON (cp.path_id = c2.id) LEFT JOIN category_description cd1 ON "
                ."(cp.path_id = cd1.category_id) LEFT JOIN category_description cd2 ON (cp.category_id = cd2.category_id) "
                . "GROUP BY cp.category_id ORDER BY name, c1.id";
        return DB::select($sql);
    }
    public static function getServices ($offset, $no_of_records ) {
        $sql = "SELECT category_icon,name,slug, category_description.description from category  "
                . " Join category_description on category_description.category_id= category.id"
                . " where category.parent_id!=0 "
                . "order by category.parent_id desc"
                . " limit $offset, $no_of_records";
        return DB::select($sql);
    }
    public static function getTotalServices ( ) {
        $sql = "SELECT count(*) as total_services from category "
                . " Join category_description on category_description.category_id= category.id"
                . " where category.parent_id!=0 ";
        return DB::select($sql);
    }
    public static function getSubCategoriesByids ($ids = null) {
        if (is_array($ids)) {
            $ids = implode(",", $ids);
        }
        $sql = "SELECT cp.category_id AS id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, "
                ."cd2.name as catName, c1.parent_id, if (c1.status = 1, 'Enabled', 'Disabled') catStatus FROM category_path cp LEFT JOIN category c1 ON  "
                ."(cp.category_id = c1.id) LEFT JOIN category c2 ON (cp.path_id = c2.id) LEFT JOIN category_description cd1 ON "
                ."(cp.path_id = cd1.category_id) LEFT JOIN category_description cd2 ON (cp.category_id = cd2.category_id) "
                . "WHERE c1.id IN (".$ids.") GROUP BY cp.category_id ORDER BY name, c1.id";
//        echo $sql;exit;
        return DB::select($sql);
    }
    
    public static function getCategoryBySlug ($slug) {
        return DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')->select("c.*", "cd.*")
                            ->where('c.slug', $slug)->orderBy('c.id', 'desc')->get();
    }
    
    public static function getCategoryByID ($id) {
        return DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')->select("c.*", "cd.*")
                            ->where('c.id', $id)->orderBy('c.id', 'desc')->get();
    }
    
    public static function getChildCategoriesByID ($ids = null) {
        return DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')->select("c.id", "cd.name")
                            ->where('c.parent_id', $ids)->where('c.parent_id', '!=', 0)->orderBy('cd.name', 'ASC')->get();
    }
    
    public static function getChildCategoriesByIDs ($ids = null) {
        return DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
                            ->leftJoin('category_description as cd2', 'c.parent_id', '=', 'cd2.category_id')
                            ->select("c.id", "cd.name", 'cd2.name as parentName')
                            ->whereIn('c.parent_id', $ids)->where('c.parent_id', '!=', 0)->orderBy('cd2.name', 'ASC')->orderBy('cd.name', 'ASC')->get();
    }

}