<div class="form-group-fields">
    <x-admin.forms.form-search-by-autocomplete 
        label="Medio aliado" 
        fieldName="allied_media_id"
        fieldPlaceholder="Buscar medios aliados" 
        divClass="field-items alliedmediaSelect"
        divClassWidth="col-md-4">
    </x-form-search-by-autocomplete>
    <x-admin.forms.form-input-select 
        label="Role"
        name="special_allied_media_role_id"
        required="true"
        fieldWidth="col-md-4 field-items">
    </x-admin.forms.form-input-select>
    <x-admin.forms.form-button-primary action="QueryModalDataAlliedMediaAction()" buttonClass="btn-sm col-md-3" text="Agregar Medio Aliado"></x-form-button-to-accept>
</div>