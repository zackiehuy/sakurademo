<header>
    <div id="header-wrapper" class=" header-wrapper" role="main">
        <div class="row-header">
            <nav class="navbar navbar-expand-lg navbar-light justify-content-center">
                <div class="row justify-content-between content-main menu-header">
                    <div class="col-md-6 col-11">
                        <div class="text-desktop">
                            <a href="http://kofu-bldg.co.jp/">甲府ビルサービス株式会社(Japanese Company)<span class="line-1"> |
                            </span></a>
                            <a class="recruitment-name" href="{{route('recruitment.index')}}">{{__('guest.recruitment')}}</a>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    En
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Ja</a></li>
                                    <li><a class="dropdown-item" href="#">Vn</a></li>
                                </ul>
                            </div>
                        </div>
                        @if(View::hasSection('logo'))
                            @yield('logo')
                        @else
                            <a class="team-line-logo" href="{{route('sakura.maintenance')}}">
                                <img class="logo-main" src="{{asset('guest/images/Logo-Company.png')}}" alt="Logo-Company">
                            </a>
                        @endif
                    </div>
                    <div class="col-md-6 col-1">
                        <div class="menu-drop">
                            <div class="home-lang">
                                <a class="lang" href="#">{{__('guest.'.App::getLocale())}}
                                    <i class="mdi mdi-chevron-down"></i>
                                    <ul class="lang-menu">
                                        @if(App::getLocale() !=='en')
                                            <li><a href="{{url('lang/en')}}">{{__('guest.en')}}</a></li>
                                        @endif
                                        @if(App::getLocale() !=='jp')
                                            <li><a href="{{url('lang/jp')}}">{{__('guest.jp')}}</a></li>
                                        @endif
                                        @if(App::getLocale() !=='vi')
                                            <li><a href="{{url('lang/vi')}}">{{__('guest.vi')}}</a></li>
                                        @endif
                                    </ul>
                                </a>
                            </div>
                            <div class="icon-menu">
                                <label class="icon-main show-menu-btn"><i class="mdi mdi-menu"></i></label>
                                <label class="icon-main hide-menu-btn"><i class="mdi mdi-close"></i></label>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
