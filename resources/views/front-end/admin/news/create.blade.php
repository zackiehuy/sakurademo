@extends('dashboard.base')
@section('title')
    {{__('news.news')}}
@endsection
@section('content')
    <div class="row">
        <div class="col mx-4">
            <div class="card">
                <div class="card-header add-new-item">
                    <a href="{{route('news.index')}}" class="float-left back-to-list">
                            {{__('news.news')}}
                    </a>
                    <span class="cross-back">/</span>
                    {{ $news ?? '' ? __('base.edit') : __('base.create')}}
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="form-news"
                          action="{{ url( $news ?? '' ? 'admin/news/' . $news->id : 'admin/news') }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ $news ?? '' ? method_field('PUT') : ''}}
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-news-vi" data-toggle="tab" onclick="changeTab('#nav-news-vi')" href="#" role="tab" aria-controls="nav-news-vi" aria-selected="true">{{__('base.news_vi')}}<span class="required-input">*</span></a>
                                <a class="nav-item nav-link" id="nav-news-jp" data-toggle="tab" onclick="changeTab('#nav-news-jp')" href="#" role="tab" aria-controls="nav-news-jp" aria-selected="false">{{__('base.news_jp')}}<span class="required-input">*</span></a>
                                <a class="nav-item nav-link" id="nav-news-en" data-toggle="tab" onclick="changeTab('#nav-news-en')" href="#" role="tab" aria-controls="nav-news-en" aria-selected="false">{{__('base.news_en')}}<span class="required-input">*</span></a>
                            </div>
                        </nav>
                        <div class="tab-content tab-news" id="nav-tabContent">
                            <div class="tab-pane active" id="nav-news-vi" role="tabpanel" aria-labelledby="nav-branch-tab">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="title_vi">{{__('news.title')}}<span class="required-input">*</span></label>
                                    <div class="col-md-10">
                                <textarea class="form-control" id="title_vi" rows="2"
                                          type="text" name="vi[title]" placeholder="{{__('news.title_input')}}"
                                          onkeyup="newLineNews(event)" @error('vi.title') autofocus @enderror>{{ old('vi.title', $news->{'title:vi'} ?? '') }}</textarea>
                                        @error('vi.title')<div class="text-danger title_vi">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="abstract_vi">{{__('news.abstract')}}<span class="required-input">*</span></label>
                                    <div class="col-md-10">
                                    <textarea class="form-control" id="abstract_vi" onkeyup="newLineNews(event)" name="vi[abstract]" rows="2"
                                          placeholder="{{__('news.abstract_input')}}" @error('vi.abstract') autofocus @enderror>{{ old('vi.abstract', $news->{'abstract:vi'} ?? '') }}</textarea>
                                        @error('vi.abstract')<div class="text-danger abstract_vi">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="nav-news-jp" role="tabpanel" aria-labelledby="nav-hotline-tab">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="title_jp">{{__('news.title')}}<span class="required-input">*</span></label>
                                    <div class="col-md-10">
                                <textarea class="form-control" id="title_jp" rows="2"
                                          type="text" name="jp[title]" placeholder="{{__('news.title_input')}}"
                                          onkeyup="newLineNews(event)" @error('jp.title') autofocus @enderror>{{ old('jp.title', $news->{'title:jp'} ?? '') }}</textarea>
                                        @error('jp.title')<div class="text-danger title_jp">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="abstract_jp">{{__('news.abstract')}}<span class="required-input">*</span></label>
                                    <div class="col-md-10">
                                <textarea class="form-control" id="abstract_jp" onkeyup="newLineNews(event)" name="jp[abstract]" rows="2"
                                          placeholder="{{__('news.abstract_input')}}" @error('jp.abstract') autofocus @enderror>{{ old('jp.abstract', $news->{'abstract:jp'} ?? '') }}</textarea>
                                        @error('jp.abstract')<div class="text-danger abstract_jp">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="nav-news-en" role="tabpanel" aria-labelledby="nav-hotline-tab">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="title_en">{{__('news.title')}}<span class="required-input">*</span></label>
                                    <div class="col-md-10">
                                <textarea class="form-control" id="title_en" rows="2"
                                          type="text" name="en[title]" placeholder="{{__('news.title_input')}}"
                                          onkeyup="newLineNews(event)" @error('en.title') autofocus @enderror>{{ old('en.title', $news->{'title:en'} ?? '') }}</textarea>
                                        @error('en.title')<div class="text-danger title_en">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="abstract_en">{{__('news.abstract')}}<span class="required-input">*</span></label>
                                    <div class="col-md-10">
                                <textarea class="form-control" id="abstract_en" onkeyup="newLineNews(event)" name="en[abstract]" rows="2"
                                          placeholder="{{__('news.abstract_input')}}" @error('en.abstract') autofocus @enderror>{{ old('en.abstract', $news->{'abstract:en'} ?? '') }}</textarea>
                                        @error('en.abstract')<div class="text-danger abstract_en">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="image">{{__('base.image')}}</label>
                            <div class="col-md-10">
                                <label class="btn btn-file">
                                    {{__('news.choose_file')}}<input accept="image/gif,image/jpeg,image/webp,image/png,image/svg,image/svg+xml" type="file" onchange="readImage(this)" style="display: none;" name="image" id="image" />
                                </label>
                                <span class="file-image" style="display: none"><span class="name-file"></span><a href="javascript:fileDelete();">&times;</a></span>
                            </div>
                            <span class="col-md-2 required-field"><span class="required-input">*</span>{{__('base.file_size') . __('base.standard_size') . '612x315'}}</span>
                            <div class="col-md-10">
                                <img id="img-preview"  src="{{ old('image',$news->image ?? '' ? asset('storage/images/news/'. $news->image)  : ($news->default_image ?? '' ? asset($news->default_image)  : asset('img/no-image.jpg')) ) }}" alt="" class="img-thumbnail" style="max-width:275px;
                                    margin-top: 4px;@if(!isset($news)) display: none; @endif ">
                                <div class="text-danger image"></div>
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-2 col-form-label" for="content">{{__('news.content')}}<span class="required-input">*</span></label>--}}
{{--                            <div class="col-md-10">--}}
{{--                                <textarea class="form-control" id="contentNews" name="content" rows="2"--}}
{{--                                          onkeyup="keyUpError(this)"--}}
{{--                                          placeholder="{{__('news.content_input')}}">{{ old('content', $news->content ?? '') }}</textarea>--}}
{{--                                @error('content')<div class="text-danger content">{{ $message }}</div>@enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <span class="float-left required-field">{{__('base.field')}} <span class="required-input">*</span> {{__('base.is_required')}}</span>
                            <div class="float-right">
                                <div>
                                    <button class="btn btn-create" type="submit">{{ $news ?? '' ? __('base.update') : __('base.create')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection
@section('javascript')
        <script>
            function newLineNews(e)
            {
                $(`#form-news .text-danger.${e.target.id}`).text('');
                if (e.target.value.match(/\n/g)) {
                    let lines = parseInt(e.target.value.match(/\n/g).length) + 1;
                    $(`textarea#${e.target.id}`).attr('rows',lines);
                }
            }
        </script>
@endsection
