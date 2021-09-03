<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductCampaign extends Model
{
    protected $table = 'product_campaigns';

    protected $fillable = ['discount_type', 'discount_value', 'campaigns_id', 'products_id'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function campaign(){
        return $this->hasOne(CityGroup::class, 'id', 'campaigns_id');
    }

    public function product(){
        return $this->hasOne(CityGroup::class, 'id', 'products_id');
    }

    public function setDiscount($price, $type, $value){

        if($type == "percents"){
            $price = $price - (($price * $value)/10000);
            return $price;
        }
        $price = $price - $value;

        return $price;
    }
}
