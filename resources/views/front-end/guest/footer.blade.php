<footer class="footer-content  @yield('company-footer')">
    <div class="contact">
        <h2 id="contact">{{__('guest.contact_us')}}</h2>
        <div class="contact-us">
            <div class="footer-wrap">
                @foreach($branch_guest as $key => $value)
                <div class="{{$key ?? 0 ? 'branch-hanoi' : 'branch-hcm'}} wow fadeInUp">
                    @if($key == 0)
                        <h4>SAKURA ECOLOGY CO.,LTD</h4>
                    @endif
                    <p>{{$value->name}}</p>
                    <ul class="{{$key ?? 0 ? 'info-branch-hanoi' : 'info-branch'}}">
                        <li>
                            <a  href="http://maps.google.com/maps?q={{urlencode($value->address)}}" target='_blank'>
                                <i class="mdi mdi-map-marker"></i>
                                <span>{{$value->address}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="tel:(+84){{$value->phone}}">
                                <i class="mdi mdi-phone-classic"></i>
                                <span>{{__('guest.tel')}}: (+84) {{format_phone($value->phone)}}</span>
                            </a>
                        </li>
                        @foreach($value->hotlines as $hotline)
                            <li>
                                <a href="tel:(+84){{$hotline->phone}}">
                                    <i class="mdi mdi-cellphone"></i>
                                    <span>{{__('guest.hotline')}}: {{format_phone($hotline->phone) . ' ' . $hotline->name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
            <div class="form-send wow fadeInUp" >
                <form action="{{ route('contact.send') }}"  method="POST" class="form-info">
                    @csrf
                    <input type="text" name="name" required placeholder="{{__('guest.name')}}:" class="name">
                    <input type="email" name="email" required placeholder="{{__('guest.email')}}:" class="email">
                    <textarea placeholder="{{__('guest.messenger')}}:" name="message" required class="mess" id="message" cols="30" rows="2"></textarea>
                    <div class="box subsend">
                        <button type="submit" class="button button--winona button--border-thin button--round-s"
                                data-text="{{__('guest.send')}}"><span>{{__('guest.send')}}</span></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="us-row">
            <p>Sakura Ecology - - - Copyright 2021</p>
        </div>
    </div>
</footer>
