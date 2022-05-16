<button type="button" class="btn btn-primary {{ isset($buttonClass) ? $buttonClass : '' }}" onclick="{{ isset($action) ? $action : '' }}" >
    <em class="fa {{ isset($icon) ? $icon : 'fa-save' }}"></em> {{ isset($text) ? $text : 'button' }}
</button>