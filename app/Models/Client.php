<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
protected $fillable = ['name', 'email', 'telefone', 'cover', /* other fields */];
public function getCoverUrlAttribute()
{
    return asset('storage/' . $this->cover); // Assuming you're using Laravel storage.
}

    
}
