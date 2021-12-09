@extends('dashboard.base')
@section('title')
    {{__('menu.dashboard')}}
@endsection
@section('content')

    <div class="container-fluid dashboard">
        <div class="fade-in">
            <!-- /.row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <!-- /.col-->
                        <div class="col-sm-5">
                            <div class="card card-recruitment">
                                <div class="table-dashboard-job">
                                    <h2>{{__('base.job')}}</h2>
                                    <div class="table-responsive" id="scroll-table">
                                        <table id="table-dashboard-job"
                                               class="table table-bordered table-hover table-striped">
                                            <thead  class="thead-light">
                                            <tr>
                                                <th>{{__('job.title')}}</th>
                                                <th style="width: 90px">{{__('job.end_date')}}</th>
                                                <th style="width: 67px">{{__('base.action')}}</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="calendar">
                                <div class="content-wrapper ">
                                    <div class="calendar-wrapper">
                                        <div class="header-background">
                                            <div class="calendar-header">
                                                <a class="prev-button" id="prev">
                                                    <i class="fa fa-chevron-left"></i>
                                                </a>
                                                <a class="next-button" id="next">
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>
                                                <span id="todayMonthName"> Friday</span>
                                                <div class="row header-title">
                                                    <div class="header-text">
                                                        <h2 id="">{{trans('dashboard.calendar')}}</h2>
                                                        <h3 id="todayDayName">Today is Friday 7 Feb</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="calendar-content">
                                            <div id="calendar-table" class="calendar-cells">
                                                <div id="table-header">
                                                    <div class="row">
                                                        <div class="col">{{trans('dashboard.mon')}}</div>
                                                        <div class="col">{{trans('dashboard.tue')}}</div>
                                                        <div class="col">{{trans('dashboard.wed')}}</div>
                                                        <div class="col">{{trans('dashboard.thu')}}</div>
                                                        <div class="col">{{trans('dashboard.fri')}}</div>
                                                        <div class="col">{{trans('dashboard.sat')}}</div>
                                                        <div class="col">{{trans('dashboard.sun')}}</div>
                                                    </div>
                                                </div>

                                                <div id="table-body">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-7">
                            <div class="card card-dashboard-recruitment">
                                <div class="table-dashboard-recruitment">
                                    <h2>
                                        @if(App::getLocale() == 'vi')
                                            {{__('base.list')}} {{__('base.recruitment_header')}}
                                        @else
                                            {{__('base.recruitment')}} {{__('base.list')}}
                                        @endif
                                    </h2>
                                    <div class="table-responsive">
                                        <div class="filter-recruitment row">
                                            <input type="search" id="recruitment-dashboard-search" class="col-8 form-control form-control-sm" placeholder="{{__('base.search')}}">
                                            <select class="col custom-select custom-select-sm form-control form-control-sm" name="read_at" id="filter">
                                                <option value="0">{{__('recruitment.filter_name')}}</option>
                                                <option value="1">{{__('recruitment.not_seen')}}</option>
                                                <option value="2">{{__('recruitment.seen')}}</option>
                                            </select>
                                        </div>
                                        <table id="table-dashboard-recruitment"
                                               class="table table-bordered table-hover table-striped">
                                            <thead  class="thead-light">
                                            <tr>
                                                <th>{{__('base.stt')}}</th>
                                                <th>{{__('base.email')}}</th>
                                                <th style="width: 78px">{{__('base.phone')}}</th>
                                                <th style="width: 109px">{{__('base.application_date')}}</th>
                                                <th style="width: 59px;">{{__('base.download')}}</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input name="job_id" value="@if(isset($job)){{$job->id}}@endif" disabled style="display: none">
@endsection

@section('javascript')
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script>
        let job_id = '-1';
        if ($('input[name=job_id]').val() != null) {
            job_id = $('input[name=job_id]').val();
        }
        $('#table-dashboard-job').DataTable({
            pageLength: 4,
            bLengthChange: false,
            processing: true,
            "ordering": false,
            serverSide: true,
            language: {
                url: '{{asset('lib/datatables/lang/').'/'.App::getLocale().'.json'}}',
            },
            ajax: {
                url: "{{ url('/admin/job') }}",
            },
            "drawCallback": function( settings ) {
                $(`#job_row_${job_id}`).prop('disabled',true).closest('tr').addClass('row-active');
            },
            columns: [
                { data: 'title_dashboard', name: 'title_dashboard' },
                { data: 'end_date', name: 'end_date' },
            ],
            columnDefs: [
                {
                    "targets": 2,
                    "data": null,
                    "render": function (data) {
                        let event = ' onclick="changeUrl(' + data.id + ')" ';
                        return '<button class="btn btn-sm btn-job-info" ' + event + 'id="job_row_'+ data.id+'">'
                            +'<span class="fa fa-info"></span></button>';
                    },
                }],
            "order": [[ 1, 'asc' ]]
        });
        let dataTable = $('#table-dashboard-recruitment').DataTable({
            pageLength: 10,
            bLengthChange: false,
            processing: true,
            serverSide: true,
            language: {
                url: '{{asset('lib/datatables/lang/').'/'.App::getLocale().'.json'}}',
            },
            ajax: {
                url: "{{ url('/admin/job') }}"+ '/' + parseInt(job_id),
                data: function(d){
                    d.read_at = $('select[name=read_at]').val();
                    d.search = $('input[type="search"]').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'mail_to', name: 'mail_to' },
                { data: 'phone', name: 'phone' },
                { data: 'date_submitted', name: 'date_submitted' },
            ],
            columnDefs: [
                { "sortable": false, "targets": [ 0] },
                {
                    "targets": 4,
                    "data": null,
                    "render": function (data) {
                        let update_event = ' onclick="updateItem(' + data.id + ')" ';
                        let href = ' href="'+ data.cv +'" ';
                        return '<a class="btn btn-sm btn-download" ' + href + update_event + ' id="recruitment_row_'+ data.id +'" download>' +
                            '<span class="fa fa-download" ></span></a> ';
                    },
                }],
            "order": [[ 4, 'asc' ]]
        });


        $("#recruitment-dashboard-search").on('keyup',function(e){
            dataTable.search($(this).val()).draw();
        });
        $("#filter").on('change', function(e){
            dataTable.draw();
            e.preventDefault();
        });

        function changeUrl(id){
            $('tr').removeClass('row-active');
            $('tr button').prop('disabled',false);
            $(`#job_row_${id}`).prop('disabled',true).closest('tr').addClass('row-active');
            let url ="{{  url('/admin/job/') }}" + '/' + id;
            $('#table-dashboard-recruitment').DataTable().ajax.url( url ).load();
        }

        function updateItem(id)
        {
            let update_URL = "{{ url('admin/recruitment') }}/" + id;
            let request = $.ajax({
                url: update_URL,
                data:{
                    '_token': '{{ csrf_token() }}'
                },
                method: 'PUT'
            }).done(function (data) {
                $(`#recruitment_row_${id}`).closest('tr').addClass('row-download');
                if(data.status == 500){
                    iziToast.success({
                        title: 'Error',
                        message: data.message,
                        position: 'topRight'
                    });
                }
                else {
                    iziToast.success({
                        title: 'Message',
                        message: data.message,
                        position: 'topRight'
                    });
                }
                dataTable.draw();
            });
        }

    </script>
@endsection
