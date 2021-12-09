<?php


namespace App\Repositories\Eloquent;

use App\Models\RecruitmentCategory;
use App\Repositories\Contracts\IRecruitmentCategory;

class RecruitmentCategoryRepository extends BaseRepository implements IRecruitmentCategory
{
    public function model()
    {
        return RecruitmentCategory::class;
    }
}
