<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelCities extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'state', 'featured', 'meta_title', 'meta_keywords', 'meta_description'];
    
    public function state () {
        return $this->belongsTo("App\ModelStates", 'state');
    }

}
