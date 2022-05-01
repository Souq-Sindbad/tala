<section class="funfact-style-two" id="statistics">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="sec-title custom-li">
                    <h4>@lang('site.buil_dev')</h4>
                    <h4 class="mt-2">@lang('site.buil_raize')</h4>
                </div>
            </div>

            @foreach($data['statistics'] as $s)
            <div class="col-lg-3  col-md-6 col-sm-12   counter-block" style="margin:auto">
                <div class="counter-block-two ">
                    <div class="inner-box text-center">
                        <div class="count-outer count-box">
                            <span class="count-text " data-speed="1500" data-stop="{{ $s->counter }}">0</span><span>+</span>
                        </div>
                        <h5 style="color:#1B2B58">{{ $s->getTranslateName(app()->getLocale()) }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
