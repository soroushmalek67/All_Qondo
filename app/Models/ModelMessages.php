<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelMessages extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['quote_id', 'sender_id', 'message', 'created_at'];

}
