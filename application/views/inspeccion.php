<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">Lista de Inspecciones</h5>
		<button class="btn btn-success" onclick=""><i class="glyphicon glyphicon-plus"></i> Añadir Inspeccion</button>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        		<!-- <li><a data-action="close"></a></li> -->
        	</ul>
    	</div>
    	
	</div>
	<table class="table datatable-basic table-bordered table-striped table-hover" id="t_reclamo">
		<thead class="listarra listarrac">
			<tr >
				<td>Nro.</td>
				<td>Cod. Usuario</td>
				<td>Nombre</td>
				<td>Nro. Reclamo</td>
				<td>Fecha Reclamo</td>
				<td>Fecha Respuesta</td>
				<td>Dias</td>
				<td>Motivo</td>
				<td>Tipo de Visita</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody class="listarr">
		</tbody>
	</table>
</div>

<script type="text/javascript">
	var save_method; //for save method string
	var table;
		 
	$(document).ready(function() {

	    //datatables


	   table = $('#t_reclamo').DataTable({ 
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
 			
		//        // "paging": false,
	//        // "searching": false,
	        // "retrieve": true,
	        "processing": true, //Feature control the processing indicator.
	        // "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "destroy" : true,
	        // "order": [], //Initial no order.

	
			"olanguage": {
	            // "slengthMenu": "Mostrar _MENU_ registros por pagina",
	            // "zeroRecords": "Nothing found - sorry",
	            "sinfo": "Mostrar pagina _START_ de _END_ de _TOTAL_ reclamos",
	            "sLoadingRecords": "Cargando...",
	            "loadingRecords": "Por favor espere - cargando...",
	            // "sinfoEmpty": "No hay reclamos",
       		},
	
			// $fechaactual = date("d-m-Y",strtotime('now'));

			"ajax":{
		            url: "<?php echo site_url('cinspeccion/lista')?>",	
		            type: "POST",
		            // dataSrc : "", 	
		            // beforeSend: function () {
              //           $("#resultado").html("Procesando, espere por favor...");
              //   	}, 
		            error: function (jqXHR, textStatus, errorThrown)
			        {
			            alert('No hay reclamos pendientes');
			        }   

		// 	        if ( ! lang.sLoadingRecords && zeroRecords &&
		// 	defaults.sLoadingRecords === "Cargando..." )
		// {
		// 	_fnMap( lang, lang, 'sZeroRecords', 'sLoadingRecords' );
		// }        	          
	        },
			// 
	        

	//         //Set column definition initialisation properties.
	        "columnDefs": [
	        { 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	          	"createdCell": function (td, cellData, rowData, row, col) {
			      // if ( cellData >9 ) {
			      //   $(td).css('color', 'red')
			      // } else if ( cellData >5 ){
			      // 	  $(td).css('color', 'yellow')}
			      // 	  else{
			      // 	  	$(td).css('color', 'green')
			      // 	  }
			      $(td).css('background-color', 'white');
			    }
	        }
	        ],
			
	    });

	    // //datepicker
	    // $('.datepicker').datepicker({
	    //     autoclose: true,
	    //     format: "yyyy-mm-dd",
	    //     todayHighlight: true,
	    //     orientation: "top auto",
	    //     todayBtn: true,
	    //     todayHighlight: true,  
	    // });

	    // //set input/textarea/select event when change value, remove class error and remove text help block 
	    // $("input").change(function(){
	    //     $(this).parent().parent().removeClass('has-error');
	    //     $(this).next().empty();
	    // });

	    // $("textarea").change(function(){
	    //     $(this).parent().parent().removeClass('has-error');
	    //     $(this).next().empty();
	    // });

	    // $("select").change(function(){
	    //     $(this).parent().parent().removeClass('has-error');
	    //     $(this).next().empty();
	    // });

	});

	function errordevolverformuno(id)
	{
		$('#id_reclamo_error').val(id);
		$('#modal_error_devolver').modal('show');
	}

	function modificar_seguimiento_reclamo(){
		var id = $('#id_reclamo_error').val();
		$('#modal_error_devolver').modal('hide');
		$.ajax({
			url: '<?php echo base_url("cinspeccion/actualizar_inspeccion_error") ?>',
			type: 'POST',
			dataType: 'JSON',
			data: {id_reclamo: id, estado: 1},
		})
		.done(function() {
			console.log("Se devolvio con éxito");
			// window.location.href = '<?php //echo base_url("form_inspecciontres/") ?>';
			reload_table();

		})
		.fail(function() {
			console.log("No se guardo");
		});
	}

	function concluirinspeccionformuno(id)
	{
		// alert (id);
		$('#id_reclamo_conf').val(id);
		$('#modal_confirmar').modal('show'); // show bootstrap modal when complete loaded
	}

	function concluirinspeccioncuatro(id)
	{
		// alert (id);
		$('#id_reclamo_conf').val(id);
		$('#modal_confirmarcuatro').modal('show'); // show bootstrap modal when complete loaded
	}

	function concluirinspeccioncinco(id)
	{
		// alert (id);
		$('#id_reclamo_conf').val(id);
		$('#modal_confirmarcinco').modal('show'); // show bootstrap modal when complete loaded
	}

	function guardar(){

		var id = $('#id_reclamo_conf').val();
		$('#modal_confirmar').modal('hide');
		$.ajax({
			url: '<?php echo base_url("reclamo/actualizar_inspeccion") ?>',
			type: 'POST',
			dataType: 'JSON',
			data: {id: id, estado: 2},
		})
		.done(function() {
			console.log("Se guardo con éxito");
			window.location.href = '<?php echo base_url("form_inspeccion/") ?>';
		})
		.fail(function() {
			console.log("No se guardo");
		});
	}

	function guardar_cuatro(){

		var id = $('#id_reclamo_conf').val();
		// alert(id);
		$('#modal_confirmar').modal('hide');
		$.ajax({
			url: '<?php echo base_url("cinspeccion/actualizar_inspeccion") ?>',
			type: 'POST',
			dataType: 'JSON',
			data: {id: id, estado: 2},
		})
		.done(function() {
			console.log("Se guardo con éxito");
			window.location.href = '<?php echo base_url("form_ins_tecnica/") ?>';
		})
		.fail(function() {
			console.log("No se guardo");
		});
	}

	function guardar_cinco(){

		var id = $('#id_reclamo_conf').val();
		// alert(id);
		$('#modal_confirmar').modal('hide');
		$.ajax({
			url: '<?php echo base_url("cinspeccion/actualizar_inspeccion") ?>',
			type: 'POST',
			dataType: 'JSON',
			data: {id: id, estado: 2},
		})
		.done(function() {
			console.log("Se guardo con éxito");
			window.location.href = '<?php echo base_url("form_ins_tecnicados/") ?>';
		})
		.fail(function() {
			console.log("No se guardo");
		});
	}
	function inspeccionform(){

	}


	$.get('<?php echo base_url('cinspeccion/datos_user') ?>', function(data) {
		// alert(data);
		var fr = $.parseJSON(data);
		
			$('#nomuser').text(fr[0]['nombres']+' '+fr[0]['apellidos']);
			$('#nom_user').text(fr[0]['nombres']+' '+fr[0]['apellidos']);
			$('#nom_cargo').text(fr[0]['detallecargo']);
			
	});

