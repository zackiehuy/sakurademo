<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotline extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['branch'];

    protected $withCount = ['jobs'];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
