<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class couponModel extends Model {

	//
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'promotion_coupons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['users_id',  'stars',  'title',  'description' ,  'discount' ,  'image'];
    
    
    public function getTable() {
        return $this->table;
    }
}
