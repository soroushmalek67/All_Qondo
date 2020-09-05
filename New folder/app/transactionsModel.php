<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class transactionsModel extends Model {

	//
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['userid',  'package',  'expires_at', ];
    
    public function getTable() {
        return $this->table;
    }
}
