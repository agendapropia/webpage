<button type="button" class="btn btn-default {{ isset($buttonClass) ? $buttonClass : '' }}" onclick="{{ isset($action) ? $action : '' }}" >
    <em class="fa {{ isset($icon) ? $icon : 'fa-angle-left' }}"></em> {{ isset($text) ? $text : 'button' }}
</button>