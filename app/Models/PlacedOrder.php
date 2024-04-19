<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacedOrder extends Model
{
    use HasFactory;

    protected $table = 'placed_order';
    protected $fillable = ['delivery_address','order_time', 'client_id'];
    protected $primaryKey = 'order_id';
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }
}
