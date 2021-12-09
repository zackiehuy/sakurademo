<?php


namespace App\Repositories\Eloquent;

use App\Models\JobCategory;
use App\Repositories\Contracts\IJobCategory;

class JobCategoryRepository extends BaseRepository implements IJobCategory
{
    public function model()
    {
        return JobCategory::class;
    }
}
