<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelQuotes extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quotes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['request_id', 'description', 'price', "quoteFile", 'supplier_id'];

}
