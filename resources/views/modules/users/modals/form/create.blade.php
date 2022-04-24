<div class="row">
    <x-form-input-text label="Nombres" name="first_name" placeholder="Ingresa los nombres" required="true"></x-form-input-text>
    <x-form-input-text label="Apellidos" name="last_name" placeholder="Ingresa los apellidos" required="true"></x-form-input-text>
    <x-form-input-select label="Sexo" name="gender_id" placeholder="Selecciona un genero" required="true"></x-form-input-text>
    <x-form-input-email label="Idioma (es/en)" name="location" placeholder="Ingresa el Idioma" required="true"></x-form-input-text>    
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
