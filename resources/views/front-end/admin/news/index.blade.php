@extends('dashboard.base')
@section('title')
    {{__('news.news')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline thead-light list-item">
                            <div class="card-header">
                                <span class="lead bold-text" >
                                    @if(App::getLocale() == 'vi')
                                        {{__('base.list')}} {{__('base.news_header')}}
                                    @else
                                        {{__('base.news')}}{{__('base.list')}}
                                    @endif
                                </span>
                                <a href="{{ route('news.create') }}">
                                    <button class="btn btn-create float-right px-2 py-1">
                                        <i class="fa fa-plus"></i>
                                        @if(App::getLocale() == 'vi')
                                            {{__('base.create')}} {{__('base.news_header')}}
                                        @else
                                            {{__('base.news')}}{{__('base.create')}}
                                        @endif
                                    </button>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="table-search">
                                        <input type="search" id="table-search" name="list-news" class="col-8 form-control form-control-sm" placeholder="{{__('base.search')}}">
                                    </div>
                                    <table id="list-news"
                                           class="table table-bordered table-hover table-striped"
                                           style="width: 100%">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>{{__('base.stt')}}</th>
                                            <th>{{__('news.title')}}</th>
                                            <th>{{__('base.image')}}</th>
                                            <th style="width: 145px">{{__('base.created_at')}}</th>
                                            <th style="width: 85px">{{__('base.action')}}</th>
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
                            {{__('base.delete_message',['item' => __('base.news_header')])}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnConfirmDelete" class="btn btn-delete btn-ok"
                                    onclick="deleteItem($(this).val())">
                                {{__('base.delete')}}
                            </button>
                            <button type="button" id="confirmCancel" class="btn btn-secondary" data-dismiss="modal"
                                    data-toggle="modal" data-target="#confirmDeleteNews">
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
    var table = [];
        $(document).ready(function() {
            table= $('#list-news').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('news.index') }}",
                },
                language: {
                    url: '{{asset('lib/datatables/lang/').'/'.App::getLocale().'.json'}}',
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'title', name: 'title' },
                    { data: 'image', name: 'image' },
                    { data: 'date_submitted', name: 'date_submitted' },
                ],
                columnDefs: [
                    { "sortable": false, "targets": [ 0 ] },
                    {
                    "targets": 4,
                    "data": null,
                    "render": function (data) {
                        edit_url = "{{ url('admin/news') }}/" + data.id;
                        delete_event = ' onclick = checkItemExisted(' + data.id + ') ';
                        return '<a class="btn btn-edit btn-sm" href=' + edit_url + '><span class="fa fa-edit"></span></a> ' +
                            '<button class="btn btn-sm btn-delete" ' + delete_event + 'id="row_' + data.id + '" data-toggle="modal" data-target="#confirmDeleteItem" >' +
                            '<span class="fa fa-trash" ></span></button> ';
                    },
                }],
            });
            // table.on('order.dt search.dt', function () {
            //     table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            //         cell.innerHTML = i + 1;
            //     });
            // }).draw();
        })

        function checkItemExisted(id) {
            $('#btnConfirmDelete').val(id);
        }

        function deleteItem(id) {
            let delete_URL = "{{ url('admin/news') }}/" + id;
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
                    iziToast.success({
                        title: data.title,
                        message: data.message,
                        position: 'topRight'
                    });
                }
                $('#list-news').DataTable().ajax.reload();
            });
        }
</script>
@endsection
