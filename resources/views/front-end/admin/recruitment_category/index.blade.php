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
                        <div class="card card-primary card-outline thead-light">
                            <div class="card-header ">
                                <span class="lead" >
                                    <i class="fa fa-list-ul" aria-hidden="true"></i> Recruitment Category List
                                </span>
                                <button
                                    class="btn btn-info float-right px-2 py-1"
                                    onclick="checkRecruitmentCategory(-1)"
                                    data-toggle="modal"
                                    data-target="#createRecruitmentCategory">
                                    <i class="fa fa-plus"></i> Create
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="list-recruitment-category"
                                           class="table table-bordered table-hover table-striped"
                                           style="width: 100%">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Context</th>
                                            <th style="width: 68.8px">Action</th>
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
                            Delete confirm
                        </div>
                        <div id="confirmMessage" class="modal-body">
                            Are you sure want to delete this Recruitment Category?
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnConfirmDelete" class="btn btn-danger btn-ok"
                                    onclick="deleteItem($(this).val())">
                                Delete
                            </button>
                            <button type="button" id="confirmCancel" class="btn btn-secondary" data-dismiss="modal"
                                    data-toggle="modal" data-target="#confirmDeleteItem">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
{{--            Edit & Create--}}
            <div class="modal fade"
                 id="createRecruitmentCategory"
                 tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" >
                        <div class="modal-header card-header" id="nameForm">
                            Create Recruitment Category
                        </div>
                        <form id="formRecruitmentCategory" role="form" method="post" action="{{url('admin/recruitment-category')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group bmd-form-group label-input ">
                                    <label class="bmd-label-user" for="name">Name</label>
                                    <input type="text"
                                           class="form-control"
                                           required name="name"
                                           id="nameRecruitmentCategory"
                                           value="{{ old('name') }}">
                                </div>
                                <div class="form-group bmd-form-group label-input ">
                                    <label class="bmd-label-user" for="context">Context</label>
                                    <textarea type="text"
                                           class="form-control"
                                           required name="context"
                                              id="contextRecruitmentCategory">{{ old('context') }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="btnRecruitmentCategory">Create</button>
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
        var table= $('#list-recruitment-category').DataTable({
            processing: true,
            serverSide: true,
            language: {
                url: '{{asset('lib/datatables/lang/').'/'.App::getLocale().'.json'}}',
            },
            ajax: "{{ route('recruitment-category.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'context', name: 'context' },
            ],
            columnDefs: [
                {
                    "targets": 3,
                    "data": null,
                    "render": function (data) {
                        edit_event = ' onclick = checkRecruitmentCategory(' + data.id + ') ' ;
                        delete_event = ' onclick = checkItemExisted(' + data.id + ') ';
                        return '<button class="btn btn-primary btn-sm" ' + edit_event  + 'id="row_' + data.id +
                            '" data-toggle="modal" data-target="#createRecruitmentCategory">' +
                            '<span class="fa fa-edit"></span></button> ' +
                            '<button class="btn btn-sm btn-danger" ' + delete_event + 'id="row_' + data.id +
                            '" data-toggle="modal" data-target="#confirmDeleteItem" >' +
                            '<span class="fa fa-trash" ></span></button> ';
                    },
                }
            ]
        });
    })
        function checkItemExisted(id) {
            $('#btnConfirmDelete').val(id);
        }
        function deleteItem(id) {
            let delete_URL = "{{ url('admin/recruitment-category') }}/" + id;
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

                if(data.status_code == 500){
                    iziToast.error({
                        title: 'Error',
                        message: data.message,
                        position: 'topRight'
                    });
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

        function checkRecruitmentCategory(id)
        {
            if(id != -1)
            {
                let edit_URL = "{{ url('admin/recruitment-category') }}/" + id;
                let request = $.ajax({
                    url: edit_URL,
                    data:{
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    method: "GET"
                }).done(function (data) {
                    if(data.status == 500){
                        $("#createRecruitmentCategory").modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $(`#row_${data.row_id}`).closest("tr").remove();
                        iziToast.error({
                            title: 'Error',
                            message: data.message,
                            position: 'topRight'
                        });
                    }
                    else
                    {
                        let recruitmentCategory = data;
                        document.getElementById('nameForm').innerHTML = "Update Recruitment Category";
                        let url = "{{url('admin/recruitment-category')}}/"+ recruitmentCategory.id;
                        $("#formRecruitmentCategory").attr("action",url);
                        document.getElementById('formRecruitmentCategory').innerHTML =
                            '@csrf <input type="hidden" name="_method" value="PUT">'+
                            '<div class="modal-body">' +
                            '<div class="form-group bmd-form-group label-input ">' +
                            '<label class="bmd-label-user" for="name">Name</label>' +
                            '<input type="text" class="form-control" required name="name" id="nameRecruitmentCategory" value="'+
                            recruitmentCategory.name +'"></div>' +
                            '<div class="form-group bmd-form-group label-input ">' +
                            '<label class="bmd-label-user" for="context">Context</label>' +
                            '<textarea type="text" class="form-control" required name="context"' +
                            'id="contextRecruitmentCategory">'+ recruitmentCategory.context +'</textarea>' +
                            '</div>' +
                            '</div>' +
                            '<div class="modal-footer">' +
                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' +
                            '<button type="submit" class="btn btn-success" id="btnRecruitmentCategory">Update</button>' +
                            '</div>';
                    }
                });
            }
            else
            {
                document.getElementById('nameForm').innerHTML = "Create Recruitment Category";
                let url = "{{url('admin/recruitment-category')}}";
                $("#formRecruitmentCategory").attr("action",url);
                document.getElementById('formRecruitmentCategory').innerHTML =
                    '@csrf <div class="modal-body">' +
                    '<div class="form-group bmd-form-group label-input ">' +
                        '<label class="bmd-label-user" for="name">Name</label>' +
                        '<input type="text" class="form-control" required name="name" id="nameRecruitmentCategory">' +
                    '</div>' +
                    '<div class="form-group bmd-form-group label-input ">' +
                        '<label class="bmd-label-user" for="context">Context</label>' +
                        '<textarea type="text" class="form-control" required name="context"' +
                        'id="contextRecruitmentCategory"></textarea>' +
                    '</div>' +
                    '</div>' +
                    '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' +
                        '<button type="submit" class="btn btn-success" id="btnRecruitmentCategory">Create</button>' +
                    '</div>';
            }
        }
</script>
@endsection
