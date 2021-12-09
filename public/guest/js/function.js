$(function () {

    // adjustSize();
    // handleLinks();
    // leftToRightNavbar();

    $('.content-wrapper').hide().fadeIn(1500);
    $('footer').hide().fadeIn(1500);

    // stikcyHeader();
    // backToTop();
});

new WOW().init();

var btn = $('#button');

// $(document).ready(function(){
//   $('.panel-collapse').on('show.bs.collapse', function () {
//     $(this).siblings('.panel-heading').addClass('active');
//   });

//   $('.panel-collapse').on('hide.bs.collapse', function () {
//     $(this).siblings('.panel-heading').removeClass('active');
//   });
// });





$(document).ready(function () {
    $('.nav-item a[href^="#"]').on('click', function (e) {
        $('.nav').find('.nav-item').removeClass("active");
        $(this).parent().addClass('active');
    });

    if (localStorage.getItem("status")) {
        if (localStorage.getItem("status") == 200) {
            Swal.fire({
                icon: 'success',
                title: localStorage.getItem("title"),
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: localStorage.getItem("title"),
                text: localStorage.getItem("message"),
            });
        }
        localStorage.clear();
    }
    $('.home-lang a').click(function () {
        if ($('.lang-menu').hasClass('show')) {
            $('.lang-menu').show().removeClass('show');
        } else {
            $('.lang-menu').hide().addClass('show');
        }
    });
});

$(".icon-main").click(function () {
    $('.main-content').toggleClass('site-menu')
});

// function stikcyHeader() {
//
//     var $win = $(window),
//         $main = $('main'),
//         $nav = $('nav'),
//         navHeight = $nav.outerHeight(),
//         footerHeight = $('footer').outerHeight(),
//         documentHeight = $(document).height(),
//         navPos = $nav.offset().top,
//         fixedClass = 'is-fixed',
//         hideClass = 'is-hide';
//
//     $win.on('load scroll', function () {
//         var value = $(this).scrollTop(),
//             scrollPos = $win.height() + value;
//
//         if (value > navPos) {
//             if (documentHeight - scrollPos <= footerHeight) {
//                 $nav.addClass(hideClass);
//             } else {
//                 $nav.removeClass(hideClass);
//             }
//             $nav.addClass(fixedClass);
//             $main.css('margin-top', navHeight);
//         } else {
//             $nav.removeClass(fixedClass);
//             $main.css('margin-top', '0');
//         }
//     });
// }

function openPage(url)
{
    window.open(url, "_blank");
}

function goToPage(url)
{
    location.href = url;
}



function myFunction(x)
{
    x.classList.toggle("change");
}

$('.icon-main').click(function () {
    $('.menu-overlay').toggleClass('active');
    $('.navbar').toggleClass('show');
    $('.scroll-arrow').toggleClass('choose');
    $('.slide-left').toggleClass('choose');
})


$('.owl-staff-list').owlCarousel({
    dots: false,
    items: 5,
    autoplay: false,
    autoplayHoverPause: true,
    autoplaySpeed: 3000,
    responsiveClass: true,
    navText: ['<span class="mdi mdi-arrow-left-drop-circle-outline"></span>', '<span class="mdi mdi-arrow-right-drop-circle-outline"></span>'],
    mouseDrag: false,
    responsive: {
        0: {
            items: 2,
            margin: 9,
            autoplay: true,
            nav: true,
            loop: true
        },

        600: {
            items: 2,
            margin: 9,
            autoplay: true,
            nav: true,
            loop: true
        },

        760: {
            items: 4,
            margin: 9,
            loop: true,
            nav: false,
            autoplay: true
        },

        1024: {
            items: 5,
            margin: 12.5,
            loop: true,
            nav: false
        },

        1100: {
            items: 5,
            margin: 25,
            loop: false
        }
    }
});

$('.owl-staff').owlCarousel({
    dots: false,
    items: 5,
    autoplay: false,
    autoplayHoverPause: true,
    autoplaySpeed: 3000,
    responsiveClass: true,
    margin: 24,
    mouseDrag: false,
    responsive: {
        0: {
            items: 2,
            nav: true,
            loop: true,
            margin: 9,
        },
        600: {
            items: 3,
            nav: false,
            loop: true,
            margin: 15,
        },
        1000: {
            items: 5,
            nav: false,
            loop: false,
        }
    }
});


