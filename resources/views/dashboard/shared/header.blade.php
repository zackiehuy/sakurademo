

    <div class="c-wrapper">
      <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
{{--        <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button><a class="c-header-brand d-sm-none" href="#"><img class="c-header-brand" src="{{ url('/assets/brand/coreui-base.svg" width="97" height="46" alt="CoreUI Logo"></a>--}}
        <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
        <?php
            use App\MenuBuilder\FreelyPositionedMenus;
            if(isset($appMenus['top menu'])){
                FreelyPositionedMenus::render( $appMenus['top menu'] , 'c-header-', 'd-md-down-none');
            }
        ?>
        <ul class="c-header-nav ml-auto mr-4">
            <li class="c-header-nav-item dropdown language-menu">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('svg/flag/cif-'.App::getLocale().'.svg')}}" alt="lang">
                    <span class="text-capitalize">{{__('base.'.App::getLocale())}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
{{--                    @if(App::getLocale() !=='en')--}}
{{--                    <a class="c-sidebar-nav-link lang-flag menu-dropdown-element" href="{{url('lang/en')}}">--}}
{{--                         <img src="{{asset('svg/flag/cif-us.svg')}}" alt="lang-en">--}}
{{--                         <span>{{__('base.en')}}</span>--}}
{{--                    </a>--}}
{{--                    @endif--}}
                    @if(App::getLocale() !=='jp')
                    <a class="c-sidebar-nav-link lang-flag menu-dropdown-element" href="{{url('lang/jp')}}">
                        <img src="{{asset('svg/flag/cif-jp.svg')}}" alt="lang-japanese">
                        <span>{{__('base.jp')}}</span>
                    </a>
                    @endif
                    @if(App::getLocale() !=='vi')
                    <a class="c-sidebar-nav-link lang-flag menu-dropdown-element"  href="{{url('lang/vi')}}">
                        <img src="{{asset('svg/flag/cif-vi.svg')}}" alt="lang-viet-nam">
                        <span>{{__('base.vi')}}</span>
                    </a>
                    @endif
                </div>
            </li>
          <li class="c-header-nav-item dropdown">
              <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                  <div class="c-avatar header-avatar">
                      <div class="header-avatar-circle">
                          <span class="header-name">
                              @if(isset(Auth::user()->username))
                                  {{get_avatar(Auth::user()->username)}}
                              @endif
                          </span>
                      </div>
                  </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0 avatar-menu">
                <a href="{{ route('general-settings.get') }}" class="c-sidebar-nav-link menu-dropdown-element {{linkHref('general-settings.get')}}">
                    <i class="icon-setting c-sidebar-nav-icon"></i>
                    <span>{{__('setting.general_setting')}}</span>
                </a>
                <a href="{{ asset('document/user_document.docx') }}" class="c-sidebar-nav-link menu-dropdown-element download-nav-link" download>
                    <i class="fa fa-download icon-download-menu c-sidebar-nav-icon"></i>
                    <span>{{__('base.user_manual')}}</span>
                </a>
                <form action="{{ route('logout') }}" id="formLogoutHeader" method="POST">
                    @csrf
                    <a class="c-sidebar-nav-link menu-dropdown-element" href="javascript:document.getElementById('formLogoutHeader').submit();">
                        <i class="icon-logout c-sidebar-nav-icon"></i>
                        <span>{{__('menu.logout')}}</span>
                    </a>
                </form>
            </div>
          </li>
        </ul>
        <div class="c-subheader px-3">
          <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <?php $segments = ''; ?>
            @for($i = 1; $i <= count(Request::segments()); $i++)
                <?php $segments .= '/'. Request::segment($i); ?>
                @if($i < count(Request::segments()))
                    <li class="breadcrumb-item">{{ Request::segment($i) }}</li>
                @else
                    <li class="breadcrumb-item active">{{ Request::segment($i) }}</li>
                @endif
            @endfor
          </ol>
        </div>
    </header>
