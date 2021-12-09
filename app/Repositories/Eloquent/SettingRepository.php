<?php


namespace App\Repositories\Eloquent;

use App\Models\Setting;
use App\Repositories\Contracts\ISetting;

class SettingRepository extends BaseRepository implements ISetting
{
    public function model()
    {
        return Setting::class;
    }
}
