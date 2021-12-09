@extends('front-end.guest.base')
@section('title')
    {{__('guest.recruitment')}}
@endsection
{{--@section('logo')--}}
{{--    <a class="team-line-logo" href="#">--}}
{{--        <img class="logo-main" src="{{asset('guest/images/Logo-Company.png')}}" alt="Logo-Company">--}}
{{--    </a>--}}
{{--@endsection--}}
@section('content')
    <div class="banner-recruitment wow fadeInLeft">
        <div class="text-employee wow fadeInUp">
            <h1>employee recruitment</h1>
            <p>Làm Việc Trong Các Công Ty Vốn Fdi Nhật Bản, Mức Lương Hấp Dẫn.<br>Môi Trường Năng Động, Cơ Hội Trau Dồi
                Ngôn Ngữ</p>
        </div>
    </div>
    <div class="link-maintence wow fadeInLeft">
        <div class="breadcrumbs-title">
            <a class="c-accordion" href="{{route('homepage')}}">{{__('guest.home')}}
                <i class="mdi mdi-chevron-right material-icons float-right"></i>
            </a>
            <p>{{__('guest.recruitment')}}</p>
        </div>
    </div>
    <div class="go-top" title="Top to page">
        <i class="mdi mdi-chevron-up"></i>
    </div>
    <div class="employee-develop">
        <div class="employee-target wow fadeInUp">
            <h3>Nguồn Lực Là Mục Tiêu Của Sự Phát Triển!</h3>
            <p>Nhân lực là một thành phần không thể thiếu trong bất cứ một đơn vị doanh nghiệp nào. Không một đơn vị nào
                có thể tồn tại nếu không có nguồn nhân lực đáp ứng được sự hoạt động và vận hành của bộ máy công ty. Sakura
                luôn chú trọng và hiểu được tầm quan trọng đó , luôn tạo môi trường tốt nhất để nhân viên có thể phát huy
                hết khả năng và cống hiến hết mình cho công ty.</p>
        </div>
        <div class="employee-connect wow fadeInUp">
            <h3>Kết Nối Mọi Người.</h3>
            <div class="img-connect"><img src="{{asset('guest/images/fuji-18.png')}}" alt=""></div>
            <div class="list-connect">
                <p><span>Sakura</span> là ngôi nhà gắn kết của những người trẻ , đầy nhiêt huyết trong công việc.</p>
                <p><span>Sakura</span> cho bạn cơ hội tiếp xúc , giao lưu văn hóa làm việc của đất nước & con người Nhật Bản
                </p>
                <p><span>Sakura</span> mang lại cho bạn một sự nghiệp vững vàng không ngừng phát triển.</p>
            </div>
        </div>
        <div class="why-choose">
            <div class="text-why wow fadeInLeft">
                <h3>Vì sao chọn làm việc tại <span> Sakura ?</span></h3>
                <p>- Tôn trọng và ghi nhận thành tích của bạn<br>- Chế độ phúc lợi hấp dẫn<br>- Coi trọng chất lượng cuộc
                    sống của bạn</p>
            </div>
            <div class="image-why wow fadeInRight">
                <div class="image-why-child-1">
                    <img src="{{asset('guest/images/fuji-44.png')}}" alt="">
                </div>
                <div class="image-why-child-2">
                    <img src="{{asset('guest/images/fuji-55.png')}}" alt="">
                </div>
                <div class="image-why-child-3">
                    <img src="{{asset('guest/images/fuji-33.png')}}" alt="">
                </div>
                <div class="image-why-child-5">
                    <img src="{{asset('guest/images/fuiji-22.png')}}" alt="">
                </div>
                <div class="image-why-child-4">
                    <img src="{{asset('guest/images/fuji-11.png')}}" alt="">
                </div>

            </div>
        </div>
    </div>
    <div class="blog-manager wow fadeInUp">
        <div class="content-blog">
            <div class="text-blog">
                <p>“Đó là một cái duyên khi tôi được vào làm việc tại Sakura. Trước đây tôi thường quen làm viêc trong môi
                    trường cũ gò bó, khắt khe. Nhưng khi gia nhập Sakura đó la một môi trường hoàn toàn mới. Tự do sáng tạo tư
                    duy theo ý thích, hiệu quả cao. Sếp than thiện, đồng nghiệp hỗ trợ hết mình.<br>Bây giờ mỗi ngày đến công
                    ty là một ngày thật vui và ý nghĩa với tôi”</p>
                <p>Mr Hiệp - service manager</p>
            </div>
            <div class="image-blog">
                <img src="{{asset('guest/images/fuji-66.png')}}" alt="">
            </div>
        </div>
    </div>
    <div class="job-list wow fadeInUp">
        <div class="header-job">
            <h3>Khi bạn yêu thích công việc của mình , ngào nào cũng là ngày lễ!</h3>
            <h4>Nhiều cơ hội việc làm đang chào đón bạn!</h4>
        </div>
        <div class="job-table">
            <table id="list-job">
{{--                <tr>--}}
{{--                    <th class="job-table-child-1">--}}
{{--                        <img src="{{asset('guest/images/fuji-10.png')}}" alt="">--}}
{{--                        <p>Công Ty TNHH Sinh Thái Hoa Anh Đào</p>--}}
{{--                    </th>--}}
{{--                    <th class="job-table-child-2">--}}
{{--                        <p>Quản lý Nhân sự</p>--}}
{{--                    </th>--}}
{{--                    <th class="job-table-child-3">--}}
{{--                        <p><span><i class="mdi mdi-map-marker"></i></span>No. 67, Lane 279 Doi Can Street, Ba Dinh District,--}}
{{--                            Hanoi City.</p>--}}
{{--                    </th>--}}
{{--                    <th class="job-table-child-4">--}}
{{--                        <a href="recruitment-subpage.html">--}}
{{--                            <p>7 - 10 TRIỆU</p>--}}
{{--                        </a>--}}
{{--                        <p>Hết hạn ngày:12/12/2022</p>--}}
{{--                    </th>--}}
{{--                </tr>--}}
            </table>
            <div class="pagination-job">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id="pagination-job">
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            getJob(1);
        });
        function getJob(page)
        {
            let url = '{{route('recruitment.index')}}' + '?page=' + page ;
            let request = $.ajax({
                url: url,
                data:{
                    '_token': '{{ csrf_token() }}'
                },
                method: "GET"
            }).done(function (data) {
                jobList(data.data)
                pagination(page,data.last_page);
            });
        }
        function jobList(jobs)
        {
            let html_job = '';
                jobs.forEach(function(job){
                    html_job += ` <tr>
                                <th class="job-table-child-1">
                                    <img src="${job.image}" alt="">
                                    ${job.branch_name}
                                    </th>
                                <th class="job-table-child-2">
                                    <p>${job.job_categories.name_vi}</p>
                                </th>
                                <th class="job-table-child-3">
                                <a href="${job.uri_address}" target='_blank'>
                                    <span>
                                        <i class="mdi mdi-map-marker"></i>
                                    </span>
                                    ${job.address}
                                </a>
                                </th>
                                <th class="job-table-child-4">
                                    <a href="${job.url_detail}">
                                        <p>${job.salary}</p>
                                    </a>
                                    <p>${job.end_date}</p>
                                </th>
                            </tr>`;
                })
            $('#list-job').html(html_job);
        }
        function pagination(page,last_page)
        {
            let html_pagination = '';
            if(parseInt(page) == 1)
            {
                html_pagination += `<li class="page-item disabled">
                                            <button class="page-link" aria-label="Previous" disabled>
                                                <span aria-hidden="true"><i class="mdi mdi-chevron-left"></i></span>
                                            </button>
                                       </li>`;
            }
            else
            {
                html_pagination += `<li class="page-item">
                                            <button class="page-link" onclick="getJob(${page} - 1)" aria-label="Previous">
                                                <span aria-hidden="true"><i class="mdi mdi-chevron-left"></i></span>
                                            </button>
                                       </li>`;
            }
            if(last_page <= 3)
            {
                for(let i = 1; i <= last_page; i++)
                {
                    if(parseInt(page) != i)
                    {
                        html_pagination += `<li class="page-item"><button class="page-link" onclick="getJob(${i})">${i}</button></li>`;
                    }
                    else
                    {
                        html_pagination += `<li class="page-item active"><button class="page-link" onclick="getJob(${i})">${i}</button></li>`;
                    }
                }
            }
            else if(page <= 2)
            {
                for(let i = 1; i <= 3; i++)
                {
                    if(parseInt(page) != i)
                    {
                        html_pagination += `<li class="page-item"><button class="page-link" onclick="getJob(${i})">${i}</button></li>`;
                    }
                    else
                    {
                        html_pagination += `<li class="page-item active"><button class="page-link" onclick="getJob(${i})">${i}</button></li>`;
                    }
                }
            }
            else if(last_page - page < 2)
            {
                for(let i = last_page - 2; i <= last_page; i++)
                {
                    if(parseInt(page) != i)
                    {
                        html_pagination += `<li class="page-item"><button class="page-link" onclick="getJob(${i})">${i}</button></li>`;
                    }
                    else
                    {
                        html_pagination += `<li class="page-item active"><button class="page-link" onclick="getJob(${i})">${i}</button></li>`;
                    }
                }
            }
            else
            {
                for(let i = page - 1; i <= page + 1; i++)
                {
                    if(parseInt(page) != i)
                    {
                        html_pagination += `<li class="page-item"><button class="page-link" onclick="getJob(${i})">${i}</button></li>`;
                    }
                    else
                    {
                        html_pagination += `<li class="page-item active"><button class="page-link" onclick="getJob(${i})">${i}</button></li>`;
                    }
                }
            }
            if(parseInt(page) == last_page)
            {
                html_pagination += `<li class="page-item disabled">
                                            <button class="page-link" aria-label="Next" disabled>
                                                <span aria-hidden="true"><i class="mdi mdi-chevron-right"></i></span>
                                            </button>
                                        </li>`;
            }
            else
            {
                html_pagination += `<li class="page-item">
                                            <button class="page-link" onclick="getJob(${page} + 1)" aria-label="Next">
                                                <span aria-hidden="true"><i class="mdi mdi-chevron-right"></i></span>
                                            </button>
                                        </li>`;
            }
            $(`#pagination-job`).html(html_pagination);
        }
    </script>
@endsection
