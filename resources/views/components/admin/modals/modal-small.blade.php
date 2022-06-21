<div class="modal fade modal-table-gear" id="{{ isset($id) ? $id : 'modal-id'  }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-alert" role="document">
        <div class="modal-content {{ isset($bg_gradient) ? $bg_gradient : ''  }}">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">{{ isset($title) ? $title : 'Modal title'  }}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body padding-modal-small {{ isset($classBody) ? $classBody : $classBody}}">
                {{ $slot }}
            </div>

            <div class="modal-footer {{ isset($classFooter) ? $classFooter : '' }}">
                {{ isset($footer) ? $footer : ''  }}
            </div>

            <x-admin.plugins.overlay></x-admin.plugins.overlay>
        </div>
    </div>
</div>