</script>


<div class="modal fade" id="modal_inspector" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" bgcolor="green">Formulario Persona</h3>
            </div>
            <div class="modal-body form">
                <form id="form_inspector">
                	<input type="text"  name="id_reclamo_confirmacion" id="id_reclamo_confirmacion"> 
				    <div class="panel-body">
				    	<div class="row">
				    		<div class="col-md-4">
				    			<div class="form-group">
									<label>Fecha reclamo: </label>
				                	<input type="text" class="form-control" name="fechareclamo" placeholder="99/99/9999" cols="4" readonly="true">
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Abonado: </label>
				                	<input type="text" class="form-control " name="nombres" placeholder="99/99/9999" readonly="true">
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Apellidos: </label>
				                	<input type="text" class="form-control " name="apellidos" placeholder="99/99/9999" readonly="true" >
								</div>
							</div>
						</div>
						<div class="row">
				    		<div class="col-md-4">
				    			<div class="form-group">
									<label>Reclamo: </label>
				                	<!-- <input type="text" name="motivo" placeholder="99/99/9999"> -->
				                	<textarea name="motivo" id="motivo" cols="67" rows="5" class="bg-success" readonly="true"></textarea>
								</div>
							</div>
							
						</div>
						
						<div class="row">
							<div class="text-center">
								<!-- <button type="submit" id="btnSave" onclick="save()" class="btn bg-teal-400">Guardar <i class="icon-arrow-right14 position-right"></i></button> -->
								<select name="listainsp" id="listainsp">
					               <?php   	                       
										foreach($listainsp as $cargar){
										echo '<option name="listaselec" value="'.$cargar->id_funcionario.'">'.$cargar->nombres.' '.$cargar->apellidos.'</option>';
					                	}
				                	?>
				                </select>
							</div>
 							
						</div>
				    </div>
				</form>
				<!-- <button type="button" class="btn btn-default btn-sm" id="pnotify-confirm">Launch <i class="icon-play3 position-right"></i></button> -->
            </div>
            <div class="modal-footer">
                <!-- <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button> -->
                <button type="submit" id="btnSave" onclick="confirmar()" class="btn bg-teal-400">Guardar <i class="icon-arrow-right14 position-right"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
	    </div><div class="sa-icon sa-custom" style="display: none;"></div><h2>¿Está seguro de ir a inspeccionar?</h2>
	    <!-- <p style="display: block;">De enviar el reclamo!</p> -->
	    <input type="text" id="id_reclamo_conf">
	    
	    <fieldset>
	      <input tabindex="3" placeholder="" type="text">
	      <div class="sa-input-error"></div>
	    </fieldset><div class="sa-error-container">
	      <div class="icon">!</div>
	      <p>Not valid!</p>
	    </div><div class="sa-button-container">
	      <button class="cancel" tabindex="2" style="display: inline-block; box-shadow: none;" data-dismiss="modal">Cancelar</button>
	      <div class="sa-confirm-button-container">
	        <button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(255, 112, 67); box-shadow: rgba(255, 112, 67, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;" onclick="guardar()">Ir a inspeccion</button><div class="la-ball-fall">
	          <div></div>
	          <div></div>
	          <div></div>
	        </div>
	      </div>
	    </div>
	</div>
   </div>
</div>

<div class="modal fade" id="modal_confirmarcuatro" role="dialog">
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
	    </div><div class="sa-icon sa-custom" style="display: none;"></div><h2>¿Está seguro de ir a inspeccionar?</h2>
	    <!-- <p style="display: block;">De enviar el reclamo!</p> -->
	    <input type="text" id="id_reclamo_conf">
	    
	    <fieldset>
	      <input tabindex="3" placeholder="" type="text">
	      <div class="sa-input-error"></div>
	    </fieldset><div class="sa-error-container">
	      <div class="icon">!</div>
	      <p>Not valid!</p>
	    </div><div class="sa-button-container">
	      <button class="cancel" tabindex="2" style="display: inline-block; box-shadow: none;" data-dismiss="modal">Cancelar</button>
	      <div class="sa-confirm-button-container">
	        <button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(255, 112, 67); box-shadow: rgba(255, 112, 67, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;" onclick="guardar_cuatro()">Ir a inspeccion</button><div class="la-ball-fall">
	          <div></div>
	          <div></div>
	          <div></div>
	        </div>
	      </div>
	    </div>
	</div>
   </div>
</div>

<div class="modal fade" id="modal_confirmarcinco" role="dialog">
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
	    </div><div class="sa-icon sa-custom" style="display: none;"></div><h2>¿Está seguro de ir a inspeccionar?</h2>
	    <!-- <p style="display: block;">De enviar el reclamo!</p> -->
	    <input type="text" id="id_reclamo_conf">
	    
	    <fieldset>
	      <input tabindex="3" placeholder="" type="text">
	      <div class="sa-input-error"></div>
	    </fieldset><div class="sa-error-container">
	      <div class="icon">!</div>
	      <p>Not valid!</p>
	    </div><div class="sa-button-container">
	      <button class="cancel" tabindex="2" style="display: inline-block; box-shadow: none;" data-dismiss="modal">Cancelar</button>
	      <div class="sa-confirm-button-container">
	        <button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(255, 112, 67); box-shadow: rgba(255, 112, 67, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;" onclick="guardar_cinco()">Ir a inspeccion</button><div class="la-ball-fall">
	          <div></div>
	          <div></div>
	          <div></div>
	        </div>
	      </div>
	    </div>
	</div>
   </div>
</div>

<!-- modal error devolver -->
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