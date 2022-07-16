<div class="form-group form-group-search-autocomplete {{ isset($divClass) ? $divClass : '' }} {{ isset($divClassWidth) ? $divClassWidth : 'col-md-6' }}" id="{{ $divClass }}">
    @if (isset($label))
        <label class="form-control-label" for="">{{ $label }}</label>
    @endif
    @if (!isset($basic))
        <span class="is-required">{{ isset($required) && $required ? '*' : '' }}</span>
    @endif
    <input type="hidden" class="input-hidden" name="{{ isset($fieldName) ? $fieldName : '' }}">
    <div class="group-field ">
        <input type="text" class="form-control input-search form-control-sm{{ isset($fieldClass) ? $fieldClass : '' }}" placeholder="{{ isset($fieldPlaceholder) ? $fieldPlaceholder : '' }}" autocomplete="{{ isset($fieldAutocomplete) ? $fieldAutocomplete : 'off' }}" />
        <em class="icon-loading fa fa-search"></em>
        <ul class="items"></ul>
        <div class="selected-items"></div>
    </div>
    @if (!isset($basic))
        <div class="label-error"></div>
    @endif
</div>
