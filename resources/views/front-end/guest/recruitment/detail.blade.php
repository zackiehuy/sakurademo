@extends('front-end.guest.base')
@section('title')
    {{__('guest.recruitment')}}
@endsection
@section('content')
    <div class="recruitment-detail">
        <div class="recruitment-billboard">
            <h3>{{$job->jobCategories->name_vi}}</h3>
            <div class="content-billboard">
                <div class="salary">
                    <p>{{$job->salary}}</p>
                </div>
                <div class="address-billboard">
                    <a href="{{$job->uri_address}}" target='_blank'><span><i class="mdi mdi-map-marker"></i></span>{{$job->address}}</a>
                </div>
                <div class="date-expire">
                    <p>{{$job->end_date}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-info">
        <div class="row">
            <div class=" col-12 col-sm-12 col-md-12 col-lg-7 col-xl-8 img-contact-info">
                <img src="{{asset('guest/images/recruitment-detail.png')}}" alt="">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-4">
                <div class="content-contact-info {{$job->disabled}}">
                    <p>*THÔNG TIN LIÊN HỆ<br><span>Người liên hệ:</span> {{$job->hotline_name}}</p>
                    <p>
                        <span class="px-0">
                            <i class="mdi mdi-phone"></i>
                            <span id="phone">{{$job->hotline_phone_show}}
                                <span id="hotline_phone_hide" class="hotline_replace phone-number">{{$job->hotline_replace}}</span>
                                <span id="hotline_replace" class="hotline_phone_hide phone-number hide-phone-number">{{$job->hotline_phone_hide}}</span>
                            </span>
                        </span>
                        <button onclick="showHotline()">BẤM ĐỂ HIỆN SỐ</button>
                    </p>
                    <p><i class="mdi mdi-clipboard-file"></i><button class="submit-cv" onclick="showForm()">NỘP HỒ SƠ</button></p>
                    <form id="formCV" method="POST" action="{{route('recruitment.store')}}" class="form-group hide">
                        @csrf

                        <div class="row">
                            <div class="col-3 px-0">
                                <label class=" btn btn-file ">
                                    Đăng CV
                                    <input accept="image/gif,image/jpeg,image/png,image/jpg" onchange="readCV(this)" type="file" style="display: none;" name="cv" id="cv" />
                                </label>
                            </div>
                            <div class="col-9" id="cv-title"></div>
                        </div>
                        <div class="row">
                            <div class="required-input error-cv"></div>
                        </div>
                        <div class="row">
                            <input class="col name" type="text" name="name" placeholder="Họ và tên:" onkeyup="keyUpError(this)">
                            <span class="required-input error-name"></span>
                        </div>
                        <div class="row">
                            <input class="col name" type="text" name="phone" placeholder="Số điện thoại:" onkeyup="keyUpError(this)">
                            <span class="required-input error-phone"></span>
                        </div>
                        <div class="row">
                            <input class="col name" type="text" name="email" placeholder="Email:" onkeyup="keyUpError(this)">
                            <span class="required-input error-email"></span>
                        </div>
                        <div class="row">
                            <div class="col px-0">
                                <button class="float-right btn btn-create" type="submit">Ứng tuyển</button>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="job_id" value="{{$job->id}}" disabled style="display: none">
                    </form>
                    <p>
                        @if($job->disabled == 'disabled')
                            <i class="mdi mdi-chat-processing"></i>
                        @else
                            <a href="https://zalo.me/{{$job->hotline_phone_show.$job->hotline_phone_hide}}" target="_blank">
                                <img src="{{asset('guest/images/zalo.png')}}" alt="zalo">
                            </a>
                        @endif
                        CHAT VỚI NHÀ TUYỂN DỤNG
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="link-recruitment">
        <div class="breadcrumbs-title">
            <a class="c-accordion" href="{{route('recruitment.index')}}"> {{__('guest.back')}}
                <i class="mdi mdi-chevron-right material-icons float-right"></i>
            </a>
            <p>{{__('guest.recruitment')}}</p>
        </div>
    </div>
    <div class="go-top" title="Top to page">
        <i class="mdi mdi-chevron-up"></i>
    </div>
    <div class="description-work">
        <h3>Công Ty TNHH Sinh Thái Hoa Anh Đào</h3>
        @if(isset($job->company->information))
            <h5>Thông tin công ty:</h5>
            <ul class="list-work-description">
                <ul>
                    <li>Tên công ty: {{$job->company->name}}</li>
                </ul>
                <ul>
                    <li>Thông tin công ty:</li>
                    {!! $job->company->information !!}
                </ul>
            </ul>
        @endif
        <h5>1. MÔ TẢ CÔNG VIỆC :</h5>
        <ul class="list-work-description">
            {!! $job->description !!}
        </ul>
        <h5>2. TIÊU CHÍ TUYỂN DỤNG :</h5>
        <ul class="list-work-description">
            {!! $job->criteria !!}
        </ul>
        <h5>3. HÌNH THỨC LÀM VIỆC: </h5>
        <ul class="list-work-description">
            @if($job->is_fulltime)
                <li>Toàn thời gian cố định </li>
            @else
                <li>Bán thời gian</li>
            @endif

            @if(isset($job->vacancies))
                <li>SỐ LƯỢNG CẦN TUYỂN: {{$job->vacancies}}</li>
            @endif
        </ul>
        <h5>4. QUYỀN LỢI :</h5>
        <ul class="list-work-descriptionk">
            {!! $job->benefit !!}
        </ul>
        <h5> 5.YÊU CẦU HỒ SƠ</h5>
        <ul class="list-work-description">
            <li>Sơ yếu lý lịch</li>
            <li>Đơn xin việc.</li>
            <li>Hộ khẩu, chứng minh nhân dân và giấy khám sức khỏe.</li>
            <li>Các bằng cấp có liên quan.</li>
        </ul>
        <h6>Chia sẽ tin tuyển dụng này cho bạn bè:</h6>
        <div class="img-description">
            <a target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/sharer/sharer.php?u={{$job->url_detail}}">
                <img src="{{asset('guest/images/facebook.png')}}" alt="facebook">
            </a>
            <a target="_blank" rel="noopener noreferrer" href="https://twitter.com/intent/tweet?url={{$job->url_detail}}">
                <img src="{{asset('guest/images/twitter.svg')}}" alt="messenger">
            </a>
        </div>
        <h5 class="link-to-work">Công việc liên quan</h5>
        <div class="job-table">
            <table>
                @foreach($same_jobs as $same_job)
                    <tr>
                        <th class="job-table-child-1">
                            <img src="{{$same_job->image}}" alt="logo-company">
                            {!! $same_job->branch_name !!}
                        </th>
                        <th class="job-table-child-2">
                            <p>{{$same_job->jobCategories->name_vi}}</p>
                        </th>
                        <th class="job-table-child-3">
                            <a href="{{$same_job->uri_address}}" target='_blank'>
                                    <span>
                                        <i class="mdi mdi-map-marker"></i>
                                    </span>
                                {{$same_job->address}}
                            </a>
                        </th>
                        <th class="job-table-child-4">
                            <a href="{{$same_job->url_detail}}">
                                <p>{{$same_job->salary}}</p>
                            </a>
                            <p>{{$same_job->end_date}}</p>
                        </th>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $('#formCV').submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            let url = $(this).attr('action');
            let job_id = $('input[name=job_id]').val();
            formData.append('job_id',job_id);
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
                    if(res.status == 200)
                    {
                        location.reload();
                    }
                    else
                    {
                        if(res.is_existed)
                        {
                            location.reload();
                        }
                        else
                        {
                            localStorage.clear();
                            window.location.replace(res.url);
                        }
                    }
                },
                error: function(error){
                    let errors = error.responseJSON.errors;
                    $(`#formCV .required-input`).html("");
                    $.each(errors,function (key,value){
                        $(`#formCV .error-${key}`).html(value[0]).addClass("error-input");
                    });
                }
            })
        });
        function showHotline()
        {
            let id = $('.hide-phone-number').attr('id');
            $('.phone-number').removeClass('hide-phone-number');
            $(`.${id}`).addClass('hide-phone-number');
            if(id == 'hotline_replace')
            {
                $('.content-contact-info #phone').css({'color' : '#2d2d2d'});
            }
            else if(id == 'hotline_phone_hide')
            {
                $('.content-contact-info #phone').css({'color' : '#949BAD'});
            }
        }
        function showForm()
        {
            if($('.submit-cv').hasClass('show'))
            {
                $('.submit-cv').removeClass('show');
                $('#formCV').addClass('hide');
            }
            else
            {
                $('.submit-cv').addClass('show');
                $('#formCV').removeClass('hide');
            }
        }

        function keyUpError(e)
        {
            $(`#formCV .error-${e.name}`).text('')
        }

        function readCV(input)
        {
            $(`#formCV .error-${input.name}`).text('');
            if (input.files[0].size > 3000000) {
                input.value="";
                $(`#formCV .error-${input.name}`).text($('meta[name="file_size"]').attr('content'));
                $('#cv-title').text('');
                return;
            }
            else
            {
                $('#cv-title').text(input.files[0].name);
            }
        }
    </script>
@endsection
