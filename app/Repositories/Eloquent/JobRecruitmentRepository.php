<?php


namespace App\Repositories\Eloquent;

use App\Models\JobRecruitment;
use App\Repositories\Contracts\IJobRecruitment;
use Carbon\Traits\Date;
use Illuminate\Support\Str;

class JobRecruitmentRepository extends BaseRepository implements IJobRecruitment
{
    public function model()
    {
        return JobRecruitment::class;
    }

    public function datatableRecruitment($id, $request)
    {
        $query = $this->model->where('job_id', $id)->orderBy('read_at')->orderBy('id')->get();
        return datatables()->of($query)
            ->addIndexColumn()
            ->filter(
                function ($instance) use ($request) {
                    if (!empty($request->get('read_at'))) {
                        $instance->collection = $instance->collection->filter(
                            function ($row) use ($request) {
                                $read_at = $row['read_at'];
                                if ($request->read_at == 1) {
                                    return $read_at == null;
                                } elseif ($request->read_at == 2) {
                                    return $read_at != null;
                                } else {
                                    return false;
                                }
                            }
                        );
                    }
                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(
                            function ($row) use ($request) {
                                if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
                                    return true;
                                } elseif (Str::contains(Str::lower($row['email']), Str::lower($request->get('search')))) {
                                    return true;
                                } elseif (Str::contains(Str::lower($row['phone']), Str::lower($request->get('search')))) {
                                    return true;
                                }
                                return false;
                            }
                        );
                    }
                }
            )
            ->addColumn('status', function ($item) {
//                $status = 'Chờ phản hồi';
                $status = 'Chưa xem';
                $color = 'primary';
                if ($item->read_at != null) {
                    $status = 'Đã xem';
                    $color = 'success';
                }
                return recruitment_status($status, $color);
            })
            ->editColumn('cv', function ($item) {
                return asset("storage/cv/job/".$item->job['id']."/".$item->cv);
                return '<a src="'. $path .'" download><i class="fa fa-download" aria-hidden="true"></i></a>';
            })
            ->editColumn('created_at', function ($item) {
                return format_date($item->created_at, 'Y.m.d H:i:s');
            })
            ->addColumn('date_submitted', function ($item) {
                return format_date($item->created_at);
            })
            ->addColumn('mail_to', function ($item) {

                return '<a href="mailto:'. $item->email .'">'. $item->email .'</a>';
            })
            ->editColumn('is_male', function ($item) {
                if ($item->is_male == 0) {
                    return 'Nữ';
                } else {
                    return 'Nam';
                }
            })
            ->rawColumns(['mail_to'])
            ->make(true);
    }
}
