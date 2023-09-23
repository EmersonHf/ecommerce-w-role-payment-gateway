<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{

    use HasFactory;
    protected $fillable = [

        'name','price','stock','cover','description','slug','role_id','user_id'
    ];
    public function seller()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
