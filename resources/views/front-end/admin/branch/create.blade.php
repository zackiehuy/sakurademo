@extends('dashboard.base')
@section('title')
    {{__('branch.branch')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline thead-light">
                            <div class="card-header add-new-item">
                                <a href="{{route('branch.index')}}" class="float-left back-to-list">
                                    {{__('base.branch')}} & {{__('menu.hotline')}}
                                </a>
                                <span class="cross-back">/</span>
                                {{ $branch ?? '' ? __('base.edit') : __('base.create')}}
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" action="{{ url( $branch ?? '' ? 'admin/branch/' . $branch->id : 'admin/branch') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{ $branch ?? '' ? method_field('PUT') : ''}}
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="name">{{__('base.name')}}<span class="required-input">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" id="name" value="{{ old('name', $branch->name ?? '') }}" type="text" name="name"
                                                   onkeyup="keyUpError(this)" placeholder="{{__('branch.name_input')}}" @error('name') autofocus @enderror>
                                            @error('name')<div class="text-danger name">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="location">{{__('base.location')}}<span class="required-input">*</span></label>
                                        <div class="col-md-10">
                                            <div class="form-group row row-margin-0 justify-content-between">
                                                <select class="form-control col" name="location_id" id="location" onchange="keyUpError(this)" @error('location_id') autofocus @enderror>
                                                    <option value="">
                                                        {{__('branch.location_input')}}
                                                    </option>
                                                    @foreach($locations as $location)
                                                        <option value="{{$location->id}}" @if(old('location_id', $branch->location_id ?? '') == $location->id) selected @endif>{{$location->name}} ({{$location->country}})</option>
                                                    @endforeach
                                                </select>
                                                <p class="btn btn-create col btn-add" data-toggle="modal" data-target="#createLocationModal">
                                                    <i class="fa fa-plus"></i>
                                                </p>
                                            </div>
                                            @error('location_id')<div class="text-danger location_id">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="company">{{__('base.company')}}<span class="required-input">*</span></label>
                                        <div class="col-md-10">
                                            <div class="form-group row row-margin-0 justify-content-between">
                                                <select class="form-control col" name="company_id" id="company" onchange="keyUpError(this)" @error('company_id') autofocus @enderror>
                                                    <option value="">
                                                        {{__('branch.company_input')}}
                                                    </option>
                                                    @foreach($companies as $company)
                                                        <option value="{{$company->id}}" @if(old('company_id', $branch->company_id ?? '') == $company->id) selected @endif >{{$company->name}}</option>
                                                    @endforeach
                                                </select>
                                                <p class="btn btn-create col btn-add" data-toggle="modal" data-target="#createCompanyModal">
                                                    <i class="fa fa-plus"></i>
                                                </p>
                                            </div>
                                            @error('company_id')<div class="text-danger company_id">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="address">{{__('base.address')}}<span class="required-input">*</span></label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" id="address" name="address" rows="2" onkeyup="newLine(event)"
                                                      placeholder="{{__('branch.address_input')}}" @error('address') autofocus @enderror>{{ old('address', $branch->address ?? '') }}</textarea>
                                            @error('address')<div class="text-danger address">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="phone">{{__('base.phone')}}<span class="required-input">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" id="phone" value="{{ old('phone', $branch->phone ?? '') }}" type="text" name="phone"
                                                   onkeyup="keyUpError(this)" placeholder="{{__('branch.phone_input')}}" @error('phone') autofocus @enderror>
                                            @error('phone')<div class="text-danger phone">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="email">{{__('base.email')}}<span class="required-input">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" id="email" value="{{ old('email', $branch->email ?? '') }}" type="text" name="email"
                                                   onkeyup="keyUpError(this)" placeholder="{{__('branch.email_input')}}" @error('email') autofocus @enderror>
                                            @error('email')<div class="text-danger email">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="address">{{__('base.image')}}</label>
                                        <div class="col-md-10">
                                            <label class="btn btn-file">
                                                {{__('branch.choose_file')}}<input accept="image/gif,image/jpeg,image/webp,image/png,image/svg,image/svg+xml" type="file" onchange="readBranchImage(this)" style="display: none;" name="image" id="image" />
                                            </label>
                                            <span class="file-image" id="file-image-branch" style="display: none"><span class="name-file"></span><a href="javascript:fileDeleteBranch();">&times;</a></span>
                                        </div>
                                        <span class="col-md-2 required-field"><span class="required-input">*</span>{{__('base.file_size') . __('base.standard_size') . '796x707'}}</span>
                                        <div class="col-md-10">
                                            <img id="img-branch-preview"  src="{{ old('image',$branch ?? '' ? ($branch->image ?? '' ? asset('storage/images/branch/' . $branch->image) : asset('img/branch_image.png')) : '' ) }}" alt="" class="img-thumbnail"
                                                 style="max-width:300px;margin-top: 14px;@if(!isset($branch)) display: none; @endif">
                                            <div class="text-danger image"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="float-left required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>
                                        <div class="float-right">
                                            <div>
                                                <button class="btn btn-create" type="submit">{{ $branch ?? '' ? __('base.update') : __('base.create')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@include ('blocks.company.create')
@include ('blocks.location.create')
@section('javascript')
    <script>
        function readBranchImage(input)
        {
            $(`.text-danger.${input.name}`).text('');
            if (input.files[0].size > 3000000) {
                input.value="";
                $(`.text-danger.${input.name}`).text($('meta[name="file_size"]').attr('content'));
                $('#img-branch-preview').attr('src', '').show().css({display: 'none'});
                $('#file-image-branch').css({display: 'none'});
                $('#file-image-branch .name-file').text('');
                return;
            }
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img-branch-preview').attr('src', e.target.result).show().css({display: ''});
                    $('#file-image-branch').css({display: ''});
                    $('#file-image-branch .name-file').text(input.files[0].name);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        function fileDeleteBranch()
        {
            $('input[name=image]').val('');
            $('#img-branch-preview').attr('src', '').show().css({display: 'none'});
            $('#file-image-branch').css({display: 'none'});
            $('#file-image-branch .name-file').text('');
        }
    </script>
@endsection
