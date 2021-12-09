@extends('dashboard.base')
@section('title')
    {{__('base.recruitment')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline thead-light">
                            <div class="card-header add-new-item">
                                <a href="{{route('job.index')}}" class="float-left back-to-list">
                                    {{__('base.job')}}
                                </a>
                                <span class="cross-back">/</span>
                                {{__('base.detail')}}
                            </div>
                            <div class="card-body">
                                <div class="row info-row">
                                    <div class="col-7">
                                        @if(isset($job->branches))
                                            <label class="label-info">{{__('recruitment.company')}}:</label>
                                            <span class="info-normal">{{$job->branches['company']->name}} ({{$job->branches->name}})</span>
                                        @else
                                            <label class="label-info">{{__('recruitment.company')}}:</label>
                                            <span class="info-normal">{{$job->company['name']}}</span>
                                        @endif
                                    </div>
                                    <div class="col-5">
                                        <label class="label-info">{{__('recruitment.job_category')}}:</label>
                                        <span class="info-normal">{{$job->jobCategories['name_vi']}}</span>
                                    </div>
                                </div>
                                <div class="row info-row">
                                    <div class="col-4">
                                        <label class="label-info">{{__('recruitment.end_date')}}:</label>
                                        <span class="info-normal">{{format_date($job->end_date)}}</span>
                                    </div>
                                    <div class="col-4">
                                        <label class="label-info">{{__('job.working_form')}}:</label>
                                        @if($job->is_fulltime)
                                            <span class="info-normal">{{__('job.full_time')}}</span>
                                        @else
                                            <span class="info-normal">{{__('job.part_time')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-4">
                                        <label class="label-info">{{__('recruitment.vacancies')}}:</label>
                                        <span class="info-normal">{{$job->vacancies ?? null ? $job->vacancies : 0}}</span>
                                    </div>
                                </div>
                                <div class="row info-row">
                                    <div class="col-4">
                                        <label class="label-info">{{__('recruitment.salary')}}:</label>
                                        <span class="info-normal">
                                        @if($job->salary_from == null && $job->salary_to == null)
                                                {{__('recruitment.negotiable')}}
                                            @elseif($job->salary_from == null)
                                                {{__('recruitment.maximum')}} {{$job->salary_to}}
                                            @elseif($job->salary_to == null)
                                                {{__('recruitment.minimum')}} {{$job->salary_from}}
                                            @else
                                                {{$job->salary_from}} - {{$job->salary_to}}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-4">
                                        <label class="label-info">{{__('recruitment.contacts')}}:</label>
                                        <span class="info-normal">{{$job->hotline['contact']}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary card-outline thead-light">
                            <div class="card-header ">
                                <span class="lead bold-text" >
                                    @if(App::getLocale() == 'vi')
                                        {{__('base.list')}} {{__('base.recruitment_header')}}
                                    @else
                                        {{__('base.recruitment')}} {{__('base.list')}}
                                    @endif
                                </span>
                                <button class="btn btn-sm btn-delete float-right {{$job->disabled}}" onclick ="checkItemExisted({{$job->id}},'{{$job->disabled}}')"
                                        id="row_{{$job->id}}" data-toggle="modal" data-target="#confirmDeleteItem" @if($job->disabled == 'disabled')
                                        style="pointer-events: none" @endif {{$job->disabled}}>
                                    <span class="fa fa-trash" ></span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-recruitment">
                                    <div class="filter-recruitment row">
                                        <input type="search" id="table-search" name="table-recruitment" class="col-8 form-control form-control-sm" placeholder="{{__('base.search')}}">
                                        <select class="col custom-select custom-select-sm form-control form-control-sm" name="read_at" id="filter">
                                            <option value="0">{{__('recruitment.filter_name')}}</option>
                                            <option value="1">{{__('recruitment.not_seen')}}</option>
                                            <option value="2">{{__('recruitment.seen')}}</option>
                                        </select>
                                    </div>
                                    <table id="table-recruitment"
                                           class="table table-bordered table-hover table-striped"
                                           style="width: 100%">
                                        <thead  class="thead-light">
                                        <tr>
                                            <th>{{__('base.stt')}}</th>
                                            <th>{{__('base.name')}}</th>
                                            <th>{{__('base.email')}}</th>
                                            <th>{{__('base.phone')}}</th>
                                            <th>{{__('base.application_date')}}</th>
                                            <th>{{__('base.read_at')}}</th>
                                            <th style="width: 68.8px">{{__('base.download')}}</th>
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
                            {{__('base.delete_message',['item' => __('base.recruitment')])}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnConfirmDelete" class="btn btn-delete btn-ok"
                                    onclick="deleteItem($(this).val(),$(this).attr('data-type'))">
                                {{__('base.delete')}}
                            </button>
                            <button type="button" id="confirmCancel" class="btn btn-secondary" data-dismiss="modal"
                                    data-toggle="modal" data-target="#confirmDeleteRecruitment">
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
    <style>
            .info-row {
                margin: 0 10px;
                margin-bottom: 30px;
            }
            .label-info {
                margin: 0;
                font-weight: bold;
            }
            .info-title {
                font-size: 25px;
            }
            .info-normal {
                font-size: 16px;
                margin-left: 3px;
            }
            .modal-xl {
                max-width: 1200px;
                width: 88%;
            }
            .header-form {
                padding: 13px 10px;
                border-radius: 10px;
                background-color: #e6e6e6;
                box-shadow: 1px 1px 2px #1d1d1d;
                margin: 0 4px 10px 4px;
                font-size: 22px;
            }
            .row-form {
                padding: 0 25px;
                margin-bottom: 10px;
            }
            .bold {
                font-weight: bold;
            }
    </style>
@endsection
@section('javascript')
    <script>
        let dataTable = $('#table-recruitment').DataTable({
            processing: true,
            serverSide: true,
            language: {
                url: '{{asset('lib/datatables/lang/').'/'.App::getLocale().'.json'}}',
            },
            ajax: {
                url: "{{  url('/admin/job/'. $job->id) }}",
                data: function(d){
                    d.read_at = $('select[name=read_at]').val();
                    d.search = $('input[type="search"]').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'mail_to', name: 'mail_to' },
                { data: 'phone', name: 'phone' },
                { data: 'created_at', name: 'created_at' },
                { data: 'read_at', name: 'read_at' },
            ],
            columnDefs: [
                { "sortable": false, "targets": [0] },
                {
                    "targets": 6,
                    "data": null,
                    "render": function (data) {
                        let update_event = ' onclick="updateItem(' + data.id + ')" ';
                        let href = ' href="'+ data.cv +'" ';
                        return '<a class="btn btn-sm btn-download" ' + href + update_event + ' download>' +
                            '<span class="fa fa-download" ></span></a> ';
                    },
                }],
            "order": [[ 6, 'desc' ]]
        });

        $("#filter").on('change', function(e){
            dataTable.draw();
            e.preventDefault();
        });

        $('#openBtn').click(function () {
            $('#detailRecruitment').modal({
                show: true
            })
        });

        $('.modal').on('show.bs.modal', function (event) {
            var idx = $('.modal:visible').length;
            $(this).css('z-index', 1040 + (10 * idx));
        });
        $('.modal').on('shown.bs.modal', function (event) {
            var idx = ($('.modal:visible').length) - 1; // raise backdrop after animation.
            $('.modal-backdrop').not('.stacked').css('z-index', 1039 + (10 * idx));
            $('.modal-backdrop').not('.stacked').addClass('stacked');
        });

        const listJobRecruitment = <?php echo $listJobRecruitment; ?>;
        function updateJobRecruitment(id,status_recruitment_id)
        {
            $('#status_recruitment_id').val(status_recruitment_id);
            $('#btnConfirmUpdate').val(id);
            let status = 'accept';
            if (status_recruitment_id == 3)
            {
                status = 'decline';
            }
            document.getElementById('confirmMessage').innerHTML = 'Are you sure want to '+ status +' this recruitment?';
        }

        function checkItemExisted(id,disabled) {
            $('#btnConfirmDelete').val(id).attr('data-type',disabled);
        }

        function deleteItem(id,disabled) {
            let delete_URL = "{{ url('admin/recruitment/job') }}/" + parseInt(id);
            let request = $.ajax({
                url: delete_URL,
                data:{
                    'id': id,
                    '_token': '{{ csrf_token() }}',
                    'disabled': disabled
                },
                method: "DELETE"
            }).done(function (data) {
                $("#confirmDeleteItem").modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                if(data.status == 500){
                    if(data.not_exist)
                    {
                        localStorage.setItem("status",data.status);
                        localStorage.setItem("title",data.title);
                        localStorage.setItem("message",data.message);
                        window.location.replace('{{route('job.index')}}');
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
                    dataTable.draw();
                }
            });
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
                if(data.status == 500){
                    iziToast.error({
                        title: data.title,
                        message: data.message,
                        position: 'topRight'
                    });
                }
                else {
                    iziToast.success({
                        title: data.title,
                        message: data.message,
                        position: 'topRight'
                    });
                }
                dataTable.draw();
            });
        }

        // function DetailRecruitment(id) {
        //     $('#btnAcceptJobRecruitment').val(id);
        //     $('#btnDeclineJobRecruitment').val(id);
        //     let jobRecruitment = listJobRecruitment.find(element => element.id == id);
        //     document.getElementById('salary_expectation').innerText = jobRecruitment.salary_expectation;
        //     document.getElementById('work_date').innerText = moment(jobRecruitment.work_date).format('DD/MM/YYYY');
        //     document.getElementById('work_place_expectation').innerText = jobRecruitment.branch['province'];
        //     document.getElementById('name').innerText = jobRecruitment.name;
        //     document.getElementById('is_married').innerText = jobRecruitment.is_married ?? '0' ? 'Đã kết hôn' : 'Độc thân' ;
        //     document.getElementById('is_male').innerText = jobRecruitment.is_male ?? '0' ? 'Nam' : 'Nữ' ;
        //     document.getElementById('DOB').innerText = moment(jobRecruitment.DOB).format('DD/MM/YYYY');
        //     document.getElementById('POB').innerText = jobRecruitment.POB;
        //     document.getElementById('email').innerText = jobRecruitment.email;
        //     document.getElementById('phone').innerText = jobRecruitment.phone;
        //     document.getElementById('identity_card').innerText = jobRecruitment.identity_card;
        //     document.getElementById('date_of_issue').innerText = jobRecruitment.date_of_issue;
        //     document.getElementById('place_of_issue').innerText = jobRecruitment.place_of_issue;
        //     document.getElementById('permanent_address').innerText = jobRecruitment.permanent_address;
        //     document.getElementById('current_address').innerText = jobRecruitment.current_address;
        //     document.getElementById('weight').innerText = jobRecruitment.weight;
        //     document.getElementById('height').innerText = jobRecruitment.height;
        // }

    </script>
@endsection
