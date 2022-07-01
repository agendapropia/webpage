<div class="form-row {{ isset($widthfield) ? $widthfield : 'col-md-6' }}">
    <div class="col-5">
        <label class="form-control-label" for="">{{ isset($selectlabel) ? $selectlabel : 'label' }}</label>
        <span class="is-required">{{ isset($selectrequired) && $selectrequired ? '*' : '' }}</span>
        <select class="form-control form-control-sm {{ isset($fieldClass) ? $fieldClass : '' }}" name="{{ isset($selectname) ? $selectname : 'name' }}"/>
        </select>
        <small id="emailHelp" class="form-text text-muted">
            {{ isset($description) ? $description : '' }}
            <div class="label-error"></div>
        </small>
    </div>
    <div class="col-7">
        <label class="form-control-label" for="">{{ isset($label) ? $label : 'label' }}</label>
        <span class="is-required">{{ isset($required) && $required ? '*' : '' }}</span>
        <input type="text" class="form-control form-control-sm {{ isset($fieldClass) ? $fieldClass : '' }}" name="{{ isset($name) ? $name : 'name' }}" placeholder="{{ isset($placeholder) ? $placeholder : '' }}" autocomplete="{{ isset($autocomplete) ? $autocomplete : 'off' }}" />
        <small id="emailHelp" class="form-text text-muted">
            {{ isset($description) ? $description : '' }}
            <div class="label-error"></div>
        </small>
    </div>
</div>
