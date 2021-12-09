@extends('front-end.guest.base')
@section('title')
    {{__('menu.dashboard')}}
@endsection
@section('logo')
    <a class="team-line-logo" href="{{route('team1000.homepage')}}">
        <img class="logo-main" src="{{asset('guest/images/team-sub-banner-logo.png')}}" alt="Logo-Company">
    </a>
@endsection
@section('company-top') team-top @endsection
@section('company-footer') footer-team @endsection
@section('content')
    <div class="banner-wrap banner-wrap-team">
        <div class="content-banner">
            <div class="wow fadeInLeft text-banner text-banner-sub">
                <h3>{{__('team1000.business')}}</h3>
                <p>{{__('team1000.responsibly')}}</p>
                <div class="box team-page team-button-main">
                    <a href="#link-next" class="button button--winona button--border-thin button--round-s"
                       data-text="{{__('guest.read_more')}}"><span>{{__('guest.read_more')}}</span></a>
                </div>
            </div>
            <div class="image-fuji image-fuji-sub">
                <div class="wow fadeInRight">
                    <img class="team-main" src="{{asset('guest/images/team-sub-banner.png')}}" alt="Banner-Main">
                </div>
                <div class="wow fadeInRight">
                    <img class="team-icon-1" src="{{asset('guest/images/team-1000-11.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="team-icon-2" src="{{asset('guest/images/team-1000-22.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="team-icon-3" src="{{asset('guest/images/team-1000-33.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="team-icon-4" src="{{asset('guest/images/team-4.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="team-icon-5" src="{{asset('guest/images/team-2.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="team-icon-6" src="{{asset('guest/images/team-5.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="team-icon-7" src="{{asset('guest/images/team-6.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="team-icon-8" src="{{asset('guest/images/team-3.png')}}" alt="">
                </div>
            </div>

        </div>
    </div>
    <div class="link-maintence wow fadeInLeft" id="link-next">
        <div class="breadcrumbs-title">
            <a class="c-accordion" href="{{route('homepage')}}">{{__('guest.home')}}
                <i class="mdi mdi-chevron-right material-icons float-right"></i>
            </a>
            <p>{{__('guest.video_production')}}</p>
        </div>
    </div>
    <div class="list-team">
        <div class="row">
            <div class="col-md-4 col-12 team-sub-list">
                <div class="list-team-child wow fadeInUp">
                    <img src="{{asset('guest/images/Shout.png')}}" alt="shout">
                    <p>{{__('guest.visualization_product')}}</p>
                </div>
            </div>
            <div class="col-md-4 col-12 team-sub-list">
                <div class="list-team-child wow fadeInUp">
                    <img src="{{asset('guest/images/Global.png')}}" alt="Global">
                    <p>{{__('guest.building_system')}}</p>
                </div>
            </div>
            <div class="col-md-4 col-12 team-sub-list">
                <div class="list-team-child wow fadeInUp">
                    <img src="{{asset('guest/images/Orbit.png')}}" alt="Orbit">
                    <p>{{__('guest.multilingual_movie')}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="list-work">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="content-work wow fadeInLeft">
                    <p>{{__('guest.team100_introduce1')}}<br>{{__('guest.team100_introduce2')}}<br> {{__('guest.team100_introduce3')}}</p>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <img class="wow fadeInRight" src="{{asset('guest/images/Product-1.png')}}" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-12">
                <img class="wow fadeInLeft" src="{{asset('guest/images/Product-2.png')}}" alt="">
            </div>
            <div class="col-md-6 col-12">
                <div class="content-work wow fadeInRight">
                    <h5>{{__('guest.main_service')}}</h5>
                    <p>-{{__('guest.visualization_product')}}<br>-{{__('guest.building_system')}}<br>-{{__('guest.multilingual_movie')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="content-work wow fadeInLeft">
                    <h5>{{__('guest.strength_advantage')}}</h5>
                    <p>{{__('guest.strength_advantage1') . __('guest.strength_advantage2') . __('guest.strength_advantage3')}}</p>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <img class="wow fadeInRight" src="{{asset('guest/images/Product-3.png')}}" alt="">
            </div>
        </div>
    </div>
    <div class="go-top" title="Top to page">
        <i class="mdi mdi-chevron-up"></i>
    </div>
    <div class="video-team">
        <h2>{{__('guest.past_work')}}</h2>
        <div class="video-list-team">
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="content-video wow fadeInUp">
                        <img src="{{asset('guest/images/video1.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="content-video wow fadeInUp">
                        <img src="{{asset('guest/images/video2.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="content-video wow fadeInUp">
                        <img src="{{asset('guest/images/video3.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div id="image-viewer" style="display: none;">
                <span class="close">&times;</span>
                <div class="modal-content" id="full-image">
                    <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