$('.owl-logo').owlCarousel({
    loop: false,
    margin: 60,
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 3000,
    responsive: {
        0: {
            items: 3,
            margin: 7.5,
        },
        575: {
            items: 3,
            margin: 7.5,
        },
        768: {
            items: 3
        },
        992: {
            items: 5
        },
        1200: {
            items: 5
        }
    }
});

function myFunction()
{
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}


$(document).ready(() => {
    const pageUrl = window.location.href;
    const windowWidth = document.body.clientWidth;
});

function openPage(url)
{
    window.open(url, "_blank");
}

function goToPage(url)
{
    location.href = url;
}

function getMainContentMinHeight()
{

    let screenHeight = $(window).innerHeight();
    let headerHeight = $("#header-wrapper").outerHeight();
    let footerHeight = $("#footer-wrapper").outerHeight();
    let paddingBottom = 10;

    let mainContentMinHeight = screenHeight - headerHeight - footerHeight - paddingBottom;

    return mainContentMinHeight;
}



$('#top_navbar li.languages').hover(function () {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function () {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});

$(window).resize(function () {
    changeBackground();
});

function changeBackground()
{
    var viewportWidth = $(window).width();

    if (viewportWidth < 1200) {
        $("#video-bg").html(`<video autoplay muted loop>  <source src="images/Comp.mp4" type="video/mp4"></video>`);
    } else {
        $("#video-bg").html(`<video  autoplay muted loop> <source src="images/top/background-hp.mp4" type="video/mp4"></video>`);
    }
}


$('.owl-logo').owlCarousel({
    loop: true,
    margin: 15,
    nav: false,
    dots: true,
    autoplay: false,
    autoplayTimeout: 3000,

    responsive: {
        0: {
            items: 5
        },
        600: {
            items: 5
        },
        1000: {
            items: 5
        }
    }
});



$(document).ready(function () {
    $("#fuji-button").click(function () {
        window.open("maintence.html");
    });
    $('.accordion-toggle').click(function () {
        $('#collapseOne').toggle();
        $('.accordion-toggle i').toggleClass('change');
    });
});

// Go to top

$(document).ready(() => {
    $('.go-top').fadeOut().css('transform','scale(0)');
    // go products
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.go-top').fadeIn().css({"transform": "scale(1)", "display": "block"});
        } else {
            $('.go-top').fadeOut().css({"transform": "scale(0)", "display": "none"});
        }
    });
    $('.go-top').click(() => {
        $("html, body").animate({
            scrollTop: 0
        }, 200);
        return false;
    });
});


// Scroll down

$(function () {
    // $('a[href*=#]').on('click', function (e) {
    //     e.preventDefault();
    //     $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top }, 500, 'linear');
    // });
});


// video

// function onClick(element) {
//   document.getElementById("myVideo").src = element.src;
//   document.getElementById("video").style.display = "block";
//   $(document).ready(function () {
//     window.onclick = function (event) {
//       if (event.target == video) {
//         video.style.display = "none";
//       }
//     }
//   });
// }


$(".content-video img").click(function () {
    $("#full-image").attr("src", $(this).attr("src"));
    $('#image-viewer').css({'display' : 'flex'});
});

$("#image-viewer .close").click(function () {
    $('#image-viewer').css({'display' : ''});
});

function changeNews(news)
{
    let base_url = $('meta[name="url"]').attr('content');
    if (news.image == null) {
        if (news.default_image == null) {
            $('.news-item img').attr('src',base_url + '/img/no-image.jpg');
        } else {
            $('.news-item img').attr('src',base_url + '/' + news.default_image);
        }
    } else {
        $('.news-item img').attr('src',base_url + '/storage/images/news/' + news.image);
    }
    $('.news-item h5').text(news.title);
    $('.news-item strong.time').text(news.date);
    $('.news-item p').text(news.abstract);
    $(`.news-item-sub .overlay`).css({'opacity' : 0 });
    $(`.news-item-sub#row-${news.id} .overlay`).css({'opacity' : 1 });
}
