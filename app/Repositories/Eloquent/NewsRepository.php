<?php


namespace App\Repositories\Eloquent;

use App\Models\News;
use App\Repositories\Contracts\INews;

class NewsRepository extends BaseRepository implements INews
{
    public function model()
    {
        return News::class;
    }
    public function datatable()
    {
        $query = $this->model->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return datatables()->of($query)
            ->addIndexColumn()
            ->editColumn('image', function ($item) {
                $path = asset("storage/images/news/" . $item->image);
                if ($item->image == null) {
                    if ($item->default_image == null) {
                        $path = asset("img/no-image.jpg");
                    } else {
                        $path = asset($item->default_image);
                    }
                }
                return view('blocks.img_thumb', compact('path'));
            })
            ->addColumn('date_submitted', function ($item) {
                return date_format($item->created_at, 'd-m-Y H:i:s');
            })
            ->make('true');
    }
}
