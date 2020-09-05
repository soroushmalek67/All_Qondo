<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class notificationModel extends Model {

	//
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notification';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content',  'notificationName', 'template_image' , 'created_at'];
    
    public function getTable() {
        return $this->table;
    }
}
