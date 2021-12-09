<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRecruitment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with =['job','branch'];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'work_place_expectation');
    }
}
