<section class="team-section home-5" id="partners">
    <div class="auto-container">
        <div class="sec-title centred">
            <h2 class="text-blue">@lang('site.our_partners')</h2>
        </div>
        <div class="clients owl-nav-none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sec-heading text-center">
                            <h3 class="line" style="font-size:35px;font-weight: 600">@lang('site.company_partners')</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme clients-carousel">
                            @foreach($data['companies'] as $c)
                                <div class="item box">
                                <a href="{{ $c->url }}">
                                    <img alt="{{ $c->getTranslateName(app()->getLocale()) }}" class="client-img"
                                         src="{{ $c->image_path }}" >
                                </a>
                                    <h6 class="text-center" style="font-size: 18px">
                                        {{ $c->getTranslateName(app()->getLocale()) }}
                                    </h6>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clients owl-nav-none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sec-heading text-center">
                            <h3 class="line" style="font-size:35px;font-weight: 600">@lang('site.product_partners')</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme clients-carousel">
                            @foreach($data['products'] as $p)
                                <div class="item box">
                                    <a href="{{ $p->url }}" style="height: 300px; !important;">
                                        <img alt="{{ $p->getTranslateName(app()->getLocale()) }}" class="client-img"
                                             src="{{ $p->image_path }}" >
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
