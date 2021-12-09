<div class="modal fade"
     id="createLocationModal"
     tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true"
     data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
            <div class="modal-header card-header" id="nameForm">
                @if(App::getLocale() == 'vi')
                    <span class="bold-text">{{__('base.create')}} {{__('base.location_header')}}</span>
                @else
                    <span class="bold-text">{{__('base.location')}} {{__('base.create')}}</span>
                @endif
                <span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>
            </div>
            <form id="formLocationModal" role="form" enctype="multipart/form-data" >
                <div class="modal-body">
                    <div class="form-group bmd-form-group label-input row">
                        <label class="col-md-3 bmd-label-user" for="name">{{__('base.name')}}<span class="required-input">*</span></label>
                        <div class="col-md-9 pl-0">
                            <input type="text"
                                   class="form-control"
                                   name="location-name"
                                   id="location-name"
                                   value="{{ old('name') }}"
                                   onkeyup="keyUpError(this)"
                                   placeholder="{{__('location.name_input')}}">
                        </div>
                        <label class="col-md-3"></label>
                        <div class="text-danger location-name col-md-9 pl-0"></div>
                    </div>
                    <div class="form-group bmd-form-group label-input row">
                        <label class="bmd-label-user col-md-3" for="country">{{__('location.country')}}<span class="required-input">*</span></label>
                        <div class=" col-md-9 pl-0">
                            <input type="text"
                                   class="form-control"
                                   name="location-country"
                                   id="location-country"
                                   value="{{ old('country') }}"
                                   onkeyup="keyUpError(this)"
                                   placeholder="{{__('location.country_input')}}">
                        </div>
                        <label class="col-md-3"></label>
                        <div class="text-danger location-country col-md-9 pl-0"></div>
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
