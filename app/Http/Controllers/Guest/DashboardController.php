<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IExecutiveBoard;
use App\Repositories\Contracts\INews;

class DashboardController extends Controller
{
    protected $executiveBoardRepository;
    protected $newsRepository;

    public function __construct(
        IExecutiveBoard $executiveBoard,
        INews $newsRepository
    ) {
        $this->executiveBoardRepository = $executiveBoard;
        $this->newsRepository = $newsRepository;
    }

    public function index()
    {
        $executiveBoards = $this->executiveBoardRepository->all()->take(5);
        $news_list = $this->newsRepository->all();
        foreach($news_list as $key => $value)
        {
            $news_list[$key]->date = format_date($value->created_at,'d-m-Y');
        }
        return view('front-end.guest.dashboard', ['executiveBoards' => $executiveBoards, 'news_list' => $news_list]);
    }
}
