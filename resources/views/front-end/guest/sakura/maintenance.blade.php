@extends('front-end.guest.base')
@section('title')
    {{__('guest.maintenance')}}
@endsection
@section('content')
    <div class="banner-wrap banner-wrap-team">
        <div class="content-banner content-sakura">
            <div class="text-banner">
                <div class="wow fadeInLeft full-text">
                    <h3>{{__('sakura.business')}}</h3>
                    <p>{{__('sakura.quote')}}<br>{{__('sakura.introduce') . ' ' . __('sakura.responsibly') }}</p>
                    <div class="box">
                        <a href="#link-next" class="button button--winona button--border-thin button--round-s"
                           data-text="{{__('guest.read_more')}}"><span>{{__('guest.read_more')}}</span></a>
                    </div>
                </div>
            </div>
            <div class="image-fuji">
                <div class="wow fadeInRight">
                    <img class="sakura-banner" src="{{asset('guest/images/Banner-Main.png')}}" alt="Banner-Main">
                </div>
                <div class="wow fadeInRight">
                    <img class="sakura-icon-1" src="{{asset('guest/images/Banner-Sub-5.png')}}" alt="Banner-Main">
                </div>
                <div class="wow fadeInRight">
                    <img class="sakura-icon-2" src="{{asset('guest/images/Banner-Sub-6.png')}}" alt="Banner-Main">
                </div>
                <div class="wow fadeInRight">
                    <img class="sakura-icon-3" src="{{asset('guest/images/Banner-Sub-2.png')}}" alt="Banner-Main">
                </div>
                <div class="wow fadeInRight">
                    <img class="sakura-icon-4" src="{{asset('guest/images/Banner-Sub-1.png')}}" alt="Banner-Main">
                </div>
                <div class="wow fadeInRight">
                    <img class="sakura-icon-5" src="{{asset('guest/images/Banner-Sub-4.png')}}" alt="Banner-Main">
                </div>
                <div class="wow fadeInRight" >
                    <img class="sakura-icon-6" src="{{asset('guest/images/Banner-Sub-3.png')}}" alt="Banner-Main">
                </div>
            </div>
        </div>
    </div>
    <div class="link-maintence wow fadeInLeft" id="link-next">
        <div class="breadcrumbs-title">
            <a class="c-accordion" href="{{route('homepage')}}">{{__('guest.home')}}
                <i class="mdi mdi-chevron-right material-icons float-right"></i>
            </a>
            <p>{{__('guest.maintenance')}}</p>
        </div>
    </div>
    <div class="manners">
        <div class="content-manners">
            <div class="title-manners">
                @if(App::getLocale() == 'vi')
                    <h2><span>{{__('guest.rule_1')}}</span> {{__('guest.rule_2')}} <span>{{__('guest.rule_3')}}</span> {{__('guest.rule_4')}}</h2>
                @else
                    <h2>{{__('guest.rule_1')}} <span>{{__('guest.rule_2')}}</span> {{__('guest.rule_3')}} <span>{{__('guest.rule_4')}}</span></h2>
                @endif
            </div>
            <div class="body-manners">
                <div class="wow fadeInLeft manner-img">
                    <img src="{{asset('guest/images/manner-1.png')}}" alt="">
                </div>
                <div class="text-manners wow fadeInUp">
                    <p>{{__('guest.rule_detail')}}</p>
                    <img class="manner-rules" src="{{asset('guest/images/Banner-Rules.png')}}" alt="Banner-Rules">
                </div>
                <div class="wow fadeInRight manner-img-1">
                    <img src="{{asset('guest/images/manner-2.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="go-top" title="Top to page">
        <i class="mdi mdi-chevron-up"></i>
    </div>
    <div class="service-wrap">
        <div class="content-service">
            <h2 class="wow fadeInUp">{{__('guest.our_services')}}</h2>
            <div class="text-service">
                <div class="row">
                    <div class="col-md-6 col-12 maintance-sub">
                        <div class="child-service text-facility wow fadeInUp">
                            <img src="{{asset('guest/images/Facilities-Management.png')}}" alt="Facilities-Management">
                            <div class="content-facilities">
                                <h5>{{__('guest.facilities_management')}}</h5>
                                <p>{{__('guest.facilities_management_rule')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 maintance-sub">
                        <div class="child-service text-hygiene wow fadeInUp">
                            <img src="{{asset('guest/images/Hygiene-Management.png')}}" alt="hygiene-Management">
                            <div class="content-facilities">
                                <h5>{{__('guest.hygiene_management')}}</h5>
                                <p>{{__('guest.hygiene_management_rule1') . ' ' .  __('guest.hygiene_management_rule2')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 maintance-sub">
                        <div class="child-service text-green wow fadeInUp">
                            <img src="{{asset('guest/images/Green-Tree-Management.png')}}" alt="Green-Tree-Management">
                            <div class="content-facilities">
                                <h5>{{__('guest.green_tree_management')}}</h5>
                                <p>{{__('guest.green_tree_management_rule')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 maintance-sub">
                        <div class="child-service text-pest wow fadeInUp">
                            <img src="{{asset('guest/images/Pest-Control.png')}}" alt="Pest-Control">
                            <div class="content-facilities">
                                <h5>{{__('guest.pest_control')}}</h5>
                                <p>{{__('guest.pest_control_rule1')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="protection-wrap wow fadeInUp">
        <div class="protection">
            <h5>{{__('guest.protection_profession')}}</h5>
            <p>{{__('guest.protection_profession_rule')}}</p>
            <div class="box protection-button">
                <a class="button button--winona button--border-thin button--round-s" href="#"
                   data-text="{{__('guest.read_more')}}"><span>{{__('guest.read_more')}}</span></a>
            </div>
        </div>
    </div>
    <div class="about-wrap">
        <div class="contents-about">
            <h2 class="wow fadeInUp">{{__('guest.about_us')}}</h2>
            <div class="text-about">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="about-item wow fadeInUp">
                            <a href="{{route('sakura.business-activities')}}">
                                <img class="business-img build-item-img" src="{{asset('guest/images/Business-Activities.png')}}" alt="Business-Activities">
                                <div class="child-text">
                                    <p>{{__('guest.business_activities')}}</p>
                                    <div class="next">
                                        <img src="{{asset('guest/images/nextpage.png')}}" class="buss-text-img" alt="Nextpage">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="about-item wow fadeInUp">
                            <a href="{{route('sakura.guiding-principles')}}">
                                <img class="business-img" src="{{asset('guest/images/Guilding-Priciple.png')}}" alt="Guilding-Priciple">
                                <div class="child-text">
                                    <p>{{__('guest.guiding_principle')}}</p>
                                    <div  class="next">
                                        <img src="{{asset('guest/images/nextpage.png')}}" alt="Nextpage">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="about-item wow fadeInUp">
                            <a href="{{route('sakura.execution-order')}}">
                                <img class="business-img build-item-img" src="{{asset('guest/images/Execution-Order.png')}}" alt="Execution-Order">
                                <div class="child-text">
                                    <p>{{__('guest.execution_order')}}</p>
                                    <div class="next">
                                        <img src="{{asset('guest/images/nextpage.png')}}" class="buss-text-img" alt="Nextpage">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
