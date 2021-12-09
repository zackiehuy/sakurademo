@extends('front-end.guest.base')
@section('title')
    {{__('guest.guiding_principle')}}
@endsection
@section('content')
    <div class="link-title wow fadeInLeft">
        <div class="breadcrumbs">
            <a class="c-accordion" href="{{route('sakura.maintenance')}}">{{__('guest.back')}}
                <i class="mdi mdi-chevron-right material-icons float-right"></i>
            </a>
            <p>{{__('guest.guiding_principle')}}</p>
        </div>
    </div>
    <div class="go-top" title="Top to page">
        <i class="mdi mdi-chevron-up"></i>
    </div>
    <div class="guiding-wrap">
        <div class="content-guiding">
            <h2 class="wow fadeInUp">{{__('guest.guiding_principle')}}</h2>
            <div class="row-principles">
                <div class="principles-image wow fadeInLeft">
                    <img src="{{asset('guest/images/Guilding-Priciple-sub.png')}}" alt="Guilding Priciple">
                </div>
                <div class="colprinciples-1 wow fadeInRight">
                    {{__('guest.sakura_introduce1') .  __('guest.sakura_introduce2') . __('guest.sakura_introduce3')}}
                </div>
            </div>
            <div class="main-guiding wow fadeInUp">
                <div class="name-title">
                    <h4>{{__('guest.why_choose_us')}}</h4>
                </div>
                <div class="row-management">
                    <div class="guiding-principles">
                        <h2 class="desktop">{{__('guest.management_policy')}}<br>{{__('guest.create_valuable_space')}}</h2>
                        <h2 class="mobile">{{__('guest.management_policy') . ' ' . __('guest.create_valuable_space')}}</h2>
                    </div>
                    <div class="principles-detail">
                        <ul>
                            <li>{{__('guest.commitment')}}</li>
                            <li>{{__('guest.commitment1')}}</li>
                            <li>{{__('guest.commitment2')}}</li>
                            <li>{{__('guest.commitment3')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
