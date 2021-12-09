<?php


namespace App\Repositories\Eloquent;

use App\Models\Location;
use App\Repositories\Contracts\ILocation;

class LocationRepository extends BaseRepository implements ILocation
{
    public function model()
    {
        return Location::class;
    }
}
