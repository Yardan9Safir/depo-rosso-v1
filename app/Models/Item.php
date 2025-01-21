<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'photo_item',
        'description',
        'price',
        'quantity'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'items_id');
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_item')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
