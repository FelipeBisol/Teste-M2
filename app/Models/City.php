<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = ['name', 'cep'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function group(){
        return $this->belongsTo(CityGroup::class,'group_id', 'id');
    }
}
