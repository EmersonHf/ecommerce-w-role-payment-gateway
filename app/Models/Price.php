<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'price_id',
        'type',
        'stripe_price_id',
        'name',
        'amount',
        'currency'

    ];
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('type'); // You can include additional pivot columns if needed
    }
}
