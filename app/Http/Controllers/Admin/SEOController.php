<?php
namespace App\Http\Controllers\Admin;

use Input;
use App\Models\MetasModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MetasRequest;

class SEOController extends Controller {

    public function Metas () {
        $metas = MetasModel::select('id', 'name', 'slug', 'meta_title')->orderBy('id', 'DESC')->paginate(20);
        
        return view("admin.metas", compact('metas'));
    }

    public function MetaAdd () {
        $post = (object) ['id' => '', 'name' => '', 'slug' => '', 'meta_title' => '', 'meta_keywords' => '', 'meta_description' => ''];
        
        return view("admin.metas_add", compact('post'));
    }

    public function MetaEdit ($id) {
        $post = MetasModel::find($id);
        
        return view("admin.metas_add", compact('post'));
    }
    
    public function MetaSave(MetasRequest $request) {
        
        $meta = MetasModel::updateOrCreate($request->only('id'), $request->except("_token", "id"));
        
        return redirect("admin-panel/seo/metas/$meta->id")->with('message', 'Updated Succesfully!');
        
    }

    public function MetaDelete () {
        MetasModel::destroy(Input::get('id'));
        return redirect("admin-panel/seo/metas")->with('message', 'Deleted Succesfully!');
    }
    
}
