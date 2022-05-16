<div class="form-group {{ isset($class) ? $class : '' }} {{ isset($fieldWidth) ? $fieldWidth : 'col-md-6' }}">
    <label class="form-control-label" for="">{{ isset($label) ? $label : 'label' }}</label>
    <span class="is-required">{{ isset($required) && $required ? '*' : '' }}</span>
    <select class="form-control form-control-sm {{ isset($fieldClass) ? $fieldClass : '' }}" name="{{ isset($name) ? $name : 'name' }}" data-placeholder="{{ isset($placeholder) ? $placeholder : '' }}" autocomplete="{{ isset($autocomplete) ? $autocomplete : 'off' }}" />
    {{ $slot }}
    </select>
    <div class="label-error"></div>
</div>
