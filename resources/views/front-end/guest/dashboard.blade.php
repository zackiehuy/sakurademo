@extends('front-end.guest.base')
@section('title')
    {{__('guest.home')}}
@endsection
@section('logo')

@endsection
@section('content')
    <div class="banner-wrap">
        <div class="content-banner">
            <div class="text-banner">
                <div class="wow fadeInLeft full-text">
                    <img class="logo-banner-main" src="{{asset('guest/images/Logo-Company.png')}}" alt="Logo-Company">
                    <h3>{{__('sakura.business')}}</h3>
                    <p>{{__('sakura.quote')}}<br>{{__('sakura.introduce') . ' ' . __('sakura.responsibly') }}</p>
                    <!-- <div class="fuji-button">
                      <button name="button" type="button" class="fuji-page" id="fuji-button">Read more</button>
                    </div> -->
                    <div class="box">
                        <a href="{{route('sakura.maintenance')}}" class="button button--winona button--border-thin button--round-s"
                           data-text="{{__('guest.read_more')}}"><span>{{__('guest.read_more')}}</span></a>
                    </div>
                </div>
            </div>
            <div class="image-fuji">
                <div class="wow fadeInRight" >
                    <img src="{{asset('guest/images/Banner-Main.png')}}" alt="Banner-Main">
                </div>
                <div class="wow fadeInRight" >
                    <img class="sakura-icon-1" src="{{asset('guest/images/Banner-Sub-5.png')}}" alt="Banner-Main">
                </div>
                <div class="wow fadeInRight" >
                    <img class="sakura-icon-2" src="{{asset('guest/images/Banner-Sub-6.png')}}" alt="Banner-Main">
                </div>
                <div class="wow fadeInRight">
                    <img class="sakura-icon-3" src="{{asset('guest/images/Banner-Sub-2.png')}}" alt="Banner-Main">
                </div>
                <div class="wow fadeInRight" >
                    <img class="sakura-icon-4" src="{{asset('guest/images/Banner-Sub-1.png')}}" alt="Banner-Main">
                </div>
                <div class="wow fadeInRight" >
                    <img class="sakura-icon-5" src="{{asset('guest/images/Banner-Sub-4.png')}}" alt="Banner-Main">
                </div>
                <div class="wow fadeInRight" >
                    <img class="sakura-icon-6" src="{{asset('guest/images/Banner-Sub-3.png')}}" alt="Banner-Main">
                </div>
            </div>
        </div>
    </div>
    <div class="team-wrap">
        <div class="content-team">
            <div class="image-team">
                <div class="wow fadeInLeft" data-wow-duration="1s" data-wow-offset="400">
                    <img class="team-icon-banner" src="{{asset('guest/images/Banner-Team-1000.png')}}" alt="Banner-Team-1000">
                </div>
                <div class="wow fadeInLeft">
                    <img class="team-icon-1" src="{{asset('guest/images/Team-1000-1.png')}}" alt="">
                </div>
                <div class="wow fadeInLeft">
                    <img class="team-icon-2" src="{{asset('guest/images/Team-1000-2.png')}}" alt="">
                </div>
                <div class="wow fadeInLeft">
                    <img class="team-icon-3" src="{{asset('guest/images/Team-1000-3.png')}}" alt="">
                </div>
                <div class="wow fadeInLeft">
                    <img class="team-icon-4" src="{{asset('guest/images/team-4.png')}}" alt="">
                </div>
                <div class="wow fadeInLeft">
                    <img class="team-icon-5" src="{{asset('guest/images/team-2.png')}}" alt="">
                </div>
                <div class="wow fadeInLeft">
                    <img class="team-icon-6" src="{{asset('guest/images/team-5.png')}}" alt="">
                </div>
                <div class="wow fadeInLeft">
                    <img class="team-icon-7" src="{{asset('guest/images/team-6.png')}}" alt="">
                </div>
                <div class="wow fadeInLeft">
                    <img class="team-icon-8" src="{{asset('guest/images/team-3.png')}}" alt="">
                </div>
            </div>
            <div class="text-team">
                <div class="wow fadeInRight right-team" data-wow-offset="350">
                    <img class="logo-team" src="{{asset('guest/images/Logo-Team-1000.png')}}" alt="Logo-Team-1000">
                    <h3>{{__('team1000.business')}}</h3>
                    <p>{{__('team1000.responsibly')}}</p>
                    <!-- <div class="team-button">
                      <button name="button" type="button" class="team-page" >Read more</button>
                    </div> -->
                    <div class="box team-page">
                        <a href="{{route('team1000.homepage')}}" class="button button--winona button--border-thin button--round-s" id="team"
                           data-text="{{__('guest.read_more')}}"><span>{{__('guest.read_more')}}</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fuji-wrap">
        <div class="content-fuji">
            <div class="text-fuji">
                <div class="wow fadeInLeft left-fuji" data-wow-offset="200">
                    <img class="logo-fujione" src="{{asset('guest/images/Logo-Fuji-One.png')}}" alt="Logo-Fuji-One">
                    <h3>{{__('fujione.business')}}</h3>
                    <p>{{__('fujione.introduce')}}<br>{{__('fujione.responsibly')}}</p>
                    <!-- <div class="banner-button">
                      <button name="button" type="button" class="banner-page" id="banner-button">Read more</button>
                    </div> -->
                    <div class="box banner-page">
                        <a href="{{route('fujione.homepage')}}" class="button button--winona button--border-thin button--round-s"
                           data-text="{{__('guest.read_more')}}"><span>{{__('guest.read_more')}}</span></a>
                    </div>
                </div>
            </div>
            <div class="image-fuji">
                <div class="wow fadeInRight" data-wow-duration="1s" data-wow-offset="300">
                    <img class="fuji-icon-banner" src="{{asset('guest/images/sake-banner.png')}}" alt="Banner-Fuji-One">
                </div>
                <div class="wow fadeInRight">
                    <img class="fuji-icon-main" src="{{asset('guest/images/banner-sake.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="fuji-icon-1" src="{{asset('guest/images/Banner-Fuji-One-1.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="fuji-icon-2" src="{{asset('guest/images/Banner-Fuji-One-2.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="fuji-icon-3" src="{{asset('guest/images/Banner-Fuji-One-3.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="sake-1" src="{{asset('guest/images/sake-1.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="sake-2" src="{{asset('guest/images/sake-2.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="sake-3" src="{{asset('guest/images/sake-3.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="sake-4" src="{{asset('guest/images/sake-4.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="sake-5" src="{{asset('guest/images/sake-5.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="sake-6" src="{{asset('guest/images/sake-6.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="sake-7" src="{{asset('guest/images/sake-7.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="sake-8" src="{{asset('guest/images/sake-8.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="sake-9" src="{{asset('guest/images/sake-9.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="staff-wrap wow fadeInUp" data-wow-offset="400">
        <div class="staff">
            <h2>{{__('guest.staff')}}</h2>
            <div class="staff-content">
                <div class="owl-carousel owl-theme owl-staff-list">
                    @foreach($executiveBoards as $executiveBoard)
                        <div class="staff-item">
                            <img src="{{$executiveBoard->image ?? '' ? asset('storage/images/executive_board/'. $executiveBoard->image) : ($executiveBoard->default_image ?? '' ? asset($executiveBoard->default_image) : asset('img/avatar/avatar.jpg'))}}" alt="{{$executiveBoard->name}}">
                            <div class="staff-info">
                                <p>{{$executiveBoard->name ?? '' ? $executiveBoard->name : $executiveBoard->translate('en')->name}}</p>
                                <span>{{$executiveBoard->job_category['name_'.App::getLocale()]}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- <div class="staff-add">
                  <button name="button" type="button" class="staff-page" id="staff-add">list staff</button>
                </div> -->
                <div class="box staff-page">
                    <a href="{{route('sakura.staff')}}" class="button button--winona button--border-thin button--round-s one-change"
                       data-text="{{__('guest.staff_list')}}"><span>{{__('guest.staff_list')}}</span></a>
                    <a href="{{route('sakura.staff')}}" class="button button--winona button--border-thin button--round-s two-changes"
                       data-text="{{__('guest.read_more')}}"><span>{{__('guest.read_more')}}</span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="news wow fadeInUp" data-wow-offset="410">
        <h2 id="news">{{__('guest.news')}}</h2>
        <div class="news-list">
            @if(isset($news_list[0]))
                <div class="news-item">
                    <img src="{{$news_list[0]->image ?? '' ? asset('/storage/images/news/'.$news_list[0]->image) : ($news_list[0]->default_image ?? '' ? asset($news_list[0]->default_image) : asset('img/no-image.jpg'))}}" alt="images about news">
                    <div class="news-info">
                        @if($news_list[0]->title != null)
                            <h5>{{$news_list[0]->title}}</h5>
                        @else
                            <h5>{{$news_list[0]->translate('vi')->title}}</h5>
                        @endif
                        <strong class="time">{{$news_list[0]->date}}</strong>
                        @if($news_list[0]->abstract != null)
                            <p>{{$news_list[0]->abstract}}</p>
                        @else
                            <p>{{$news_list[0]->translate('vi')->abstract}}</p>
                        @endif
                    </div>
                </div>
            @endif
            <div class="news-list-child">
                @foreach($news_list as $key => $news)
                    <div class="news-item-sub" onclick="changeNews({{$news}})" id="row-{{$news->id}}">
                        <img src="{{$news->image ?? '' ? asset('/storage/images/news/'.$news->image) : ($news->default_image ?? '' ? asset($news->default_image) : asset('img/no-image.jpg'))}}" alt="images about news">
                        <div class="news-info infor-news">
                            @if($news->title != null)
                                <h5>{{$news->title}}</h5>
                            @else
                                <h5>{{$news->translate('vi')->title}}</h5>
                            @endif
                            <strong class="time">{{$news->date}}</strong>
                            @if($news->abstract != null)
                                <p>{{$news->abstract}}</p>
                            @else
                                <p>{{$news->translate('vi')->abstract}}</p>
                            @endif
                        </div>
                        <div class="overlay" @if($key == 0) style="opacity: 1" @endif></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="logo-wrap wow fadeInUp" data-wow-offset="400">
        <div class="content-logo contents-wrap">
            <h2>{{__('guest.business_partner')}}</h2>
            <div class="owl-carousel owl-theme owl-logo">
                <div class="item">
                    <img src="{{asset('guest/images/Toshiba.png')}}" alt="Logo Toshiba company">
                </div>
                <div class="item">
                    <img src="{{asset('guest/images/Shirai.png')}}" alt="Logo Shirai company">
                </div>
                <div class="item">
                    <img src="{{asset('guest/images/Bidv.png')}}" alt="Logo Bidv company">
                </div>
                <div class="item">
                    <img src="{{asset('guest/images/Yakult.png')}}" alt="Logo Yakult company">
                </div>
                <div class="item">
                    <img src="{{asset('guest/images/Koikeya.png')}}" alt="Logo Koikeya company">
                </div>
                <div class="item">
                    <img src="{{asset('guest/images/Sapporo.png')}}" alt="Logo Sapporo company">
                </div>
                <div class="item">
                    <img src="{{asset('guest/images/Visaho.png')}}" alt="Logo Visaho company">
                </div>
                <div class="item">
                    <img src="{{asset('guest/images/Nidec.png')}}" alt="Logo Nidec company">
                </div>
                <div class="item">
                    <img src="{{asset('guest/images/Nova-Land.png')}}" alt="Logo Nova-Land company">
                </div>
                <div class="item">
                    <img src="{{asset('guest/images/Capital-Land.png')}}" alt="Logo Capital-Land company">
                </div>
                <div class="item">
                    <img src="{{asset('guest/images/Aeon-Delight.png')}}" alt="Logo Aeon-Delight company">
                </div>
                <div class="item">
                    <img src="{{asset('guest/images/Suzuki.png')}}" alt="Logo Suzuki company">
                </div>
                <div class="item">
                    <img src="{{asset('guest/images/Daiwa-House.png')}}" alt="Logo Daiwa-House company">
                </div>
                <div class="item">
                    <img src="{{asset('guest/images/Fpt.png')}}" alt="Logo Fpt company">
                </div>
                <div class="item">
                    <img src="{{asset('guest/images/Rcg.png')}}" alt="Logo Rcg company">
                </div>
            </div>
        </div>
    </div>
    <div class="go-top" title="Top to page">
        <i class="mdi mdi-chevron-up"></i>
    </div>
@endsection

