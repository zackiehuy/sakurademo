<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $withCount = ['jobs','executiveBoard'];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
    public function executiveBoard()
    {
        return $this->hasMany(ExecutiveBoard::class);
    }
}
