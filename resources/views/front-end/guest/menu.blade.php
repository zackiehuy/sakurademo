<div class="menu-overlay">
    <div class="menu-show">
        <div class="title-home">
            <a href="{{route('homepage')}}">
                <p>{{__('guest.home')}}</p>
            </a>
        </div>
        <div>
            <ul>
                <li class="list-title-special">
                    <a href="{{route('sakura.staff')}}">
                        <p>{{__('guest.staff')}}</p>
                        <i class="mdi mdi-chevron-right"></i>
                    </a>
                </li>
                <li class="list-title">
                    <div class="accordion" id="accordion2">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="{{route('sakura.maintenance')}}">Sakura </a>
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"><i  class="mdi mdi-chevron-down"></i></a>
                            </div>
                            <div id="collapseOne" class="accordion-body collapse show">
                                <div class="accordion-inner">
                                    <ul class="list-child-title">
                                        <li>
                                            <a href="{{route('sakura.business-activities')}}">
                                                <p>{{__('guest.business_activities')}}</p>
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('sakura.guiding-principles')}}">
                                                <p>{{__('guest.guiding_principle')}}</p>
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('sakura.execution-order')}}">
                                                <p>{{__('guest.execution_order')}}</p>
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('recruitment.index')}}">
                                                <p>{{__('guest.recruitment')}}</p>
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-title">
                    <a class="show-all" href="{{route('team1000.homepage')}}">Team 1000 <i class="mdi mdi-chevron-right"></i></a>
                </li>
                <li class="list-title">
                    <a class="show-all" href="{{route('fujione.homepage')}}">Fuji One<i class="mdi mdi-chevron-right"></i></a>
                </li>
            </ul>
        </div>
        <div class="script">
            <p><a href="http://kofu-bldg.co.jp/">甲府ビルサービス株式会社(Japanese Company)</a></p>
        </div>
        <div class="num-phone">
            <p>{{__('guest.tel')}}: (+84) 08-5433-0938 <span>{{__('guest.fax')}}: (+84) 08-5433-0918</span></p>
        </div>
    </div>
</div>
