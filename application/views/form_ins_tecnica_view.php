<!-- text-semibold bg-success input-xlg text-default -->

<div class="panel panel-flat">
	<div class="panel-heading">
        <h5 class="panel-title">RECLAMO </h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>
	<div id="reclamo"></div>
</div>


<div class="panel panel-flat bg-success-300" id="eso">
	<div class="panel-heading">
        <h5 class="panel-title">FORMULARIO DE INSPECCIÓN </h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>
	<form id="form_inspeccion">
	    <div class="panel-body">
	    	<div class="row">
	    		<!-- <label for="">id_reclamo</label> -->
	    		<input type="hidden" class="form-control" id="id_reclamoo" name="id_reclamoo">
	    		<!-- <label for="">id_formularioinspeccion</label> -->
	    		<input type="hidden" class="form-control" id="id_formularioinspeccion" name="id_formularioinspeccion">
	    		<div class="col-md-4">
	    			<div class="form-group">
						<label>Fecha de inspeccion: </label>
	                	<input type="text" class="form-control" id="fechaforinspcuatro" name="fechaforinspcuatro" readonly="true">
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Cambio de Acometida: </label>
						<select name="cambioacometida" id="cambioacometida" class="form-control">
	                		<option value="">Seleccione...</option>
	                		<option value="Fierro galvanizado">Fierro galvanizado</option>
	                		<option value="Por falta de presión">Por falta de presión</option>
	                		<option value="Tubería de mala calidad">Tubería de mala calidad</option>      	
	                		<option value="Por falta de agua">Por falta de agua</option> 	
	                		<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Traslado de Medidor: </label>
	                	<select name="trasmedidor" id="trasmedidor" class="form-control">
	                		<option value="">Seleccione...</option>
	                		<option value="Del interior al exterior">Del interior al exterior</option>
	                		<option value="De forma paralela">De forma paralela </option>  		      		
	                		<option value="No">No</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Falta de agua: </label>
						<select name="faltaagua" id="faltaagua" class="form-control">
	                		<option value="">Seleccione...</option>
	                		<option value="Suministro no sea la correcta">Suministro no sea la correcta</option>
	                		<option value="Por llave en mal estado">Por llave en mal estado</option>
	                		<option value="Obstrucción del filtro de medidor">Obstrucción del filtro de medidor</option>
	                		<option value="Obstrucción en la red de medidor">Obstrucción en la red de medidor</option>
	                		<option value="Obstrucción interno">Obstrucción interno</option>
	                		<option value="Rotura por terceros">Rotura por terceros</option>
	                		<option value="Por corte de comercial">Por corte de comercial</option>
	                		<option value="Corte programado">Corte programado </option>
	                		<option value="Mantenimiento de tanques">Mantenimiento de tanques</option>
	                		<option value="No">No</option>
						</select>
					</div>
				</div>
	    		<div class="col-md-4">
	    			<div class="form-group">
						<label>Fuga intradomiciliaria: </label>
	                	<select name="fugaintra" id="fugaintra" class="form-control">
	                		<option value="">Seleccione...</option>
	                		<option value="SI">SI</option>
	                		<option value="NO">NO</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Falta de presión : </label>
	                	<select name="faltapresion" id="faltapresion" class="form-control">
	                		<option value="">Seleccione...</option>
	                		<option value="Obstrucción en la red de medidor">Obstrucción en la red de medidor</option>
	                		<option value="Obstrucción interna">Obstrucción interna</option>
	                		<option value="Rotura por terceros">Rotura por terceros</option>
	                		<option value="Por corte de comercial">Por corte de comercial</option>
	                		<option value="Corte programado">Corte programado </option>
	                		<option value="Mantenimiento de tanques">Mantenimiento de tanques </option>
	                		<option value="Por corte de comercial">Normal</option>
						</select>
					</div>
				</div>
				
			</div>
			<div class="row">
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Fuga en red Matriz: </label>
						<select name="fugaredmatriz" id="fugaredmatriz" class="form-control">
	                		<option value="">Seleccione...</option>
	                		<option value="Trabajo por terceros">Trabajo por terceros</option>
	                		<option value="Trabajo por municipio">Trabajo por municipio</option>
	                		<option value="Mal estado de la tubería">Mal estado de la tubería</option>
	                		<option value="Collarin de la red">Collarin de la red</option>
	                		<option value="No">No</option>
						</select>
					</div>
				</div>
	    		<div class="col-md-4">
	    			<div class="form-group">
						<label>Reinstalación y Reconexión acometidas : </label>
	                	<select name="reinsreconexion" id="reinsreconexion" class="form-control">
	                		<option value="">Seleccione...</option>
	                		<option value="Por cambio de la red de matriz">Por cambio de la red de matriz</option>	                		
	                		<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Cambio de llave de paso: </label>
	                	<select name="llavemal" id="llavemal" class="form-control">
	                		<option value="">Seleccione...</option>
	                		<option value="SI SE HIZO">SI SE HIZO</option>
	                		<option value="NO SE HIZO">NO SE HIZO</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Fuga en Acometida: </label>
						<select name="fugaacometida" id="fugaacometida" class="form-control">
	                		<option value="">Seleccione...</option>
	                		<option value="Trabajo por terceros">Trabajo por terceros</option>
	                		<option value="Tubería en mal estado">Tubería en mal estado</option>
	                		<option value="Trabajo por municipio">Trabajo por municipio</option>      		
	                		<option value="No">No</option>
						</select>
					</div>
				</div>
	    		<div class="col-md-4">
	    			<div class="form-group">
						<label>Nivelación de medidor: </label>
	                	<select name="nivemedidor" id="nivemedidor" class="form-control">
	                		<option value="">Seleccione...</option>
	                		<option value="SI SE HIZO">SI SE HIZO</option>
	                		<option value="NO SE HIZO">NO SE HIZO</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Mala calidad del agua: </label>
	                	<select name="malaagua" id="malaagua" class="form-control">
	                		<option value="">Seleccione...</option>
	                		<option value="SI">SI</option>
	                		<option value="NO">NO</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				
	    		
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Persona que atendio la inspección: </label>
	                	<input type="text" class="form-control " name="personaqueatendio" placeholder="">
					</div>
				</div>
			</div>
			
			<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Informe Inspección: </label>
                        <textarea id="descripcionmedidor" name ="descripcioninformeinspeccion" rows="3" class="form-control elastic"></textarea>
                    </div>
                </div>
            </div>

			<div class="row">
				
				
				<input type="hidden" class="form-control" id="estadoreclamo" name="estadoreclamo" value="4">
				<input type="hidden" class="form-control" id="id_funcionario" name="id_funcionario" value="<?php echo $_SESSION['user_id'] ?>">
			</div>
			<div class="row">
				<div class="col-md-12">
	    			<label>Subir imagen:</label>	
	    			<!-- <div class="form-group">		
						<input type="file" class="file-input-ajax form-control" id="photo" name="photo[]" multiple="multiple">
					</div> -->

					<!-- <label class="col-lg-2 control-label text-semibold">Overwrite preview:</label> -->
					<!-- <div class="col-lg-10"> -->
						<input type="file" class="file-input-overwrite form-control" id="photo" name="photo[]" multiple="multiple">
						<!-- <span class="help-block">Display preview on load with preset files/images and captions with <code>overwriteInitial</code> set to <code>true</code>.</span> -->
					<!-- </div> -->

				</div>
				<!-- <div class="form-group">
					<label class="col-lg-2 control-label text-semibold">Multiple file upload:</label>
					<div class="col-lg-10">
						<input type="file" class="file-input" multiple="multiple">
						<span class="help-block">Automatically convert a file input to a bootstrap file input widget by setting its class as <code>file-input</code>.</span>
					</div>
				</div> -->
			</div>

			<div class="row">
				<div class="text-center">
					<button type="submit" id="btnSave" class="btn bg-success-800">Guardar <i class="icon-arrow-right14 position-right"></i></button>
					<!-- <button type="submit" id="btnSave" class="btn bg-teal-400">Guardar <i class="icon-arrow-right14 position-right"></i></button> -->
				</div>
			</div>
	    </div>
	</form>
