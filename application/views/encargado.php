<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Lista de Reclamos</h5>
							<button class="btn btn-success" onclick=""><i class="glyphicon glyphicon-plus"></i> Añadir Respuesta</button>
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

	
			  "responsive":  true,
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

			"ajax":{
		            url: "<?php echo site_url('cencargado/lista')?>",	
		            type: "POST",
		            // dataSrc : "", 	
		            // beforeSend: function () {
              //           $("#resultado").html("Procesando, espere por favor...");
              //   	}, 
		            error: function (jqXHR, textStatus, errorThrown)
			        {
			            // alert('No hay reclamos pendientes');
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
	        }],
	//         // botones 
			
	    });

	    //datepicker
	    // funcnumero_enc();
	    $('.datepicker').datepicker({
	        autoclose: true,
	        format: "yyyy-mm-dd",
	        todayHighlight: true,
	        orientation: "top auto",
	        todayBtn: true,
	        todayHighlight: true,  
	    });

	    //set input/textarea/select event when change value, remove class error and remove text help block 
	    $("input").change(function(){
	        $(this).parent().parent().removeClass('has-error');
	        $(this).next().empty();
	    });

	    $("textarea").change(function(){
	        $(this).parent().parent().removeClass('has-error');
	        $(this).next().empty();
	    });

	    $("select").change(function(){
	        $(this).parent().parent().removeClass('has-error');
	        $(this).next().empty();
	    });

	});

