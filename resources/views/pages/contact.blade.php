<section class="research-section funfact-style-two" id="contact" style="background: #1f2b55">

    <div class="auto-container">
        <div class="row mb-5">
            <div class="col-md-12">
                <h1 style="color:#fff; font-size: 30px;
    line-height: 40px;
    font-weight: 600;">@lang('site.contact')</h1>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-7 col-md-7 col-sm-7 research-block">
                <div class="research-block-one wow fadeInLeft animated animated" data-wow-delay="00ms"
                     data-wow-duration="1500ms"
                     style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                    <div class="inner-box">
                        <form class="contact" method="post" action="{{ route('contact') }}">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="name"
                                           placeholder="@lang('site.name')">
                                    <span class="help-block" id="name_error"></span>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="tel" name="phone"
                                           placeholder="@lang('site.phone')">
                                    <span class="help-block" id="phone_error"></span>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <input class="form-control" type="email" name="email"
                                           placeholder="@lang('site.email')">
                                    <span class="help-block" id="email_error"></span>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <input class="form-control" type="text" name="subject"
                                           placeholder="@lang('site.subject')">
                                    <span class="help-block" id="subject_error"></span>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <textarea rows="5" class="form-control" name="message"
                                              placeholder="@lang('site.message')"></textarea>
                                    <span class="help-block" id="message_error"></span>
                                </div>

                                <div class="col-md-12">
                                    <button class="btn btn-success">
                                        @lang('site.send')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 animated fadeInUp" data-animate="fadeInUp">
                <ul class="contact_info_iconbox ul_li_block mt-5">
                    <li>
                      <span>
                        <i class="far fa-phone"></i>
                      </span>
                        <strong class="text-white">
                            <a class="text-white" dir="ltr"
                               href="tel:{{  $settings->phone }}">{{  $settings->phone }}</a>
                        </strong>
                    </li>
                    <li>
                      <span>
                        <i class="far fa-envelope"></i>
                      </span>
                        <strong class="text-white">
                            <a class="text-white" href="mailto:{{  $settings->email }}">{{  $settings->email }}</a>
                        </strong>
                    </li>
                    <li>
                      <span>
                        <i class="far fa-map-marker-alt"></i>
                      </span>
                        <strong class="text-white">
                            @if(app()->getLocale() == 'en')
                                Riyadh Al-Rabee District, Abu Bakr Al-Siddiq Road - may God be pleased with him <br> Executive Offices - Office No. 8
                            @else
                                الرياض - حي الربيع - طريق أبي بكر الصديق<br>
                                المكاتب التنفيذية – مكتب رقم 8
                            @endif
                        </strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14488.090393188912!2d46.6855959!3d24.7946797!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2efd46e17af74b%3A0x1ae78d38382d1851!2z2KrYp9mE2Kkg2KfZhNi52YLYp9ix2YrYqQ!5e0!3m2!1sar!2s!4v1650028155036!5m2!1sar!2s"
        width="100%" height="300px" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>




