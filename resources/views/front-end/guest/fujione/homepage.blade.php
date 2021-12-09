@extends('front-end.guest.base')
@section('title')
    {{__('menu.dashboard')}}
@endsection
@section('logo')
    <a class="team-line-logo" href="{{route('fujione.homepage')}}">
        <img class="logo-main" src="{{asset('guest/images/sake-logo-1.png')}}" alt="Logo-Company">
    </a>
@endsection
@section('company-top') sake-main @endsection
@section('company-footer') footer-sake @endsection
@section('content')
    <div class="fuji-wrap">
        <div class="content-fuji fuji-sake">
            <div class="text-fuji">
                <div class="wow fadeInLeft left-fuji">
                    <h3>{{__('fujione.business')}}</h3>
                    <p>{{__('fujione.introduce')}}<br>{{__('fujione.responsibly')}}</p>
                    <!-- <div class="banner-button">
                      <button name="button" type="button" class="banner-page" id="banner-button">Read more</button>
                    </div> -->
                    <div class="box banner-page">
                        <a href="#link-next" class="button button--winona button--border-thin button--round-s"
                           data-text="{{__('guest.read_more')}}"><span>{{__('guest.read_more')}}</span></a>
                    </div>
                </div>
            </div>
            <div class="image-fuji">
                <div class="wow fadeInRight">
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
                    <img class="sake-8" src="{{asset('guest/images/sake-8.png')}}" alt="">
                </div>
                <div class="wow fadeInRight">
                    <img class="sake-9" src="{{asset('guest/images/sake-9.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="link-maintence wow fadeInLeft" id="link-next">
        <div class="breadcrumbs-title">
            <a class="c-accordion" href="{{route('homepage')}}">{{__('guest.home')}}
                <i class="mdi mdi-chevron-right material-icons float-right"></i>
            </a>
            <p>Sakeyamanashi</p>
        </div>
    </div>
    <div class="sake-text">
        <p class="wow fadeInUp">
            {{__('guest.fujione_introduce1')}}<span>{{__('guest.fuji_one')}}</span> {{__('guest.fujione_introduce2')}}
        </p>
    </div>
    <div class="list-wrap-sake">
        <ul class="child-sake">
            @foreach($wines as $wine)
                <li class="wow fadeInUp">
                    @if($wine->is_new == 1)
                        <div class="image-sake">
                            <img src="{{asset('img/coming-sake.png')}}" alt="">
                            <span class="coming-sake">{{__('guest.coming_soon_sake')}}</span>
                        </div>
                        <div class="year-sake">
                            <p>{{$wine->code}}</p>
                        </div>
                    @else
                        <div class="image-sake">
                            <img src="{{$wine->image ?? '' ? asset('storage/images/wines/'.$wine->image) : ($wine->default_image ?? '' ? asset($wine->default_image) : asset('img/sake_icon.png'))}}" alt="">
                        </div>
                        <div class="year-sake">
                            <p>{{$wine->code}}</p>
                        </div>
                        <p class="name-sake">{{split_sake($wine->name,false)}}</p> <span> {{split_sake($wine->name,true)}}</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <div class="video-sake wow fadeInUp">
        <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY">
        </iframe>
    </div>
    <div class="go-top" title="Top to page">
        <i class="mdi mdi-chevron-up"></i>
    </div>
@endsection
