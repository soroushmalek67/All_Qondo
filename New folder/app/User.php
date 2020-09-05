<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'email', 'password', 'job_position', 'phone_number', 'mobile_number', 'user_type', 'building_id', 'approval_email', 'bids', 
                            'business_name', 'tax_id', 'describe_product', 'industries_you_buy', 'industries_you_sell', 'street_address', 'city', 
                            'state', 'postal_code', 'country', 'website', 'last_name', 'service_kilometers', 'lati', 'longi', 'main_categories', 
                            'sub_categories', 'service_cities', 'service_states', 'company_logo','company_banner', 'company_slug','certificate_awards', 
                            'video', 'facebook', 'twitter', 'googleplus', 'award', 'status', 'anonymous', 'dedicated_url','linkedin','added_by','subscrption_mnth','top_supplier'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->token = str_random(30);
        });
    }

    public function requestedServices () {
        return $this->hasMany("App\ModelRequestService", 'buyer_id');
    }

    /**
     * Confirm the user.
     *
     * @return void
     */
    public function confirmEmail() {
    	$this->status = ($this->user_type == '1') ? 1 : 2;
    	$this->token = null;
    	$this->save();
    }
    public function updateStatus() {
    	$this->status = 2;
    	$this->token = null;
    	$this->save();
    }
    // changes by salman confirmEmail '$this->status = ($this->user_type == '1') ? 1 : 2;'

//    public function delete()
//    {
//        // delete all related photos 
//        $this->requestedServices()->delete();
//        // as suggested by Dirk in comment,
//        // it's an uglier alternative, but faster
//        // Photo::where("user_id", $this->id)->delete()
//
//        // delete the user
//        return parent::delete();
//    }

    public static function getSuppliersByID ($ids = null) {
    }
    
    public static function getSuppliersByIDs ($ids = null) {
        return DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
                            ->leftJoin('category_description as cd2', 'c.parent_id', '=', 'cd2.category_id')
                            ->select("c.id", "cd.name", 'cd2.name as parentName')
                            ->whereIn('c.parent_id', $ids)->where('c.parent_id', '!=', 0)->orderBy('cd2.name', 'ASC')->orderBy('cd.name', 'ASC')->get();
    }

}
