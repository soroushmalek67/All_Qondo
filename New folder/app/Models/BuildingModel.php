<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BuildingModel extends Model {
   /* **
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'buildings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','building_name', 'lot_number', 'postal_code', 'url', 'country_id', 'state_id', 'city_id', 'Address', 'status', 'Phone', 'management_company', 'onsite_manager'];
    

}
?>