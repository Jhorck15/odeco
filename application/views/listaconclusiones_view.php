<!-- Basic datatable -->
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">Inspecciones para concluir:</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        		<!-- <li><a data-action="close"></a></li> -->
        	</ul>
    	</div>
	</div>
	<table id="tlistcoclusioens" class="table datatable-basic">
		<thead>
			<tr>
				<th>N°</th>
				<th>Codigo Usuario</th>
				<th>Abonado</th>
				<th>N° Reclamo</th>
				<th>Fecha Inicio</th>
        <th>Fecha Conclusión</th>
        <th>Dias</th>
        <th>Informe Inspección</th>
        <th>Tipo Reclamo</th>
				<th class="text-center">Acciones</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<script type="text/javascript">

// var save_method; //for save method string
var table;
// var base_url = '<?php echo base_url();?>';

$(document).ready(function() {
    table = $('#tlistcoclusioens').DataTable({ 
        "rowCallback": function( row, data, index ) {
                
            var fechareclamo = data[6];
            $node = this.api().row(row).nodes().to$();

                
            if (fechareclamo>10 ) {
                $node.addClass('reclamor');
            } else {
                if (fechareclamo>=5) {
                    $node.addClass('reclamoa');
                } else {$node.addClass('reclamog');}
            }
        },

        "processing":  true, //Feature control the processing indicator.
        // "serverSide"  true, //Feature control DataTables' server-side processing mode.
        "destroy":  true,
        "responsive": true,
        // "order"  [], //Initial no order.
        "language": {
           
            "info" : "Mostrar pagina _START_ de _END_ de _TOTAL_ reclamos",
            "loadingRecords":  "No hay reclamos...",
            "processing" :     "Procesando...",
            "sSearch" :      "Buscar ",
            "ZeroRecords":  "No se encontraron resultados",
            "infoEmpty":  "No hay reclamos",
            "lengthMenu":  "Mostrar _MENU_ registros",
       
        },

        // $fechaactual = date("d-m-Y",strtotime('now'));
        "ajax": {
                url: "<?php echo site_url('listaconclusiones/ajax_list')?>",   
                type: "POST",
             
                error: function (jqXHR, textStatus, errorThrown)
                {
                    // alert('No hay reclamos pendientes...'+textStatus+' '+errorThrown);
                    // alert('Error  '+textStatus+' '+errorThrown);
                }   

        },
        "columnDefs" : [{ 
            "targets" : [ -1 ], //last column
            "orderable" : false, //set not orderable
            "createdCell" : function (td, cellData, rowData, row, col) {
              $(td).css('background-color', 'white');
            }
        }]
    });
});

    function devolver_inspeccioninspector(id){
        // alert(id);
        $('#id_reclamo_error').val(id);
        $('#modal_error_devolver').modal('show'); // show bootstrap modal when complete loaded
    }

    function modificar_seguimiento_reclamo(){
        var id = $('#id_reclamo_error').val();
        // alert(id);
        $('#modal_error_devolver').modal('hide');
        $.ajax({
            url: '<?php echo base_url("listaconclusiones/actualizar_inspeccion_error") ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {eso: id, estado: 2},
        })
        .done(function() {
            console.log("Se devolvio con éxito");
            window.location.href = '<?php echo base_url("listaconclusiones/") ?>';
            reload_table();

        })
        .fail(function() {
            console.log("No se guardo");
        });
    }

    function reload_table(){
        table.ajax.reload(null,false); //reload datatable ajax 
    }

    function terminar_reclamo(id){
        $('#id_reclamo_confirmar').val(id);
        $('#modal_confirmar').modal('show'); // show bootstrap modal when complete loaded
    }

    function guardar_terminar(){
        var id = $('#id_reclamo_confirmar').val();
        $('#modal_confirmar').modal('hide');
        $.ajax({
            url: '<?php echo base_url("listaconclusiones/concluir") ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {id_reclamo: id, estado: 5},
        })
        .done(function() {
            console.log("Se devolvio con éxito");
            window.location.href = '<?php echo base_url("conclusion/") ?>';
            reload_table();
        })
        .fail(function() {
            console.log("No se guardo");
        });
    }


