<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primarykey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id_customer', 
        'id_user',
        'full_name',
        'phone',
        'email',
        'address',
        'note',
        'total_amount',
        'date_order',
        'time_order',
        'canceled_at',
        'delivery_at',
        'id_voucher',
        'payment_method',
        'status'
    ];
}
