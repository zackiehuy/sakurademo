@extends('dashboard.base')
@section('title')
    {{__('base.company')}}
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
                                        {{__('base.list')}} {{__('base.company_header')}}
                                    @else
                                        {{__('base.company')}}{{__('base.list')}}
                                    @endif
                                </span>
                                <button class="btn btn-create float-right px-2 py-1"
                                        onclick="checkCompany(-1)"
                                        data-toggle="modal"
                                        data-target="#createCompanyModal">
                                    <i class="fa fa-plus"></i>
                                    @if(App::getLocale() == 'vi')
                                        {{__('base.create')}} {{__('base.company_header')}}
                                    @else
                                        {{__('base.company')}}{{__('base.create')}}
                                    @endif
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="table-search">
                                        <input type="search" id="table-search" name="list-company" class="col-8 form-control form-control-sm" placeholder="{{__('base.search')}}">
                                    </div>
                                    <table id="list-company"
                                           class="table table-bordered table-hover table-striped"
                                           style="width: 100%">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>{{__('base.stt')}}</th>
                                            <th>{{__('base.name')}}</th>
                                            <th>{{__('base.logo')}}</th>
                                            <th style="min-width: 68.8px">{{__('base.action')}}</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade"
                 id="createCompanyModal"
                 tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true"
                 data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" >
                        <div class="modal-header card-header" id="nameForm">
                            @if(App::getLocale() == 'vi')
                                <span class="bold-text">{{__('base.create')}} {{__('hotline.company_header')}}</span>
                            @else
                                <span class="bold-text">{{__('hotline.company')}} {{__('base.create')}}</span>
                            @endif
                        </div>
                        <form id="formCompanyModal" role="form" enctype="multipart/form-data" action="{{url('admin/companies')}}">
                            <div class="modal-body">
                                <div class="form-group bmd-form-group label-input row">
                                    <label class="col-md-3 bmd-label-user" for="name">{{__('base.name')}}<span class="required-input">*</span></label>
                                    <div class="col-md-9 pl-0">
                                        <input type="text"
                                               class="form-control"
                                               name="name"
                                               id="company-name"
                                               value="{{ old('name') }}"
                                               onkeyup="keyUpError(this)"
                                               placeholder="{{__('company.name_input')}}">
                                    </div>
                                    <label class="col-md-3"></label>
                                    <div class="col-md-9 pl-0 text-danger error-company name"></div>
                                </div>
                                <div class="form-group bmd-form-group label-input row" id="company-information">
                                    <label class="col-md-3 bmd-label-user" for="information">{{__('company.information')}}</label>
                                    <div class="col-md-9 pl-0">
                                        <textarea type="text"
                                               class="form-control"
                                               name="information"
                                               id="information"
                                               onkeyup="keyUpError(this)"
                                               placeholder="{{__('company.information_input')}}">{{ old('information') }}</textarea>
                                    </div>
                                    <label class="col-md-3"></label>
                                    <div class="col-md-9 pl-0 text-danger error-company information"></div>
                                </div>
                                <div class="form-group bmd-form-group label-input row">
                                    <label class="col-md-3 bmd-label-user" for="image">{{__('base.logo')}}</label>
                                    <div class="col-md-9 pl-0">
                                        <label class="btn btn-file">
                                            {{__('company.choose_file')}}<input accept="image/gif,image/jpeg,image/webp,image/png,image/svg,image/svg+xml" type="file" onchange="readImage(this)" style="display: none;" name="logo" id="logo-wine" />
                                        </label>
                                        <span class="file-image" style="display: none"><span class="name-file"></span><a href="javascript:fileDeleteLogo();">&times;</a></span>
                                    </div>
                                    <span class="col-md-3 required-field"><span class="required-input">*</span>{{__('base.file_size') . __('base.standard_size') . '268x23'}}</span>
                                    <div class="col-md-9 pl-0">
                                        <img id="img-preview" style="display: none" src=""  class="image-company">
                                        <div class="text-danger logo"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>
                                <button class="btn btn-create" id="btn-submit" type="submit">{{__('base.create')}}</button>
                            </div>
                        </form>
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
                            {{__('base.delete_message',['item' => __('base.company_header')])}}
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
    let information = CKEDITOR.replace('information', {
        // Define the toolbar groups as it is a more accessible solution.
                toolbarGroups: [
                    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                    { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                    { name: 'forms', groups: [ 'forms' ] },
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                    { name: 'links', groups: [ 'links' ] },
                    { name: 'insert', groups: [ 'insert' ] },
                    { name: 'styles', groups: [ 'styles' ] },
                    { name: 'colors', groups: [ 'colors' ] },
                    { name: 'tools', groups: [ 'tools' ] },
                    { name: 'others', groups: [ 'others' ] },
                    { name: 'about', groups: [ 'about' ] }
                ],
                // Remove the redundant buttons from toolbar groups defined above.
                removeButtons: 'Source,Save,NewPage,ExportPdf,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Checkbox,Form,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Strike,Superscript,Subscript,CopyFormatting,RemoveFormat,Indent,Outdent,Blockquote,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Table,HorizontalRule,Smiley,PageBreak,Iframe,SpecialChar,ShowBlocks,Maximize,About,Undo,Redo,Styles,Font,BGColor,Image,Flash',
                height: '150px', resize_enabled : true, language: '<?php echo App::getLocale(); ?>'
                }
        ).on('change',function(){
            $(`.text-danger.information`).text('');
        });
        $(document).ready(function() {
            var table= $('#list-company').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('companies.index') }}",
                language: {
                    url: '{{asset('lib/datatables/lang/').'/'.App::getLocale().'.json'}}',
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'logo', name: 'logo' },
                ],
                columnDefs: [
                    { "sortable": false, "targets": [0 ] },
                    {
                    "targets": 3,
                    "data": null,
                    "render": function (data) {
                        let disabled = '';
                        let event = '';
                        if(data.branches_count  + data.jobs_count > 0 || [1, 2, 3].indexOf(data.id) >= 0)
                        {
                            disabled = 'disabled';
                            event = ' style="pointer-events: none" ';
                        }
                        let edit_url = ' onclick = checkCompany(' + data.id + ') ';
                        let delete_event = ' onclick = checkItemExisted(' + data.id + ') ';
                        return '<a class="btn btn-edit btn-sm" ' + edit_url + 'id="row_' + data.id +
                        '" data-toggle="modal" data-target="#createCompanyModal"><span class="fa fa-edit"></span></a> ' +
                            '<button class="btn btn-sm btn-delete '+ disabled +'" ' + delete_event + 'id="row_' + data.id + '" data-toggle="modal" ' +
                            'data-target="#confirmDeleteItem" ' + event + disabled +'>' +
                            '<span class="fa fa-trash" ></span></button> ';
                    },
                }],
                // "order": [[ 1, 'asc' ]]
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

        function fileDeleteLogo() {
            $('input[name=logo]').val('');
            $('#img-preview').attr('src', '').show().css({display: 'none'});
            $('.file-image').css({display: 'none'});
            $('.file-image .name-file').text('');
        }

        function deleteItem(id) {
            let delete_URL = "{{ url('admin/companies') }}/" + id;
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
                $('#list-company').DataTable().ajax.reload();
            });
        }
        function checkCompany(id)
        {
            if(id != -1)
            {
                let edit_URL = "{{ url('admin/companies') }}/" + id;
                let request = $.ajax({
                    url: edit_URL,
                    data:{
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    async: false,
                    method: "GET",
                }).done(function (data) {
                    if(data.status == 500){
                        setTimeout(function(){
                            $("#createCompanyModal").hide();
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                            $('#list-company').DataTable().ajax.reload();
                        },100);
                        iziToast.warning({
                            title: data.title,
                            message: data.message,
                            position: 'topRight'
                        });
                    }
                    else
                    {
                        let title = "<span class='bold-text'>{{ __('base.company')}} {{__('base.edit') }}</span>";
                        if($('meta[name=language]').prop('content') == 'vi')
                        {
                            title = "<span class='bold-text'>{{__('base.edit') }} {{ __('base.company_header')}}</span>";
                        }
                        document.getElementById('nameForm').innerHTML = title +
                            '<span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>';
                        let url = "{{url('admin/companies')}}/"+ data.id;
                        let avatar = "{{asset('/img/no-image.jpg')}}";
                        if(data.logo != null)
                        {
                            avatar = "{{asset('storage/images/companies')}}/" + data.logo;
                        }
                        else if(data.default_logo != null)
                        {
                            avatar = '{{url('')}}' + data.default_logo;
                        }
                        $("#formCompanyModal").attr("action",url).attr('data-type','put').attr('novalidate', 'novalidate');
                        let method_put = '{{method_field('PUT')}}';
                        $('#formCompanyModal').append(method_put);
                        $("#formCompanyModal #btn-submit").text("{{__('base.update')}}");
                        for (const [key, value] of Object.entries(data)) {
                            $(`#formCompanyModal input[name=${key}][type=text]`).val(value);
                        }
                        let check = [1,2,3].includes(data.id);
                        if(check)
                        {
                            $('#company-information').css({'display' : 'none'});
                        }
                        else
                        {
                            $('#company-information').css({'display' : ''});
                            CKEDITOR.instances['information'].setData(data.information);
                        }
                        // CKEDITOR.instances.information.setData($.parseHTML(data.information));
                        $("#formCompanyModal #img-preview").attr('src',avatar).css({display : ''});
                    }
                });
            }
            else
            {
                let url = "{{url('admin/companies')}}";
                let title = "<span class='bold-text'>{{ __('base.company')}} {{__('base.create') }}</span>";
                if($('meta[name=language]').prop('content') == 'vi')
                {
                    title = "<span class='bold-text'>{{__('base.create') }} {{ __('base.company_header')}}</span>";
                }
                document.getElementById('nameForm').innerHTML = title +
                    '<span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>';
                $("#formCompanyModal").attr("action",url).attr('data-type','post').attr('novalidate', '');
                $("#formCompanyModal #btn-submit").text("{{__('base.create')}}");
                $('#formCompanyModal :input').each(function (){
                    $(this).val('');
                });
                $('#company-information').css({'display' : ''});
                CKEDITOR.instances['information'].setData('');
                $("#formCompanyModal #img-preview").attr('src','');
            }
        }
        $("#formCompanyModal").submit(function (e) {
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            let formData = new FormData(this);
            let method = $(this).attr("method");
            let url = $(this).attr("action");
            let type = $(this).attr('data-type');
            if(type == 'put')
            {
                formData.append('_method', 'PUT');
            }
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
                    $(`.error-company`).html("");
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
                    $('#createCompanyModal').hide();
                    $('body').removeClass('modal-open').css({padding : 0});
                    $(".modal-backdrop").remove();
                    $('#list-company').DataTable().ajax.reload();
                },
                error: function(error){
                    let errors = error.responseJSON.errors;
                    $(`.error-company`).html("");
                    $.each(errors,function (key,value){
                        $(`.error-company.${key}`).html(value[0]).addClass("error-input");
                        $(`#formCompanyModal input[name=${key}]`).focus();
                    });
                }
            })
        });
</script>
@endsection
