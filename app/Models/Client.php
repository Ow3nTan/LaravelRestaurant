<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;

    protected $guard = 'client';
    protected $table = 'client';

    protected $fillable = ['client_id','client_name', 'client_phone', 'client_email'];

    public static function countItems($item, $table)
    {
        return DB::table($table)->count($item);
    }


    public function placedOrder()
    {
        return $this->hasOne(PlacedOrder::class, 'client_id', 'client_id');
    }
}
