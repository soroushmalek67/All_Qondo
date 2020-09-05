<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelInvoice extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['request_id', 'buyer_id', 'supplier_id', 'description', 'amount', 'tax_percent', 'total_amount'];

}
