<?php


namespace App\Repositories\Eloquent;

use App\Models\Wine;
use App\Repositories\Contracts\IWine;

class WineRepository extends BaseRepository implements IWine
{
    public function model()
    {
        return Wine::class;
    }
    public function datatable()
    {
        $query = $this->model->orderBy('code', 'DESC')->get();
        return datatables()->of($query)
            ->addIndexColumn()
            ->editColumn('image', function ($item) {
                $path = asset("storage/images/wines/" . $item->image);
                if ($item->image == null) {
                    if ($item->default_image == null) {
                        if($item->is_new == 1)
                        {
                            $path = asset("img/coming-sake.png");
                        }
                        else
                        {
                            $path = asset("img/sake_icon.png");
                        }
                    } else {
                        $path = asset($item->default_image);
                    }
                }
                return view('blocks.wine_img_thumb',['path' => $path, 'is_new' => $item->is_new]);
            })->make('true');
    }

    public function lastest(){
        return $this->model->latest()->first();
    }
}
