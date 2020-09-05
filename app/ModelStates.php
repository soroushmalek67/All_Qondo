<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelStates extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'provinces';

    public $timestamps = false;
    
    protected $fillable = ['name', 'tax_percent','country_id'];

    
    public function cities () {
        return $this->hasMany("App\ModelCities", 'state');
    }
    public function country () {
        return $this->belongsTo("App\countryModel", 'country_id');
    }

}
