<?php
/*
    $data = $menuel['elements']
*/

if(!function_exists('renderDropdown')){
    function renderDropdown($data){
        if(array_key_exists('slug', $data) && $data['slug'] === 'dropdown'){
            echo '<li class="c-sidebar-nav-dropdown'. dropdownHref($data['function_href']) .'">';
            echo '<a class="c-sidebar-nav-dropdown-toggle navbar-admin" href="#">';
            if($data['hasIcon'] === true && $data['iconType'] === 'coreui'){
                echo '<i class="' . $data['icon'] . ' c-sidebar-nav-icon"></i>';
            }
            echo __('menu.'.$data['name']) . '</a>';
            echo '<ul class="c-sidebar-nav-dropdown-items">';
            renderDropdown( $data['elements'] );
            echo '</ul></li>';
        }else{
            for($i = 0; $i < count($data); $i++){
                if( $data[$i]['slug'] === 'link'){
                    echo '<li class="c-sidebar-nav-item">';
                    echo '<a class="c-sidebar-nav-link '. linkHref($data[$i]['function_href']) .'" href="' . url($data[$i]['href']) . '">';
                    echo '<span class="c-sidebar-nav-icon"></span>' . __('menu.'.$data[$i]['name']) . '</a></li>';
                }elseif( $data[$i]['slug'] === 'dropdown' ){
                    renderDropdown( $data[$i] );
                }
            }
        }
    }
}
?>


        <div class="c-sidebar-brand" style="background-color: #fff !important;">
            <img class="c-sidebar-brand-full" src="{{ $setting->image ?? '' ? Storage::url('images/setting/image/') . $setting->image : asset("img/sakura.png") }}" width="206" height="17" alt="Sakura Logo">
            <img class="c-sidebar-brand-minimized" src="{{ $setting->logo ?? '' ? Storage::url('images/setting/logo/') . $setting->logo : asset("img/sakura_icon.png") }}" width="118" height="46" alt="Sakura Logo">
        </div>
        <ul class="c-sidebar-nav">
        @if(isset($appMenus['sidebar menu']))
            @foreach($appMenus['sidebar menu'] as $menuel)
                @if($menuel['slug'] === 'link' && $menuel['href'] != '/logout')
                    <li class="c-sidebar-nav-item" @if($menuel['name'] == 'dashboard') style="margin-bottom: 15px" @endif>
                        <a class="c-sidebar-nav-link navbar-admin {{linkHref($menuel['function_href'])}}" href="{{ url($menuel['href']) }}">
                        @if($menuel['hasIcon'] === true)
                            @if($menuel['iconType'] === 'coreui')
                                <i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i>
                            @endif
                        @endif
                        {{ __('menu.'.$menuel['name']) }}
                        </a>
                    </li>
                @elseif($menuel['slug'] === 'link' && $menuel['href'] == '/logout')
                        <li class="c-sidebar-nav-item">
                            <form action="{{ route('logout') }}" id="formLogout" method="POST">
                                @csrf
                                <a class="c-sidebar-nav-link navbar-admin" href="javascript:document.getElementById('formLogout').submit();">
                                    <i class="icon-logout c-sidebar-nav-icon"></i>{{ __('menu.'.$menuel['name']) }}
                                </a>
                            </form>

                        </li>
                @elseif($menuel['slug'] === 'dropdown')
                    <?php renderDropdown($menuel) ?>
                @elseif($menuel['slug'] === 'title')
                    <li class="c-sidebar-nav-title">
                        @if($menuel['hasIcon'] === true)
                            @if($menuel['iconType'] === 'coreui')
                                <i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i>
                            @endif
                        @endif
                            {{ __('menu.'.$menuel['name']) }}
                    </li>
                @endif
            @endforeach
        @endif
        </ul>
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>
