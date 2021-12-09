<?php


namespace App\Repositories\Eloquent;

use App\Models\Branch;
use App\Repositories\Contracts\IBranch;

class BranchRepository extends BaseRepository implements IBranch
{
    public function model()
    {
        return Branch::class;
    }

    public function datatable()
    {
        $query = $this->model->get();

        return datatables()->of($query)
            ->addIndexColumn()
            ->editColumn('image', function ($item) {
                $path = asset("storage/images/branch/".$item->image);
                if ($item->image == null) {
                    $path = asset("img/branch_image.png");
                }
                return view('blocks.img_thumb', compact('path'));
            })
            ->editColumn('location', function ($item) {
                if ($item->location != null) {
                    return $item->location->name . ' (' . $item->location->country . ')';
                }
            })
            ->editColumn('company', function ($item) {
                if ($item->company != null) {
                    return $item->company->name ;
                }
            })
            ->addColumn('disabled', function ($item) {
                $count = $item->executive_boards_count + $item->hotlines_count + $item->jobs_count;
                if ($count > 0) {
                    return 'disabled';
                }
                return '';
            })
            ->make(true);
    }
    public function branchHotlines($id)
    {
        $branches = $this->model->where('id', '!=', $id)->having('hotlines_count', '<', 2)->get();
        if ($id != -1) {
            $old_branch_choose = $this->model->find($id);
            if (isset($old_branch_choose)) {
                $branches->push($old_branch_choose);
            }
        }
        return $branches;
    }
    public function branchLocation()
    {
        return $this->model->with('executiveBoards')->where('company_id', 1)->groupBy('location_id')->get();
    }
}