</div>





<!-- 
<div class="panel panel-flat">
	<div class="panel-heading">
        <h5 class="panel-title">Lista de reclamos atendidos </h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>
	<table id="tableformulario" class="table datatable-basic">
	    <thead>
	        <tr>
	        	<th>Nº</th>
	            <th>Fec. Inspección</th>
	            <th>Tamaño vivienda</th>
	            <th>Calibrado</th>
	            <th>Ubicación</th>
	            <th>Estado tanque de baño</th>
	            <th>Presión en la Zona</th>
	            <th>Piscina</th>
	            <th>Filtracion interna</th>
	            <th>Marca</th>
	            <th>Descripción</th>
	            <th>Reclamo</th>
	            <th>Fecha</th>
	            <th style="Actionh:125px;">Acción</th>
	        </tr>
	    </thead>
	    <tbody>
	    </tbody>
	</table>
</div> -->

<div class="panel panel-flat bg-danger-300">
	<div class="panel-heading">
		<h5 class="panel-title">RECLAMOS</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>

	<table id="tableformulario" class="table datatable-basic dataTable no-footer">
		<thead>
			<tr>
	        	<!-- <th>Nº</th> -->
	            <th>Fec. Inspección</th>
	            <th>Presión de Agua</th>
	            <th>Falta de Agua</th>
	            <th>Falta de Presión</th>
	            <th>Fuga de Red Matriz</th>
	            <th>LLave de paso</th>
	            <th>Cambio de Acometida</th>	
	            <th>Persona que Atendio</th>      
	            <th style="Actionh:125px;">Acción</th>
	        </tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	var table;
	var base_url = '<?php echo base_url();?>';
	var urlimagen = [];

	$(document).ready(function() {
		// $(".file-input-overwrite").fileinput();
		var f = toDate(Date());
		f.setDate(f.getDate()); 
		// console.log(f);
		$('#fechaforinspcuatro').val(f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear() +' '+ f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds());

		function toDate(fecha) {
	    	return new Date(fecha.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3") );
		}
		var id_rec = 
		cargarreclamo();
		table = $('#tableformulario').DataTable({ 
			"destroy": true,
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.

	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('form_ins_tecnica/ajax_list')?>",
	            "type": "POST"
	        },

	        //Set column definition initialisation properties.
	        "columnDefs": [
	        { 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        },
	        ]

	    });

	});

	// function clearFileInput($input) {
	//     if ($input.val() == '') {
	//         return;
	//     }
	//     // Fix for IE ver < 11, that does not clear file inputs
	//     // Requires a sequence of steps to prevent IE crashing but
	//     // still allow clearing of the file input.
	//     if (/MSIE/.test(navigator.userAgent)) {
	//         var $frm1 = $input.closest('form');
	//         if ($frm1.length) { // check if the input is already wrapped in a form
	//             $input.wrap('<form>');
	//             var $frm2 = $input.closest('form'), // the wrapper form
	//                 $tmpEl = $(document.createElement('div')); // a temporary placeholder element
	//             $frm2.before($tmpEl).after($frm1).trigger('reset');
	//             $input.unwrap().appendTo($tmpEl).unwrap();
	//         } else { // no parent form exists - just wrap a form element
	//             $input.wrap('<form>').closest('form').trigger('reset').unwrap();
	//         }   
	//     } else { // normal reset behavior for other sane browsers
	//         $input.val('');
	//     }
	// }

	function cargarreclamo() {
		$.ajax({
			url: '<?php echo base_url('form_ins_tecnica/cargar_reclamo') ?>',
			type: 'GET',
			dataType: 'JSON',
			success: function(data)
	        {
	        	var reclamohtml = '';
	        	reclamohtml += 
					'<div class="panel-body">'+
				        // '<form action="">'+
				            '<div class="row">'+
				            	'<div class="col-md-4">'+
				            	'<input type="hidden" id="id_reclmoabonado" name="id_reclmoabonado" value="'+data.id_reclamo+'" class="form-control" type="text">'+
				                    '<div class="form-group">'+
				                        '<label>Numero de reclamo: </label>'+
				                        '<input type="text" id="id_personabusq" name="id_personabusq" value="'+data.numero+'" class="form-control bg-success-800" type="text" >'+
				                    '</div>'+
				                '</div>'+
				                '<div class="col-md-4">'+
				                    '<div class="form-group">'+
				                        '<label>Nombre del abonado: </label>'+
				                        '<input id="nombres" name="nombres" value="'+data.nombres+' '+data.apellidos+ '" class="form-control bg-success-800" type="text">'+
				                    '</div>'+
				                '</div>'+
				                '<div class="col-md-4">'+
				                    '<div class="form-group">'+
				                        '<label>Fecha de reclamo: </label>'+
				                        '<input id="apellidos" name="apellidos" value="'+data.ini+'" class="form-control bg-success-800" type="text">'+
				                    '</div>'+
				                '</div>'+
				            '</div>'+
				            '<div class="row">'+
				                '<div class="col-md-4">'+
				                    '<div class="form-group">'+
				                        '<label>Fecha de posible respuesta: </label>'+
				                        '<input id="ci" name="ci" value="'+data.fin+'" class="form-control bg-success-800" type="text">'+
				                    '</div>'+
				                '</div>'+
				                '<div class="col-md-4">'+
				                    '<div class="form-group">'+
				                        '<label>Forma de reclamo: </label>'+
				                        '<input id="telfono" name="telfono" value="'+data.nombreforma+'" class="form-control bg-success-800" type="text">'+
				                    '</div>'+
				                '</div>'+
				                '<div class="col-md-4">'+
				                    '<div class="form-group">'+
				                        '<label>Codigo de Usuario: </label>'+
				                        '<input id="codigoo" name="codigoo" value="'+data.codigousuario+'" class="form-control bg-success-800" type="text">'+
				                    '</div>'+
				                '</div>'+
				            '</div>'+
				            // '<div class="row">'+
				            //     '<div class="col-md-4">'+
				            //         '<div class="form-group">'+
				            //             '<label>Manzano: </label>'+
				            //             '<input id="nit" name="nit" value="'+data.codigousuario+'" class="form-control" type="text">'+
				            //         '</div>'+
				            //     '</div>'+
				            //     '<div class="col-md-4">'+
				            //         '<div class="form-group">'+
				            //             '<label>vivienda: </label>'+
				            //             '<input id="nit" name="nit" value="'+data.codigousuario+'" class="form-control" type="text">'+
				            //         '</div>'+
				            //     '</div>'+
				            //     // '<div class="col-md-4">'+
				            //     //     '<div class="form-group">'+
				            //     //         '<label>NIT: </label>'+
				            //     //         '<input id="nit" name="nit" value="'+data.nit+'" class="form-control" type="text">'+
				            //     //     '</div>'+
				            //     // '</div>'+	
				            // '</div>'+
				            '<div class="row">'+
				                '<div class="col-md-12">'+
				                    '<div class="form-group">'+
				                        '<label>Motivo: </label>'+
				                        '<textarea rows="3" class="form-control elastic bg-success-800">'+data.motivo+'</textarea>'+
				                    '</div>'+
				                '</div>'+	
				            '</div>'+
				            // '<div class="text-right">'+
				            //     '<button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>'+
				            // '</div>'+
				        // '</form>'+
				    '</div>';
				$('#reclamo').html(reclamohtml);
				$('#id_reclamoo').val($('#id_reclmoabonado').val());
			}
		});
	}

	$.get('<?php echo base_url('odeco/get_tiporeclamo')?>', function(data) {
		var tr = $.parseJSON(data);
		$.each(tr, function(index, val) {
			$('#tiporeclamo').append('<option value="'+val.id_tiporeclamo+'">'+val.nombretiporeclamo+'</option>');
		});
	});

	$('#tiporeclamo').change(function(e) {
		var idtr = $('#tiporeclamo').val();
		console.log(idtr);
		$.post('<?php echo base_url('odeco/get_subreclamo') ?>',
			{id_tiporeclamo: idtr}, 
			function(data, textStatus, xhr) {
				var sr = $.parseJSON(data);
				console.log(sr);
				var textohtml = '';
				$.each(sr, function(index, val) {
					textohtml+=
					'<label>'+
						'<input id="subreclamo" name="subreclamo[]" value="'+val.id_subreclamo+'" type="checkbox" class="switchery" >'+
						val.nombresubreclamo+
					'</label><br>';
				});
				$('#subreclamohtml').html(textohtml);
			}
		)
	});

	$("#form_inspeccion").on("submit", function(event) {
		event.preventDefault();

		var url;
		// console.log($('#btnSave').text());
		if($('#btnSave').text().trim() == 'Guardar') {
	        url = "<?php echo base_url('form_ins_tecnica/ajax_add_inspection')?>";
	    } else {
	        url = "<?php echo base_url('form_ins_tecnica/ajax_update_inspection')?>";
	    }

	    var formData = new FormData($('#form_inspeccion')[0]);
	    // var formData = new FormData();
	 //    $.each($('input[type=file]')[0].files, function(i, file) {
	 //    	var filename = file['name'];
	 //    	console.log(filename);
		// 	// var ext = filename.split('.').pop();
		// 	formData.append("image", file);
		// });

		// console.log(formData);

		var selected = [];
		// $(":checkbox[id=subreclamo]").each(function() {
		// 	if (this.checked) {
		// 		selected.push($(this).val());
		// 	}
		// });
		// if (!selected.length) {
		// 	// alert('Debes seleccionar al menos una opción.');
		// } else {
			var parametros = {
				"idreclamo" : $('#id_reclmoabonado').val(),
				"codigousuario" : $('#codigoo').val() 
			};
			// alert(parametros);
			$.ajax({
				url: url,
				type: "post",
				dataType: 'JSON',
				data: formData,
				contentType: false,
				processData: false,
				success: function(d) {
					if (d.status) {
						alert('Los datos fueron guardados correctamente');
						reload_table();
						window.location.href='<?php echo base_url() ?>cinspeccion/'; 
						// + $('#id_reclmoabonado').val();
					}
					else {
						if (d.error) {
							alert('Error al subir las imagenes.');
						} else{
							alert('Error: No se puede guardar los datos');
						}
					}
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
				    alert('Error al guardar los datos');
				}
			});
		// }
	});

	function edit_forminscripcion(id)
	{

		// $("#form_inspeccion").get(0).reset()
	    // cargarselectmodal();
	    $fileInput = $('.file-input-overwrite');
		// $("#clear").on("click", function () {
		    // $fileInput.replaceWith( $fileInput = $fileInput.clone( true ) );
		    // clearFileInput($fileInput);
		// });
		// $(".file-input-overwrite").closest('form').trigger('reset');

		// $('.file-input-overwrite').fileinput('reset');
		$('#input-id').fileinput('clear');

	    $.ajax({
	        url : "<?php echo site_url('form_ins_tecnica/ajax_edit_forminspeccion/')?>" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(dataforminspecc)
	        {
	            $('[name="id_forinscuatro"]').val(dataforminspecc.id_forinscuatro);
	            $('[name="fechaforinspcuatro"]').val(dataforminspecc.fechaforinspcuatro);
	            // $('[name="tamaniovivienda"]').val(dataforminspecc.tamaniovivienda);
	            // $('[name="numerohabitantes"]').val(dataforminspecc.numerohabitantes);
	            // $('[name="ubicacionmedidor"]').val(dataforminspecc.ubicacionmedidor);
	            // $('[name="marcamedidor"]').val(dataforminspecc.marcamedidor);
	            $('[name="presionaguazona"]').val(dataforminspecc.presionaguazona);
	            $('[name="faltaagua"]').val(dataforminspecc.faltaagua);
	            $('[name="fugaintra"]').val(dataforminspecc.fugaintra);
	            $('[name="faltapresion"]').val(dataforminspecc.faltapresion);
	            $('[name="fugaredmatriz"]').val(dataforminspecc.fugaredmatriz);
	            $('[name="reinsreconexion"]').val(dataforminspecc.reinsreconexion);
	            $('[name="fugaacometida"]').val(dataforminspecc.fugaacometida);
	            $('[name="nivemedidor"]').val(dataforminspecc.nivemedidor);
	            $('[name="malaagua"]').val(dataforminspecc.malaagua);
	            $('[name="cambioacometida"]').val(dataforminspecc.cambioacometida);
	            $('[name="trasmedidor"]').val(dataforminspecc.trasmedidor);
	            $('[name="personaqueatendio"]').val(dataforminspecc.personaqueatendio);
	            $('[name="descripcioninformeinspeccion"]').val(dataforminspecc.descripcioninformeinspeccion);
	            $('[name="id_reclamo"]').val(dataforminspecc.id_reclamo)
				$('[name="tiporeclamo"]').val(dataforminspecc.trsr[0].id_tiporeclamo);
				// 'fechaforinspcuatro' => $this->input->post('fechaforinspcuatro'),
				// 	'tamaniovivienda' => $this->input->post('tamaniovivienda'),
				// 	'numerohabitantes' => $this->input->post('numerohabitantes'),
				// 	'ubicacionmedidor' => $this->input->post('ubicacionmedidor'),
				// 	'marcamedidor' => $this->input->post('marcamedidor'),
				// 	'presionaguazona' => $this->input->post('presionaguazona'),
				// 	'faltaagua' => $this->input->post('faltaagua'),
				// 	'fugaintra' => $this->input->post('fugaintra'),
				// 	'faltapresion' => $this->input->post('faltapresion'),
				// 	'fugaredmatriz' => $this->input->post('fugaredmatriz'),
				// 	'reinsreconexion' => $this->input->post('reinsreconexion'),
				// 	'llavemal' => $this->input->post('llavemal'),
				// 	'fugaacometida' => $this->input->post('fugaacometida'),
				// 	'nivemedidor' => $this->input->post('nivemedidor'),
				// 	'malaagua' => $this->input->post('malaagua'),
				// 	'cambioacometida' => $this->input->post('cambioacometida'),
				// 	'trasmedidor' => $this->input->post('trasmedidor'),
				// 	'personaqueatendio' => $this->input->post('personaqueatendio'),
				// 	'descripcioninformeinspeccion' => $this->input->post('descripcioninformeinspeccion'),
				// 	'id_reclamo' => $this->input->post('id_reclamoo'),

				//// subreclamo
				// alert(dataforminspecc.trsr[0].id_tiporeclamo);
				// alert(dataforminspecc.trsr.length);
				var cantsr = dataforminspecc.trsr.length;
				$.post('<?php echo base_url('form_ins_tecnica/get_subreclamo') ?>',
					{id_tiporeclamo: dataforminspecc.trsr[0].id_tiporeclamo}, 
					function(data, textStatus, xhr) {
						var sr = $.parseJSON(data);
						// console.log(sr);
						var textohtml = '';
						$.each(sr, function(index, val) {
							textohtml+=
							'<label>'+
								'<input id="subreclamo" name="subreclamo[]" value="'+val.id_subreclamo+'" type="checkbox" class="switchery" >'+
								val.nombresubreclamo+
							'</label><br>';
						});
						$('#subreclamohtml').html(textohtml);
						// console.log(dataforminspecc.trsr[0].id_subreclamo);
						// console.log(parseInt($('#subreclamomodal').val()));

						$("input#subreclamo").each(function(){
							for (var i = 0; i < cantsr; i++) {
								if (parseInt($(this).val()) == dataforminspecc.trsr[i].id_subreclamo ) {
									$(this).prop('checked',true);
								}
							}
						});
					}
				);

				// carga las imagenes para luego actualizar 
				$.post('<?php echo base_url("form_ins_tecnica/get_archivos") ?>', {id_archivo: dataforminspecc.id_forinscuatro}, function(datos, textStatus, xhr) {
            		var datoc = $.parseJSON(datos);
            		// console.log(datoc);
            		$.each(datoc, function(index, val) {
						var urlb = base_url+'upload/'+val.nombrearchivo;
						urlimagen[index] = urlb;
						// console.log(typeof(urlimagen));
					});
            		imagenes(urlimagen);
            		// var urlb = base_url+'upload/'+datoc.nombrearchivo;
            	});

	            $('#btnSave').text('Actualizar datos'); //change button text
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Erro al obtener datos');
	        }
	    });
	}

	function imagenes(esque) {

		// console.log(typeof(esque));
		console.log(esque);

        // var eso = [
        //     	"http://localhost/occv1/upload/eso1.jpg",
        //     	"http://localhost/occv1/upload/eso1.jpg"
        //     ];
        // console.log(typeof(eso));

	 //    var eso = esque;

		var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
        '  <div class="modal-content">\n' +
        '    <div class="modal-header">\n' +
        '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
        '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
        '    </div>\n' +
        '    <div class="modal-body">\n' +
        '      <div class="floating-buttons btn-group"></div>\n' +
        '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
        '    </div>\n' +
        '  </div>\n' +
        '</div>\n';

        var previewZoomButtonClasses = {
	        toggleheader: 'btn btn-default btn-icon btn-xs btn-header-toggle',
	        fullscreen: 'btn btn-default btn-icon btn-xs',
	        borderless: 'btn btn-default btn-icon btn-xs',
	        close: 'btn btn-default btn-icon btn-xs'
	    };

	    var previewZoomButtonIcons = {
	        prev: '<i class="icon-arrow-left32"></i>',
	        next: '<i class="icon-arrow-right32"></i>',
	        toggleheader: '<i class="icon-menu-open"></i>',
	        fullscreen: '<i class="icon-screen-full"></i>',
	        borderless: '<i class="icon-alignment-unalign"></i>',
	        close: '<i class="icon-cross3"></i>'
	    };

	    var fileActionSettings = {
	        zoomClass: 'btn btn-link btn-xs btn-icon',
	        zoomIcon: '<i class="icon-zoomin3"></i>',
	        dragClass: 'btn btn-link btn-xs btn-icon',
	        dragIcon: '<i class="icon-three-bars"></i>',
	        removeClass: 'btn btn-link btn-icon btn-xs',
	        removeIcon: '<i class="icon-trash"></i>',
	        indicatorNew: '<i class="icon-file-plus text-slate"></i>',
	        indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
	        indicatorError: '<i class="icon-cross2 text-danger"></i>',
	        indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
	    };

	    $(".file-input-overwrite").fileinput({

	        browseLabel: 'Browse',
	        browseClass: 'btn btn-primary',
	        uploadClass: 'btn btn-default',
	        browseIcon: '<i class="icon-file-plus"></i>',
	        uploadIcon: '<i class="icon-file-upload2"></i>',
	        removeIcon: '<i class="icon-cross3"></i>',
	        layoutTemplates: {
	            icon: '<i class="icon-file-check"></i>',
	            modal: modalTemplate
	        },
	        initialPreview: esque,

	        // initialPreviewConfig: [
	        //     {caption: "Jane.jpg", size: 930321, key: 1, showDrag: false},
	        //     // {caption: "Anna.jpg", size: 1218822, key: 2, showDrag: false}
	        // ],
	        initialPreviewAsData: true,
	        overwriteInitial: true,
	        allowedFileExtensions: ["jpg", "gif", "png", "txt", "pdf"],
	        initialCaption: "No file selected",
	        previewZoomButtonClasses: previewZoomButtonClasses,
	        previewZoomButtonIcons: previewZoomButtonIcons,
	        fileActionSettings: fileActionSettings,

	        // browseLabel: 'Browse',
	        

	        // maxFilesNum: 10,
	        
	        // previewZoomButtonClasses: previewZoomButtonClasses,
	        // previewZoomButtonIcons: previewZoomButtonIcons,
	        // fileActionSettings: fileActionSettings
	    });

	    // ------------------------------
	    
	    // ------------------------------

	  //   $(".file-input-ajax").fileinput({
	  //       uploadUrl: "http://localhost", // server upload action
	  //       uploadAsync: true,
	  //       maxFileCount: 5,
	  //       initialPreview: eso,
	  //       fileActionSettings: {
	  //       	    browseLabel: 'Browse',
	  //       browseIcon: '<i class="icon-file-plus"></i>',
	  //       uploadIcon: '<i class="icon-file-upload2"></i>',
	  //       // removeIcon: '<i class="icon-cross3"></i>',


	  //           removeIcon: '<i class="icon-bin"></i>',
	  //           removeClass: 'btn btn-link btn-xs btn-icon',
	  //           uploadIcon: '<i class="icon-upload"></i>',
	  //           uploadClass: 'btn btn-link btn-xs btn-icon',
	  //           indicatorNew: '<i class="icon-file-plus text-slate"></i>',
	  //           indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
	  //           indicatorError: '<i class="icon-cross2 text-danger"></i>',
	  //           indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
	  //       },
			// initialPreviewConfig: [
	  //           {caption: "Jane.jpg", size: 930321, key: 1, showDrag: false},
	  //           {caption: "Anna.jpg", size: 1218822, key: 2, showDrag: false}
	  //       ],
	  //       initialPreviewAsData: true,
	  //       layoutTemplates: {
	  //           icon: '<i class="icon-file-check"></i>',
	  //           modal: modalTemplate
	  //       },
	  //           overwriteInitial: false,
	  //       initialCaption: "Ningun archivo seleccionado",
	  //       previewZoomButtonClasses: previewZoomButtonClasses,
	  //       previewZoomButtonIcons: previewZoomButtonIcons
	  //   });
	}

	function reload_table()
	{
	    table.ajax.reload(null,false); //reload datatable ajax 
	}

	$.get('<?php echo base_url('cprincipal/datos_user') ?>', function(data) {
				// alert(data);
				var fr = $.parseJSON(data);				
					$('#nomuser').text(fr[0]['nombres']+' '+fr[0]['apellidos']);
					$('#nom_user').text(fr[0]['nombres']+' '+fr[0]['apellidos']);
					$('#nom_cargo').text(fr[0]['detallecargo']);
					$('#nombrefunc').text(fr[0]['nombres']);
					$('#apellidofunc').text(fr[0]['apellidos']);
					$('#telefonofunc').text(fr[0]['telefono']);
					$('#celularfunc').text(fr[0]['celular']);
					$('#direccfunc').text(fr[0]['direccion']); 					
			});
</script>