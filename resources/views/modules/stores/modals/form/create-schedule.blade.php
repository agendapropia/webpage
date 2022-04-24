<div class="form-group-fields">
    <x-form-input-select label="Día" name="day_id" placeholder="Selecciona el día" required="true" fieldWidth="col-md-4 field-items"></x-form-input-text>
    <x-form-input-text label="Hora inicio" name="start_time" placeholder="08:00:00" required="true" fieldWidth="col-md-4 field-items"></x-form-input-text>
    <x-form-input-text label="Hora final" name="end_time" placeholder="18:00:00" required="true" fieldWidth="col-md-4 field-items"></x-form-input-text>
    <x-form-button-primary action="CreateStoreSchedule.Send()" buttonClass="btn-sm" text="Agregar Horario"></x-form-button-to-accept>
</div>