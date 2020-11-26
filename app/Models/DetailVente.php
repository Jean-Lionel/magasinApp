<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailVente extends MyModel
{
    use HasFactory;

    protected $fillable = ['quantite','price_unitaire', 'code_product','name','unite_mesure','date_expiration','vente_id'];
}
