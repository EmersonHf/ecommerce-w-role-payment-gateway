<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    public static function sellersWithUsersWithSellersRole()
    {
        return self::with(['user' => function ($query) {
            $query->whereHas('role', function ($roleQuery) {
                $roleQuery->where('name', 'seller');
            });
        }])->get();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function products()
{
    return $this->hasMany(Product::class);
}
}
