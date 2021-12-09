<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Repositories\Contracts\INews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{

    protected $newsRepository;

    public function __construct(INews $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->newsRepository->datatable();
        }
        return view('front-end.admin.news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front-end.admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $data = $request->except('_token');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = time().'_'.$file->getClientOriginalName();
            Storage::putFileAs('public/images/news/', $file, $data['image']);
        }
        $this->newsRepository->create($data);
        return redirect()->route('news.index')->with(
            [
                'flash_level' => 'success',
                'flash_message' => trans('base.add_success', ['item' => trans('base.news_header')])
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->newsRepository->find($id);
        if (!isset($data)) {
            return redirect()->route('news.index')->with(
                [
                    'flash_level'   => 'warning',
                    'flash_message' => trans('base.not_existed', ['item' => trans('base.news')])
                ]
            );
        }
        return view(
            'front-end.admin.news.create',
            ['news' => $data ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        $news = $this->newsRepository->find($id);
        if (!isset($news)) {
            return redirect()->route('news.index')->with(
                [
                    'flash_level'   => 'warning',
                    'flash_message' => trans('base.not_existed', ['item' => trans('base.news')])
                ]
            );
        }
        $data = $request->except('_token');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = time().'_'.$file->getClientOriginalName();
            Storage::putFileAs('public/images/news/', $file, $data['image']);
            if (isset($news['image'])) {
                Storage::delete('public/images/news/' . $news['image']);
            }
        }
        $news->update($data);
        return redirect()->route('news.index')->with(
            [
                'flash_level' => 'success',
                'flash_message' => trans('base.update_success', ['item' => trans('base.news_header')])
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = $this->newsRepository->find($id);
        if (!isset($news)) {
            return response()->json(
                [
                    'title' => trans('base.warning'),
                    'status' => '500',
                    "message" => trans('base.not_existed', ['item' => trans('base.news')])
                ]
            );
        }
        if (isset($news['image'])) {
            Storage::delete('public/images/news/' . $news['image']);
        }
        $news->delete();
        return response()->json(
            [
                'title' => trans('base.success'),
                'status' => '200',
                'row_id' => $id,
                "message" => trans('base.delete_success', ['item' => trans('base.news_header')])
            ]
        );
    }
}
