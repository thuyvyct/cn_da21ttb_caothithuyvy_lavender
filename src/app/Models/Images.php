<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'image_name','image_img','product_id'
    ];
    protected $primaryKey = 'image_id';
    protected $table = 'tbl_image';
}
