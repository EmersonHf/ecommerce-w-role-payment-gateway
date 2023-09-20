<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        // Add other columns from your orders table here.
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
