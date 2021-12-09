@extends('dashboard.authBase')

@section('content')

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card-group">
            <div class="card p-4 card-login">
              <div class="card-body">
                <h1>{{__('auth.login')}}</h1>
                <p class="text-muted">{{__('auth.sign_in')}}</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <svg class="c-icon">
                          <use xlink:href="{{asset('assets/icons/coreui/free-symbol-defs.svg#cui-user')}}"></use>
                        </svg>
                      </span>
                    </div>
                    <input class="form-control" type="text" placeholder="{{__('auth.username')}}" name="username" value="{{ old('username') }}" required autofocus>
                    </div>
                    <div class="input-group mb-4">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <svg class="c-icon">
                          <use xlink:href="{{asset('assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked')}}"></use>
                        </svg>
                      </span>
                    </div>
                    <input class="form-control" type="password" placeholder="{{__('auth.password')}}" name="password" required>
                    </div>
                    <div class="row">
                    <div class="col-6">
                        <button class="btn btn-download px-4" type="submit">{{__('auth.login')}}</button>
                    </div>
                    </form>
                    <div class="col-6 text-right">
                        <a href="{{ route('password.request') }}" class="btn btn-link px-0 link-forgot" >{{__('auth.forgot_password')}}</a>
                    </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('javascript')

@endsection
