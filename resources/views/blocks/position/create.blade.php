<div class="modal fade"
     id="createPositionModal"
     tabindex="0" role="dialog"
     aria-labelledby="exampleModalLabel"
     data-backdrop="static"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" data-backdrop="static">
        <div class="modal-content" >
            <div class="modal-header card-header" id="name">
                <span><strong>{{__('position.position')}}</strong> {{__('base.create')}}</span>
                <span class="required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>
            </div>
            <form id="formPositionModal" role="form" enctype="multipart/form-data" >
                <div class="modal-body">
                    <div class="form-group bmd-form-group label-input ">
                        <label class="bmd-label-user" for="name">{{__('base.name')}}<span class="required-input">*</span></label>
                        <input type="text"
                               class="form-control"
                               name="position-name"
                               id="position-name"
                               value="{{ old('name') }}"
                               onkeyup="keyUpError(this)"
                               placeholder="{{__('position.name_input')}}">
                        <div class="text-danger position-name"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('base.close')}}</button>
                    <button class="btn btn-download" type="submit">{{__('base.create')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
