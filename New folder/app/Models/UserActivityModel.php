<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivityModel extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_activity';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'ip'];

}
