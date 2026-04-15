<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RiceItem;
use App\Models\Payment;

class Order extends Model
{
    protected $fillable = [
        'rice_item_id',
        'customer_name',
        'quantity',
        'total_amount',
        'status',
    ];

    public function riceItem()
    {
        return $this->belongsTo(RiceItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}