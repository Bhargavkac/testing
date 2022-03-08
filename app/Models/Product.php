<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{  
    protected $table = 'products';

    public function Tag()
    {
        return $this->hasMany(Tag::class,'product_id');
    }
}
