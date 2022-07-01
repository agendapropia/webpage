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