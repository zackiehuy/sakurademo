@extends('dashboard.base')
@section('title')
    {{__('base.wine')}}
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
                                        {{__('base.list')}} {{__('base.wine_header')}}
                                    @else
                                        {{__('base.wine')}}{{__('base.list')}}
                                    @endif
                                </span>

                                <div class="float-right px-2 py-1">
                                    <button
                                        class="btn btn-create new-wine"
                                        onclick="checkWine(-1)"
                                        data-toggle="modal"
                                        data-target="#createWine">
                                        <i class="fa fa-plus"></i>
                                        {{__('base.wine_new')}}
                                    </button>
                                    <button
                                        class="btn btn-create btn-wine-coming"
                                        data-toggle="modal"
                                        data-target="#newWine">
                                        <i class="fa fa-plus"></i>
                                        {{__('base.wine_coming')}}
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="table-search">
                                        <input type="search" id="table-search" name="list-wine" class="col-8 form-control form-control-sm" placeholder="{{__('base.search')}}">
                                    </div>
                                    <table id="list-wine"
                                           class="table table-bordered table-hover table-striped"
                                           style="width: 100%">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>{{__('base.stt')}}</th>
                                            <th>{{__('base.name')}}</th>
                                            <th>{{__('base.code')}}</th>
                                            <th>{{__('base.image')}}</th>
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
                            {{__('base.delete_message',['item' => __('base.wine_header')])}}
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
                 id="createWine"
                 tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 data-backdrop="static"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" >
                        <div class="modal-header card-header" id="nameForm">
                            {{__('base.create'). ' ' .__('base.wine')}}
                        </div>
                        <form id="formWine" role="form" method="post"  enctype="multipart/form-data" action="{{url('admin/wines/new')}}" novalidate>
                            @csrf
                            <div class="modal-body">
                                <div class="form-group bmd-form-group label-input ">
                                    <label class="bmd-label-user" for="name">{{__('base.name')}}</label>
                                    <input type="text"
                                           class="form-control"
                                           required name="name"
                                           id="nameWine"
                                           value="{{ old('name') }}">
                                </div>
                                <div class="form-group bmd-form-group label-input ">
                                    <label class="bmd-label-user" for="image">{{__('base.image')}}</label>
                                    <input type="file"
                                           name="image"
                                           id="imageWine">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>
                                <button type="submit" class="btn btn-create" id="btnWine">{{__('base.create')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{--            New wine--}}
            <div class="modal fade"
                 id="newWine"
                 tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 data-backdrop="static"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" >
                        <div class="modal-header card-header" id="newWine">
                            @if(App::getLocale() == 'vi')
                                {{__('base.create'). ' ' .__('base.wine_header')}}
                            @else
                                {{__('base.wine').__('base.create')}}
                            @endif
                            <span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>
                        </div>
                        <form id="formNewWine" role="form" method="post"  enctype="multipart/form-data" action="{{route('wines.new')}}" novalidate>
                            @csrf
                            <div class="modal-body">
                                <div class="form-group bmd-form-group label-input ">
                                    <label class="bmd-label-user" for="name">{{__('base.quantity')}}<span class="required-input">*</span></label>
                                    <input type="text"
                                           class="form-control"
                                           name="quantity"
                                           id="quantity"
                                           onkeyup="keyUpError(this)"
                                           placeholder="{{__('base.quantity_input')}}"
                                           value="{{ old('quantity') }}">
                                    <span class="text-danger quantity"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>
                                <button type="submit" class="btn btn-create" id="newWine">{{__('base.create')}}</button>
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
        var table= $('#list-wine').DataTable({
            processing: true,
            serverSide: true,
            language: {
                url: '{{asset('lib/datatables/lang/').'/'.App::getLocale().'.json'}}',
            },
            ajax: {
                url: "{{ route('wines.index') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'code', name: 'code' },
                { data: 'image', name: 'image' },
            ],
            columnDefs: [
                { "sortable": false, "targets": [0 ] },
                {
                    "targets": 4,
                    "data": null,
                    "render": function (data) {
                        edit_event = ' onclick = checkWine(' + data.id + ') ' ;
                        delete_event = ' onclick = checkItemExisted(' + data.id + ') ';
                        return '<button class="btn btn-edit btn-sm" ' + edit_event  + 'id="row_' + data.id +
                            '" data-toggle="modal" data-target="#createWine">' +
                            '<span class="fa fa-edit"></span></button> ' +
                            '<button class="btn btn-sm btn-delete" ' + delete_event + 'id="row_' + data.id +
                            '" data-toggle="modal" data-target="#confirmDeleteItem" >' +
                            '<span class="fa fa-trash" ></span></button> ';
                    },
                }
            ],
            "order": [[ 2, 'asc' ]]
        });
    })
    function readImage(input) {
        $(`.text-danger.${input.name}`).text('');
        if (input.files[0].size > 3000000) {
            input.value="";
            $(`.text-danger.${input.name}`).text($('meta[name="file_size"]').attr('content'));
            $('#load_image').attr('src', '').show().css({display: 'none'});
            $('.file-image').css({display: 'none'});
            $('.file-image .name-file').text('');
            return;
        }
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#load_image').attr('src', e.target.result).show().css({display: ''});
                $('.file-image').css({display: ''});
                $('.file-image .name-file').text(input.files[0].name);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function fileDelete()
    {
        $('input[name=image]').val('');
        $('#load_image').attr('src', '').show().css({display: 'none'});
        $('.file-image').css({display: 'none'});
        $('.file-image .name-file').text('');
    }
        function checkItemExisted(id) {
            $('#btnConfirmDelete').val(id);
        }
        function deleteItem(id) {
            let delete_URL = "{{ url('admin/wines') }}/" + id;
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
                    iziToast.warning({
                        title: data.title,
                        message: data.message,
                        position: 'topRight'
                    });
                    $('#list-wine').DataTable().ajax.reload();
                }
                else {
                    $(`#row_${data.row_id}`).closest("tr").remove();
                    iziToast.success({
                        title: data.title,
                        message: data.message,
                        position: 'topRight'
                    });
                }
            });
        }

        function checkWine(id)
        {
            let dataExecutiveBoard = null;
            if(id != -1)
            {
                let edit_URL = "{{ url('admin/wines') }}/" + id;
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
                            dataExecutiveBoard = data;
                        }
                    }
                }).done(function (data) {
                    if(data.status == 500){
                        setTimeout(function(){
                            $("#createWine").hide();
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                            $(`#row_${data.row_id}`).closest("tr").remove();
                        },100);
                        iziToast.warning({
                            title: data.title,
                            message: data.message,
                            position: 'topRight'
                        });
                    }
                    else
                    {
                        let wine = data;
                        let title = "<span class='bold-text'>{{ __('base.wine')}}{{__('base.edit') }}</span>";
                        if($('meta[name=language]').prop('content') == 'vi')
                        {
                            title = "<span class='bold-text'>{{__('base.edit') }} {{ __('base.wine_header')}}</span>";
                        }
                        document.getElementById('nameForm').innerHTML = title +
                            '<span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>';
                        let url = "{{url('admin/wines')}}/"+ wine.id;
                        let avatar = "{{asset('img/sake_icon.png')}}";
                        let name = '';
                        if(wine.name != null)
                        {
                            name = wine.name;
                        }
                        let coming_sake = '';
                        if(wine.is_new == 1)
                        {
                            avatar = "{{asset('img/coming-sake.png')}}";
                            coming_sake = '<span class="coming-sake">{{__('guest.coming_soon_sake')}}</span>';
                        }
                        else
                        {
                            if(wine.image != null)
                            {
                                avatar = "{{asset('storage/images/wines')}}/" + wine.image;
                            }
                            else if(wine.default_image != null)
                            {
                                avatar = "{{url('')}}/" + wine.default_image;
                            }
                        }
                        $("#formWine").attr("action",url).attr('method','PUT');
                        let html =
                            '@csrf <input type="hidden" name="_method" value="PUT">'+
                            '<div class="modal-body">' +
                                '<div class="form-group bmd-form-group label-input row">' +
                                    '<label class="col-md-3 bmd-label-user" for="name">{{__('base.name')}}<span class="required-input">*</span></label>' +
                                    '<div class="col-md-9 pl-0">'+
                                        '<input type="text" class=" form-control" placeholder="{{__('base.name_input')}}" name="name" id="nameWine" value="'+
                                        name +'">'+
                                        '<span class="error-wine text-danger name"></span>'+
                                    '</div>'+
                                '</div>' +
                                '<div class="row">' +
                                    '<label class="col-md-3 bmd-label-user" for="image">{{__('base.image')}}</label>' +
                                    '<div class="col-md-9 pl-0">'+
                                        '<label class="btn btn-file">'+
                                                '{{__('news.choose_file_wine')}}<input accept="image/gif,image/jpeg,image/webp,image/png,image/svg,image/svg+xml" type="file" onchange="readImage(this)" style="display: none;" name="image" id="imageWine" />'+
                                        '</label>' +
                                        '<span class="file-image" style="display: none"><span class="name-file"></span><a href="javascript:fileDelete();">&times;</a></span>' +
                                    '</div>'+
                                    '<span class="col-md-3 required-field"><span class="required-input">*</span>{{__('base.file_size') . __('base.standard_size') . '261x353'}}</span>' +
                                    '<div class="col-md-9 pl-0 img-wine-coming">'+
                                        '<img id="load_image" src="'+ avatar + '"  class="image-executive-board">' +
                                        coming_sake +
                                        '<div class="text-danger image"></div>'+
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                            '<div class="modal-footer">' +
                                '<button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>' +
                                '<button type="submit" class="btn btn-create" id="btnWine">{{__('base.update')}}</button>' +
                            '</div>';
                        document.getElementById('formWine').innerHTML = html;

                    }
                });
            }
            else
            {
                let title = "<span class='bold-text'>{{ __('base.wine')}} {{__('base.create') }}</span>";
                if($('meta[name=language]').prop('content') == 'vi')
                {
                    title = "<span class='bold-text'>{{__('base.create') }} {{ __('base.wine_header')}}</span>";
                }
                document.getElementById('nameForm').innerHTML = title +
                '<span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>';
                let url = "{{url('admin/wines')}}";
                $("#formWine").attr("action",url).attr('method','POST');
                let html =
                    '@csrf <div class="modal-body">' +
                        '<div class="form-group bmd-form-group label-input row">' +
                            '<label class="col-md-3 bmd-label-user" for="name">{{__('base.name')}}<span class="required-input">*</span></label>' +
                            '<div class="col-md-9 pl-0">'+
                                '<input type="text" style="padding-right:15px" class=" form-control" placeholder="{{__('base.name_input')}}" name="name" id="nameWine">' +
                                '<span class="error-wine text-danger name"></span>'+
                            '</div>'+
                        '</div>' +
                        '<div class="row">' +
                            '<label class="col-md-3 bmd-label-user" for="image">{{__('base.image')}}</label>'+
                            '<div class="col-md-9 pl-0">'+
                                '<label class="btn btn-file">'+
                                '{{__('news.choose_file_wine')}}<input accept="image/gif,image/jpeg,image/webp,image/png,image/svg,image/svg+xml" type="file" onchange="readImage(this)" style="display: none;" name="image" id="imageWine" />'+
                                '</label>'+
                                '<span class="file-image" style="display: none"><span class="name-file"></span><a href="javascript:fileDelete();">&times;</a></span>' +
                            '</div>'+
                            '<span class="col-md-3 required-field"><span class="required-input">*</span>{{__('base.file_size') . __('base.standard_size') . '261x353'}}</span>' +
                            '<div class="col-md-9 pl-0">'+
                                '<img id="load_image" src="" class="image-executive-board">' +
                                '<div class="text-danger image"></div>'+
                            '</div>' +
                        '</div>' +
                    '</div>' +
                    '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>' +
                        '<button type="submit" class="btn btn-create" id="btnExecutiveBoard">{{__('base.create')}}</button>' +
                    '</div>';
                document.getElementById('formWine').innerHTML = html;
            }            $('#formWine :input').each(function (){
            $(this).bind('keyup',function(){
                $(`.text-danger.${$(this)[0].name}`).text('')
            });
        });

        };
    $("#formWine").submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        let method = $(this).attr("method");
        let url = $(this).attr("action");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}",
            },
            type: 'post',
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            success: function (res){
                $(`.error-wine`).html("");
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
                $('#createWine').hide();
                $('body').removeClass('modal-open').css({padding : 0});
                $(".modal-backdrop").remove();
                $('#list-wine').DataTable().ajax.reload();
                $('#list-wine').DataTable().page('last').draw('page');
            },
            error: function(error){
                let errors = error.responseJSON.errors;
                $(`.error-wine`).html("");
                $.each(errors,function (key,value){
                    $(`.error-wine.${key}`).html(value[0]).addClass("error-input");
                    $(`#formWine input[name=${key}]`).focus();
                });
            }
        })
    });
    $('#formNewWine').submit(function(e){
        e.preventDefault();
        let form = $(this).serialize();
        let url = $(this).attr("action");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}",
            },
            type: 'post',
            url: url,
            data: form,
            success: function (res){
                iziToast.success({
                    title: res.title,
                    message: res.message,
                    position: "topRight"
                });
                $('#newWine').hide();
                $('body').removeClass('modal-open').css({padding : 0});
                $(".modal-backdrop").remove();
                $('#list-wine').DataTable().ajax.reload();
                $('#list-wine').DataTable().page('last').draw('page');
                setTimeout(function()
                {
                    res.id.forEach(element =>  $(`#row_${element}`).closest('tr').addClass('row-active'));
                },1000)
            },
            error: function(error){
                let errors = error.responseJSON.errors;
                $(`#formNewWine .text-danger`).html("");
                $.each(errors,function (key,value){
                    $(`#formNewWine .text-danger.${key}`).html(value[0]);
                    $(`#formNewWine input[name=${key}]`).focus();
                });
            }
        })
    });
</script>
@endsection
