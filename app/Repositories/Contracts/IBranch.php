<?php


namespace App\Repositories\Contracts;

interface IBranch extends IBase
{
    public function branchHotlines($id);
    public function branchLocation();
}
