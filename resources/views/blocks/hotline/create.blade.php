<div class="modal fade"
     id="createHotlineModal"
     tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true"
     data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
            <div class="modal-header card-header" id="nameForm">
                @if(App::getLocale() == 'vi')
                    <span class="bold-text">{{__('base.create')}} {{__('base.hotline_header')}}</span>
                @else
                    <span class="bold-text">{{__('hotline.hotline')}} {{__('base.create')}}</span>
                @endif
            </div>
            <form id="formHotlineModal" role="form" enctype="multipart/form-data" data-type="post" data-for="another" action="{{url('admin/hotlines')}}">
                <div class="modal-body">
                    <div class="form-group bmd-form-group label-input row">
                        <label class="col-md-3 bmd-label-user" for="name">{{__('base.name')}}<span class="required-input">*</span></label>
                        <div class="col-md-9 pl-0">
                            <input type="text"
                                   class="form-control"
                                   name="hotline-name"
                                   id="hotline-name"
                                   value="{{ old('name') }}"
                                   onkeyup="keyUpError(this)"
                                   placeholder="{{__('hotline.name_input')}}">
                            <div class="text-danger hotline-name"></div>
                        </div>
                    </div>
                    <div class="form-group bmd-form-group label-input row">
                        <label class="col-md-3 bmd-label-user" for="name">{{__('base.gender')}}<span class="required-input">*</span></label>
                        <div class="col-md-9 pl-0">
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" onclick="keyUpError(this)" type="radio" name="hotline-gender" id="Male" value="1" @if(old('is_male') == 1) checked @endif>
                                    <label class="form-check-label" for="male">{{__('base.male')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" onclick="keyUpError(this)" type="radio" name="hotline-gender" id="Female" value="0" @if(old('is_male') == 0) checked @endif>
                                    <label class="form-check-label" for="female">{{__('base.female')}}</label>
                                </div>
                            </div>
                            <div class="text-danger hotline-gender"></div>
                        </div>
                    </div>
                    <div class="form-group bmd-form-group label-input row">
                        <label class="col-md-3 bmd-label-user" for="country">{{__('base.phone')}}<span class="required-input">*</span></label>
                        <div class="col-md-9 pl-0">
                            <input type="text"
                                   class="form-control"
                                   name="hotline-phone"
                                   id="hotline-phone"
                                   value="{{ old('phone') }}"
                                   onkeyup="keyUpError(this)"
                                   placeholder="{{__('hotline.phone_input')}}">
                            <div class="text-danger hotline-phone"></div>
                        </div>
                    </div>
                    <div class="form-group bmd-form-group label-input row" id="showBranch" style="display: none">
                        <label class="col-md-3 bmd-label-user" for="country">{{__('branch.branch')}}</label>
                        <div class="col-md-9 pl-0">
                            <select
                                type="text"
                                class="form-control"
                                name="hotline-branch_id"
                                id="hotline-branch_id"
                                onchange="keyUpError(this)">
                                <option value="">{{__('base.branch_input')}}</option>
                            </select>
                            <div class="text-danger hotline-branch_id"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>
                    <button class="btn btn-create" type="submit">{{__('base.create')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
