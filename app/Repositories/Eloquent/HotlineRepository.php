<?php


namespace App\Repositories\Eloquent;

use App\Models\Hotline;
use App\Repositories\Contracts\IHotline;

class HotlineRepository extends BaseRepository implements IHotline
{
    public function model()
    {
        return Hotline::class;
    }
    public function datatable()
    {
        $query = $this->model->orderBy('updated_at')->orderBy('created_at')->get();
        return datatables()->of($query)
            ->addIndexColumn()
            ->addColumn('gender', function ($item) {
                if ($item->is_male == 0) {
                    return trans('base.female');
                }
                return trans('base.male');
            })
            ->addColumn('branch', function ($item) {
                if ($item->branch != '') {
                    if($item->branch['company'] != '')
                    {
                        return $item->branch['name'] . ' (' . $item->branch['company']->name . ')';
                    }
                    return $item->branch['name'];
                }
                return '';
            })
            ->make(true);
    }
}
