<div class="row-sm">
    <div class="col-md-5">
        <x-admin.forms.form-input-text
            label="Titulo" 
            name="title" 
            placeholder="Titulo"
            fieldWidth>
        </x-admin.forms.form-input-text>
        <x-admin.forms.form-input-text 
            label="Subtitulo" 
            name="subtitle" 
            placeholder="Subtitulo"
            fieldWidth>
        </x-admin.forms.form-input-text>
        <x-admin.forms.form-input-select 
            label="Estado" 
            name="status_id" 
            required="true"
            description="Estado del contenido." fieldWidth>
            <option value="1">Publicado</option>
            <option value="2">Editando</option>
        </x-admin.forms.form-input-select>
    </div>
    <div class="col-md-7">
        <x-admin.forms.form-input-textarea 
            label="Resumen" 
            name="summary"
            placeholder="Descripción"
            textareaClass="textarea-min-height"
            fieldWidth>
        </x-admin.forms.form-input-textarea>
    </div>
</div>