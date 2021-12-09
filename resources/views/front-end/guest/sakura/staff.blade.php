@extends('front-end.guest.base')
@section('title')
    {{__('guest.staff')}}
@endsection
@section('content')
    <div class="link-title wow fadeInLeft">
        <div class="breadcrumbs">
            <a class="c-accordion" href="{{route('sakura.maintenance')}}">{{__('guest.back')}}
                <i class="mdi mdi-chevron-right material-icons float-right"></i>
            </a>
            <p>{{__('guest.staff')}}</p>
        </div>
    </div>
    <div class="go-top" title="Top to page">
        <i class="mdi mdi-chevron-up"></i>
    </div>
    <div class="team-staff-wrap">
        <div class="content-list">
            <h2 class="wow fadeInUp">{{__('guest.staff')}}</h2>
            @foreach($list_branch as $branch)
                <div class="team-staff wow fadeInUp">
                    @if($branch->location->name == 'Hà Nội')
                        {{__('guest.hanoi_team')}}
                    @else
                        {{__('guest.hcm_team')}}
                    @endif
                </div>
                <div class="title-staff">
                    <div class="owl-carousel owl-theme owl-staff">
                        @foreach($branch->executiveBoards as $staff)
                            <div class="staff-item">
                                <img src="{{$staff->image ?? '' ? asset('storage/images/executive_board/'. $staff->image) : ($staff->default_image ?? '' ? asset($staff->default_image) : asset('img/avatar/avatar.jpg'))}}" alt="{{$staff->name}}">
                                <div class="staff-info">
                                    <p>{{$staff->name ?? '' ? $staff->name : $staff->translate('en')->name}}</p>
                                    <div>
                                        {{$staff->job_category['name_'.App::getLocale()]}}
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
