@extends('dashboard.base')
@section('title')
    {{__('setting.general_setting')}}
@endsection
@section('content')
    <div class="row">
        <div class="col mx-4">
            <div class="card">
                <div class="card-header ">
                    <span class="lead bold-text" >
                        @if(App::getLocale() == 'vi')
                            {{__('base.edit')}} {{__('setting.general_setting_header')}}
                        @else
                            {{__('setting.general_setting')}}{{__('base.edit')}}
                        @endif
                    </span>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="formGeneralSetting" action="{{ route('general-settings.post') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="name">{{__('setting.name')}}</label>
                            <div class="col-md-10">
                                <input class="form-control" id="name" value="{{ old('name', $setting->name ?? '') }}" type="text" name="name"
                                       onkeyup="keyUpError(this)" placeholder="{{__('setting.name_input')}}">
                                <div class="text-danger error-recruitment name"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="logo">{{__('setting.favicon')}}</label>
                                    <div class="col-md-8">
                                        <label class="btn btn-file">
                                            {{__('setting.favicon_input')}}<input accept="image/gif,image/jpeg,image/webp,image/png,image/svg,image/svg+xml" type="file" onchange="readImageSetting(this,'logo')" style="display: none;" name="logo" id="logo" />
                                        </label>
                                        <span class="file-image" id="file-logo-setting" style="display: none"><span class="name-file"></span><a href="javascript:fileDeleteSetting('logo');">&times;</a></span>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-8">
                                        <div class="float-left required-field">{{__('setting.favicon_promote')}}</div>
                                        <br>
                                        <div class="text-danger logo"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 col-form-label" for="address"></label>
                                    <img id="img-preview-logo"  src="{{ old('logo',$setting->logo ?? '' ? asset('storage/images/setting/logo/' . $setting->logo) : asset("img/sakura_icon.png") ) }}" alt="" class="img-thumbnail" style="max-width:200px;
                        margin-top: 4px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="logo">{{__('setting.logo')}}</label>
                                    <div class="col-md-8">
                                        <label class="btn btn-file">
                                            {{__('setting.logo_input')}}<input accept="image/gif,image/jpeg,image/webp,image/png,image/svg,image/svg+xml" type="file" onchange="readImageSetting(this,'image')" style="display: none;" name="image" id="image" />
                                        </label>
                                        <span class="file-image" id="file-image-setting" style="display: none"><span class="name-file"></span><a href="javascript:fileDeleteSetting('image');">&times;</a></span>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-8">
                                        <div class="float-left required-field">{{__('setting.logo_promote')}}</div>
                                        <br>
                                        <div class="text-danger image"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 col-form-label" for="address"></label>
                                    <img id="img-preview-image"  src="{{ old('image',$setting->image ?? '' ? asset('storage/images/setting/image/' . $setting->image) : asset("img/sakura.png") ) }}" alt="" class="img-thumbnail" style="max-width:200px;
                        margin-top: 4px;">
                                </div>
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-2 col-form-label" for="founded_date">{{__('company.founded_date')}}</label>--}}
{{--                            <div class="col-md-10">--}}
{{--                                <input class="form-control" id="founded_date" value="{{ old('founded_date', format_date($setting->founded_date ?? '') ?? '') }}" type="date" name="founded_date" placeholder="{{__('company.founded_date_input')}}">--}}
{{--                                @error('founded_date')<div class="text-danger">{{ $message }}</div>@enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-2 col-form-label" for="charter_capital">{{__('company.charter_capital')}}</label>--}}
{{--                            <div class="col-md-10">--}}
{{--                                <input class="form-control formattedNumberField" id="charter_capital" value="{{ old('charter_capital', $setting->charter_capital ?? '') }}" type="text" name="charter_capital" placeholder="{{__('company.charter_capital_input')}}">--}}
{{--                                @error('charter_capital')<div class="text-danger">{{ $message }}</div>@enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-2 col-form-label" for="cost">{{__('company.cost')}}</label>--}}
{{--                            <div class="col-md-10">--}}
{{--                                <select class="form-control" id="cost" name="cost">--}}
{{--                                    <option value="">{{__('company.cost_input')}}</option>--}}
{{--                                    @foreach($costs as $key => $value)--}}
{{--                                        <option value="{{$key}}" @if(old('cost', $setting->cost ?? '') == $key) selected @endif>{{$value}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('cost')<div class="text-danger">{{ $message }}</div>@enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-2 col-form-label" for="legal_representative">{{__('company.legal_representative')}}</label>--}}
{{--                            <div class="col-md-10">--}}
{{--                                <input class="form-control" id="legal_representative" value="{{ old('legal_representative', $setting->legal_representative ?? '') }}" type="text" name="legal_representative" placeholder="{{__('company.legal_representative_input')}}">--}}
{{--                                @error('legal_representative')<div class="text-danger">{{ $message }}</div>@enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-2 col-form-label" for="main_business_activities">{{__('company.main_business_activities')}}</label>--}}
{{--                            <div class="col-md-10">--}}
{{--                                <textarea class="form-control" id="main_business_activities" name="main_business_activities" rows="2" placeholder="{{__('company.main_business_activities_input')}}">{{ old('main_business_activities', $setting->main_business_activities ?? '') }}</textarea>--}}
{{--                                @error('main_business_activities')<div class="text-danger">{{ $message }}</div>@enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="mail_manager">{{__('setting.mail_manager')}}</label>
                            <div class="col-md-10">
                                <input class="form-control" id="mail_manager" onkeyup="keyUpManager(this)" value="{{ old('mail_manager', $setting->mail_manager ?? '') }}" type="text" name="mail_manager" placeholder="{{__('setting.mail_manager_input')}}">
                                <div class="text-danger error-recruitment mail_manager"></div>
                            </div>
                        </div>
                        <div class="form-group row name-manager-field" @if(!isset($setting->mail_manager)) style="display: none" @endif>
                            <label class="col-md-2 col-form-label" for="name_manager">{{__('setting.name_manager')}}<span class="required-input">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" id="name_manager" onkeyup="keyUpError(this)" value="{{ old('name_manager', $setting->name_manager ?? '') }}" type="text" name="name_manager" placeholder="{{__('setting.name_manager_input')}}">
                                <div class="text-danger error-recruitment name_manager"></div>
                            </div>
                        </div>
                        <div class="form-group row phone-manager-field" @if(!isset($setting->mail_manager)) style="display: none" @endif>
                            <label class="col-md-2 col-form-label" for="phone_manager">{{__('setting.phone_manager')}}<span class="required-input">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" id="phone_manager" onkeyup="keyUpError(this)" value="{{ old('phone_manager', $setting->phone_manager ?? '') }}" type="text" name="phone_manager" placeholder="{{__('setting.phone_manager_input')}}">
                                <div class="text-danger error-recruitment phone_manager"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="mail_username">{{__('setting.mail_username')}}<span class="required-input">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" id="mail_username" onkeyup="keyUpError(this)" value="{{ old('mail_username', $setting->mail_username ?? '') }}" type="text" name="mail_username" placeholder="{{__('setting.mail_username_input')}}">
                                <div class="text-danger error-recruitment mail_username"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="mail_password">{{__('setting.mail_password')}}<span class="required-input">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" id="mail_password" onkeyup="keyUpError(this)" value="{{ old('mail_password', $setting->mail_password ?? '') }}" type="password" name="mail_password" placeholder="{{__('setting.mail_password_input')}}">
                                <div class="text-danger error-recruitment mail_password"></div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 40px">
                            <span class="float-left required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>
                            <div class="float-right">
                                <div>
                                    <button class="btn btn-create" type="submit">{{__('base.update')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection

@section('javascript')
    <script>
        // CKEDITOR.replace('main_business_activities', {height: '150px', resize_enabled : true, language: '<?php echo App::getLocale(); ?>'})
        function readImageSetting(input,id)
        {
            $(`.text-danger.${input.name}`).text('');
            if (input.files[0].size > 3000000) {
                input.value="";
                $(`.text-danger.${input.name}`).text($('meta[name="file_size"]').attr('content'));
                $(`#img-preview-${id}`).attr('src', '').show().css({display: 'none'});
                $(`#file-${id}-setting`).css({display: 'none'});
                $(`#file-${id}-setting .name-file`).text('');
                return;
            }
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(`#img-preview-${id}`).attr('src', e.target.result).show().css({display: ''});
                    $(`#file-${id}-setting`).css({display: ''});
                    $(`#file-${id}-setting .name-file`).text(input.files[0].name);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function fileDeleteSetting(name)
        {
            $(`input[name=${name}]`).val('');
            $(`#img-preview-${name}`).attr('src', '').show().css({display: 'none'});
            $(`#file-${name}-setting`).css({display: 'none'});
            $(`#file-${name}-setting .name-file`).text('');
        }

        function keyUpManager(input){
            keyUpError(input);
            if(input.value == '')
            {
                $('.phone-manager-field').css({display: 'none'});
                $('.name-manager-field').css({display: 'none'});
                $('input[name=phone_manager]').val('');
                $('input[name=name_manager]').val('');
            }
            else
            {
                $('.phone-manager-field').css({display: ''});
                $('.name-manager-field').css({display: ''});
            }
        }
        $('#formGeneralSetting').submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            let url = $(this).attr('action');
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
                    localStorage.setItem("status",res.status);
                    localStorage.setItem("title",res.title);
                    localStorage.setItem("message",res.message);
                    window.setTimeout(() => {
                        location.reload();
                    }, 200);
                },
                error: function(error){
                    let errors = '';
                    if(error.responseJSON)
                    {
                        errors = error.responseJSON.errors;
                    }
                    $(`.error-recruitment`).html("");
                    $.each(errors,function (key,value){
                        $(`.error-recruitment.${key}`).html(value[0]).addClass("error-input");
                        $(`#formGeneralSetting input[name=${key}]`).focus();
                    });
                }
            })
        });
    </script>
@endsection
