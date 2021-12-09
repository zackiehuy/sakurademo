<?php


namespace App\Repositories\Contracts;

interface IJob extends IBase
{
    public function listRecruitment();
    public function getFirstRecruitment();
    public function sameJob($url, $job_category_id);
}
