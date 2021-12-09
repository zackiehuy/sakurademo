<?php


namespace App\Repositories\Eloquent;

use App\Models\Job;
use App\Repositories\Contracts\IJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class JobRepository extends BaseRepository implements IJob
{
    public function model()
    {
        return Job::class;
    }

    public function datatable()
    {
        $query = $this->model->orderBy('end_date', 'DESC')->orderBy('id')->get();
        return datatables()->of($query)
            ->addIndexColumn()
            ->editColumn('title', function ($item) {
                $title = $item->title;
                $path = 'admin/job/'.$item->id;
                $category = 'job';
                return view('blocks.link', ['title' => $title, 'path' => $path, 'category' => $category]);
            })
            ->addColumn(
                'salary',
                function ($item) {
                    if ($item->salary_from == null && $item->salary_to == null) {
                        return 'Có thể thương lượng';
                    } elseif ($item->salary_to == $item->salary_from) {
                        return $item->salary_from;
                    } elseif ($item->salary_to == null) {
                        return 'Tối thiểu ' . $item->salary_from;
                    } elseif ($item->salary_from == null) {
                        return 'Tối đa ' . $item->salary_to;
                    }
                    return $item->salary_from . ' - ' . $item->salary_to;
                }
            )
            ->addColumn(
                'contacts',
                function ($item) {
                    $contact = $item->hotline->phone . ' (';
                    if ($item->hotline->is_male == 1) {
                        $contact .= 'Mr ';
                    } else {
                        $contact .= 'Mrs ';
                    }
                    $name = explode(" ", $item->hotline->name);
                    return $contact . $name[count($name) -1] . ')';
                }
            )
            ->addColumn('disabled', function ($item) {
                $end_date = strtotime($item->end_date);
                $now = strtotime(format_date(Date::now()));
                if ($item->job_recruitments_count > 0 && $end_date >= $now) {
                    return 'disabled';
                }
                return '';
            })
            ->addColumn('branch', function ($item) {
                if (isset($item->company)) {
                    return '<div class="company-name">' . $item->company['name'] . '</div>';
                } else {
                    return '<div class="company-name">' . $item->branches->company['name'] . '</div>'
                        .'<div class="branch-name">' . $item->branches['name'] . '</div>';
                }
            })
            ->addColumn('title_dashboard', function ($item) {
                if (isset($item->company)) {
                    return '<div class="company-name">' . $item->company['name'] . '</div>'
                        .'<div class="branch-name">' . $item->jobCategories['name'] . '</div>';
                } else {
                    return '<div class="company-name">' . $item->branches->company['name'] . '</div>'
                        .'<div class="branch-name">' . $item->jobCategories['name'] . '</div>';
                }
            })
            ->addColumn('sluv', function ($item) {
                return $item->job_recruitments_count;
            })
            ->editColumn('end_date', function($item){
                return format_date($item->end_date);
            })
            ->rawColumns(['branch','title_dashboard'])
            ->make(true);
    }
    public function listRecruitment()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->model->whereDate('end_date', '>=', $today)->get();
    }
    public function getFirstRecruitment()
    {
        return $this->model->orderBy('end_date', 'DESC')->orderBy('id')->first();
    }

    public function pagination($perPage)
    {
        return $this->model->orderBy('end_date', 'DESC')->paginate($perPage);
    }

    public function where($column, $value)
    {
        return $this->model->where($column, $value)->orderBy('end_date', 'DESC');
    }
    public function sameJob($url, $job_category_id)
    {
        return $this->model->where('url', '!=', $url)->where('job_category_id', $job_category_id)->orderBy('end_date', 'DESC')->get();
    }
}
