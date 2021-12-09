@extends('front-end.guest.base')
@section('title')
    {{__('guest.business_activities')}}
@endsection
@section('content')
    <div class="link-title wow fadeInLeft">
        <div class="breadcrumbs">
            <a class="c-accordion" href="{{route('sakura.maintenance')}}">{{__('guest.back')}}
                <i class="mdi mdi-chevron-right material-icons float-right"></i>
            </a>
            <p>{{__('guest.business_activities')}}</p>
        </div>
    </div>
    <div class="go-top" title="Top to page">
        <i class="mdi mdi-chevron-up"></i>
    </div>
    <div class="busines-outline">
        <div class="content-outline wow fadeInUp">
            <h2>{{__('guest.business_activities')}}</h2>
            <div class="text-outline">
                <div class="name-company">
                    <p>{{__('guest.company_name')}}<span class="special-name">{{__('guest.sakura_ecology')}}</span></p>
                    <p>{{__('guest.founded')}} <span>{{__('guest.date_founded')}}</span></p>
                    <p>{{__('guest.charter_capital')}} <span>4.369.500.000VND</span></p>
                    <p>{{__('guest.legal_representative')}}<span>SAKAMOTO RYUTA</span></p>
                </div>
                <div class="content-detail">
                    <h5>{{__('guest.main_business_activities')}}</h5>
                    <div class="child-detail-1">
                        <p>{{__('guest.main_business_activities1')}}</p>
                        <p>{{__('guest.main_business_activities2')}}</p>
                    </div>
                    <div class="child-detail-2">
                        <p>{{__('guest.main_business_activities3')}}</p>
                        <p>{{__('guest.main_business_activities4')}}</p>
                        <p>{{__('guest.main_business_activities5')}}</p>
                        <p>{{__('guest.main_business_activities6')}}</p>
                        <p>{{__('guest.main_business_activities7')}}</p>
                    </div>
                    <div class="child-detail-1 child-detail-special ">
                        <p>{{__('guest.main_business_activities8')}}</p>
                        <p class="sub-special">{{__('guest.main_business_activities9')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