</script>


<div class="modal fade" id="modal_error_devolver" role="dialog">
    <div class="modal-dialog">
    <div class="sweet-alert showSweetAlert visible" data-custom-class="" data-has-cancel-button="true" data-has-confirm-button="true" data-allow-outside-click="false" data-has-done-function="false" data-animation="pop" data-timer="null" style="display: block; margin-top: -5px;"><div class="sa-icon sa-error animateErrorIcon" style="display: block;">
      <span class="sa-x-mark animateXMark">
        <span class="sa-line sa-left"></span>
        <span class="sa-line sa-right"></span>
      </span>
    </div><div class="sa-icon sa-warning" style="display: none;">
      <span class="sa-body"></span>
      <span class="sa-dot"></span>
    </div><div class="sa-icon sa-info" style="display: none;"></div><div class="sa-icon sa-success" style="display: none;">
      <span class="sa-line sa-tip"></span>
      <span class="sa-line sa-long"></span>

      <div class="sa-placeholder"></div>
      <div class="sa-fix"></div>
    </div><div class="sa-icon sa-custom" style="display: none;"></div><h2>Devolver la inspeccion</h2>
        <!-- <p style="display: block;">De enviar el reclamo!</p> -->
        <input type="text" id="id_reclamo_error">
        
        <fieldset>
          <input tabindex="3" placeholder="" type="text">
          <div class="sa-input-error"></div>
        </fieldset><div class="sa-error-container">
          <div class="icon">!</div>
          <p>Not valid!</p>
        </div><div class="sa-button-container">
          <button class="cancel" tabindex="2" style="display: inline-block; box-shadow: none;" data-dismiss="modal">Cancelar</button>
          <div class="sa-confirm-button-container">
            <button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(255, 112, 67); box-shadow: rgba(255, 112, 67, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;" onclick="modificar_seguimiento_reclamo()">Devolver</button><div class="la-ball-fall">
              <div></div>
              <div></div>
              <div></div>
            </div>
          </div>
        </div>
    </div>
   </div>
</div>


<!-- modal conifirmar terminar -->
<div class="modal fade" id="modal_confirmar" role="dialog">
    <div class="modal-dialog">
    <div class="sweet-alert showSweetAlert visible" data-custom-class="" data-has-cancel-button="true" data-has-confirm-button="true" data-allow-outside-click="false" data-has-done-function="false" data-animation="pop" data-timer="null" style="display: block; margin-top: -5px;"><div class="sa-icon sa-error" style="display: none;">
          <span class="sa-x-mark">
            <span class="sa-line sa-left"></span>
            <span class="sa-line sa-right"></span>
          </span>
        </div><div class="sa-icon sa-warning pulseWarning" style="display: block;">
          <span class="sa-body pulseWarningIns"></span>
          <span class="sa-dot pulseWarningIns"></span>
        </div><div class="sa-icon sa-info" style="display: none;"></div><div class="sa-icon sa-success" style="display: none;">
          <span class="sa-line sa-tip"></span>
          <span class="sa-line sa-long"></span>

          <div class="sa-placeholder"></div>
          <div class="sa-fix"></div>
        </div><div class="sa-icon sa-custom" style="display: none;"></div><h2>¿Esta seguro de Concluir?</h2>
        <!-- <p style="display: block;">De enviar el reclamo!</p> -->
        <input type="text" id="id_reclamo_confirmar">
        
        <fieldset>
          <input tabindex="3" placeholder="" type="text">
          <div class="sa-input-error"></div>
        </fieldset><div class="sa-error-container">
          <div class="icon">!</div>
          <p>Not valid!</p>
        </div><div class="sa-button-container">
          <button class="cancel" tabindex="2" style="display: inline-block; box-shadow: none;" data-dismiss="modal">Cancelar</button>
          <div class="sa-confirm-button-container">
            <button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(255, 112, 67); box-shadow: rgba(255, 112, 67, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;" onclick="guardar_terminar()">Concluir</button><div class="la-ball-fall">
              <div></div>
              <div></div>
              <div></div>
            </div>
          </div>
        </div>
    </div>
   </div>
</div>