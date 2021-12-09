@if($path)
    <a href="{{url($path)}}" @if(isset($category)) class="link-detail" @endif>{{$title}}</a>
@endif
