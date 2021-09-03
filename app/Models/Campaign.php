<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    protected $table = 'campaigns';

    protected $fillable = ['name', 'status'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cityGroup()
    {
        return $this->hasOne(CityGroup::class, 'id', 'group_id');
    }
}
