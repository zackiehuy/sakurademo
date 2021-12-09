<div class="modal fade"
     id="createJobCategoryModal"
     tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true"  data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
            <div class="modal-header card-header" id="nameForm">
                @if(App::getLocale() == 'vi')
                    <span class="bold-text">{{__('base.create')}} {{__('base.job_category_header')}}</span>
                @else
                    <span class="bold-text">{{__('base.job_category')}} {{__('base.create')}}</span>
                @endif
                <span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>
            </div>
            <form id="formJobCategory" role="form" method="post"  enctype="multipart/form-data" >
                @csrf
                <div class="modal-body">
                    <div class="form-group bmd-form-group label-input row">
                        <label class="col-md-3 bmd-label-user" for="name">{{__('job_category.name_en')}}<span class="required-input">*</span></label>
                        <div class="col-md-9 pl-0">
                            <input type="text"
                                   class="form-control"
                                   name="job-category-name_en"
                                   id="job-category-name_en"
                                   value="{{ old('name') }}"
                                   onkeyup="keyUpError(this)"
                                   placeholder="{{__('job_category.name_en_input')}}">
                        </div>
                        <label class="col-md-3"></label>
                        <div class="col-md-9 pl-0 text-danger job-category-name_en"></div>
                    </div>
                    <div class="form-group bmd-form-group label-input row">
                        <label class="col-md-3 bmd-label-user" for="name">{{__('job_category.name_vi')}}<span class="required-input">*</span></label>
                        <div class="col-md-9 pl-0">
                            <input type="text"
                                   class="form-control"
                                   name="job-category-name_vi"
                                   id="job-category-name_vi"
                                   value="{{ old('name') }}"
                                   onkeyup="keyUpError(this)"
                                   placeholder="{{__('job_category.name_vi_input')}}">
                        </div>
                        <label class="col-md-3"></label>
                        <div class="col-md-9 pl-0 text-danger job-category-name_vi"></div>
                    </div>
                    <div class="form-group bmd-form-group label-input row">
                        <label class="col-md-3 bmd-label-user" for="name">{{__('job_category.name_jp')}}<span class="required-input">*</span></label>
                        <div class="col-md-9 pl-0">
                            <input type="text"
                                   class="form-control"
                                   name="job-category-name_jp"
                                   id="job-category-name_jp"
                                   value="{{ old('name') }}"
                                   onkeyup="keyUpError(this)"
                                   placeholder="{{__('job_category.name_jp_input')}}">
                        </div>
                        <label class="col-md-3"></label>
                        <div class="col-md-9 pl-0 text-danger job-category-name_jp"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>
                    <button type="submit" class="btn btn-create" id="btnJobCategroyModal">{{__('base.create')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
