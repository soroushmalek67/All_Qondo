<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class emailSub extends Model {

	//
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'emails_subscription';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['userid',  'request_notification',  'quote_notification',  'message_notification' ,  'quotes_left_notification' ,];
    
    
    public function getTable() {
        return $this->table;
    }
}
