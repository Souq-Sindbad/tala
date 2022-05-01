<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>{{ $settings->getTranslateTitle(app()->getLocale()) }}</title>
    <link rel="icon" href="{{ asset('public/assets/images/favicon.ico')}}" type="image/x-icon">

    <!-- Stylesheets -->
    <link href="{{ asset('public/assets/css/font-awesome-all.css')}}?v=4" rel="stylesheet">
    <link href="{{ asset('public/assets/css/owl.css')}}?v=4" rel="stylesheet">
    @if(app()->getLocale() == 'ar')
        <link href="{{ asset('public/assets/css/rtl.css')}}?v=19" rel="stylesheet">
        <link href="{{ asset('public/assets/css/ar_responsive.css')}}?v=19" rel="stylesheet">
    @else
        <link href="{{ asset('public/assets/css/bootstrap.css')}}?v=4" rel="stylesheet">
        <link href="{{ asset('public/assets/css/jquery.fancybox.min.css')}}?v=4" rel="stylesheet">
        <link href="{{ asset('public/assets/css/animate.css')}}?v=4" rel="stylesheet">
        <link href="{{ asset('public/assets/css/style.css')}}?v=6" rel="stylesheet">
        <link href="{{ asset('public/assets/css/responsive.css')}}?v=6" rel="stylesheet">
    @endif

    <style>
        @font-face {
            font-family: 'IBMPlexSansArabicBold';
            src: url({{ asset('public/assets/font/Effra_Std_Bd.ttf') }});
            font-weight: 700;
        }

        @font-face {
            font-family: 'IBMPlexSansArabic';
            src: url({{ asset('public/assets/font/Effra_Std_Rg.ttf') }});
            font-weight: 400;
        }

         h1, h2, h3, h4, h5, h6 {
             letter-spacing: 0;
            font-family: 'IBMPlexSansArabicBold', sans-serif !important;
         }

        body,p, a {
            letter-spacing: 0;
            font-family: 'IBMPlexSansArabic', sans-serif !important;
        }
        .content_block_1 .content-box .bold-text p{
            color: #1B2B58;
            font-family: IBMPlexSansArabicBold;
        }
    </style>

</head>
<body dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<div class="boxed_wrapper">
    <header class="main-header style-four style-five">
        <div class="header-lower">
            <div class="outer-box">
                    <div class="logo-box">
                        <figure class="logo"><a href="/"><img src="{{ asset('public/assets/images/logo-2.png')}}"
                                                              style="width:65px" alt=""></a></figure>
                    </div>
                    <div class="menu-area clearfix">
                        <div class="mobile-nav-toggler">
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation scroll-nav clearfix">

                                    <li class="current "><a href="#home">@lang('site.home')</a>

                                    </li>
                                    <li><a href="#about">@lang('site.about')</a></li>
{{--                                    <li><a href="#statistics">@lang('site.statistics')</a></li>--}}
                                    <li><a href="#projects">@lang('site.projects')</a></li>
{{--                                    <li><a href="#why_us">@lang('site.why_us')</a></li>--}}
                                    <li><a href="#partners">@lang('site.partners')</a></li>
                                    <li><a href="#contact">@lang('site.contact')</a></li>
                                    <li class="lang_item">
                                        @if(app()->getLocale() == 'ar')
                                            <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"
                                            >En</a>
                                        @else
                                            <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"
                                            >العربية</a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                <ul class="menu-right-content clearfix">
                    @if(app()->getLocale() == 'ar')
                        <li class="btn-box">
                            <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"
                               class="btn btn-outline-light">En</a>
                        </li>
                    @else
                        <li class="btn-box">
                            <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"
                               class="btn btn-outline-light">العربية</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <!--sticky Header-->
        <div class="sticky-header">
            <div class="auto-container">
                <div class="outer-box clearfix">

                    <div class="menu-area pull-left">

                        <nav class="main-menu clearfix">

                            <!--Keep This Empty / Menu will come through Javascript-->
                        </nav>
                    </div>
                    <ul class="menu-right-content pull-right clearfix">

                        @if(app()->getLocale() == 'ar')
                            <li class="btn-box">
                                <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"
                                   class="btn btn-outline-primary mt-2">En</a>
                            </li>
                        @else
                            <li class="btn-box">
                                <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"
                                   class="btn btn-outline-primary mt-2">العربية</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href="/"><img src="{{ asset('public/assets/images/logo-2.png')}}"
                                                            style="width:75px" alt="" title=""></a></div>
            <div class="menu-outer">
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>

        </nav>
    </div>

