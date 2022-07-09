<x-admin.modals.modal-small id="modal-change-of-password" title="Cambio de contraseña" classBody="center-body" classFooter="center-footer">
    <div class="error-change-password"></div>
    <x-admin.forms.form name="form-change-password-user" id="form-change-password-user" action="/auth/change-password" method="POST">
        <div class="row display-inline-block" style="width:100%">
            <x-admin.forms.form-input-password name="old_password" label="Contraseña actual" classDiv="display-inline-block"></x-admin.forms.form-input-text>
        </div>
        <div class="row display-inline-block" style="width:100%">
            <x-admin.forms.form-input-password name="password" label="Nueva contraseña" classDiv="display-inline-block"></x-admin.forms.form-input-text>
        </div>
        <div class="row display-inline-block" style="width:100%">
            <x-admin.forms.form-input-password name="password_confirmation" label="Repetir contraseña nueva" classDiv="display-inline-block"></x-admin.forms.form-input-text>
        </div>
    </x-admin.forms.form>

    <x.slot name="footer">
        <x-admin.forms.form-button-primary data-dismiss="modal" buttonClass="button-send-password" text="Actualizar constraseña"></x-admin.forms.form-button-to-accept>
    </x.slot>
</x-admin.modals.modal-small>