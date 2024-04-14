<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacedOrder extends Model
{
    use HasFactory;

    protected $table = 'placed_order';

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }
}
