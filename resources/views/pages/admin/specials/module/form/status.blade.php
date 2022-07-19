<div class="row">
    <x-admin.forms.form-input-select 
        label="Estado" 
        name="status_id" 
        description="Selecciona el estado al que quiere cambiar."
        required>
            <option value="">Estados</option>
            @foreach ($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
            @endforeach
    </x-admin.forms.form-input-select>
</div>
