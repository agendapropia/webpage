<div class="{{ isset($elementBasic) ? '' : 'form-group' }} {{ isset($class) ? $class : '' }} {{ isset($fieldWidth) ? $fieldWidth : 'col-md-6' }}">
    <label class="form-control-label">{{ isset($label) ? $label : 'label' }}</label>
    @if (!isset($elementBasic))
        <span class="is-required">{{ isset($required) && $required ? '*' : '' }}</span>
    @endif

    <select 
        class="form-control form-control-sm {{ isset($fieldClass) ? $fieldClass : '' }}"
        name="{{ isset($name) ? $name : 'name' }}"
        data-placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
        autocomplete="{{ isset($autocomplete) ? $autocomplete : 'off' }}">
        {{ $slot }}
    </select>
    
    @if (!isset($elementBasic))
        <small class="form-text text-muted">
            {{ isset($description) ? $description : '' }}
            <div class="label-error"></div>
        </small>
    @endif
</div>
