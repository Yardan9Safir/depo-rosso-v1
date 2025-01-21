<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['clients_id', 'items_id', 'quantity', 'total_price', 'status'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'clients_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'items_id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_item')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
