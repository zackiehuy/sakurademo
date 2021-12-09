@extends('dashboard.base')
@section('title')
    {{__('base.job')}}
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
                                        {{__('base.list')}} {{__('base.job_header')}}
                                    @else
                                        {{__('base.job')}}{{__('base.list')}}
                                    @endif
                                </span>
                                <a href="{{route('job.create')}}">
                                    <button class="btn btn-create float-right px-2 py-1">
                                        <i class="fa fa-plus"></i>
                                        @if(App::getLocale() == 'vi')
                                            {{__('base.create')}} {{__('base.job_header')}}
                                        @else
                                            {{__('base.job')}}{{__('base.create')}}
                                        @endif
                                    </button>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="table-search">
                                        <input type="search" id="table-search" name="job-list" class="col-8 form-control form-control-sm" placeholder="{{__('base.search')}}">
                                    </div>
                                    <table id="job-list"
                                           class="table table-bordered table-hover table-striped"
                                           style="width: 100%">
                                        <thead  class="thead-light">
                                        <tr>
                                            <th>{{__('base.stt')}}</th>
                                            <th>{{__('base.company')}}</th>
                                            <th>{{__('job.job_category')}}</th>
                                            <th>{{__('job.end_date')}}</th>
                                            <th>{{__('job.contacts')}}</th>
                                            <th>{{__('base.sluv')}}</th>
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
                            {{__('base.delete_message',['item' => __('base.job_header')])}}
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
        </section>
    </div>
@endsection

@section('css')

@endsection
@section('javascript')
<script>
        $('#job-list').DataTable({
            processing: true,
            serverSide: true,
            language: {
                url: '{{asset('lib/datatables/lang/').'/'.App::getLocale().'.json'}}',
            },
            ajax: {
                url : "{{ route('job.index') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'branch', name: 'branch' },
                { data: 'job_categories.name_vi', name: 'job_categories.name_vi' },
                { data: 'end_date', name: 'end_date' },
                { data: 'contacts', name: 'contacts' },
                { data: 'sluv', name: 'sluv' }
            ],
            columnDefs: [
                { "sortable": false, "targets": [0] },
                {
                    "targets": 6,
                    "data": null,
                    "render": function (data) {
                        let detail_event = "{{ url('admin/job/')}}/" + data.id;
                        let edit_url = "{{ url('admin/job') }}/" + data.id + "/edit";
                        let delete_event = ' onclick = checkItemExisted(' + data.id + ') ';
                        let event = '';
                        if(data.disabled == 'disabled')
                        {
                            event = ' style="pointer-events: none" ';
                        }
                        return '<a class="btn btn-sm btn-recruitment-info" href="' + detail_event + '" id="job_row_'+ data.id+'">'
                            +'<span class="fa fa-info"></span></a>' +
                            '<a class="btn btn-edit btn-sm" href=' + edit_url + '><span class="fa fa-edit"></span></a> ' +
                            '<button class="btn btn-sm btn-delete '+data.disabled+'" ' + delete_event + 'id="row_' + data.id + '" data-toggle="modal" ' +
                            'data-target="#confirmDeleteItem" '+ event + data.disabled +'>' +
                            '<span class="fa fa-trash" ></span></button> ';
                    },
                }],
            "order": [[ 3, 'desc' ]]
        });

        function checkItemExisted(id) {
            $('#btnConfirmDelete').val(id);
        }

        function deleteItem(id) {
            let delete_URL = "{{ url('admin/job') }}/" + id;
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
                        $(`#row_${data.row_id}`).closest("tr").remove();
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
                $('#job-list').DataTable().ajax.reload();
            });
        }
</script>
@endsection
