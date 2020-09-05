<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetasModel extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages_metas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'meta_title', 'meta_keywords', 'meta_description'];

}
