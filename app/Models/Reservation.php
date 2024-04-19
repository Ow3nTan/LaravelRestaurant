<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservation';
    protected $primaryKey = 'reservation_id';
    
    protected $fillable = ['date_created', 'client_id', 'selected_time', 'nbr_guests', 'table_id'];
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
