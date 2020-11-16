<div class="panel panel-flat" id="eso">
	<div class="panel-heading">
        <h5 class="panel-title">SEGUNDO FORMULARIO DE INSPECCIÓN </h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>
	<form id="form_inspecciondos">
	    <div class="panel-body">
	    	<div class="row">
	    		<!-- <label for="">ID_:RECLAMO</label> -->
	    		<input type="hidden" class="form-control" id="id_reclamo" name="id_reclamo" value="<?php echo $_SESSION['id_reclamosession'] ?>">
	    		<!-- <label for="">id_formularioinsepccion</label> -->
	    		<input type="hidden" class="form-control" id="id_formularioinspecciondos" name="id_formularioinspecciondos" >
	    		<div class="col-md-4">
	    			<div class="form-group">
						<label>Fecha de inspeccion: </label>
	                	<input type="text" class="form-control bg-success-800" name="fechainspeccion" id="fechainspeccion">
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Persona que atendio la inspección</label>
	                	<input type="text" class="form-control bg-success-800" id="personaqueatendio" name="personaqueatendio">
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Código </label> 
	                	<input type="text" class="form-control bg-success-800" id="codigo" name="codigo">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Dirección: </label>
	                	<input type="text" class="form-control bg-success-800" id="direccion" name="direccion">
					</div>
				</div>
	    		<div class="col-md-4">
	    			<div class="form-group">
						<label>Observaciones de la inspección: </label>
						<select name="observaciones" id="observaciones" class="form-control bg-success-800">
	                		<option value="">Seleccione...</option>
	                		<option value="DESCALIBRADO">DESCALIBRADO</option>
	                		<option value="DESTROZADO">DESTROZADO</option>
	                		<option value="DENTRO DE PREDIO">DENTRO DE PREDIO</option>
	                		<option value="TRANCADO">TRANCADO</option>
	                		<option value="EMPAÑADO">EMPAÑADO</option>
	                		<option value="TAPADO">TAPADO</option>
	                		<option value="MEDIDOR PROFUNDO">MEDIDOR PROFUNDO</option>
	                		<option value="CONSUMO ALTO">CONSUMO ALTO</option>
	                		<option value="ERROR DE LECTURA">ERROR DE LECTURA</option>
	                		<option value="CONSUMO ELEVADO">CONSUMO ELEVADO</option>
	                		<option value="MEDIDOR NUEVO">MEDIDOR NUEVO</option>
	                		<option value="FILTRACIÓN">FILTRACIÓN</option>
	                		<option value="NINGUNA OBSERVACIÓN">NINGUNA OBSERVACIÓN</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Recomendación: </label>
	                	<select name="recomendacion" id="recomendacion" class="form-control bg-success-800">
	                		<option value="">Seleccione...</option>
	                		<option value="CAMBIO">CAMBIO</option>
	                		<option value="TRASLADO">TRASLADO</option>
	                		<option value="VERIFICAR">VERIFICAR</option>
	                		<option value="NINGUNA">NINGUNA</option>
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<input type="hidden" class="form-control" id="estadoreclamo" name="estadoreclamo" value="5">
				<input type="hidden" class="form-control" id="id_funcionario" name="id_funcionario" value="<?php echo $_SESSION['user_id'] ?>">
			</div>

			<div class="row">
				<div class="text-center">
					<button type="submit" id="btnSave" class="btn bg-success-800">Guardar<i class="icon-arrow-right14 position-right"></i></button>
				</div>
			</div>
	    </div>
	</form>
</div>

<button id="btnLimpiar" class="btn btn-sm btn-primary">Limpiar formulario <i class="icon-arrow-right14 position-right"></i></button>

<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">RECLAMOS inspeccion dos</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>

	<table id="tableformulariodos" class="table datatable-basic dataTable no-footer">
		<thead>
			<tr>
	            <th>Fec. Inspección</th>
	            <th>Persona que atendió</th>
	            <th>Código</th>
	            <th>direccion</th>
	            <th>inspeccion</th>
	            <th>recomendacion</th>
	            <th>id_funcionario</th>
	            <th>id_reclamo</th>
	            <th style="Actionh:125px;">Acción</th>
	        </tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>


<script type="text/javascript">
	var save_method; //for save method string
	var table;
	// var base_url = '<?php echo base_url();?>';

	$(document).ready(function() {
		cargarreclamo();
		table = $('#tableformulariodos').DataTable({ 
			"destroy": true,
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.

	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('form_inspecciondos/ajax_list')?>",
	            "type": "POST"
	        },

	        //Set column definition initialisation properties.
	        "columnDefs": [
	            { 
	                "targets": [ -1 ], //last column
	                "orderable": false, //set not orderable
	            },
	            // { 
	            //     "targets": [ -2 ], //2 last column (photo)
	            //     "orderable": false, //set not orderable
	            // },
	        ],
		});

		var f = toDate(Date());
		f.setDate(f.getDate()); 
		// console.log(f);
		$('input#fechainspeccion').val(f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear() +' '+ f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds());

		function toDate(fecha) {
	    	return new Date(fecha.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3") );
		}



	});

	$.get('<?php echo base_url("form_inspecciondos/cargarcodigo") ?>', function(data) {
		var cod = $.parseJSON(data);
		$.each(cod, function(index, val) {
			$('[name="codigo"]').val(val);
		});
	});


	$('#form_inspecciondos').on('submit', function(event) {
		event.preventDefault();
		var url;
		if($('#btnSave').text().trim() == 'Guardar') {
	        url = "<?php echo base_url('form_inspecciondos/ajax_add_inspeccion')?>";
	    } else {
	        url = "<?php echo base_url('form_inspecciondos/ajax_update_inspeccion')?>";
	    }
	    $.ajax({
			url : url,
			type: "POST",
			data: $('#form_inspecciondos').serialize(),
			dataType: "JSON",
			success: function(data)
			{
			    if (data.status) {
					alert('Los datos fueron guardados correctamente');
					
					reload_table();
				}
				else {
					if (data.error) {
						alert('Error al subir las imagenes.');
					} else{
						alert('Error: No se puede guardar los datos');
					}
				}
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
			    alert('Error al insertar los datos');
			}
		})
	});
	

