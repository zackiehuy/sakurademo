<div class="modal fade"
     id="createCompanyModal"
     tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true"  data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
            <div class="modal-header card-header" id="nameForm">
                @if(App::getLocale() == 'vi')
                    <span class="bold-text">{{__('base.create')}} {{__('base.company_header')}}</span>
                @else
                    <span class="bold-text">{{__('base.company')}} {{__('base.create')}}</span>
                @endif
                <span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>
            </div>
            <form id="formCompany" role="form" method="post"  enctype="multipart/form-data" >
                @csrf
                <div class="modal-body">
                    <div class="form-group bmd-form-group label-input row">
                        <label class="col-md-3 bmd-label-user" for="name">{{__('base.name')}}<span class="required-input">*</span></label>
                        <div class="col-md-9 pl-0">
                            <input type="text"
                                   class="form-control"
                                   name="company-name"
                                   id="company-name"
                                   value="{{ old('name') }}"
                                   onkeyup="keyUpError(this)"
                                   placeholder="{{__('company.name_input')}}">
                        </div>
                        <label class="col-md-3"></label>
                        <div class="col-md-9 pl-0 text-danger company-name"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="image">{{__('base.image')}}</label>
                        <div class="col-md-9 pl-0">
                            <label class="btn btn-file">
                                {{__('branch.choose_file')}}<input accept="image/gif,image/jpeg,image/webp,image/png,image/svg,image/svg+xml" type="file" onchange="readImage(this)" style="display: none;" name="company-logo" id="logo" />
                            </label>
                            <span class="file-image" style="display: none"><span class="name-file"></span><a href="javascript:fileDelete();">&times;</a></span>
                        </div>
                        <span class="col-md-3 required-field"><span class="required-input">*</span>{{__('base.file_size') . __('base.standard_size') . '268x23'}}</span>
                        <div class="col-md-9 pl-0">
                            <img id="img-preview"  src="" alt="" class="img-thumbnail" style="max-width:200px;
                        margin-top: 14px;display: none">
                            <div class="text-danger company-logo"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>
                    <button type="submit" class="btn btn-create" id="btnCompanyModal">{{__('base.create')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
