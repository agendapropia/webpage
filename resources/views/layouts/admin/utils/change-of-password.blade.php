<x-modal-small id="modal-change-of-password" title="Cambio de contraseña" classBody="center-body" classFooter="center-footer">
    <div class="error-change-password"></div>
    <x-form name="form-change-password-user" id="form-change-password-user" action="/auth/change-password" method="POST">
        <div class="row display-inline-block" style="width:100%">
            <x-form-input-password name="old_password" label="Contraseña actual" classDiv="display-inline-block"></x-form-input-text>
        </div>
        <div class="row display-inline-block" style="width:100%">
            <x-form-input-password name="password" label="Nueva contraseña" classDiv="display-inline-block"></x-form-input-text>
        </div>
        <div class="row display-inline-block" style="width:100%">
            <x-form-input-password name="password_confirmation" label="Repetir contraseña nueva" classDiv="display-inline-block"></x-form-input-text>
        </div>
    </x-form>
    <x-slot name="footer">
        <x-form-button-primary data-dismiss="modal" buttonClass="button-send-password" text="Actualizar constraseña"></x-form-button-to-accept>
    </x-slot>
</x-modal-small>