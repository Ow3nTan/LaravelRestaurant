<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $fillable = ['name', 'description', 'price', 'image', 'category_id'];
    protected $primaryKey = 'menu_id';


    public function category()
    {
        return $this->belongsTo(MenuCategory::class);
    }
}
