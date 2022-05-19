<div class="form-group {{ isset($widthfield) ? $widthfield : 'col-md-6' }}">
    <label class="form-control-label" for="">{{ isset($label) ? $label : 'label' }}</label>
    <span class="is-required">{{ isset($required) && $required ? '*' : '' }}</span>
    <input type="email" class="form-control form-control-sm {{ isset($fieldClass) ? $fieldClass : '' }}" name="{{ isset($name) ? $name : 'name' }}" placeholder="{{ isset($placeholder) ? $placeholder : '' }}" autocomplete="{{ isset($autocomplete) ? $autocomplete : 'off' }}" />
    <small id="emailHelp" class="form-text text-muted">
        {{ isset($description) ? $description : '' }}
        <div class="label-error"></div>
    </small>
</div>
