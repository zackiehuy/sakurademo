<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class ExecutiveBoard extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name'];

    protected $guarded = ['id'];

    protected $with = array('branch','location','position','job_category');

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function job_category()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }
}
