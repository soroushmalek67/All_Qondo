<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class awardModel extends Model {

	//
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'awards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['users_id',  'review',  'stars', ];
    
    public function getTable() {
        return $this->table;
    }
}
