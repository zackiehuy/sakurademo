<?php


namespace App\Repositories\Eloquent;

use App\Models\StatusRecruitment;
use App\Repositories\Contracts\IStatusRecruitment;

class StatusRecruitmentRepository extends BaseRepository implements IStatusRecruitment
{
    public function model()
    {
        return StatusRecruitment::class;
    }
}
