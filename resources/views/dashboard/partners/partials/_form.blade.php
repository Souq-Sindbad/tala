<div class="row">
    @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
        <div class="col-md-6">
            <div class="form-group" id="{{ $locale }}_name_div">
                @php $name[$locale] = isset($form_data) ? $form_data->getTranslateName($locale) : ""; @endphp
                <label
                    for="{{ $locale }}_name_input">@lang('site.' . $locale . '.name')</label>
                <input name="{{ $locale }}_name" type="text" value="{{ $name[$locale] }}"
                       class="form-control" id="{{ $locale }}_name_input"
                       placeholder="@lang('site.' . $locale . '.name')">
                <span id="{{ $locale }}_name_error" class="help-block"></span>
            </div>
        </div>
    @endforeach
</div>

<div class="row">

    <div class="col-md-6">
        <div class="form-group" id="url">
            <label for="url_input">@lang('site.url')</label>
            <input id="url_input" type="url" name="url" placeholder="@lang('site.url')" class="form-control"
                   value="">
            <span id="url_error" class="help-block"></span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group row">
            <label for="url_input">@lang('site.status')</label>
            <br>
            <div class="checkbox checkbox-primary col-md-7">
                <input id="status" name="status" type="checkbox" data-original-title="" title="" value="1" checked>
                <label for="status">@lang('site.active')</label>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group" id="url_div">
            <label for="type_input">@lang('site.type')</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="company_partners" name="type" value="1">
                        <label for="company_partners" class="custom-control-label">@lang('site.company_partners')</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="product_partners" name="type" value="2">
                        <label for="product_partners" class="custom-control-label">@lang('site.product_partners')</label>
                    </div>
                </div>
            </div>
            <span id="type_error" class="help-block"></span>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="file" name="image" id="image_file" class="image">
        </div>

        <div class="form-group">
            @php $image_path = isset($form_data) ? $form_data->image_path : asset('public/uploads/photo.svg'); @endphp
            <img class="image-preview" width="200" height="200" src="{{ $image_path }}">
        </div>
    </div>
</div>
