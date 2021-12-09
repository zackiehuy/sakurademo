<?php


namespace App\Repositories\Eloquent;

use App\Models\Position;
use App\Repositories\Contracts\IPosition;

class PositionRepository extends BaseRepository implements IPosition
{
    public function model()
    {
        return Position::class;
    }
}
