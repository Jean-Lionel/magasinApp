<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends MyModel
{
    use HasFactory;



    protected $fillable = ['code_product','name','price','date_expiration','quantite','category_id','unite_mesure'];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
}
