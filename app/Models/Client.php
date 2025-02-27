<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'photo_profile',
        'email',
        'address',
        'password'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'clients_id');
    }
}
