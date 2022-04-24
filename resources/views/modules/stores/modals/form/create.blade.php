<div class="row">
    <x-form-input-select label="Estado" name="store_status_id" placeholder="Selecciona el estado inicial" required="true"></x-form-input-text>
    <x-form-input-select label="Tipo de tiendas" name="store_type_id" placeholder="Selecciona el tipo de tienda" required="true"></x-form-input-text>
    <x-form-input-text label="Nombre" name="name" placeholder="Ingresa el nombre completo" required="true"></x-form-input-text>
    <x-form-input-text label="Nombre corto" name="name_short" placeholder="Ingresa el nombre corto" required="true"></x-form-input-text>
    <x-form-input-textarea label="Detalles" name="details" placeholder="Descripción breve de la tienda" required="true" widthfield="col-md-12"></x-form-input-textarea>
</div>
<hr>
<div class="row">  
    <x-form-input-select label="Ciudad" name="city_id" placeholder="Selecciona la ciudad" required="false" widthfield="col-md-4"></x-form-input-text>
    <x-form-input-text label="Dirección" name="address" placeholder="Dirección de la tienda" required="true" widthfield="col-md-8"></x-form-input-text>
    <x-form-input-text label="Latitud" name="latitude" placeholder="Latitud (GPS)" required="true" widthfield="col-md-3"></x-form-input-text>
    <x-form-input-text label="Longitud" name="longitude" placeholder="Longitud (GPS)" required="true" widthfield="col-md-3"></x-form-input-text>
    <x-form-input-text-group
        label="Número de teléfono"
        name="phone_number"
        placeholder="3134445566"
        required="true"
        selectlabel="Code País"
        selectname="phone_code"
        selectrequired="true">
    </x-form-input-text-group>
</div>
<hr>
<div class="row">  
    <x-form-input-text label="Icono" name="icon" placeholder="Nombre del icono" required="true"></x-form-input-text>
    <x-form-input-text label="Image" name="image" placeholder="Portada" required="true"></x-form-input-text>
</div>
