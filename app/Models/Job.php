<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = array('branches', 'jobCategories', 'hotline','company','recruitmentAddress');

    protected $withCount = ['jobRecruitments'];

    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function recruitmentAddress()
    {
        return $this->belongsTo(Branch::class, 'recruitment_address');
    }

    public function jobCategories()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    public function hotline()
    {
        return $this->belongsTo(Hotline::class, 'hotline_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function jobRecruitments()
    {
        return $this->hasMany(JobRecruitment::class);
    }
}
