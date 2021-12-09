<?php

namespace App\Providers;

use App\Repositories\Contracts\IBranch;
use App\Repositories\Contracts\ICompany;
use App\Repositories\Contracts\IExecutiveBoard;
use App\Repositories\Contracts\IHotline;
use App\Repositories\Contracts\IJob;
use App\Repositories\Contracts\IJobCategory;
use App\Repositories\Contracts\IJobRecruitment;
use App\Repositories\Contracts\ILocation;
use App\Repositories\Contracts\INews;
use App\Repositories\Contracts\IPosition;
use App\Repositories\Contracts\IRecruitmentCategory;
use App\Repositories\Contracts\ISetting;
use App\Repositories\Contracts\IStatusRecruitment;
use App\Repositories\Contracts\IUser;
use App\Repositories\Contracts\IWine;
use App\Repositories\Eloquent\BranchRepository;
use App\Repositories\Eloquent\CompanyRepository;
use App\Repositories\Eloquent\ExecutiveBoardRepository;
use App\Repositories\Eloquent\HotlineRepository;
use App\Repositories\Eloquent\JobCategoryRepository;
use App\Repositories\Eloquent\JobRecruitmentRepository;
use App\Repositories\Eloquent\JobRepository;
use App\Repositories\Eloquent\LocationRepository;
use App\Repositories\Eloquent\NewsRepository;
use App\Repositories\Eloquent\PositionRepository;
use App\Repositories\Eloquent\RecruitmentCategoryRepository;
use App\Repositories\Eloquent\SettingRepository;
use App\Repositories\Eloquent\StatusRecruitmentRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\WineRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IBranch::class, BranchRepository::class);
        $this->app->bind(IJob::class, JobRepository::class);
        $this->app->bind(IJobCategory::class, JobCategoryRepository::class);
        $this->app->bind(IJobRecruitment::class, JobRecruitmentRepository::class);
        $this->app->bind(IRecruitmentCategory::class, RecruitmentCategoryRepository::class);
        $this->app->bind(IExecutiveBoard::class, ExecutiveBoardRepository::class);
        $this->app->bind(IStatusRecruitment::class, StatusRecruitmentRepository::class);
        $this->app->bind(ICompany::class, CompanyRepository::class);
        $this->app->bind(ILocation::class, LocationRepository::class);
        $this->app->bind(IHotline::class, HotlineRepository::class);
        $this->app->bind(INews::class, NewsRepository::class);
        $this->app->bind(IWine::class, WineRepository::class);
        $this->app->bind(IPosition::class, PositionRepository::class);
        $this->app->bind(IUser::class, UserRepository::class);
        $this->app->bind(ISetting::class, SettingRepository::class);
    }
}
