<button type="button" id="{{ isset($id) ? $id : '' }}" class="btn btn-default btn-close {{ isset($buttonClass) ? $buttonClass : '' }}" data-dismiss="modal">
    {{ isset($text) ? $text : 'button' }}
</button>