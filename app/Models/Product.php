<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'price'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function campaigns(){
        return $this->belongsToMany(Campaign::class, 'product_campaigns', 'products_id', 'campaigns_id');
    }
}
