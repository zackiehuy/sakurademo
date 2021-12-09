<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('lib/iziToast/iziToast.min.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('lib/iziToast/iziToast.min.js') }}"></script>
</head>
<body>

<div class="container">
    <h2>Contact form</h2>
    <form action="{{ route('contact.send') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Name:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="{{__('base.name')}}" name="name">
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="">Email:</label>
            <input type="text" class="form-control  @error('email') is-invalid @enderror" placeholder="{{__('base.email')}}" name="email">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="">Message:</label>
            <input type="text" class="form-control  @error('message') is-invalid @enderror" placeholder="{{__('base.message')}}" name="message">
            @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary">{{__('base.send')}}</button>
    </form>
</div>
<script>
    @if (Session::has('flash_message'))
    let level = "{{ Session::get('flash_level') }}";
    let message = "{{ Session::get('flash_message') }}";
    switch (level) {
        case 'success':
            iziToast.success({
                title: 'Message',
                message: message,
                position: 'topRight'
            });
            break;
        case 'warning':
            iziToast.warning({
                title: 'Warning',
                message: message,
                position: 'topRight'
            });
            break;
        case 'error':
            iziToast.error({
                title: 'Error',
                message: message,
                position: 'topRight',
            });
            break;
        default:
            break;
    }
    @endif
</script>
</body>
</html>
