@extends('dashboard.base')
@section('title')
    {{__('base.job')}}
@endsection
@section('content')
    <div class="row">
        <div class="col mx-4">
            <div class="card">
                <div class="card-header add-new-item">
                    <a href="{{route('job.index')}}" class="float-left back-to-list">
                        {{__('base.job')}}
                    </a>
                    <span class="cross-back">/</span>
                    {{ $job ?? '' ? __('base.edit') : __('base.create')}}
                </div>
                <input name="jobCategories" value="{{$jobCategories}}" style="display: none" disabled>
                <input name="branches" value="{{$branches}}" style="display: none" disabled>
                <div class="card-body">
                    <form class="form-horizontal" id="form-job" action="{{ url( $job ?? '' ? 'admin/job/' . $job->id : 'admin/job') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ $job ?? '' ? method_field('PUT') : ''}}
                        <div class="form-group row">
                                <input class="form-control" id="url" value="" type="text" name="url" hidden>
                            <input class="form-control" id="is_company" value="{{ old('is_company', !isset($job->company_id) && isset($job) || (in_array(isset($job) ?? '' ? $job->company_id : '',array("1","2","3")) == 1)) }}" type="text" name="is_company" hidden>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="branch_id">{{__('base.company')}}<span class="required-input">*</span></label>
                            <div class="col-md-10">
                                <select class="form-control" id="branch_id" type="text" name="branch_id" onchange="changeBranch(this)" @error('branch_id') autofocus @enderror>
                                    <option value="">{{__('job.company_input')}}</option>
                                    @foreach($branches as $branch)
                                        <option
                                            @if(isset($branch->company))
                                            value="{{$branch->id}}"
                                            @if(old('branch_id', $job->branch_id ?? '') == $branch->id) selected @endif
                                            @else
                                            value="company_{{$branch->id}}"
                                            @if(old('branch_id', isset($job->company_id) ? "company_".$job->company_id :'') == "company_".$branch->id) selected @endif
                                            @endif
                                        >
                                            @if(isset($branch->company))
                                                {{$branch->company['name']}} ({{$branch->name}})
                                            @else
                                                {{$branch->name}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('branch_id') <div class="text-danger branch_id">{{ $message }}</div>@enderror
                                @error('company_id') <div class="text-danger branch_id">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="job_category_id">{{__('job.job_category')}}<span class="required-input">*</span></label>
                            <div class="col-md-10">
                                <select class="form-control" id="job_category_id" type="text" name="job_category_id" onchange="keyUpError(this)" @error('job_category_id') autofocus @enderror>
                                    <option value="">{{__('job.job_category_input')}}</option>
                                    @foreach($jobCategories as $jobCategory)
                                        <option value="{{$jobCategory->id}}"  @if(old('job_category_id', $job->job_category_id ?? '') == $jobCategory->id) selected @endif>{{$jobCategory->name_vi}}</option>
                                    @endforeach
                                </select>
                                @error('job_category_id')<div class="text-danger job_category_id">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="end_date">{{__('job.end_date')}}<span class="required-input">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="date" datetimeformat="dd/MM/yyyy" onchange="keyUpError(this)" value="{{ old('end_date', $job->end_date ?? '') }}" id="end_date" name="end_date" @error('end_date') autofocus @enderror>
                                @error('end_date')<div class="text-danger end_date">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row form-file" @if(old('is_company',!isset($job->company_id) && !isset($job) || isset($job->branches) || (in_array(isset($job) ?? '' ? $job->company_id : '',array("1","2","3")) == 1)) == "true") style="display:none;" @endif >
                            <label class="col-md-2 col-form-label" for="image">{{__('base.image')}}</label>
                            <div class="col-md-10">
                                <label class="btn btn-file">
                                    {{__('job.choose_file')}}<input accept="image/gif,image/jpeg,image/webp,image/png,image/svg,image/svg+xml" type="file" onchange="changeImageJob(this)" style="display: none;" name="image" id="image" />
                                </label>
                                <span class="file-image" id="file-image-job" style="display: none"><span class="name-file"></span><a href="javascript:fileDeleteJob();">&times;</a></span>
                            </div>
                            <span class="col-md-2 required-field"><span class="required-input">*</span>{{__('base.file_size') . __('base.standard_size') . '796x707'}}</span>
                            <div class="col-md-10">
                                <img id="img-preview-job"  src="{{ old('image',$job ?? '' ? ($job->image ?? '' ? asset('storage/images/job/'. $job->image) : asset('img/branch_image.png')) : '' ) }}" alt="" class="img-thumbnail" style="max-width:300px;
                                margin-top: 4px; margin-bottom: 20px;@if(!isset($job)) display: none @endif">
                                <div class="text-danger image"></div>
                            </div>
                            <label class="col-md-2 col-form-label" for="recruitment_address">{{__('job.recruitment_address')}}<span class="required-input">*</span></label>
                            <div class="col-md-10">
                                <select class="form-control" id="recruitment_address" type="text" name="recruitment_address" onchange="keyUpError(this)" @error('recruitment_address') autofocus @enderror>
                                    <option value="">{{__('job.recruitment_address_input')}}</option>
                                    @foreach($recruitmentAddress as $recruitment)
                                        <option value="{{$recruitment->id}}"  @if(old('recruitment_address', $job->recruitment_address ?? '') == $recruitment->id) selected @endif>{{$recruitment->name}}</option>
                                    @endforeach
                                </select>
                                @error('recruitment_address')<div class="text-danger recruitment_address">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{__('job.working_form')}}<span class="required-input">*</span></label>
                            <div class="col-md-10 form-group" style="margin-top : 7px">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="radio" name="is_fulltime"  onclick="keyUpError(this)" value =0 @if(old('is_fulltime',$job->is_fulltime ?? '') == 0) checked @endif @error('is_fulltime') autofocus @enderror>
                                        <label>{{__('job.part_time')}}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="radio" name="is_fulltime"  onclick="keyUpError(this)" value =1 @if(old('is_fulltime',$job->is_fulltime ?? '') == 1) checked @endif>
                                        <label>{{__('job.full_time')}}</label>
                                    </div>
                                </div>
                                @error('is_fulltime')<div class="text-danger is_fulltime">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="vacancies">{{__('job.vacancies')}}</label>
                            <div class="col-md-10">
                                <input class="form-control" style="width: 15%" id="vacancies" value="{{ old('vacancies', $job->vacancies ?? '') }}" type="text" name="vacancies" placeholder="{{__('job.vacancies_input')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{__('job.salary')}}<span class="required-input">*</span></label>
                            <div class="col-md-10 form-group" style="margin-top : 7px">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="radio" id="cttl" name="salary" value =0 @if(old('salary') == 0) checked @endif @error('salary') autofocus @enderror>
                                        <label>{{__('job.negotiable')}}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="radio" id="mlqd" name="salary" value =1 @if(old('salary') == 1 || old('',$job->salary_to ?? '') != null || old('',$job->salary_from ?? '') != null) checked @endif>
                                        <label>{{__('job.specified_salary')}}</label>
                                    </div>
                                </div>
                                <div class="salary" hidden>
                                    <div>
                                        <label for="salary_from">{{__('job.from')}}</label>
                                        <input class="form-control formattedNumberField" id="salary_from" onkeyup="keyUpError(this)" name="salary_from" value="{{ old('salary_from', $job->salary_from ?? '') }}" placeholder="{{__('job.minimum_salary_input')}}" disabled  @error('salary_from') autofocus @enderror>
                                    </div>
                                    <div>
                                        <label  for="salary_to">{{__('job.to')}}</label>
                                        <input class="form-control formattedNumberField" id="salary_to" name="salary_to" value="{{ old('salary_to', $job->salary_to ?? '') }}" placeholder="{{__('job.maximum_salary_input')}}" disabled>
                                    </div>
                                    <div class="required-field required-among"  for="name_vi"><span class="required-input">*</span>{{ __('base.required_among',['items' => __('job.salary_from') . ' , ' . __('job.salary_to')]) }}</div>
                                    @error('salary_from')<br><div class="text-danger salary_from">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="description">{{__('job.description')}}<span class="required-input">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control" style='white-space:pre' id="description" name="description" onkeyup="newLine(event)" rows="2" placeholder="{{__('job.description_input')}}" @error('description') autofocus @enderror>{{ old('description', $job->description ?? '') }}</textarea>
                                @error('description')<div class="text-danger job-description">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="criteria">{{__('job.criteria')}}<span class="required-input">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control" style='white-space:pre' id="criteria" name="criteria" rows="2" onkeyup="newLine(event)" placeholder="{{__('job.criteria_input')}}" @error('criteria') autofocus @enderror>{{ old('criteria', $job->criteria ?? '') }}</textarea>
                                @error('criteria')<div class="text-danger job-criteria">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="benefit">{{__('job.benefit')}}<span class="required-input">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control" style='white-space:pre' id="benefit" name="benefit" rows="2" onkeyup="newLine(event)" placeholder="{{__('job.benefit_input')}}" @error('benefit') autofocus @enderror>{{ old('benefit', $job->benefit ?? '') }}</textarea>
                                @error('benefit')<div class="text-danger job-benefit">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="hotline">{{__('base.hotline')}}<span class="required-input">*</span></label>
                            <div class="form-group col-md-10 row row-margin-0 justify-content-between">
                                <select class="form-control col" id="hotline_id" type="text" name="hotline_id" onchange="keyUpError(this)" @error('hotline_id') autofocus @enderror>
                                    <option value="">{{__('job.hotline_input')}}</option>
                                    @foreach($hotlines as $hotline)
                                        <option value="{{$hotline->id}}"  @if(old('hotline_id', $job->hotline_id ?? '') == $hotline->id) selected @endif>{{$hotline->phone}} ( @if($hotline->is_male == 0) Mrs @else Mr @endif {{$hotline->name}})</option>
                                    @endforeach
                                </select>
                                <p class="btn btn-create col btn-add" data-toggle="modal" data-target="#createHotlineModal">
                                    <i class="fa fa-plus"></i>
                                </p>
                            </div>
                            <label class="col-md-2"></label>
                            @error('hotline_id')<div class="text-danger col-md-10 hotline_id">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <span class="float-left required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>
                            <div class="float-right">
                                <div>
                                    <button class="btn btn-create" type="submit">{{ $job ?? '' ? __('base.update') : __('base.create')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection
@include ('blocks.hotline.create')

@section('javascript')
    <script>
        CKEDITOR.replace('description', {height: '150px', resize_enabled : true, language: '<?php echo App::getLocale(); ?>'})
            .on('change',function(){
                $(`.text-danger.job-description`).text('');
            });
        CKEDITOR.replace('criteria', {height: '150px', resize_enabled : true, language: '<?php echo App::getLocale(); ?>'})
            .on('change',function(){
                $(`.text-danger.job-criteria`).text('');
            });
        CKEDITOR.replace('benefit', {height: '150px', resize_enabled : true, language: '<?php echo App::getLocale(); ?>'})
            .on('change',function(){
                $(`.text-danger.job-benefit`).text('');
            });
        $(document).ready(function() {
            changeUrl()
            if ($('input[id=cttl]:checked').length > 0) {
                $(".salary").attr('hidden',true);
                $("#salary_from").attr('disabled',true);
                $("#salary_to").attr('disabled',true);
            }
            else
            {
                $(".salary").attr('hidden',false);
                $("#salary_from").attr('disabled',false);
                $("#salary_to").attr('disabled',false);
            }
        })
        $("input[type=radio][name=salary]").on('change', function(){
            if($(this).val() == 0)
            {
                $(".salary").attr('hidden',true);
                $("#salary_from").attr('disabled',true);
                $("#salary_to").attr('disabled',true);
            }
            else
            {
                $(".salary").attr('hidden',false);
                $("#salary_from").attr('disabled',false);
                $("#salary_to").attr('disabled',false);
            }
        })
        const job_categories = JSON.parse($('input[name="jobCategories"]').val());
        const branches = JSON.parse($('input[name="branches"]').val());
        $("select[name=job_category_id],select[name=branch_id]").on('change', function (){
            changeUrl();
        })
        function changeUrl()
        {
            let job_category = Object.values(job_categories).find(element => element.id == $("select[name=job_category_id] option:selected").val());
            let branch = Object.values(branches).find(element => element.id == $("select[name=branch_id] option:selected").val());
            let branch_id = $("select[name=branch_id] option:selected").val();
            if(branch_id.indexOf('company_') > -1)
            {
                branch = (branches.find(element => element.company_id == undefined && 'company_' + element.id == branch_id));
            }
            let branch_name = "";
            let job_category_name = "";
            if(branch != undefined)
            {
                if(branch.company_id != null)
                {
                    branch_name = branch.company.name + '-';
                }
                branch_name += branch.name;
            }
            if(job_category != undefined)
            {
                job_category_name = job_category.name_vi.normalize("NFD")
                    .replace(/[\u0300-\u036f]/g, "")
                    .replace(/đ/g, "d")
                    .replace(/Đ/g, "D");
            }
            let value = (branch_name + '-' + job_category_name).toLowerCase().replaceAll(' ','-');
            $("input[name=url]").val(value);
            setTimeout(function(){
                $("input[name=url]").val(value);
            },100);
        }
        function changeImageJob(input)
        {
            $(`.text-danger.${input.name}`).text('');
            if(input.files[0].size > 3000000)
            {
                input.value="";
                $(`.text-danger.${input.name}`).text($('meta[name="file_size"]').attr('content'));
                $('#img-preview-job').attr('src', '').show().css({display: 'none'});
                $('#file-image-job').css({display: 'none'});
                $('#file-image-job .name-file').text('');
                return;
            }
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img-preview-job').attr('src', e.target.result).show().css({display: ''});
                    $('#file-image-job').css({display: ''});
                    $('#file-image-job .name-file').text(input.files[0].name);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        function fileDeleteJob()
        {
            $('input[name=image]').val('');
            $('#img-preview').attr('src', '').show().css({display: 'none'});
            $('#file-image-job').css({display: 'none'});
            $('#file-image-job .name-file').text('');
        }
        function changeBranch(e)
        {
            keyUpError(e);
            if(e.value.search('company_') != -1 || e.value == '')
            {
                let id = e.value.replace('company_','');
                $('.form-file select[name=recruitment_address]').val('');
                if(["1", "2", "3"].indexOf(id) >= 0)
                {
                    $('.form-file').css({display: 'none'});
                    $("input[name=is_company]").val(true);
                    $('.form-file input[name=image]').val('');
                    $('.form-file select[name=recruitment_address]').val('1');
                    $('#img-preview-job').attr('src', '').show();
                }
                else
                {
                    $('.form-file').css({display: ''});
                    $("input[name=is_company]").val(false);
                }
            }
            else
            {
                $("input[name=is_company]").val(true);
                $('.form-file').css({display: 'none'});
                $('.form-file input[name=image]').val('');
                $('.form-file select[name=recruitment_address]').val('');
                $('#img-preview-job').attr('src', '').show();
            }
        }
        function fileDeleteJob(){
            $('input[name=image]').val('');
            $('#img-preview-job').attr('src', '').show().css({display: 'none'});
            $('.file-image').css({display: 'none'});
            $('.file-image .name-file').text('');
        }
    </script>
@endsection
