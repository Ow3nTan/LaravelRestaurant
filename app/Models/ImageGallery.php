<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageGallery extends Model
{
    use HasFactory;
    protected $table = 'image_gallery';
    protected $primaryKey = 'image_id';
    protected $fillable = [
        'image_name', // Name of the image
        'image'       // Path or filename of the stored image
    ];
    public $timestamps = true;
}
