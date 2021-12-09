@extends('dashboard.base')
@section('title')
    {{__('base.executive_board')}}
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
                                        {{__('base.list')}} {{__('base.executive_board_header')}}
                                    @else
                                        {{__('base.executive_board')}}{{__('base.list')}}
                                    @endif
                                </span>
                                <button
                                    class="btn btn-create float-right px-2 py-1"
                                    onclick="checkExecutiveBoard(-1)"
                                    data-toggle="modal"
                                    data-target="#createExecutiveBoard">
                                    <i class="fa fa-plus"></i>
                                    @if(App::getLocale() == 'vi')
                                        {{__('base.create')}} {{__('base.executive_board_header')}}
                                    @else
                                        {{__('base.executive_board')}}{{__('base.create')}}
                                    @endif
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="table-search">
                                        <input type="search" id="table-search" name="list-executive-board" class="col-8 form-control form-control-sm" placeholder="{{__('base.search')}}">
                                    </div>
                                    <table id="list-executive-board"
                                           class="table table-bordered table-hover table-striped"
                                           style="width: 100%">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>{{__('base.stt')}}</th>
                                            <th>{{__('base.name')}}</th>
                                            <th>{{__('base.image')}}</th>
                                            <th>{{__('executive_board.position')}}</th>
                                            <th>{{__('base.location')}}</th>
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
                            {{__('base.delete_message',['item' => __('base.executive_board_header')])}}
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
                 id="createExecutiveBoard"
                 tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 data-backdrop="static"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" >
                        <div class="modal-header card-header" id="nameForm">
                            {{__('base.create'). ' ' . __('base.executive_board')}}
                        </div>
                        <form id="formExecutiveBoard" role="form" method="post"  enctype="multipart/form-data" action="{{url('admin/executive-board')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group bmd-form-group label-input ">
                                    <label class="bmd-label-user" for="name">{{__('base.name')}}</label>
                                    <input type="text"
                                           class="form-control"
                                           required name="name"
                                           id="nameExecutiveBoard"
                                           value="{{ old('name') }}">
                                </div>
                                <div class="form-group bmd-form-group label-input ">
                                    <label class="bmd-label-user" for="image">{{__('base.image')}}</label>
                                    <input type="file"
                                           class="form-control"
                                           required name="image"
                                           id="imageExecutiveBoard"
                                           value="{{ old('image') }}">
                                </div>
                                <div class="form-group bmd-form-group label-input ">
                                    <label class="bmd-label-user" for="position">{{__('base.position')}}</label>
                                    <input type="text"
                                           class="form-control"
                                           required name="job_category_id"
                                           id="positionExecutiveBoard"
                                           value="{{ old('position') }}">
                                    <p class="btn btn-success" style="width: 40px;margin-left: 20px;" data-toggle="modal" data-target="#createJobCategoryModal">
                                        <i class="fa fa-plus"></i>
                                    </p>
                                </div>
                                <div class="form-group bmd-form-group label-input ">
                                    <label class="bmd-label-user" for="image">{{__('base.image')}}</label>
                                    <input type="file"
                                           class="form-control"
                                           required name="image"
                                           id="imageExecutiveBoard"
                                           value="{{ old('image') }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>
                                <button type="submit" class="btn btn-download" id="btnExecutiveBoard">{{__('base.create')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include ('blocks.job_category.create')
        </section>
    </div>
@endsection
@section('css')

@endsection
@section('javascript')
<script>
    $("#createExecutiveBoard").on('hide.bs.modal', function () {
        $(".modal-backdrop").remove();
    });

    $(document).ready(function() {
        var table= $('#list-executive-board').DataTable({
            processing: true,
            serverSide: true,
            language: {
                url: '{{asset('lib/datatables/lang/').'/'.App::getLocale().'.json'}}',
            },
            ajax: "{{ route('executive-board.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'image', name: 'image' },
                { data: 'position', name: 'position' },
                { data: 'location', name: 'location' },
            ],
            columnDefs: [
                { "sortable": false, "targets": [0 ] },
                {
                    "targets": 5,
                    "data": null,
                    "render": function (data) {
                        edit_event = ' onclick = checkExecutiveBoard(' + data.id + ') ' ;
                        delete_event = ' onclick = checkItemExisted(' + data.id + ') ';
                        return '<button class="btn btn-edit btn-sm" ' + edit_event  + 'id="row_' + data.id +
                            '" data-toggle="modal" data-target="#createExecutiveBoard">' +
                            '<span class="fa fa-edit"></span></button> ' +
                            '<button class="btn btn-sm btn-delete" ' + delete_event + 'id="row_' + data.id +
                            '" data-toggle="modal" data-target="#confirmDeleteItem" >' +
                            '<span class="fa fa-trash" ></span></button> ';
                    },
                }
            ],
            // "order": [[ 1, 'asc' ]]
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
                $('#load_image').attr('src', e.target.result).show();
                $('.file-image').css({display: ''});
                $('.file-image .name-file').text(input.files[0].name);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function removeImage(){
        $('input[name=image]').val('');
        $('#load_image').attr('src', '').show().css({display: 'none'});
        $('.file-image').css({display: 'none'});
        $('.file-image .name-file').text('');
    }
    function keyUpEmployee(e)
    {
        $(`#formExecutiveBoard .text-danger.${e.target.id}`).text('');
        if(e.target.id == 'name_jp')
        {
            $(`#formExecutiveBoard .text-danger.name_vi`).text('');
        }
        else if(e.target.id == 'name_vi')
        {
            $(`#formExecutiveBoard .text-danger.name_jp`).text('');
        }
    }
        function checkItemExisted(id) {
            $('#btnConfirmDelete').val(id);
        }
        function deleteItem(id) {
            let delete_URL = "{{ url('admin/executive-board') }}/" + id;
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
                }
                else {
                    $(`#row_${data.row_id}`).closest("tr").remove();
                    iziToast.success({
                        title: data.title,
                        message: data.message,
                        position: 'topRight'
                    });
                }
                $('#list-executive-board').DataTable().ajax.reload();
            });
        }

        function checkExecutiveBoard(id)
        {
            let urlJobCategory = "{{ url('admin/job-category') }}";
            let urlBranch = "{{ url('admin/branch-employee') }}";
            let branches = [];
            let jobCategory = [];
            $.ajax({
                url : urlJobCategory,
                data:{
                    '_token': '{{ csrf_token() }}'
                },
                method: 'GET',
                async: false,
            }).done(function(data){
                jobCategory = data.data;
            });
            $.ajax({
                url : urlBranch,
                data:{
                    '_token': '{{ csrf_token() }}'
                },
                method: 'GET',
                async: false,
            }).done(function(data){
                branches = data;
            });
            let dataExecutiveBoard = null;
            if(id != -1)
            {
                let edit_URL = "{{ url('admin/executive-board') }}/" + id;
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
                            $("#createExecutiveBoard").hide();
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                        },100);
                        $(`#row_${data.row_id}`).closest("tr").remove();
                        iziToast.warning({
                            title: data.title,
                            message: data.message,
                            position: 'topRight'
                        });
                    }
                    else
                    {
                        let executiveBoard = data;
                        let title = ''
                        if($('meta[name=language]').prop('content') == 'vi')
                        {
                            title = "<span class='bold-text'>{{__('base.edit') }} {{ __('base.executive_board_header')}}</span>";
                        }
                        else
                        {
                            title = '<span class="bold-text">' + '{{__('base.executive_board') }} {{ __('base.edit')}}' + "</span>";
                        }
                        document.getElementById('nameForm').innerHTML = title +
                        '<span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>';
                        let url = "{{url('admin/executive-board')}}/"+ executiveBoard.id;
                        let avatar = "{{asset('img/avatar/avatar.jpg')}}";
                        if(executiveBoard.image != null)
                        {
                            avatar = "{{asset('storage/images/executive_board')}}/" + executiveBoard.image;
                        }
                        else if(executiveBoard.default_image != null)
                        {
                            avatar = "{{url('')}}/" + executiveBoard.default_image;
                        }
                        let name_en = '';
                        let name_vi = '';
                        let name_jp = '';
                        executiveBoard.translations.forEach(function(element){
                            if(element.locale == 'en')
                            {
                                if(element.name != 'null')
                                {
                                    name_en = element.name;
                                }
                            }
                            else if(element.locale == 'vi')
                            {
                                if(element.name != 'null')
                                {
                                    name_vi = element.name;
                                }
                            }
                            else if(element.locale == 'jp')
                            {
                                if(element.name != 'null')
                                {
                                    name_jp = element.name;
                                }
                            }
                        })
                        $("#formExecutiveBoard").attr("action",url).attr('method','PUT');
                        let html = '@csrf <input type="hidden" name="_method" value="PUT">'+
                            '<div class="modal-body">' +
                            '<div class="form-group bmd-form-group label-input ">' +
                            '<label class="bmd-label-user" for="name_en">{{ __('job_category.name_en') }}<span class="required-input">*</span></label>' +
                            '<input type="text" class="form-control" placeholder="{{ __('job_category.name_en_input') }}" onkeyup="keyUpEmployee(event)" name="en[name]" id="name_en" value="'+
                            name_en +'">'+
                            '<span class="text-danger name_en"></span>'+
                            '</div>' +
                            '<div class="form-group bmd-form-group label-input ">' +
                            '<div>{{ __('job_category.name_vi') }}</div>' +
                            '<label class="required-field required-among"  for="name_vi"><span class="required-input">*</span>{{ __('base.required_among',['items' => __('job_category.name_vi') . ' , ' . __('job_category.name_jp')]) }}</label>' +
                            '<input type="text" class="form-control" placeholder="{{ __('job_category.name_vi_input') }}" onkeyup="keyUpEmployee(event)" name="vi[name]" id="name_vi" value="'+
                            name_vi +'">'+
                            '<span class="text-danger name_vi"></span>'+
                            '</div>' +
                            '<div class="form-group bmd-form-group label-input ">' +
                            '<div>{{ __('job_category.name_jp') }}</div>' +
                            '<label class="required-field required-among"  for="name_jp"><span class="required-input">*</span>{{ __('base.required_among',['items' => __('job_category.name_vi') . ' , ' . __('job_category.name_jp')]) }}</label>' +
                            '<input type="text" class="form-control" placeholder="{{ __('job_category.name_jp_input') }}" onkeyup="keyUpEmployee(event)" name="jp[name]" id="name_jp" value="'+
                            name_jp +'">'+
                            '<span class="text-danger name_jp"></span>'+
                            '</div>' +
                            '<div class="row">' +
                            '<label class="col-md-3 bmd-label-user" for="image">{{ __('base.image') }}</label>' +
                            '<div class="col-md-9 pl-0">'+
                            '<label class="btn btn-file">'+
                            '{{__('executive_board.choose_file')}}<input accept="image/gif,image/jpeg,image/webp,image/png,image/svg,image/svg+xml" type="file" onchange="readImage(this)" style="display: none;" name="image" id="image" />'+
                            '</label>' +
                            '<span class="file-image" style="display: none"><span class="name-file"></span><a href="javascript:removeImage();">&times;</a></span>' +
                            '</div>'+
                            '</div>' +
                            '<div class="row">'+
                            '<span class="col-md-3 required-field"><span class="required-input">*</span>{{__('base.file_size') . __('base.standard_size') . '215x314'}}</span>' +
                            '<div class=col-md-9>'+
                            '<img id="load_image" src="'+ avatar + '"  class="col-md-9 pl-0 image-executive-board">' +
                            '<div class="text-danger image"></div>'+
                            '</div>' +

                            '</div>' +
                            '<div class="form-group bmd-form-group label-input ">' +
                            '<label class="bmd-label-user" for="location">{{ __('base.branch') }}<span class="required-input">*</span></label>' +
                            '<div class="row row-margin-0 justify-content-between">' +
                            '<select type="text" class="form-control col" name="branch_id" id="locationExecutiveBoard"  onchange="keyUpError(this)"> </select>'+
                            '</div>' +
                            '<span class="text-danger branch_id"></span>'+
                            '</div>' +
                            '<div class="form-group bmd-form-group label-input ">' +
                                '<label class="bmd-label-user" for="position">{{ __('executive_board.position') }}<span class="required-input">*</span></label>' +
                                '<div class="row row-margin-0 justify-content-between">' +
                                    '<select type="text" class="form-control col" name="job_category_id" id="categoryExecutiveBoard" onchange="keyUpError(this)"> </select>'+
                                    '<p class="btn btn-create col btn-add" data-toggle="modal" data-target="#createJobCategoryModal">'+
                                        '<i class="fa fa-plus"></i>' +
                                    '</p>' +
                                '</div>' +
                            '<span class="text-danger job_category_id"></span>'+
                            '</div>' +
                            '</div>' +
                            '<div class="modal-footer">' +
                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('base.close') }}</button>' +
                            '<button type="submit" class="btn btn-create" id="btnExecutiveBoard">{{ __('base.update') }}</button>' +
                            '</div>';
                        document.getElementById('formExecutiveBoard').innerHTML = html;

                    }
                });
            }
            else
            {
                let title = ''
                if($('meta[name=language]').prop('content') == 'vi')
                {
                    title = "<span class='bold-text'>{{__('base.create') }} {{ __('base.executive_board_header')}}</span>";
                }
                else
                {
                    title = '<span class="bold-text">' + '{{__('base.executive_board') }} {{ __('base.create')}}' + "</span>";
                }
                document.getElementById('nameForm').innerHTML = title+
                '<span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>';
                let url = "{{url('admin/executive-board')}}";
                $("#formExecutiveBoard").attr("action",url).attr('method','POST');
                let html = '@csrf <div class="modal-body">' +
                    '<div class="form-group bmd-form-group label-input ">' +
                    '<label class="bmd-label-user" for="name_en">{{ __('job_category.name_en')}}<span class="required-input">*</span></label>' +
                    '<input type="text" class="form-control" placeholder="{{ __('job_category.name_en_input') }}" onkeyup="keyUpEmployee(event)" name="en[name]" id="name_en">' +
                    '<span class="text-danger name_en"></span>'+
                    '</div>' +
                    '<div class="form-group bmd-form-group label-input ">' +
                    '<div>{{ __('job_category.name_vi') }}</div>' +
                    '<label class="required-field required-among"  for="name_vi"><span class="required-input">*</span>{{ __('base.required_among',['items' => __('job_category.name_vi') . ' , ' . __('job_category.name_jp')]) }}</label>' +
                    '<input type="text" class="form-control" placeholder="{{ __('job_category.name_vi_input') }}" onkeyup="keyUpEmployee(event)" name="vi[name]" id="name_vi">' +
                    '<span class="text-danger name_vi"></span>'+
                    '</div>' +
                    '<div class="form-group bmd-form-group label-input ">' +
                    '<div>{{ __('job_category.name_jp') }}</div>' +
                    '<label class="required-field required-among"  for="name_vi"><span class="required-input">*</span>{{ __('base.required_among',['items' => __('job_category.name_vi') . ' , ' . __('job_category.name_jp')]) }}</label>' +
                    '<input type="text" class="form-control" placeholder="{{ __('job_category.name_jp_input') }}" onkeyup="keyUpEmployee(event)" name="jp[name]" id="name_jp">' +
                    '<span class="text-danger name_jp"></span>'+
                    '</div>' +
                    '<div class="row">' +
                    '<label class="col-md-3 bmd-label-user" for="image">{{ __('base.image') }}</label>' +
                    '<div class="col-md-9 pl-0">'+
                    '<label class="btn btn-file">'+
                    '{{__('executive_board.choose_file')}}<input accept="image/gif,image/jpeg,image/webp,image/png,image/svg,image/svg+xml" type="file" onchange="readImage(this)" style="display: none;" name="image" id="image" />'+
                    '</label>' +
                    '<span class="file-image" style="display: none"><span class="name-file"></span><a href="javascript:removeImage();">&times;</a></span>' +
                    '</div>'+
                    '</div>' +
                    '<div class="form-group bmd-form-group label-input row">'+
                    '<span class="col-md-3 required-field"><span class="required-input">*</span>{{__('base.file_size') . __('base.standard_size') . '215x314'}}</span>' +
                    '<div class=col-md-9>'+
                    '<img id="load_image" src="" class="image-executive-board" style="display:none">' +
                        '<div class="text-danger image"></div>'+
                    '</div>' +
                    '</div>' +
                    '<div class="form-group bmd-form-group label-input ">' +
                    '<label class="bmd-label-user" for="location">{{ __('base.branch')}}<span class="required-input">*</span></label>'+
                    '<div class="row row-margin-0 justify-content-between">' +
                    '<select type="text" class="form-control col" name="branch_id" id="locationExecutiveBoard" onchange="keyUpError(this)"> </select>' +
                    '</div>' +
                    '<span class="text-danger branch_id"></span>'+
                    '</div>' +
                    '<div class="form-group bmd-form-group label-input ">' +
                        '<label class="bmd-label-user" for="position">{{ __('executive_board.position')}}<span class="required-input">*</span></label>'+
                        '<div class="row row-margin-0 justify-content-between">' +
                            '<select type="text" class="form-control col" name="job_category_id" id="categoryExecutiveBoard" onchange="keyUpError(this)"> </select>' +
                            '<p class="btn btn-create col btn-add" data-toggle="modal" data-target="#createJobCategoryModal">'+
                                '<i class="fa fa-plus"></i>' +
                            '</p>' +
                        '</div>' +
                        '<span class="text-danger job_category_id"></span>'+
                    '</div>' +
                    '</div>' +
                    '<div class="modal-footer">' +
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('base.close')}}</button>' +
                    '<button type="submit" class="btn btn-create" id="btnExecutiveBoard">{{ __('base.create')}}</button>' +
                    '</div>';
                document.getElementById('formExecutiveBoard').innerHTML = html;
            }
            let htmlJobCategory = `<option value=""> {{ __('executive_board.position_input') }} </option>`;
            if($('meta[name=language]').prop('content') == 'vi')
            {
                jobCategory.forEach(element => {
                    htmlJobCategory += `<option value="${element.id}">${element.name_vi}</option>`;
                });
            }
            else {
                jobCategory.forEach(element => {
                    htmlJobCategory += `<option value="${element.id}">${element.name_en}</option>`;
                });
            }
            let htmlBranch = `<option value="">{{ __('executive_board.location_input') }} </option>`;
            branches.forEach(element => {
                htmlBranch += `<option value="${element.id}">${element.location.name} (${element.location.country})</option>`;
            });
            $('select[name="job_category_id"]').html(htmlJobCategory).val();
            $('select[name="branch_id"]').html(htmlBranch);
            if(dataExecutiveBoard != null)
            {
                $('select[name="job_category_id"]').val(dataExecutiveBoard.job_category_id);
                $('select[name="branch_id"]').val(dataExecutiveBoard.branch_id);
            }
        }
        $('#formExecutiveBoard').submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            let method = $(this).attr("method");
            let url = $(this).attr("action");
            $.ajax({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', '_method': method},
                type: 'post',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                success: function (res){
                    $(`.text-danger`).html("");
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
                    $('#createExecutiveBoard').hide();
                    $('body').removeClass('modal-open').css({padding : 0});
                    $(".modal-backdrop").remove();
                    $('#list-executive-board').DataTable().ajax.reload();
                },
                error: function(error){
                    let errors = error.responseJSON.errors;
                    $(`.text-danger`).html("");
                    $.each(errors,function (key,value){
                        if(key.search('name') == -1)
                        {
                            $(`#formExecutiveBoard select[name=${key}],#formExecutiveBoard input[name=${key}]`).focus();
                            $(`.text-danger.${key}`).html(value[0]).addClass("error-input");
                        }
                        else
                        {
                            let id = 'name_' + key.replace('.name','');
                            $(`.text-danger.${id}`).html(value[0]).addClass("error-input");
                            $(`#formExecutiveBoard #${id}`).focus();
                        }
                    });
                    let old_job_category_id = $('select[name="job_category_id"]').val();
                    let old_branch_id = $('select[name="branch_id"]').val();
                    let urlJobCategory = "{{ url('admin/job-category') }}";
                    let urlBranch = "{{ url('admin/branch-employee') }}";
                    let branches = [];
                    let jobCategory = [];
                    $.ajax({
                        url : urlJobCategory,
                        data:{
                            '_token': '{{ csrf_token() }}'
                        },
                        method: 'GET',
                        async: false,
                    }).done(function(data){
                        jobCategory = data.data;
                    });
                    $.ajax({
                        url : urlBranch,
                        data:{
                            '_token': '{{ csrf_token() }}'
                        },
                        method: 'GET',
                        async: false,
                    }).done(function(data){
                        branches = data;
                    });
                    let htmlJobCategory = `<option value=""> {{ __('executive_board.position_input') }} </option>`;
                    if($('meta[name=language]').prop('content') == 'vi')
                    {
                        jobCategory.forEach(element => {
                            htmlJobCategory += `<option value="${element.id}">${element.name_vi}</option>`;
                        });
                    }
                    else {
                        jobCategory.forEach(element => {
                            htmlJobCategory += `<option value="${element.id}">${element.name_en}</option>`;
                        });
                    }
                    let htmlBranch = `<option value="">{{ __('executive_board.location_input') }} </option>`;
                    branches.forEach(element => {
                        htmlBranch += `<option value="${element.id}">${element.location.name} (${element.location.country})</option>`;
                    });
                    $('select[name="job_category_id"]').html(htmlJobCategory).val();
                    $('select[name="branch_id"]').html(htmlBranch);
                    $('select[name="job_category_id"]').val(old_job_category_id);
                    $('select[name="branch_id"]').val(old_branch_id);
                    $('#list-executive-board').DataTable().ajax.reload();
                }
            })
        });
</script>
@endsection
