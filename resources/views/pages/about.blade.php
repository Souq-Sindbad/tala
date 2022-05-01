<section class="about-style-two" id="about" style="padding-bottom: 0px; !important;">
    <div class="auto-container">
        <div class="row align-items-center clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                <div class="image_block_8">
                    <figure class="image-pad"><img src="{{ asset('public/assets/images/logo1.svg')}}" alt="">
                    </figure>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div class="content_block_1 pad-content">
                    <div class="content-box">
                        <div class="sec-title">
{{--                            <h6>@lang('site.about')</h6>--}}
                            <h2>@lang('site.about')</h2>
                        </div>

                        <div class="bold-text">
                            <p>
                                @lang('site.about_desc')
                            </p>
                        </div>
                        <div class="text text-">
                            <ul class="list-style-one clearfix">
                                @foreach($data['features'] as $f)
                                    <li style="color:#222534">{{ $f->getTranslateName(app()->getLocale()) }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
