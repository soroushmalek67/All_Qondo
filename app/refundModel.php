<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class refundModel extends Model {

	//
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'refund';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['reason',  'transaction_reference',  'subject', 'transaction' ,'user_id' ,'comment' ,'status'];
    
    public function getTable() {
        return $this->table;
    }
}
