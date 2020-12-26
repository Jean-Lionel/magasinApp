<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Product extends MyModel
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;

//     code_product
// name
// unite_mesure
// quantite
// quantite_alert
// price
// price_max
// price_min
// date_expiration
// description
// category_id



    protected $fillable = ['code_product','name','price','date_expiration','quantite','quantite_alert','category_id','unite_mesure','price_min','price_max','description','marque'];

    protected $sortable= ['code_product','name','price','date_expiration','quantite','quantite_alert','category_id','unite_mesure','price_min','price_max','description','marque'];
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    
}
