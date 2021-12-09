@extends('dashboard.base')
@section('title')
    {{__('base.hotline')}}
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
                                        {{__('base.list')}} {{__('base.hotline_header')}}
                                    @else
                                        {{__('base.hotline')}} {{__('base.list')}}
                                    @endif
                                </span>
                                <button
                                    class="btn btn-create float-right px-2 py-1"
                                    onclick="checkHotline(-1,-1)"
                                    data-toggle="modal"
                                    data-target="#createHotlineModal">
                                    <i class="fa fa-plus"></i> {{__('base.create')}}
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="table-search">
                                        <input type="search" id="table-search" name="list-hotline" class="col-8 form-control form-control-sm" placeholder="{{__('base.search')}}">
                                    </div>
                                    <table id="list-hotline"
                                           class="table table-bordered table-hover table-striped"
                                           style="width: 100%">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>{{__('base.stt')}}</th>
                                            <th>{{__('base.name')}}</th>
                                            <th>{{__('base.gender')}}</th>
                                            <th>{{__('base.phone')}}</th>
                                            <th>{{__('base.branch')}}</th>
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
            {{--            Delete hotlines modal--}}
            <div class="modal fade" id="confirmDeleteHotline" tabindex="-1" role="dialog" aria-labelledby="modelLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{__('base.delete_confirm')}}
                        </div>
                        <div id="confirmMessage" class="modal-body">
                            {{__('base.delete_message',['item' => __('base.hotline_header')])}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnConfirmHotline" class="btn btn-delete btn-ok"
                                    onclick="deleteHotline($(this).val())">
                                {{__('base.delete')}}
                            </button>
                            <button type="button" id="confirmCancel" class="btn btn-secondary" data-dismiss="modal"
                                    data-toggle="modal" data-target="#confirmDeleteHotline">
                                {{__('base.cancel')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @include ('blocks.hotline.create')
@endsection
@section('css')

@endsection
@section('javascript')
<script>
    $(document).ready(function() {
        $('#list-hotline').DataTable({
            processing: true,
            serverSide: true,
            language: {
                url: '{{asset('lib/datatables/lang/').'/'.App::getLocale().'.json'}}',
            },
            ajax: "{{ route('hotlines.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'gender', name: 'gender' },
                { data: 'phone', name: 'phone' },
                { data: 'branch', name: 'branch' },
            ],
            columnDefs: [
                { "sortable": false, "targets": [ 0 ] },
                {
                    "targets": 5,
                    "data": null,
                    "render": function (data) {
                        let disabled = '';
                        let event = '';
                        if(data.jobs_count > 0){
                            disabled = 'disabled';
                            event = ` style="pointer-events:none" `;
                        }
                        let branch_id = -1;
                        if(data.branch_id != null)
                        {
                            branch_id = data.branch_id;
                        }
                        let edit_event = ' onclick = checkHotline(' + data.id + ',' + branch_id + ') ' ;
                        let delete_event = ' onclick = checkHotlineExisted(' + data.id + ') ';
                        return '<button class="btn btn-edit btn-sm" ' + edit_event  + 'id="row_' + data.id +
                            '" data-toggle="modal" data-target="#createHotlineModal">' +
                            '<span class="fa fa-edit"></span></button> ' +
                            '<button class="btn btn-sm btn-delete '+ disabled +'" ' + delete_event + 'id="row_' + data.id +
                            '" data-toggle="modal" data-target="#confirmDeleteHotline"'+ event + disabled +'>' +
                            '<span class="fa fa-trash" ></span></button> ';
                    },
                }
            ],
            "order": [[ 1, 'asc' ]]
        });

    })
        function checkHotlineExisted(id) {
            $('#btnConfirmHotline').val(id);
        }
        function deleteHotline(id) {
            let delete_URL = "{{ url('admin/hotlines') }}/" + id;
            let request = $.ajax({
                url: delete_URL,
                data:{
                    'id': id,
                    '_token': '{{ csrf_token() }}'
                },
                method: "DELETE"
            }).done(function (data) {
                $("#confirmDeleteHotline").modal('hide');
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
                    $(`#row_${data.row_id}`).closest("tr").remove();
                    iziToast.success({
                        title: data.title,
                        message: data.message,
                        position: 'topRight'
                    });
                }
                $('#list-hotline').DataTable().ajax.reload();
            });
        }

        function checkHotline(id,$job_id)
        {
            let dataHotline = null;
            if(id != -1)
            {
                let edit_URL = "{{ url('admin/hotlines') }}/" + id;
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
                            dataHotline = data;
                        }
                    }
                }).done(function (data) {
                    if(data.status == 500){
                        setTimeout(function(){
                            $("#createHotlineModal").hide();
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
                        let hotline = data;
                        let title = "<span class='bold-text'>{{ __('base.hotline')}} {{__('base.edit') }}</span>";
                        if($('meta[name=language]').prop('content') == 'vi')
                        {
                            title = "<span class='bold-text'>{{__('base.edit') }} {{ __('base.hotline_header')}}</span>";
                        }
                        document.getElementById('nameForm').innerHTML = title +
                        '<span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>';
                        let url = "{{url('admin/hotlines')}}/"+ hotline.id;
                        $("#formHotlineModal").attr("action",url).attr('data-type','put');
                    }
                });
            }
            else
            {
                let url = "{{url('admin/hotlines')}}";
                let title = "<span class='bold-text'>{{ __('base.hotline')}} {{__('base.create') }}</span>";
                if($('meta[name=language]').prop('content') == 'vi')
                {
                    title = "<span class='bold-text'>{{__('base.create') }} {{ __('base.hotline_header')}}</span>";
                }
                document.getElementById('nameForm').innerHTML = title +
                    '<span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>';
                $("#formHotlineModal").attr("action",url).attr('data-type','post');
            }
            $("#formHotlineModal").attr("data-for",'self');
            $('#showBranch').css('display','');
            let urlBranch = "{{ url('admin/branch-hotlines') }}"+'/'+$job_id;
            let branches = [];
            $.ajax({
                url : urlBranch,
                method: 'GET',
                async: false,
            }).done(function(data){
                let htmlBranch = `<option value="">{{__('base.branch_input')}}</option>`;
                data.forEach(element => {
                    let company = '';
                    if(data.company)
                    {
                        company = '(' + data.company['name'] + ')';
                    }
                    htmlBranch += `<option value="${element.id}">${element.name} ${company}</option>`;
                    $('select[name="hotline-branch"]').html(htmlBranch);
                });
                if(dataHotline != null)
                {
                    $('input[name="hotline-name"]').val(dataHotline.name);
                    $('input[name="hotline-phone"]').val(dataHotline.phone);
                    $('select[name="hotline-branch"]').val(dataHotline.branch_id);
                    if(dataHotline.is_male == 1)
                    {
                        $('input[id="Male"]').prop("checked", true);
                    }
                    else
                    {
                        $('input[id="Female"]').prop("checked", true);
                    }
                    $('button[type="submit"').text('{{trans('base.update')}}');
                }
                else
                {
                    $("#formHotlineModal :input").each(function(){
                        if($(this)[0].name != "hotline-gender")
                        {
                            $(this).val('');
                        }
                    });
                    $('select[name="hotline-branch"]').val('');
                    $('button[type="submit"').text('{{trans('base.create')}}');
                }
            });
        }
</script>
@endsection
