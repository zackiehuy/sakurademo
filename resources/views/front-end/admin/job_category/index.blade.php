@extends('dashboard.base')
@section('title')
    {{__('base.job_category')}}
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
                                        {{__('base.list')}} {{__('base.job_category_header')}}
                                    @else
                                        {{__('base.job_category')}}{{__('base.list')}}
                                    @endif
                                </span>
                                <button
                                    class="btn btn-create float-right px-2 py-1"
                                    onclick="checkJobCategory(-1)"
                                    data-toggle="modal"
                                    data-target="#createCategory">
                                    <i class="fa fa-plus"></i>
                                    @if(App::getLocale() == 'vi')
                                        {{__('base.create')}} {{__('base.job_category_header')}}
                                    @else
                                        {{__('base.job_category')}}{{__('base.create')}}
                                    @endif
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="table-search">
                                        <input type="search" id="table-search" name="list-job-category" class="col-8 form-control form-control-sm" placeholder="{{__('base.search')}}">
                                    </div>
                                    <table id="list-job-category"
                                           class="table table-bordered table-hover table-striped"
                                           style="width: 100%">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>{{__('base.stt')}}</th>
                                            <th>{{__('job_category.name_en')}}</th>
                                            <th>{{__('job_category.name_vi')}}</th>
                                            <th>{{__('job_category.name_jp')}}</th>
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
                            {{__('base.delete_message',['item' => __('base.job_category_header')])}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnConfirmDelete" class="btn btn-delete btn-ok"
                                    onclick="deleteItem($(this).val())">
                                {{__('base.delete')}}
                            </button>
                            <button type="button" id="confirmCancel" class="btn btn-secondary" data-dismiss="modal"
                                    data-toggle="modal" data-target="#confirmDeleteJob">
                                {{__('base.cancel')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
{{--            Edit & Create--}}
            <div class="modal fade"
                 id="createCategory"
                 tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" >
                        <div class="modal-header card-header" id="nameForm">
                            {{__('base.create'). ' ' .__('base.job_category')}}
                        </div>
                        <form id="formJobCategory" role="form" method="post" action="{{url('admin/job-category')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group bmd-form-group label-input ">
                                    <label class="bmd-label-user" for="name">{{__('base.name')}}</label>
                                    <input type="text"
                                           class="form-control"
                                           required name="name"
                                           id="nameJobCategory"
                                           value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>
                                <button type="submit" class="btn btn-success" id="btnJobCategory">{{__('base.create')}}</button>
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
        var table= $('#list-job-category').DataTable({
            processing: true,
            serverSide: true,
            language: {
                url: '{{asset('lib/datatables/lang/').'/'.App::getLocale().'.json'}}',
            },
            ajax: "{{ route('job-category.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name_en', name: 'name_en' },
                { data: 'name_vi', name: 'name_vi' },
                { data: 'name_jp', name: 'name_jp' },
            ],
            columnDefs: [
                { "sortable": false, "targets": [0 ] },
                {
                    "targets": 4,
                    "data": null,
                    "render": function (data) {
                        let disabled = '';
                        let event = '';
                        if(data.jobs_count + data.executive_board_count > 0)
                        {
                            disabled = 'disabled';
                            event = ' style="pointer-events: none" ';
                        }
                        let edit_event = ' onclick = checkJobCategory(' + data.id + ') ' ;
                        let delete_event = ' onclick = checkItemExisted(' + data.id + ') ';
                        return '<button class="btn btn-edit btn-sm" ' + edit_event  + 'id="row_' + data.id +
                            '" data-toggle="modal" data-target="#createCategory">' +
                            '<span class="fa fa-edit"></span></button> ' +
                            '<button class="btn btn-sm btn-delete '+ disabled +'" ' + delete_event + 'id="row_' + data.id +
                            '" data-toggle="modal" data-target="#confirmDeleteItem" '+ event + disabled +'>' +
                            '<span class="fa fa-trash" ></span></button> ';
                    },
                }
            ],
        });
    })
        function checkItemExisted(id) {
            $('#btnConfirmDelete').val(id);
        }
        function deleteItem(id) {
            let delete_URL = "{{ url('admin/job-category') }}/" + id;
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
                    $('#list-job-category').DataTable().ajax.reload();
                }
                else {
                    $(`#row_${data.row_id}`).closest("tr").remove();
                    iziToast.success({
                        title: 'Message',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            });
        }

        function checkJobCategory(id)
        {
            if(id != -1)
            {
                let edit_URL = "{{ url('admin/job-category') }}/" + id;
                let request = $.ajax({
                    url: edit_URL,
                    data:{
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    method: "GET"
                }).done(function (data) {
                    if(data.status == 500){
                        setTimeout(function(){
                            $("#createCategory").hide();
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
                        let jobCategory = data;
                        let title = "";
                        if($('meta[name=language]').prop('content') == 'vi')
                        {
                            title = "<span class='bold-text'>{{__('base.edit') }} {{ __('base.job_category_header')}}</span>";
                        }
                        else
                        {
                            title = '<span class="bold-text">' + '{{__('base.job_category') }} {{ __('base.edit')}}' + "</span>";
                        }
                        document.getElementById('nameForm').innerHTML = title +
                        '<span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>';
                        let url = "{{url('admin/job-category')}}/"+ jobCategory.id;
                        $("#formJobCategory").attr("action",url).attr('method','PUT');
                        document.getElementById('formJobCategory').innerHTML =
                            '@csrf <input type="hidden" name="_method" value="PUT">'+
                            '<div class="modal-body">' +
                                '<div class="form-group bmd-form-group label-input row">' +
                                    '<label class="col-md-3 bmd-label-user" for="name_en">{{__('job_category.name_en')}}<span class="required-input">*</span></label>' +
                                    '<div class="col-md-9 pl-0">' +
                                        '<input type="text" class="form-control" onkeyup="keyUpError(this)" placeholder="{{__('job_category.name_en_input')}}" name="name_en" id="name_enJobCategory" value="'+
                                        jobCategory.name_en +'">'+
                                    '</div>' +
                                    '<label class="col-md-3"></label>'+
                                    '<div class="col-md-9 pl-0 text-danger name_en"></div>' +
                                '</div>' +
                                '<div class="form-group bmd-form-group label-input row">' +
                                    '<label class="col-md-3 bmd-label-user" for="name_vi">{{__('job_category.name_vi')}}<span class="required-input">*</span></label>' +
                                    '<div class="col-md-9 pl-0">' +
                                        '<input type="text" class="form-control" onkeyup="keyUpError(this)" placeholder="{{__('job_category.name_vi_input')}}" name="name_vi" id="name_viJobCategory" value="'+
                                        jobCategory.name_vi +'">'+
                                    '</div>' +
                                    '<label class="col-md-3"></label>'+
                                    '<div class="col-md-9 pl-0 text-danger name_vi"></div>' +
                                '</div>' +
                            '<div class="form-group bmd-form-group label-input row">' +
                            '<label class="col-md-3 bmd-label-user" for="name_jp">{{__('job_category.name_jp')}}<span class="required-input">*</span></label>' +
                            '<div class="col-md-9 pl-0">' +
                            '<input type="text" class="form-control" onkeyup="keyUpError(this)" placeholder="{{__('job_category.name_jp_input')}}" name="name_jp" id="name_jpJobCategory" value="'+
                            jobCategory.name_jp +'">'+
                            '</div>' +
                            '<label class="col-md-3"></label>'+
                            '<div class="col-md-9 pl-0 text-danger name_jp"></div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="modal-footer">' +
                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>' +
                            '<button type="submit" class="btn btn-create" id="btnJobCategory">{{__('base.update')}}</button>' +
                            '</div>';
                    }
                });
            }
            else
            {
                let title = "";
                if($('meta[name=language]').prop('content') == 'vi')
                {
                    title = "<span class='bold-text'>{{__('base.create') }} {{ __('base.job_category_header')}}</span>";
                }
                else
                {
                    title = "<span class='bold-text'>{{__('base.job_category') }} {{ __('base.create')}}</span>";
                }
                document.getElementById('nameForm').innerHTML = title+
                '<span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>';
                let url = "{{url('admin/job-category')}}";
                $("#formJobCategory").attr("action",url).attr('method','POST');
                document.getElementById('formJobCategory').innerHTML =
                    '@csrf <div class="modal-body">' +
                    '<div class="form-group bmd-form-group label-input row">' +
                        '<label class="col-md-3 bmd-label-user" for="name_en">{{__('job_category.name_en')}}<span class="required-input">*</span></label>' +
                        '<div class="col-md-9 pl-0">'+
                            '<input type="text" class="form-control" onkeyup="keyUpError(this)" placeholder="{{__('job_category.name_en_input')}}" name="name_en" id="name_enJobCategory">' +
                        '</div>'+
                        '<label class="col-md-3"></label>' +
                        '<div class="col-md-9 pl-0 text-danger name_en"></div>'+
                    '</div>' +
                    '<div class="form-group bmd-form-group label-input row">' +
                    '<label class="col-md-3 bmd-label-user" for="name_vi">{{__('job_category.name_vi')}}<span class="required-input">*</span></label>' +
                    '<div class="col-md-9 pl-0">'+
                    '<input type="text" class="form-control" onkeyup="keyUpError(this)" placeholder="{{__('job_category.name_vi_input')}}" name="name_vi" id="name_viJobCategory">' +
                    '</div>'+
                    '<label class="col-md-3"></label>' +
                    '<div class="col-md-9 pl-0 text-danger name_vi"></div>'+
                    '</div>' +
                    '<div class="form-group bmd-form-group label-input row">' +
                    '<label class="col-md-3 bmd-label-user" for="name_jp">{{__('job_category.name_jp')}}<span class="required-input">*</span></label>' +
                    '<div class="col-md-9 pl-0">'+
                    '<input type="text" class="form-control" onkeyup="keyUpError(this)" placeholder="{{__('job_category.name_jp_input')}}" name="name_jp" id="name_jpJobCategory">' +
                    '</div>'+
                    '<label class="col-md-3"></label>' +
                    '<div class="col-md-9 pl-0 text-danger name_jp"></div>'+
                    '</div>' +
                    '</div>' +
                    '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>' +
                        '<button type="submit" class="btn btn-create" id="btnJobCategory">{{__('base.create')}}</button>' +
                    '</div>';
            }
        }
    $("#formJobCategory").submit(function (e) {
        e.preventDefault();
        let form = $(this).serialize();
        let method = $("#formJobCategory").attr("method");
        let url = $("#formJobCategory").attr("action");
        $.ajax({
            type: method,
            url: url,
            data: form,
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
                $('#createCategory').hide();
                $('body').removeClass('modal-open').css({padding : 0});
                $(".modal-backdrop").remove();
                $('#list-job-category').DataTable().ajax.reload();
            },
            error: function(error){
                let errors = error.responseJSON.errors;
                $(`.text-danger`).html("");
                $.each(errors,function (key,value){
                    $(`.text-danger.${key}`).html(value[0]).addClass("error-input");
                    $(`#formJobCategory input[name=${key}`).focus();
                });
            }
        })
    });
</script>
@endsection
