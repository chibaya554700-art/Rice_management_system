<?php
// app/Models/RiceItem.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'stock', 'description'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}