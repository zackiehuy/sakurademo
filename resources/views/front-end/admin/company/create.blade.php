@extends('dashboard.base')
@section('title')
    {{__('base.company')}}
@endsection
@section('content')
    <div class="row">
        <div class="col mx-4">
            <div class="card">
                <div class="card-header"><strong>{{__('base.company')}}</strong> {{ $company ?? '' ? __('base.update') : __('base.create')}}
                    <a href="{{route('companies.index')}}" class="float-right">
                        <button class="btn btn-download"><i class="fa fa-undo"></i> {{__('base.back_to_list')}}</button>
                    </a>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ url( $company ?? '' ? 'admin/companies/' . $company->id : 'admin/companies') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ $company ?? '' ? method_field('PUT') : ''}}
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="name">{{__('base.name')}}<span class="required-input">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" id="name" value="{{ old('name', $company->name ?? '') }}" type="text" name="name"
                                       onkeyup="keyUpError(this)" placeholder="{{__('company.name_input')}}">
                                @error('name')<div class="text-danger name">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="logo">{{__('base.logo')}}</label>
                            <div class="col-md-10">
                                <label class="btn btn-download">
                                    {{__('branch.choose_file')}}<input accept="image/gif,image/jpeg,image/webp,image/png,image/svg,image/svg+xml" type="file" onchange="readImage(this)" style="display: none;" name="logo" id="logo" />
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-form-label" for="address"></label>
                            <img id="img-preview"  src="{{ old('logo',$setting ?? '' ? asset('storage/images/companies/' . $setting->logo) : '' ) }}" alt="" class="img-thumbnail" style="max-width:200px;
                        margin-top: 4px;">
                        </div>
                        <div class="form-group">
                            <span class="float-left required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>
                            <div class="float-right">
                                <div>
                                    <button class="btn btn-download" type="submit">{{ $company ?? '' ? __('base.update') : __('base.create')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection
@include ('blocks.company.create')
@include ('blocks.location.create')
