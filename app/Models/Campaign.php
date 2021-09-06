<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    protected $table = 'campaigns';

    protected $fillable = ['name', 'status', 'group_id'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function group(){
        return $this->hasOne(CityGroup::class,'id', 'group_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'product_campaigns', 'campaigns_id', 'products_id');
    }
}
