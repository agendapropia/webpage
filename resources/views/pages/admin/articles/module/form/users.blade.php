<div class="form-group-fields">
    <x-admin.forms.form-search-by-autocomplete 
        label="Usuario" 
        fieldName="user_id" 
        fieldPlaceholder="Buscar usuarios" 
        divClass="field-items usersSelect"
        divClassWidth="col-md-4">
    </x-form-search-by-autocomplete>
    <x-admin.forms.form-input-select 
        label="Role" 
        name="article_role_id" 
        required="true"
        fieldWidth="col-md-4 field-items">
    </x-admin.forms.form-input-select>
    <x-admin.forms.form-button-primary action="QueryModalCreateUsers.Send()" buttonClass="btn-sm col-md-3" text="Agregar usuario"></x-form-button-to-accept>
</div>