// ---------------------------------------------------------------------------
		function reload_table()
		{
		    table.ajax.reload(null,false); //reload datatable ajax 
		}

 		function toDate(dateStr) {
	    	return new Date(dateStr.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3") );
		}
		
		function restaFechas(f1,f2){
			
			var dif = f2 - f1;
			var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
			// console.log(dias);
			return dias;
		}
		function errordevolver(id){
			$('#id_reclamo_error').val(id);
			$('#modal_error_devolver').modal('show'); // show bootstrap modal when complete loaded
		}

		function modificar_seguimiento_reclamo(){
			var id = $('#id_reclamo_error').val();
			$('#modal_error_devolver').modal('hide');
			$.ajax({
				url: '<?php echo base_url("cencargado/actualizar_inspeccion_error") ?>',
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

		function concluirinspecciond(id)
		{
			// alert (id);
			$('#id_reclamo_conf').val(id);
			$('#modal_confirmar').modal('show'); // show bootstrap modal when complete loaded
		}

		function guardar(){
			// alert('aqui estoy');
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
				window.location.href = '<?php echo base_url("form_inspecciontres/") ?>';
			})
			.fail(function() {
				console.log("No se guardo");
			});
		}

	// 		function inspectorr()
	// 		{
	// 		    save_method = 'add';
	// 		    $('#form_inspector')[0].reset(); // reset form on modals
	// 		    $('.form-group').removeClass('has-error'); // clear error class
	// 		    $('.help-block').empty(); // clear error string
	// 		    $('#modal_inspector').modal('show'); // show bootstrap modal
	// 		    $('.modal-title').text('Derivar a Inspector:'); // Set Title to Bootstrap modal title
	// 		}

	// 		function edit_inspectorr(id)
	// 		{
	// 			// alert (usuarioid);
	// 		    save_method = 'add';
	// 		    $('#form_inspector')[0].reset(); // reset form on modals
	// 		    $('.form-group').removeClass('has-error'); // clear error class
	// 		    $('.help-block').empty(); // clear error string

	// 		    //Ajax Load data from ajax
	// 		    $.ajax({
	// 		        url : "<?php echo site_url('cprincipal/ajax_editt')?>/" + id,
	// 		        type: "GET",
	// 		        dataType: "JSON",
	// 		        success: function(data)
	// 		        {
	// 		        	$('[name="id_reclamo"]').val(data.id_reclamo);
	// 		            $('[name="fechareclamo"]').val(data.fechareclamo);
	// 		            $('[name="motivo"]').val(data.motivo);
	// 		            $('[name="nombreclase"]').val(data.nombreclase);
	// 		            $('[name="nombres"]').val(data.nombres);
	// 		            $('[name="apellidos"]').val(data.apellidos);
	// 		            $('#modal_inspector').modal('show'); // show bootstrap modal when complete loaded
	// 		            $('.modal-title').text('Derivar a Inspector'); // Set title to Bootstrap modal title

	// 		        },
	// 		        error: function (jqXHR, textStatus, errorThrown)
	// 		        {
	// 		            alert('Error get data from ajax');
	// 		        }
	// 		    });
	// 		}

	// 		function reload_table(){ 
	// 		    table.ajax.reload(null,false); //reload datatable ajax 

	// 		}
		// 		public function getNumero(){
		// $numero = pg_num_rows($this->getreclamo());
		// echo $numero;
	// }
	// 		function confirmar(){
	// 			  $('#modal_confirmar').modal('show'); 
	// 		}

	// 		function cerrar(){
	// 			  $('#modal_confirmar').modal('hide'); 
	// 		}

			// function guardar()
			// {
			//     var id = $('#listainsp').val();
			//     	// nombrefunc = $('#listainsp').attr('value');
			//     // alert (nombrefunc);
			//     $('#btnSave').text('guardando...'); //change button text
			//     $('#btnSave').attr('disabled',true); //set button disable 
			//     var url;

			//     if(save_method == 'add') {
			//         url = "<?php echo site_url('cencargado/ajax_adicionar')?>/" + id;
			//     } 
			    
			//     $.ajax({
			//         url : url,
			//         type: "POST",
			//         data: $('#form_inspector').serialize(),
			//         dataType: "JSON",

			//         success: function(data)
			//         {
			//         	// alert(data);

			//             if(data.status) 
			//             {
			//                 $('#modal_confirmar').modal('hide');
			//                 $('#modal_inspector').modal('hide');
			//                 $('#btnSave').text('Guardar'); //change button text
			//             	$('#btnSave').attr('disabled',false); //set button enable 

			//                 reload_table();
			//                 funcnumero_enc();
			//             } else
			//             {
			//                 for (var i = 0; i < data.inputerror.length; i++) 
			//                 {
			//                     $('[name="'+data.inputerror[]+'"]').parent().parent().addClass('has-error'); 
			//                     $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
			//                 }
			//             }
			//             $('#btnSave').text('Guardar'); //change button text
			//             $('#btnSave').attr('disabled',false); //set button enable 


			//         },
			        
			//         error: function (jqXHR, textStatus, errorThrown)
			//         {
			//             alert('Error adding / update data');
			//             $('#btnSave').text('Guardar'); //change button text
			//             $('#btnSave').attr('disabled',false); //set button enable 

			//         }
			//     });
			// }

	// 		function delete_person(id)
	// 		{
	// 		    if(confirm('Are you sure delete this data?'))
	// 		    {
	// 		        // ajax delete data to database
	// 		        $.ajax({
	// 		            url : "<?php echo site_url('cprincipal/ajax_delete')?>/"+id,
	// 		            type: "POST",
	// 		            dataType: "JSON",
	// 		            success: function(data)
	// 		            {
	// 		                //if success reload ajax table
	// 		                $('#modal_inspector').modal('hide');
	// 		                reload_table();
	// 		            },
	// 		            error: function (jqXHR, textStatus, errorThrown)
	// 		            {
	// 		                alert('Error deleting data');
	// 		            }
	// 		        });

	// 		    }
	// 		}
	// 		// function funclistado(){


	// 			$.get('<?php echo base_url('cprincipal/listainspectorr') ?>', function(data) {
	// 				// alert(data);
	// 				var fr = $.parseJSON(data);
	// 				$.each(fr, function(index, val) {
	// 					$('#listainsp').append('<option value="'+val.id_funcionario+'">'+val.nombres +' '+ val.apellidos+ '</option>');
	// 				});
	// 			});
	// 		// }

			$.get('<?php echo base_url('cencargado/datos_user') ?>', function(data) {
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
                	<input type="text"  name="id_reclamo" id="id_reclamo"> 
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




<!-- <div class="modal fade" id="modal_confirmar" role="dialog">
    <div class="modal-dialog">
		<div class="ui-pnotify  ui-pnotify-fade-normal ui-pnotify-mobile-able ui-pnotify-in ui-pnotify-fade-in ui-pnotify-move" style="display: none; width: 300px; right: 356px; top: 20px; cursor: auto;" aria-live="assertive" aria-role="alertdialog">
			<div class="brighttheme ui-pnotify-container brighttheme-notice ui-pnotify-shadow" role="alert" style="min-height: 16px;">
		        <div class="ui-pnotify-closer" aria-role="button" tabindex="0" title="Close" style="cursor: pointer; visibility: hidden; display: none;">
		            		<span class="brighttheme-icon-closer"></span>
		        </div>
		        <div class="ui-pnotify-sticker" aria-role="button" aria-pressed="true" tabindex="0" title="Unstick" style="cursor: pointer; visibility: hidden; display: none;">
		            		<span class="brighttheme-icon-sticker brighttheme-icon-stuck" aria-pressed="true"></span>
		        </div>
		        <div class="ui-pnotify-icon">
		            		<span class="brighttheme-icon-notice"></span>
		        </div>
		        <h4 class="ui-pnotify-title">Confirmación</h4>
		        <div class="ui-pnotify-text" aria-role="alert">
		            		<p>Usted esta seguro de enviar el reclamo al Sr. : ?</p>
		        </div>
		        <div class="ui-pnotify-action-bar" style="margin-top: 5px; clear: both; text-align: right;">
		        <button type="button" class="ui-pnotify-action-button btn btn-sm btn-primary" onclick="guardar()">Si</button> 
		        <button type="button" class="ui-pnotify-action-button btn btn-sm btn-link" data-dismiss="modal">Cancelar</button></div></div>

		</div>
	</div>
</div> -->




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
	    </div><div class="sa-icon sa-custom" style="display: none;"></div><h2>Inspeccion</h2>
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
	        <button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(255, 112, 67); box-shadow: rgba(255, 112, 67, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;" onclick="guardar()">Ir a inspeccionar</button><div class="la-ball-fall">
	          <div></div>
	          <div></div>
	          <div></div>
	        </div>
	      </div>
	    </div>
	</div>
   </div>
</div>


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


