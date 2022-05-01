
<section class="research-section funfact-style-two" id="why_us">

    <div class="auto-container">
        <div class="row mb-5">
            <div class="col-md-12">
                    <h6 style="color:#0082d666; font-size: 24px;
    line-height: 40px;
    font-weight: 600;">@lang('site.why_us_sub')</h6>
            </div>
            <div class="col-md-6">
                <div class="sec-title">
                    <h2 style="color:#476996">@lang('site.why_us_short')</h2>
                </div>

            </div>
            <div class="col-md-6">
                <div class="bold-text">
                    <p class="custom-margin tala-p">
                        @lang('site.why_us_desc')
                    </p>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 research-block">
                <div class="research-block-one wow fadeInLeft animated animated" data-wow-delay="00ms"
                     data-wow-duration="1500ms"
                     style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                    <div class="inner-box">
                        <div class="row">
                            @foreach($data['benefits'] as $b)
                                <div class="col-md-6  ">
                                    <div class="sec-title ">
                                        <ul class="list-style-one clearfix">
                                            <li><h6 style="color:#416d9c">{{ $b->getTranslateName(app()->getLocale()) }}</h6>
                                            </li>

                                        </ul>
                                        <div class="bold-text">
                                            <p class="text-dark marg-n-custom" style="font-size: 18px;font-weight: 400;">{{ $b->getTranslateDesc(app()->getLocale()) }}</p>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
