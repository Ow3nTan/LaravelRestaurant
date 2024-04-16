<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $fillable = ['menu_name', 'menu_price', 'category_id'];
    public function menuCategory()
    {
        return $this->belongsTo(MenuCategory::class, 'category_id', 'category_id');
    }
}
