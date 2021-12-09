@if($path)
    <div class="img-wine-coming">
        <img src="{{ asset("$path") }}" alt="" class="img" style="max-width:100px">
        @if($is_new == 1)
            <span class="coming-sake">{{__('guest.coming_soon_sake')}}</span>
        @endif
    </div>
@endif
