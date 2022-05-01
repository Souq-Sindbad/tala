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
    @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
        <div class="col-md-6">
            <div class="form-group" id="{{ $locale }}_short_desc_div">
                @php $short_desc[$locale] = isset($form_data) ? $form_data->getTranslateshort_desc($locale) : ""; @endphp
                <label
                    for="{{ $locale }}_short_desc_input">@lang('site.' . $locale . '.short_desc')</label>
                <input name="{{ $locale }}_short_desc" type="text" value="{{ $short_desc[$locale] }}"
                       class="form-control" id="{{ $locale }}_short_desc_input"
                       placeholder="@lang('site.' . $locale . '.short_desc')">
                <span id="{{ $locale }}_short_desc_error" class="help-block"></span>
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
        <div class="col-md-6">
            <div class="form-group" id="{{ $locale }}_address_div">
                @php $address[$locale] = isset($form_data) ? $form_data->getTranslateaddress($locale) : ""; @endphp
                <label
                    for="{{ $locale }}_address_input">@lang('site.' . $locale . '.address')</label>
                <input name="{{ $locale }}_address" type="text" value="{{ $address[$locale] }}"
                       class="form-control" id="{{ $locale }}_address_input"
                       placeholder="@lang('site.' . $locale . '.address')">
                <span id="{{ $locale }}_address_error" class="help-block"></span>
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
        <div class="col-md-6">
            <div class="form-group" id="{{ $locale }}_description_div">
                @php $description[$locale] = isset($form_data) ? $form_data->getTranslatedescription($locale) : ""; @endphp
                <label
                    for="{{ $locale }}_description_input">@lang('site.' . $locale . '.description')</label>
                <input name="{{ $locale }}_description" type="text" value="{{ $description[$locale] }}"
                       class="form-control" id="{{ $locale }}_description_input"
                       placeholder="@lang('site.' . $locale . '.description')">
                <span id="{{ $locale }}_description_error" class="help-block"></span>
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <div class="checkbox checkbox-primary col-md-7">
                <input id="status" name="status" type="checkbox" data-original-title="" title="" value="1" checked>
                <label for="status">@lang('site.active')</label>
            </div>
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
