<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with =['company','location',];

    protected $withCount = ['jobs','hotlines','executiveBoards'];


    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function hotlines()
    {
        return $this->hasMany(Hotline::class);
    }

    public function executiveBoards()
    {
        return $this->hasMany(ExecutiveBoard::class);
    }

}
