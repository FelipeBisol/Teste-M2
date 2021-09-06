<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CityGroup extends Model
{
    protected $table = 'city_groups';

    protected $fillable = ['name', 'description'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function cities(){
        return $this->hasOne(City::class, 'group_id', 'id');
    }

    public function campaigns(){
        return $this->hasMany(Campaign::class,'group_id', 'id');
    }
}
