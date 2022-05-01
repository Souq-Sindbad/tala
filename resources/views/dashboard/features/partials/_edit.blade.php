<input type="hidden" name="id" value="{{ $form_data->id }}">
<div class="row">
    @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
        <div class="col-md-12">
            <div class="form-group" id="{{ $locale }}_name_edit_div">
                @php $name[$locale] = isset($form_data) ? $form_data->getTranslateName($locale) : ""; @endphp
                <label
                    for="{{ $locale }}_name_edit_input">@lang('site.' . $locale . '.name')</label>
                <input name="{{ $locale }}_name" type="text" value="{{ $name[$locale] }}"
                       class="form-control" id="{{ $locale }}_name_edit_input"
                       placeholder="@lang('site.' . $locale . '.name')">
                <span id="{{ $locale }}_name_edit_error" class="help-block"></span>
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <div class="checkbox checkbox-primary col-md-7">
                <input id="status" name="status" type="checkbox" data-original-title="" title="" value="1" {{ $form_data->status == 1 ? 'checked' : '' }}>
                <label for="status">@lang('site.active')</label>
            </div>
        </div>
    </div>
</div>