@include('pages.home')
@include('pages.about')
@include('pages.projects')
@include('pages.partners')
    @include('pages.contact')

    <footer class="main-footer mt-5 bg-color-4">
        <div class="footer-bottom ">
            <div class="auto-container">
                <div class="row">
                    <div class="col-md-4">
                        <figure class="logo"><a href="/"><img src="{{ asset('public/assets/images/logo-2.png')}}"
                                                              style="width:75px" alt=""></a></figure>

                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="copyright">
                            <p>@lang('site.copy')
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        <div class="social-buttons">
                            <a href="{{ $settings->facebook }}"
                               class="social-buttons__button social-button social-button--facebook"
                               aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="{{ $settings->twitter }}"
                               class="social-buttons__button social-button social-button--linkedin"
                               aria-label="LinkedIn">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="{{ $settings->linkedin }}"
                               class="social-buttons__button social-button social-button--snapchat"
                               aria-label="SnapChat">
                                <i class="fab fa-snapchat-ghost"></i>
                            </a>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </footer>
    <!-- main-footer end -->


    <!--Scroll to top-->
    <button class="scroll-top scroll-to-target" data-target="html">
        <span class="fal fa-angle-up"></span>
    </button>
</div>


<script src="{{ asset('public/assets/js/jquery.js')}}"></script>
<script src="{{ asset('public/assets/js/popper.min.js')}}"></script>
<script src="{{ asset('public/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('public/assets/js/owl.js')}}"></script>
<script src="{{ asset('public/assets/js/wow.js')}}"></script>
<script src="{{ asset('public/assets/js/jquery.fancybox.js')}}"></script>
<script src="{{ asset('public/assets/js/appear.js')}}"></script>
<script src="{{ asset('public/assets/js/isotope.js')}}"></script>
<script src="{{ asset('public/assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{ asset('public/assets/js/nav-tool.js')}}"></script>
<script src="{{ asset('public/assets/js/jquery.paroller.min.js')}}"></script>
<script src="{{ asset('public/assets/js/pagenav.js')}}"></script>
@if(app()->getLocale() == 'ar')
    <script src="{{ asset('public/assets/js/ar_script.js')}}?v=0"></script>
@else
    <script src="{{ asset('public/assets/js/script.js')}}?v=0"></script>
@endif
<style>
.content-box span{
    font-size: 30px;
}
.outer-box>div:nth-child(2) {
    flex: 0 1 80%;
}
.arrow-right,
.arrow-left,
.long-arrow-right,
.long-arrow-left{
    display: block;
    margin: 30px auto;
    width: 25px;
    height: 25px;
    border-top: 4px solid #fff;
    border-left: 4px solid #fff;
}
.arrow-right,
.long-arrow-right{
    transform: rotate(135deg);
}

.arrow-left{
    transform: rotate(-45deg);
}
</style>
<script>
    $(".contact").submit(function (e) {
        e.preventDefault();
        btn = $(this).children('btn');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var actionurl = e.currentTarget.action;
        $.ajax({
            type: 'POST',
            url: actionurl,
            data: new FormData(this),
            dataType: 'text',
            processData: false,
            contentType: false,
            beforeSend: function(){
                $('#value').show();
            },
            complete: function(){
                $('button').removeAttr('disabled');
            },
            success: function (data) {
                result = jQuery.parseJSON(data);
                if (result.success) {
                    alert('{{ __('site.email_sent_successfully') }}');
                    $(".contact").trigger('reset');
                    $('.form-group').removeClass('has-error');
                    $('.help-block').text('');
                }else {
                    var errors = result.errors;
                    var html_errors = '<ul>';

                    $('#error').html('');
                    $.each(errors, function (key, val) {
                        key = key.replace('[','');
                        key = key.replace(']','');
                        key = key.replace('.','');
                        $("#" + key + "_error").text(val[0]);
                        $("#" + key + "_div").addClass('has-error');
                        html_errors += "<li>" + val[0] + "<\li>";
                    });
                    html_errors += '</ul>';
                    console.log(html_errors);
                    $('.html_error').html('');
                    $('.html_error').removeClass('text-danger');
                    $('#result_error').html(html_errors);
                    $('.help-block').css('color','red');

                }
            },
            error: function (data) {

            }
        });
    });
</script>
</body><!-- End of .page_wrapper -->
</html>
