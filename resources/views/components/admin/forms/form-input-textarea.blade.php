<div class="form-group {{ isset($fieldWidth) ? $fieldWidth : 'col-md-6' }} {{ isset($divClass) ? $divClass : '' }}">
    <label class="form-control-label" for="">{{ isset($label) ? $label : 'label' }}</label>
    <span class="is-required">{{ isset($required) && $required ? '*' : '' }}</span>
    <textarea class="form-control {{ isset($textareaClass) ? $textareaClass : '' }}" name="{{ isset($name) ? $name : 'name' }}" placeholder="{{ isset($placeholder) ? $placeholder : '' }}"></textarea>
    <div class="label-error"></div>
</div>
