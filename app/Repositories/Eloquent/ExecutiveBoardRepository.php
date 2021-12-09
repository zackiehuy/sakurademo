<?php


namespace App\Repositories\Eloquent;

use App\Models\ExecutiveBoard;
use App\Repositories\Contracts\IExecutiveBoard;
use Illuminate\Support\Facades\App;

class ExecutiveBoardRepository extends BaseRepository implements IExecutiveBoard
{
    public function model()
    {
        return ExecutiveBoard::class;
    }

    public function datatable()
    {
        $query = $this->model->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return datatables()->of($query)
            ->addIndexColumn()
            ->editColumn('name', function($item){
                if($item->name == null);
                {
                    return $item->translate('en')->name;
                }
                return $item->name;
            })
            ->editColumn('image', function ($item) {
                $path = asset("storage/images/executive_board/".$item->image);
                if ($item->image == null) {
                    if ($item->default_image == null) {
                        $path = asset("img/avatar/avatar.jpg");
                    } else {
                        $path = asset($item->default_image);
                    }
                }
                return view('blocks.img_thumb', compact('path'));
            })
            ->editColumn('position', function ($item) {
                if ($item->job_category != null) {
                    if (App::getLocale() == 'vi') {
                        return $item->job_category->name_vi;
                    } else {
                        return $item->job_category->name_en;
                    }
                }
                return '';
            })
            ->editColumn('location', function ($item) {
                if ($item->branch != null) {
                    return $item->branch->location->name . ' ( ' .$item->branch->location->country.' )';
                }
                return '';
            })
            ->make(true);
    }
}
