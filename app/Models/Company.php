<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = [
        'founded_date'
    ];

    protected $withCount = ['branches','jobs'];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
