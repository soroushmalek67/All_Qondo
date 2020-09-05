<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelRequestService extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'request_service';

//    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'main_categories', 'sub_categories', 'description', 'estimated_budget','budget_type', 'postalcode', 'when_need_it', 
                            "when_need_it_date", 'purchase_type', 'buyer_id', 'lati', 'longi', 'state', 'image', 'city', 'approved_at','supplier_id','status', 'how_to_proceed', 'time_of_day'];

    public function user () {
        return $this->belongsTo("App\user", 'buyer_id');
    }

}
