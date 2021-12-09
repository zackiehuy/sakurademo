<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menus';
    public $timestamps = false;

    protected $with = ['menus'];

    public function menus()
    {
        return $this->hasMany(Menus::class,'parent_id');
    }
}