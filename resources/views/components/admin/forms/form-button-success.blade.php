<button type="button" id="{{ isset($id) ? $id : '' }}" class="btn btn-success {{ isset($buttonClass) ? $buttonClass : '' }}" onclick="{{ isset($action) ? $action : '' }}" >
    <em class="fa {{ isset($icon) ? $icon : 'fa-save' }}"></em> {{ isset($text) ? $text : 'button' }}
</button>