<?php


namespace App\Repositories\Eloquent;

use App\Models\Company;
use App\Repositories\Contracts\ICompany;

class CompanyRepository extends BaseRepository implements ICompany
{
    public function model()
    {
        return Company::class;
    }
    public function datatable()
    {
        $query = $this->model->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return datatables()->of($query)
            ->addIndexColumn()
            ->editColumn('logo', function ($item) {
                $path = asset("storage/images/companies/".$item->logo);
                if ($item->logo == null) {
                    if ($item->default_logo == null) {
                        $path = asset("img/no-image.jpg");
                    } else {
                        $path = asset($item->default_logo);
                    }
                }
                return view('blocks.logo_thumb', compact('path'));
            })
            ->make('true');
    }
}
