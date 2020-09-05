<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class productModel extends Model {

	//
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['users_id',  'name',  'description',  'image'];
    
    public function getTable() {
        return $this->table;
    }
}
