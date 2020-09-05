<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPagesVisits extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_page_visits';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ip', 'count', 'page', 'city', 'state', 'country'];

}
