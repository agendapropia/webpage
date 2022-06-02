<x-admin.modals.modal id="modal-utils-imagen-selections">
    <x-slot name="title"><em class="fa fa-image mr-2"></em>Imágenes</x-slot>

    <x-slot name="content">    
    <div class="input_public" id="fieldPublicTicket" style="border-bottom:0px; margin-bottom: -15px">
        <div class="box-body" style="margin-left: -20px; margin-right: -20px; padding: 10px 0px;">
            
            <div id="fieldFiles" style="margin-top:-15px;">
                <div class="col-md-12">
                    
                    <ul id="photos_view" class="sortable result">
                    </ul>
    
                    <div id="photos_error">
                        <input id="file" name="file" type="file" multiple style="display: none;">
                    </div>
            
                    <div class="span_fotos">
                        * Puedes arrastrar y soltar para organizar las fotos.<br>
                        * Los formatos aceptados son .jpg, .gif y .png.<br>
                        * El tamaño máximo permitido para los archivos es 10 MB.
                    </div>
    
                </div>
    
                
            </div>
        
        </div>
            
        <div class="box-footer text-right" style="margin-left: -15px; margin-right: -15px;">
            <button class="btn btn-success pull-left btn-upload" style="width:140px;"> Subir Archivos</button>
            <div class="loading pull-left">
                <img src="{{ asset('img/app/cargador.GIF') }}">
            </div>

            <button class="btn btn-primary">Guardar</button>
        </div>
    
        
        <div class="hide">
  <div id="template-file" class="col-md-12 padding-file">
      <div class="files_list">
          <div class="logo logo-min" style="">     
          </div>
          <div class="cont cont-min"> 
            <div class="text">
                <div class="name"></div>
            </div><br>
            <div class="prog">
                <div class="progress active">
                    <div class="progress-bar" style="width:70%"></div>
                </div>
            </div>
          </div>
          <div class="ico">
              <div class="btn-group">
                <div class="delete btn_delete" data-id="">
                  <i class="fa fa-remove"></i>
                </div>               
              </div>
          </div>
          <div class="ico download" onclick="" title="Descargar">
              <div class="btn-group">
                <div class="btn_delete" data-id="">
                  <i class="fa fa-download"></i>
                </div>               
              </div>
          </div>
          <div class="error error-min">
              <button class="btn btn-success btn-xs preload"> <i class="fa fa-cloud-upload"></i> Subir</button>
              <button class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i> Eliminar</button>
              <div>Oops! ocurrio un error.</div>
          </div>
      </div>
  </div>
</div>
    </div>
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
    </x-slot>
</x-admin.modals.modal>
