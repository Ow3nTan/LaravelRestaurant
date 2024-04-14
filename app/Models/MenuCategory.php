<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    protected $table = 'menu_category';
    protected $fillable = ['category_name'];

    public function menu(){
        return $this->hasMany(Menu::class);
    }
}
