@extends('front-end.guest.base')
@section('title')
    {{__('guest.execution_order')}}
@endsection
@section('content')
    <div class="link-title wow fadeInLeft">
        <div class="breadcrumbs">
            <a class="c-accordion" href="{{route('sakura.maintenance')}}">{{__('guest.back')}}
                <i class="mdi mdi-chevron-right material-icons float-right"></i>
            </a>
            <p>{{__('guest.execution_order')}}</p>
        </div>
    </div>
    <div class="go-top" title="Top to page">
        <i class="mdi mdi-chevron-up"></i>
    </div>
    <div class="order-wrap">
        <div class="content-order">
            <h2 class="wow fadeInUp">{{__('guest.execution_order')}}</h2>
            <div class="execution-text wow fadeInUp">
                {{__('guest.register')}}
            </div>
            <ul class="execution-list">
                <li class="wow fadeInUp">
                    <div class="execution-item">
                        <div class="execution-img">
                            <img src="{{asset('guest/images/Icon-Execution-1.png')}}" alt="Icon-Execution-1">
                        </div>
                        <p><span>1.</span> {{__('guest.receive_info')}}</p>
                    </div>
                </li>
                <li class="wow fadeInUp">
                    <div class="execution-item">
                        <div class="execution-img">
                            <img src="{{asset('guest/images/Icon-Execution-2.png')}}" alt="Icon-Execution-2">
                        </div>
                        <p><span>2.</span> {{__('guest.fact_investigation')}}</p>
                    </div>
                </li>
                <li class="wow fadeInUp">
                    <div class="execution-item">
                        <div class="execution-img">
                            <img src="{{asset('guest/images/Icon-Execution-3.png')}}" alt="Icon-Execution-3">
                        </div>
                        <p><span>3.</span> {{__('guest.conduct_experiment')}}</p>
                    </div>
                </li>
                <li class="wow fadeInUp">
                    <div class="execution-item">
                        <div class="execution-img">
                            <img src="{{asset('guest/images/Icon-Execution-4.png')}}" alt="Icon-Execution-4">
                        </div>
                        <p><span>4.</span> {{__('guest.confirm_implementation')}}</p>
                    </div>
                </li>
                <li class="wow fadeInUp">
                    <div class="execution-item">
                        <div class="execution-img">
                            <img src="{{asset('guest/images/Icon-Execution-5.png')}}" alt="Icon-Execution-5">
                        </div>
                        <p><span>5.</span> {{__('guest.contract_signature')}}</p>
                    </div>
                </li>
                <li class="wow fadeInUp">
                    <div class="execution-item">
                        <div class="execution-img">
                            <img src="{{asset('guest/images/Icon-Execution-6.png')}}" alt="Icon-Execution-6">
                        </div>
                        <p><span>6.</span> {{__('guest.deploy_work')}}</p>
                    </div>
                </li>
                <li class="wow fadeInUp">
                    <div class="execution-item">
                        <div class="execution-img">
                            <img src="{{asset('guest/images/Icon-Execution-7.png')}}" alt="Icon-Execution-7">
                        </div>
                        <p><span>7.</span> {{__('guest.follow_up')}}</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection
