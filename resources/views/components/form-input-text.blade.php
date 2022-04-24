<div class="form-group {{ isset($fieldWidth) ? $fieldWidth : 'col-md-6' }}">
    <label class="form-control-label" for="">{{ isset($label) ? $label : 'label' }}</label>
    <span class="is-required">{{ isset($required) && $required ? '*' : '' }}</span>
    <input type="text" class="form-control {{ isset($fieldClass) ? $fieldClass : 'form-control-sm' }}" name="{{ isset($name) ? $name : 'name' }}" placeholder="{{ isset($placeholder) ? $placeholder : '' }}" autocomplete="{{ isset($autocomplete) ? $autocomplete : 'off' }}" />
    <div class="label-error"></div>
</div>
