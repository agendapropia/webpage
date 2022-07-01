<div class="form-group form-group-search-autocomplete {{ isset($divClass) ? $divClass : '' }} {{ isset($divClassWidth) ? $divClassWidth : 'col-md-6' }}" id="{{ $divClass }}">
    <label class="form-control-label" for="">{{ isset($label) ? $label : 'label' }}</label>
    <span class="is-required">{{ isset($required) && $required ? '*' : '' }}</span>
    <input type="hidden" class="input-hidden" name="{{ isset($fieldName) ? $fieldName : '' }}">
    <div class="group-field ">
        <input type="text" class="form-control input-search form-control-sm{{ isset($fieldClass) ? $fieldClass : '' }}" placeholder="{{ isset($fieldPlaceholder) ? $fieldPlaceholder : '' }}" autocomplete="{{ isset($fieldAutocomplete) ? $fieldAutocomplete : 'off' }}" />
        <em class="icon-loading fa fa-search"></em>
        <ul class="items"></ul>
        <div class="selected-items"></div>
    </div>
    <div class="label-error"></div>
</div>
