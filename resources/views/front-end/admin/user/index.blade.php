@extends('dashboard.base')
@section('title')
    {{__('base.user')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline thead-light list-item">
                            <div class="card-header ">
                                <span class="lead bold-text" >
                                    @if(App::getLocale() == 'vi')
                                        {{__('base.list')}} {{__('base.user_header')}}
                                    @else
                                        {{__('base.user')}}{{__('base.list')}}
                                    @endif
                                </span>
                                <button
                                    class="btn btn-create float-right px-2 py-1"
                                    onclick="checkUser(-1)"
                                    data-toggle="modal"
                                    data-target="#createUser">
                                    <i class="fa fa-plus"></i>
                                    @if(App::getLocale() == 'vi')
                                        {{__('base.create')}} {{__('base.user_header')}}
                                    @else
                                        {{__('base.user')}}{{__('base.create')}}
                                    @endif
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="table-search">
                                        <input type="search" id="table-search" name="list-user" class="col-8 form-control form-control-sm" placeholder="{{__('base.search')}}">
                                    </div>
                                    <table id="list-user"
                                           class="table table-bordered table-hover table-striped"
                                           style="width: 100%">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>{{__('base.stt')}}</th>
                                            <th>{{__('base.name')}}</th>
                                            <th>{{__('user.username')}}</th>
                                            <th>{{__('user.email')}}</th>
                                            <th>{{__('base.created_at')}}</th>
                                            <th style="width: 68.8px">{{__('base.action')}}</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            Delete modal--}}
            <div class="modal fade" id="confirmDeleteItem" tabindex="-1" role="dialog" aria-labelledby="modelLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{__('base.delete_confirm')}}
                        </div>
                        <div id="confirmMessage" class="modal-body">
                            {{__('base.delete_message',['item' => __('base.user_header')])}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnConfirmDelete" class="btn btn-delete btn-ok"
                                    onclick="deleteItem($(this).val())">
                                {{__('base.delete')}}
                            </button>
                            <button type="button" id="confirmCancel" class="btn btn-secondary" data-dismiss="modal"
                                    data-toggle="modal" data-target="#confirmDeleteItem">
                                {{__('base.cancel')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
{{--            Edit & Create--}}
            <div class="modal fade"
                 id="createUser"
                 tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 data-backdrop="static"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" >
                        <div class="modal-header card-header" id="nameForm">
                            {{__('base.create'). ' ' .__('base.user')}}
                        </div>
                        <form id="formUser" role="form" method="post"  enctype="multipart/form-data" action="{{url('admin/users')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group bmd-form-group label-input ">
                                    <label class="bmd-label-user" for="name">{{__('user.name')}}</label>
                                    <input type="text"
                                           class="form-control"
                                           required name="name"
                                           id="nameUser"
                                           placeholder="{{__('user.name_input')}}"
                                           value="{{ old('name') }}">
                                </div>
                                <div class="form-group bmd-form-group label-input ">
                                    <label class="bmd-label-user" for="image">{{__('user.email')}}</label>
                                    <input type="file"
                                           class="form-control"
                                           required name="email"
                                           id="emailUser"
                                           placeholder="{{__('user.email_input')}}"
                                           value="{{ old('image') }}">
                                </div>
                                <div class="form-group bmd-form-group label-input ">
                                    <label class="bmd-label-user" for="position">{{__('user.password')}}</label>
                                    <input type="password"
                                           class="form-control"
                                           required name="password"
                                           id="password"
                                           placeholder="{{__('user.password_input')}}"
                                           value="{{ old('position') }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('user.close')}}</button>
                                <button type="submit" class="btn btn-create" id="btnExecutiveBoard">{{__('user.create')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Change password--}}
            <div class="modal fade"
                 id="changePassword"
                 tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 data-backdrop="static"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" >
                        <div class="modal-header card-header" id="wsq">
                            <span class="bold-text">{{__('user.change_password')}}</span>
                            <span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>
                        </div>
                        <form id="formPassword" role="form" method="post"  enctype="multipart/form-data" action="{{url('admin/users')}}">
                            @csrf
{{--                            {{ method_field('PUT') }}--}}
                            <div class="modal-body">
                                <div class="form-group bmd-form-group label-input ">
                                    <div class="bmd-label-user" for="password">{{__('user.password')}}<span class="required-input">*</span></div>
                                    <label class="required-field required-among"  for="name_vi"><span class="required-input">*</span>{{ __('user.password_at_least') }}</label>
                                    <input type="password"
                                           class="form-control"
                                           name="password"
                                           id="passwordUser"
                                           placeholder="{{__('user.password_input')}}"
                                           onkeyup="keyUpError(this)"
                                           value="{{ old('password') }}">
                                    <span class="error-user text-danger password"></span>
                                </div>
                                <div class="form-group bmd-form-group label-input ">
                                    <label class="bmd-label-user" for="password_confirmation">{{__('user.password_confirmation')}}<span class="required-input">*</span></label>
                                    <input type="password"
                                           class="form-control"
                                           name="password_confirmation"
                                           id="passwordConfirmUser"
                                           onkeyup="keyUpError(this)"
                                           placeholder="{{__('user.password_confirmation_input')}}"
                                           value="{{ old('password_confirmation') }}">
                                    <span class="error-user text-danger password_confirmation"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>
                                <button type="submit" class="btn btn-create" id="btnPassword">{{__('base.update')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('css')

@endsection
@section('javascript')
<script>
    $(document).ready(function() {
        var table= $('#list-user').DataTable({
            processing: true,
            serverSide: true,
            language: {
                url: '{{asset('lib/datatables/lang/').'/'.App::getLocale().'.json'}}',
            },
            ajax: "{{ route('users.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'username', name: 'username' },
                { data: 'email', name: 'email' },
                { data: 'created_date', name: 'created_date' },
            ],
            columnDefs: [
                { "sortable": false, "targets": [0 ] },
                {
                    "targets": 5,
                    "data": null,
                    "render": function (data) {
                        let disabled = '';
                        let pointer = '';
                        if(data.id == 1)
                        {
                            disabled = 'disabled';
                            pointer = ' style="pointer-events: none" ';
                        }
                        edit_event = ' onclick = checkUser(' + data.id + ') ' ;
                        delete_event = ' onclick = checkItemExisted(' + data.id + ') ';
                        return '<button class="btn btn-edit btn-sm" ' + edit_event  + 'id="row_' + data.id +
                            '" data-toggle="modal" data-target="#createUser">' +
                            '<span class="fa fa-edit"></span></button> ' +
                            '<button class="btn btn-sm btn-delete '+ disabled +'" ' + delete_event + 'id="row_' + data.id +
                            '" data-toggle="modal" data-target="#confirmDeleteItem" '+ pointer + disabled +'>' +
                            '<span class="fa fa-trash" ></span></button> ';
                    },
                }
            ],
        });
        $("#changePassword").on('show.bs.modal', function () {
            $('.modal-backdrop').css({'z-index' : '1050'});
            if($('.modal-backdrop.fade.show').length > 2)
            {
                $('.modal-backdrop.fade.show')[0].remove();
            }
        }).on('hide.bs.modal', function () {
            // $(".modal-backdrop").remove();
            $('body').removeClass('modal-open').css({padding : 0});
            $('.modal-backdrop').css({'z-index' : '1048'});
            $('input[name="password"]').val('');
            $('input[name="password_confirmation"]').val('');
            if ($('.modal.fade.show').length > 0) {
                setTimeout(function () {
                    $('body').addClass('modal-open');
                },400);
            }
        });
        $("#createUser").on('hide.bs.modal', function () {
            $(".modal-backdrop").remove();
            $('body').removeClass('modal-open').css({padding : 0});
        });
    })
        function checkItemExisted(id) {
            $('#btnConfirmDelete').val(id);
        }
        function deleteItem(id) {
            let delete_URL = "{{ url('admin/users') }}/" + id;
            let request = $.ajax({
                url: delete_URL,
                data:{
                    'id': id,
                    '_token': '{{ csrf_token() }}'
                },
                method: "DELETE"
            }).done(function (data) {
                $("#confirmDeleteItem").modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();

                if(data.status == 500){
                    if(data.not_exist)
                    {
                        iziToast.warning({
                            title: data.title,
                            message: data.message,
                            position: 'topRight'
                        });
                    }
                    else
                    {
                        iziToast.error({
                            title: data.title,
                            message: data.message,
                            position: 'topRight'
                        });
                    }
                }
                else {
                    iziToast.success({
                        title: data.title,
                        message: data.message,
                        position: 'topRight'
                    });
                }
                $('#list-user').DataTable().ajax.reload();
            });
        }

        function checkUser(id)
        {
            let dataUser = null;
            if(id != -1)
            {
                let edit_URL = "{{ url('admin/users') }}/" + id;
                let request = $.ajax({
                    url: edit_URL,
                    data:{
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    async: false,
                    method: "GET",
                    success : function(data){
                        if(data.status != 500)
                        {
                            dataUser = data;
                        }
                    }
                }).done(function (data) {
                    if(data.status == 500){
                        $(`#row_${data.row_id}`).closest("tr").remove();
                        iziToast.warning({
                            title: data.title,
                            message: data.message,
                            position: 'topRight'
                        });
                        setTimeout(function() {
                            $('#createUser').hide();
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                        },100);
                    }
                    else
                    {
                        let user = data;
                        let title = "<span class='bold-text'>{{ __('base.user')}} {{__('base.edit') }}</span>";
                        if($('meta[name=language]').prop('content') == 'vi')
                        {
                            title = "<span class='bold-text'>{{__('base.edit') }} {{ __('base.user_header')}}</span>";
                        }
                        document.getElementById('nameForm').innerHTML = title +
                            '<span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>';
                        let url = "{{url('admin/users')}}/"+ user.id;
                        $("#formUser").attr("action",url).attr('method','put');
                        let html = '@csrf <input type="hidden" name="_method" value="PUT">'+
                            '<div class="modal-body">' +
                                '<div class="form-group bmd-form-group label-input ">' +
                                    '<label class="bmd-label-user" for="username">{{__('user.username')}}</label>' +
                                    '<input type="text" class="form-control" placeholder="{{__('user.username_input')}}" name="username" id="usernameUser" disabled value="'+
                                        user.username +'">'+
                                '</div>' +
                                '<div class="form-group bmd-form-group label-input ">' +
                                    '<label class="bmd-label-user" for="name">{{__('user.name')}}</label>' +
                                    '<input type="text" class="form-control" placeholder="{{__('user.name_input')}}" name="name" id="nameUser" value="'+
                                         user.name +'">'+
                                    '<span class="error-user text-danger name"></span>'+
                                '</div>' +
                                '<div class="form-group bmd-form-group label-input ">' +
                                    '<label class="bmd-label-user" for="email">{{__('user.email')}}<span class="required-input">*</span></label>' +
                                    '<input type="text" class="form-control" placeholder="{{__('user.email_input')}}" name="email" id="emailUser" value="'+
                                        user.email +'">'+
                                    '<span class="error-user text-danger email"></span>'+
                                '</div>' +
                            '</div>' +
                            '<div class="modal-footer">' +
                                '<button type="button" data-toggle="modal" data-target="#changePassword" class="btn btn-edit change-password">{{__('user.change_password')}}</button>' +
                                '<button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>' +
                                '<button type="submit" class="btn btn-create" id="btnUser">{{__('base.update')}}</button>' +
                            '</div>';
                        document.getElementById('formUser').innerHTML = html;
                    }
                });
            }
            else
            {
                let title = "<span class='bold-text'>{{ __('base.user')}} {{__('base.create') }}</span>";
                if($('meta[name=language]').prop('content') == 'vi')
                {
                    title = "<span class='bold-text'>{{__('base.create') }} {{ __('base.user_header')}}</span>";
                }
                document.getElementById('nameForm').innerHTML = title +
                '<span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>';
                let url = "{{url('admin/users')}}";
                $("#formUser").attr("action",url).attr('method','post');
                let html = '@csrf <div class="modal-body">' +
                        '<div class="form-group bmd-form-group label-input ">' +
                            '<label class="bmd-label-user" for="name">{{__('user.name')}}</label>' +
                            '<input type="text" class="form-control" placeholder="{{__('user.name_input')}}" name="name" id="nameUser">'+
                            '<span class="error-user text-danger name"></span>'+
                        '</div>' +
                        '<div class="form-group bmd-form-group label-input ">' +
                            '<label class="bmd-label-user" for="email">{{__('user.email')}}<span class="required-input">*</span></label>' +
                            '<input type="text" class="form-control" placeholder="{{__('user.email_input')}}" name="email" id="emailUser">'+
                            '<span class="error-user text-danger email"></span>'+
                        '</div>' +
                        '<div class="form-group bmd-form-group label-input ">' +
                            '<label class="bmd-label-user" for="username">{{__('user.username')}}<span class="required-input">*</span></label>' +
                            '<input type="text" class="form-control" placeholder="{{__('user.username_input')}}" name="username" id="usernameUser">'+
                            '<span class="error-user text-danger username"></span>'+
                        '</div>' +
                        '<div class="form-group bmd-form-group label-input ">' +
                            '<div>{{__('user.password')}}<span class="required-input">*</span></div>' +
                            '<label class="required-field required-among"  for="name_vi"><span class="required-input">*</span>{{ __('user.password_at_least') }}</label>' +
                            '<input type="password" class="form-control" placeholder="{{__('user.password_input')}}" name="password" id="passwordUser">'+
                            '<span class="error-user text-danger password"></span>'+
                        '</div>' +
                        '<div class="form-group bmd-form-group label-input ">' +
                            '<label class="bmd-label-user" for="password_confirmation">{{__('user.password_confirmation')}}<span class="required-input">*</span></label>' +
                            '<input type="password" class="form-control" placeholder="{{__('user.password_confirmation_input')}}" name="password_confirmation" id="passwordConfirmUser">'+
                            '<span class="error-user text-danger password_confirmation"></span>'+
                        '</div>' +
                    '</div>' +
                    '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>' +
                        '<button type="submit" class="btn btn-create" id="btnUser">{{__('base.create')}}</button>' +
                    '</div>';
                document.getElementById('formUser').innerHTML = html;
                $('#formUser :input').each(function (){
                    $(this).bind('keyup',function(){
                        $(`.text-danger.${$(this)[0].name}`).text('')
                    });
                });
            }
        }
    $("#formUser").submit(function (e) {
        e.preventDefault();
        let form = $(this).serialize();
        let method = $("#formUser").attr("method");
        let url = $("#formUser").attr("action");
        $.ajax({
            type: method,
            url: url,
            data: form,
            success: function (res){
                $(`.error-user`).html("");
                if(res.status == 500)
                {
                    iziToast.warning({
                        title: res.title,
                        message: res.message,
                        position: "topRight"
                    });
                }
                else
                {
                    iziToast.success({
                        title: res.title,
                        message: res.message,
                        position: "topRight"
                    });
                }
                $('#createUser').hide();
                $('body').removeClass('modal-open').css({padding : 0});
                $(".modal-backdrop").remove();
                $('#list-user').DataTable().ajax.reload();
            },
            error: function(error){
                let errors = error.responseJSON.errors;
                $(`.error-user`).html("");
                $.each(errors,function (key,value){
                    $(`.error-user.${key}`).html(value[0]).addClass("error-input");
                    $(`#formUser input[name=${key}]`).focus();
                });
            }
        })
    });
    $('#formPassword').submit(function (e) {
        e.preventDefault();
        let form = $(this).serialize();
        let method = 'post';
        let url = $("#formUser").attr("action") +'/change-password';
        $.ajax({
            type: method,
            url: url,
            data: form,
            success: function (res){
                $(`.error-user`).html("");
                if(res.status == 500)
                {
                    iziToast.warning({
                        title: res.title,
                        message: res.message,
                        position: "topRight"
                    });
                    $('#createUser').hide();
                    $('body').removeClass('modal-open').css({padding : 0});
                    $(".modal-backdrop").remove();
                    $(`#row_${res.row_id}`).closest("tr").remove();
                }
                else
                {
                    iziToast.success({
                        title: res.title,
                        message: res.message,
                        position: "topRight"
                    });
                }
                $('#changePassword').hide();
                $('.modal-backdrop').css({'z-index' : '1048'});
                if($('.modal-backdrop.fade.show').length > 1)
                {
                    $('.modal-backdrop.fade.show')[0].remove();
                }
                if ($('.modal.fade.show').length > 0) {
                    setTimeout(function () {
                        $('body').addClass('modal-open');
                    },400);
                }
                $('body').removeClass('modal-open').css({padding : 0});
            },
            error: function(error){
                let errors = error.responseJSON.errors;
                $(`.error-user`).html("");
                $.each(errors,function (key,value){
                    $(`#formPassword .error-user.${key}`).html(value[0]).addClass("error-input");
                    $(`#formPassword input[name=${key}]`).focus();
                });
            }
        })
    });
</script>
@endsection