function edit_inspecciondos(id)
{
    // save_method = 'update';
    // $('#form_inspecciondos')[0].reset(); // reset form on modals
    // $('.form-group').removeClass('has-error'); // clear error class
    // $('.help-block').empty(); // clear error string


    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('form_inspecciondos/ajax_edit_forminspecciondos')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
        	console.log(data);
            $('[name="id_formularioinspecciondos"]').val(data.id_formularioinspecciondos);
            $('[name="fechainspeccion"]').val(data.fechaforminspeccion)
            $('[name="personaqueatendio"]').val(data.nombrespersona);
            $('[name="codigo"]').val(data.codigo);
            $('[name="direccion"]').val(data.direccion);
            $('[name="observaciones"]').val(data.inspeccion);
            $('#recomendacion').val(data.recomendacion);
            $('[name="id_funcionario"]').var(data.id_funcionario);
            $('[name="id_reclamo"]').var(data.id_reclamo);
            // $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar inspección'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error al obtener datos.');
        }
    });
    $('#btnSave').text('Actualizar datos'); //change button text
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

// $("input[name=fechainspeccion]").change(function(){
// 	$('#btnSave').text('Actualizar datos'); //change button text
// });
// $("input[name=personaqueatendio]").change(function(){
// 	$('#btnSave').text('Actualizar datos'); //change button text
// });
// $("input[name=codigo]").change(function(){
// 	$('#btnSave').text('Actualizar datos'); //change button text
// });
// $("input[name=direccion]").change(function(){
// 	$('#btnSave').text('Actualizar datos'); //change button text
// });
// $("input[name=observaciones]").change(function(){
// 	$('#btnSave').text('Actualizar datos'); //change button text
// });
// $("input[name=recomendacion]").change(function(){
// 	$('#btnSave').text('Actualizar datos'); //change button text
// });

$("#btnLimpiar" ).click(function() {
	// $('#form_inspecciondos')[0].reset(); // reset form on modals
	$("#btnSave").text('Guardar'); //change button text
	$("input[name=personaqueatendio]").val(''); //change button text
	// $("input[name=codigo]").text(''); //change button text
	$("input[name=direccion]").val(''); //change button text
	$("input[name=observaciones]").val(''); //change button text
	$("input[name=recomendacion]").val(''); //change button text
});

	function retornar_inspeccionformdos(id){
		// alert ('hola'+id);
		// $('#id_reclamo_conf').val(id);
		// $('#modal_confirmar')[0].reset(); 
			    // $('.form-group').removeClass('has-error'); 
			    // $('.help-block').empty(); 
		$('#idrecla').text(id);
		$('#id_reclamo_conf').val(id);
		$('[name="apellidofunc"]').html(id);
		$('#modal_confirmar').modal('show'); // show bootstrap modal when complete loaded
		
	}

	function guardarr(){
		var id = '<?php echo $_SESSION['id_reclamosession'] ?>';
			// alert(id);
		$('#modal_confirmar').modal('hide');
		$.ajax({
			url: '<?php echo base_url("form_inspecciondos/actualizar_inspeccion_retornar") ?>',
			type: 'POST',
			dataType: 'JSON',
			data: {id_reclamo: id, estado: 4},
		})
		.done(function() {
			console.log("Se guardo con éxito");
			rep_reclamo();
			window.location.href = '<?php echo base_url("cencargado/") ?>';
		})
		.fail(function() {
			console.log("No se guardo");
		});
	}

	function cargarreclamo() {
		$.ajax({
			url: '<?php echo base_url('form_inspecciondos/cargar_reclamo') ?>',
			type: 'GET',
			dataType: 'JSON',
			success: function(data)
	        {
	        	var reclamohtml = '';	    
				$('#personaqueatendio').val(data.personaqueatendio);
				$('#codigo').val(data.codigousuario);
				$('#direccion').val(data.direccion);
			}
		});
	}


</script>


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

	    </div><div class="sa-icon sa-custom" style="display: none;"></div><h2>¿Estas seguro DERIVAR la inspeccion?</h2>
	    <!-- <p style="display: block;">De enviar el reclamo!</p> -->
	    <input type="text" id="idrecla">
	    <input type="text" class="form-control " name="apellidofunc" id="apellidofunc" >
	    <input type="text" id="id_reclamo_conf" name="id_reclamo_conf">
	    <fieldset>
	      <input tabindex="3" placeholder="" type="text">
	      <div class="sa-input-error"></div>
	    </fieldset><div class="sa-error-container">
	      <div class="icon">!</div>
	      <p>Not valid!</p>
	    </div><div class="sa-button-container">
	      <button class="cancel" tabindex="2" style="display: inline-block; box-shadow: none;" data-dismiss="modal">Cancelar</button>
	      <div class="sa-confirm-button-container">
	        <button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(255, 112, 67); box-shadow: rgba(255, 112, 67, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;" onclick="guardarr()">Retornar inspeccion</button><div class="la-ball-fall">
	          <div></div>
	          <div></div>
	          <div></div>
	        </div>
	      </div>
	    </div>
	</div>
   </div>
</div>