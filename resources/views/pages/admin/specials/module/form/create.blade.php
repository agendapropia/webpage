<div class="row">
    <x-admin.forms.form-input-text 
        label="Nombre" 
        name="name" 
        placeholder="Ingrese el nombre" 
        required="true"
        description="Este campo indica el nombre interno del especial.">
    </x-admin.forms.form-input-text>
    <x-admin.forms.form-input-text 
        label="Fecha Publicación" 
        name="publication_date" 
        placeholder="Seleccionar ..." 
        required="true"
        description="Este campo indica la fecha de publicación del especial a mostrar.">
    </x-admin.forms.form-input-text>
    <x-admin.forms.form-input-select 
        label="Template" 
        name="template_id" 
        required="true"
        description="El template indica los estilos personalizados que va a tener el especial.">
    </x-admin.forms.form-input-select>
</div>
<div class="row">
    <x-admin.forms.form-subtitle></x-admin.forms.form-subtitle>
</div>
<div class="row">
    <x-admin.forms.form-search-by-autocomplete divClass="countrySelect" label="Países" fieldName="country_ids" fieldPlaceholder="Buscar país"></x-form-search-by-autocomplete>
    <x-admin.forms.form-search-by-autocomplete divClass="tagsSelect" label="Tags" fieldName="tags_ids" fieldPlaceholder="Buscar tags"></x-form-search-by-autocomplete>
</div>
