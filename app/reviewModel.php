<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class reviewModel extends Model {

	//
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reviews_testimonials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['review',  'stars','request_id'];
    
    public function getTable() {
        return $this->table;
    }
}
