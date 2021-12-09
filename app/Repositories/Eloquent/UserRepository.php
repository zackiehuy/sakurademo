<?php


namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\IUser;

class UserRepository extends BaseRepository implements IUser
{
    public function model()
    {
        return User::class;
    }

    public function datatable()
    {
        $query = $this->model->orderBy('updated_at')->orderBy('created_at')->get();
        return datatables()->of($query)
            ->addIndexColumn()
            ->addColumn('created_date', function ($item) {
                return format_date($item->created_at,'d-m-Y H:i:s');
            })->make('true');
    }
}
