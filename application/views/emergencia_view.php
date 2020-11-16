
<!-- BUSQUEDA DEL ABONADO -->
<div class="panel panel-flat border-top-success-800 bg-success-300 text-default">
	<div class="panel-heading">
        <h5 class="panel-title">BUSQUEDA DEL USUARIO</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>
	<!-- <h1><?php // echo $_SESSION['id_persona'] ?></h1> -->
	<!-- ............................................... -->
	<form id="form_abonado">
        <div class="panel-body ">
	    	<div class="row">
	    		<div class="col-md-6">
					<div class="form-group">
			    		<label>
			        	<input type="radio" id="campo" name="campo" class="styled border-success text-success-600" value="codigousuario" checked>
			        	Codigo Usuario<br>
			    		</label>
			    		<label>
			        	<input  type="radio" id="campo" name="campo" class="styled border-success text-success-600" value="numerocuenta">
			        	Numero de Cuenta
			    		</label>
			    		<label>
			        	<input  type="radio" id="campo" name="campo" class="styled border-success text-success-600" value="nombre">
			        	Nombres 
			    		</label>
			    		<label>
			        	<input  type="radio" id="campo" name="campo" class="styled border-success text-success-600" value="ci">
			        	Cedula de Identidad 
			    		</label>
					</div>
				</div>
			</div>
            <div class="row">
                <div class="col-md-8">
                	<div class="form-group">
                		<label for="nombre">Codigo o número de cuenta:</label>
                		<input type="text" class="form-control border-success border-lg"  id="nombre" name="nombre" placeholder="Datos a Buscar" required>
                	</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                	<div class="form-group">
						<div class="col-md-6">
		                    <button type="button" id="btnbuscarabonado" class="btn btn-success btn-labeled btn-xlg" id="nombre" name="nombre">
		                        <b><i class="icon-search4"></i></b> Buscar
		                    </button>
			            </div>
                	</div>
                </div>
            </div>
        </div>
    </form>
    
    <div id="abonadores" class="panel-body">
	</div>
</div>
<!-- BUSQUEDA DEL ABONADO FIN -->

<!-- GUSQUEDA DE LA PERSONA -->
<div class="panel panel-flat border-top-success-800 bg-success-300 text-default">
    <div class="panel-heading">
        <h5 class="panel-title">BUSCAR PERSONA </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" id="form_persona">
            <div class="form-group">
                <label class="control-label col-lg-2">Carnet de Identidad: </label>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control border-success border-lg"  id="ci" name="ci" required>
                                <div class="form-control-feedback">
                                    <i class="icon-search4 text-size-base"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <button type="button" id="btnBuscarPersona" class="btn btn-success btn-labeled btn-xlg" name="nombre">
                                    <b><i class="icon-search4"></i></b> Buscar Persona
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
		<div id="reclamante">
		</div>
    </div>
</div>

<div id="reclamantevacio">
</div>
<!-- BUSQUEDA DE LA PERSONA FIN -->


<!-- registro del reclamo -->
<div class="panel panel-flat border-top-success-800 bg-success-300 text-default">
	<div class="panel-heading">
        <h5 class="panel-title">REGISTRO DEL RECLAMO</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>
	<form action="" id="form_reclamo">
	    <div class="panel-body">
	    	<div class="row">
	    		<div class="col-md-4">
	    			<div class="form-group">
						<label>Numero de reclamo: </label>
	                	<input type="text" class="form-control border-success border-lg" id="numero" name="numero" readonly="true">
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Persona que reclama: </label>
						<input type="hidden" id="id_persona" name="id_persona">
	                	<input type="text" id="nombrereclamante" class="form-control border-success border-lg" disabled></input>
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Dueño de medidor: </label>
						<input type="hidden" id="id_abonado" name="id_abonado">
	                	<input type="text" class="form-control border-success border-lg" id="nombresabonado" disabled>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Forma de Reclamo</label>
	                	<select id="formareclamo" name="formareclamo" class="form-control border-success border-lg">
							<option value="">Seleccione...</option>
                        </select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="text-semibold">TIPO DE RECLAMO</label>
						<select id="tiporeclamo" name="tiporeclamo" class="form-control border-success border-lg">
							<option value="">Seleccione...</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Clase de reclamo</label>
	                	<select id="clasereclamo" name="clasereclamo" class="form-control border-success border-lg">
							<option value="">Seleccione...</option>
                        </select>
					</div>
				</div>
	    		
				
			</div>
			<div class="row">
	    		<div class="col-md-4">
	    			<div class="form-group">
						<label>Fecha de Reclamo: </label>
	                	<input type="text" class="form-control border-success border-lg datetimepicker" id="fechareclamo" name="fechareclamo" value="" placeholder="99-99-9999" readonly="true">
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Fecha Aproximada de Respuesta: </label>
	                	<input type="text" class="form-control border-success border-lg datetimepicker" id="fecharespuesta" name="fecharespuesta" placeholder="99-99-9999" readonly="true">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="content-group">
						<label>Motivo: </label>
						<div class="form-group">
							<textarea rows="4" cols="1" id="motivo" name="motivo" class="form-control border-success border-lg elastic text-uppercase" placeholder="Motivos por el que reclama"></textarea>
						</div>
					</div>
				</div>
				<input type="hidden" class="form-control" id="estadoreclamo" name="estadoreclamo" value="0">
				<input type="hidden" class="form-control" id="id_funcionario" name="id_funcionario" value="<?php echo $_SESSION['id_persona'] ?>">
			</div>
			<div class="row">
				<div class="text-center">
					<button type="submit" id="btnSave" class="btn bg-teal-400">Guardar <i class="icon-arrow-right14 position-right"></i></button>
				</div>
			</div>
	    </div>
	</form>
</div>
<!-- registro del reclamo -->

<!-- ......................... -->
<!-- Highlighting rows and columns -->
<div class="panel panel-flat bg-info-300 text-default">
	<div class="panel-heading">
		<h5 class="panel-title">LISTA DE RECLAMOS</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>

	<table id="tabla" class="table datatable-basic dataTable no-footer">
		<thead>
			<tr>
				<th>Numero</th>
				<th>Fech. Reclamo</th>
				<th>Fech. Respuesta</th>
				<!-- <th>Motivo</th> -->
				<th>Persona</th>
				<th>Abonado</th>
				<th>Clase Reclamo</th>
				<th>Forma Reclamo</th>
				<th>Tipo Reclamo</th>
				<th class="text-center">Actions</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<!-- /highlighting rows and columns -->



<!-- modal de editar reclamo -->
<div id="modal_theme_success" class="modal fade">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h6 class="modal-title">Success header</h6>
			</div>

			<div class="modal-body">
				<form action="" id="form_reclamomodal">
				    <div class="">
				    	<div class="row">
				    		<input type="hidden" class="form-control" id="id_reclamomodal" name="id_reclamomodal">
				    		<div class="col-md-4">
				    			<div class="form-group">
									<label>Numero de reclamo: </label>
									<input type="text" class="form-control border-success border-lg" id="numeromodal" name="numeromodal" disabled>
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Persona que reclama: </label>
									<input type="text" class="form-control border-success border-lg" id="id_personamodal" name="id_personamodal" disabled>
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Dueño de medidor: </label>
									<input type="text" class="form-control border-success border-lg" id="id_abonadomodal" name="id_abonadomodal" disabled>
				                	<!-- <input type="text" class="form-control" id="nombresabonado" placeholder=""> -->
								</div>
							</div>
						</div>
						<div class="row">
				    		<div class="col-md-4">
				    			<div class="form-group">
									<label>Forma de Reclamo</label>
				                	<select id="formareclamomodal" name="formareclamomodal" class="form-control border-success border-lg">
										<option value="">Seleccione...</option>
			                        </select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Tipo de reclamo</label>
									<select id="tiporeclamomodal" name="tiporeclamomodal" class="form-control border-success border-lg">
										<option value="">Seleccione...</option>
			                        </select>
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Clase de reclamo</label>
				                	<select id="clasereclamomodal" name="clasereclamomodal" class="form-control border-success border-lg">
										<option value="">Seleccione...</option>
			                        </select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Fecha de Reclamo: </label>
				                	<input type="text" class="form-control datetimepicker border-success border-lg" id="fechareclamomodal" name="fechareclamomodal" placeholder="99-99-9999" disabled>
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Fecha Aproximada de Respuesta: </label>
				                	<input type="text" class="form-control datetimepicker border-success border-lg" id="fecharespuestamodal" name="fecharespuestamodal" placeholder="99-99-9999" disabled>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="content-group">
									<label>Motivo: </label>
									<div class="form-group">
										<textarea rows="1" cols="1" id="motivomodal" name="motivomodal" class="form-control text-uppercase elastic border-success border-lg" placeholder="Motivos por el que reclama"></textarea>
									</div>
								</div>
							</div>
							<input type="hidden" class="form-control" id="estadoreclamomodal" name="estadoreclamomodal" value="0">
							<input type="hidden" class="form-control" id="id_funcionariomodal" name="id_funcionariomodal" value="<?php echo $_SESSION['user_id'] ?>">
						</div>
				    </div>
				</form>
			</div>

			<div class="modal-footer">
				<button id="btnCerrarmodal" type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
				<button id="btnSaveReclamomodal" type="button" onclick="update_reclamomodal()" class="btn btn-success">Guardar cambios</button>
			</div>
		</div>
	</div>
</div>
<!-- modal de editar reclamo -->



<script type="text/javascript">

	var save_method; //for save method string
	var table;

	$(document).ready(function() {
		// añadir persona
		$("body").on("submit", "#form_persona_nuevo", function(e){
            e.preventDefault();
            $.ajax({
				url: "<?php echo base_url('persona/ajax_add')?>",
				type: "POST",
				dataType: 'JSON',
				data: $('#form_persona_nuevo').serialize(),
				success: function(d) {
					if (d.status) {
						alert('Los datos fueron guardados correctamente');
						$('#id_persona').val(d.persona.id_persona);
                    	$('#nombrereclamante').val(d.persona.nombres+' '+d.persona.apellidos);

					}
					else {
						alert("Error al guardar los datos");
					}
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
				    alert('Error al insertar los datos');
				}
			});
        });

        $("body").on("submit", "#form_persona_actualizar", function(e){
            e.preventDefault();
            $.ajax({
				url: "<?php echo base_url('persona/ajax_update')?>",
				type: "POST",
				dataType: 'JSON',
				data: $('#form_persona_actualizar').serialize(),
				success: function(d) {
					if (d.status) {
						alert('Los datos fueron actualizados');
						cod_num = $('#cod').val();

						$('#id_persona').val(cod_num);
                    	$('#nombrereclamante').val(d.persona.nombres+' '+d.persona.apellidos);

					}
					else {
						alert("Error al guardar los datos");
					}
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
				    alert('Error al insertar los datos');
				}
			});
        });

		numero();
		table = $('#tabla').DataTable({
			"searching": false,
			"destroy": true,
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.

	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            // "url": "<?php echo site_url('Odeco/ajax_list')?>",
	            "url": "<?php echo site_url('CEmergencia/ajax_listvista')?>",
	            "type": "POST"
	        },

	        //Set column definition initialisation properties.
	        "columnDefs": [{ 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        }],
	    });

		

	    $('.datetimepicker').datetimepicker({
            autoclose: true,
            // format: "yyyy-mm-dd hh:ii:ss",
            format: "dd-mm-yyyy hh:ii:ss",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true
            // pickTime: true,
        });

		var f = toDate(Date());
		f.setDate(f.getDate()); 
		// console.log(f);
		$('input#fechareclamo').val(f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear() +' '+ f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds());

		function toDate(fecha) {
	    	return new Date(fecha.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3") );
		}

		// busqueda de persona
		$("#ci").keydown(function(event) {
		    if (event.keyCode == 13) {
		        event.preventDefault();
		        searcpersona()
		        return false;
		    }
		});
		$('#btnBuscarPersona').click(function(){
			searcpersona();
		});

		function searcpersona() {
			var parametros = {
				"ci" : $('#ci').val(),
			};
			$.ajax({
				url: ' <?php echo base_url('persona/personaci') ?> ',
				type: 'POST',
				dataType: 'JSON',
				data: parametros,
				success: function(persona, ui) {
					var personahtml = '';
                    var alerta = '';
                    // var persona = $.parseJSON(persona);
                    console.log(persona);
                    if (persona) {
                    	personahtml += 
						'<div class="panel panel-body">'+
					        '<form id="form_persona_actualizar">'+
					            '<div class="row">'+
					                '<div class="col-md-4">'+
					                    '<div class="form-group">'+
					                        // '<label class="form-control bg-success" id="id_persona" name="id_persona">'+persona.id_persona+'</label>'+
					                        '<label>Nombres: </label>'+
					                        '<input id="nombres" name="nombres" value="'+persona.nombres+'" class="form-control bg-success" type="text">'+

					                        
					                        // '<label class="form-control bg-success">'+persona.nombres+'</label>'+
					                    '</div>'+
					                '</div>'+
					                '<div class="col-md-4">'+
					                    '<div class="form-group">'+
					                        '<label>Apellidos: </label>'+
					                        '<input id="apellidos" name="apellidos" value="'+persona.apellidos+'" class="form-control bg-success" type="text">'+
					                        '<input id="cod" name="cod" value="'+persona.id_persona+'" class="form-control bg-success" type="hidden">'+
					                        // '<label class="form-control bg-success">'+persona.apellidos+'</label>'+
					                    '</div>'+
					                '</div>'+
					                '<div class="col-md-4">'+
					                    '<div class="form-group">'+
					                        '<label>Carnet de Indentiad: </label>'+
					                        '<input id="ci" name="ci" value="'+persona.ci+'" class="form-control bg-success" type="text" >'+
					                        // '<label class="form-control bg-success">'+persona.ci+'</label>'+
					                    '</div>'+
					                '</div>'+
					            '</div>'+
					            '<div class="row">'+
					                '<div class="col-md-4">'+
					                    '<div class="form-group">'+
					                        '<label>Direccion: </label>'+
					                        '<input id="direccion" name="direccion" value="'+persona.direccion+'" class="form-control bg-success" type="text">'+
					                        // '<label class="form-control bg-success">'+persona.direccion+'</label>'+
					                    '</div>'+
					                '</div>'+
					                '<div class="col-md-4">'+
					                    '<div class="form-group">'+
					                        '<label>Teléfono: </label>'+
					                        '<input id="telefono" name="telefono" value="'+persona.telefono+'" class="form-control bg-success" type="text">'+
					                        // '<label class="form-control bg-success">'+persona.telefono+'</label>'+
					                    '</div>'+
					                '</div>'+
					                '<div class="col-md-4">'+
					                    '<div class="form-group">'+
					                        '<label>Celular: </label>'+
					                        '<input id="celular" name="celular" value="'+persona.celular+'" class="form-control bg-success" type="text">'+
					                        // '<label class="form-control bg-success">'+persona.celular+'</label>'+
					                    '</div>'+
					                '</div>'+
					            '</div>'+
					            '<div class="row">'+
					                '<div class="col-md-4">'+
					                    '<div class="form-group">'+
					                        '<label>NIT: </label>'+
					                        '<input id="nit" name="nit" value="'+persona.nit+'" class="form-control bg-success" type="text">'+
					                        // '<label class="form-control bg-success">'+persona.nit+'</label>'+
					                    '</div>'+
					                '</div>'+
					            '</div>'+
					            '<div class="text-center">'+
						                '<button id="actualizarpersona" class="btn btn-primary">Actualizar persona <i class="icon-arrow-right14 position-right"></i></button>'+
						            '</div>'+
					        '</form>'+
					    '</div>';
                    	$('#reclamante').html(personahtml);
                    	$('#reclamantevacio').html('');
                    	$('#id_persona').val($('#cod').val());
                    	$('#nombrereclamante').val($('#nombres').val()+' '+$('#apellidos').val());
                    } else {
                    	alerta +=
                    	'<div class="alert bg-info alert-styled-right">'+
							'<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>'+
							'<span class="text-semibold">Registros no encontrados. INGRESE DATOS DE LA PERSONA</span>'+
						'</div>';
                    	personahtml += 
                    	'<div class="panel panel-flat border-top-success-800">'+
						    '<div class="panel-heading">'+
						        '<h5 class="panel-title">INGRESE DATOS DE LA NUEVA PERSONA</h5>'+
						        '<div class="heading-elements">'+
						            '<ul class="icons-list">'+
						                '<li><a data-action="collapse"></a></li>'+
						                '<li><a data-action="reload"></a></li>'+
						            '</ul>'+
						        '</div>'+
						    '</div>'+
						    '<div class="panel-body">'+
						        '<form id="form_persona_nuevo">'+
						            '<div class="row">'+
						                '<div class="col-md-4">'+
						                    '<div class="form-group">'+
						                        '<label>Nombres: </label>'+
						                        '<input id="nombres" name="nombres" class="form-control bg-success-300 text-default border-success-800 border-lg" type="text">'+
						                    '</div>'+
						                '</div>'+
						                '<div class="col-md-4">'+
						                    '<div class="form-group">'+
						                        '<label>Apellidos: </label>'+
						                        '<input id="apellidos" name="apellidos" class="form-control bg-success-300 text-default border-success-800 border-lg" type="text">'+
						                    '</div>'+
						                '</div>'+
						                '<div class="col-md-4">'+
						                    '<div class="form-group">'+
						                        '<label>Carnet de Indentiad: </label>'+
						                        '<input id="ci" name="ci" class="form-control bg-success-300 text-default border-success-800 border-lg" type="text">'+
						                    '</div>'+
						                '</div>'+
						            '</div>'+
						            '<div class="row">'+
						                '<div class="col-md-4">'+
						                    '<div class="form-group">'+
						                        '<label>Direccion: </label>'+
						                        '<input id="direccion" name="direccion" class="form-control bg-success-300 text-default border-success-800 border-lg" type="text">'+
						                    '</div>'+
						                '</div>'+
						                '<div class="col-md-4">'+
						                    '<div class="form-group">'+
						                        '<label>Teléfono: </label>'+
						                        '<input id="telefono" name="telefono" class="form-control bg-success-300 text-default border-success-800 border-lg" type="text">'+
						                    '</div>'+
						                '</div>'+
						                '<div class="col-md-4">'+
						                    '<div class="form-group">'+
						                        '<label>Celular: </label>'+
						                        '<input id="celular" name="celular" class="form-control bg-success-300 text-default border-success-800 border-lg" type="text">'+
						                    '</div>'+
						                '</div>'+
						            '</div>'+
						            '<div class="row">'+
						                '<div class="col-md-4">'+
						                    '<div class="form-group">'+
						                        '<label>NIT: </label>'+
						                        '<input id="nit" name="nit" class="form-control bg-success-300 text-default border-success-800 border-lg" type="text">'+
						                    '</div>'+
						                '</div>'+
						            '</div>'+
						            '<div class="text-center">'+
						                '<button id="guarpersona" class="btn btn-primary">Guardar persona <i class="icon-arrow-right14 position-right"></i></button>'+
						            '</div>'+
						        '</form>'+
						    '</div>'+
						'</div>';
						$('#reclamantevacio').html(personahtml);
                    	$('#reclamante').html('');
                    	$('#reclamante').html(alerta);
                    }
				}
			});
		}
		

		// busqueda de Abonado 
		$('#btnbuscarabonado').click(function(){
		    makeAjaxRequest();
		});
		$("input#nombre").keydown(function(event) {
		    if (event.keyCode == 13) {
		        event.preventDefault();
		        makeAjaxRequest()
		        return false;
		    }
		});
		function makeAjaxRequest() {
		    var parametros = {
		        "name" : $('input#nombre').val(),
		        "campo": $('input[name=campo]:checked','#form_abonado').val(),
		    };
		    $.ajax({
		        url: '<?php echo base_url()?>Persona/searchh',
		        type: 'get',
		        data: parametros,
		        success: function(response) {
		            $('#abonadores').html(response);
		            $('#id_abonado').val($('#id_abonadobusq').val())
		            $('#nombresabonado').val($('#nombresbusq').val())
		        }
		    });
		}
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		    checkboxClass: 'icheckbox_minimal-blue',
		    radioClass: 'iradio_minimal-blue'
		});	

	});

	function toDate(fecha) {
		return new Date(fecha.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3") );
	}

	function edit_reclamo(id)
	{
		$("#form_reclamomodal").get(0).reset()
	    cargarselectmodal();

	    $.ajax({
	        url : "<?php echo site_url('Cemergencia/ajax_edit_reclamo/')?>" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(datosreclamo)
	        {
	            $('[name="id_reclamomodal"]').val(datosreclamo.id_reclamo);
	            $('[name="numeromodal"]').val(datosreclamo.numero);
	            $('[name="id_personamodal"]').val(datosreclamo.id_persona);
	            $('[name="id_abonadomodal"]').val(datosreclamo.id_abonado);
	            $('[name="formareclamomodal"]').val(datosreclamo.id_formareclamo);
				$('[name="tiporeclamomodal"]').val(datosreclamo.id_tiporeclamo);
	            $('[name="clasereclamomodal"]').val(datosreclamo.id_clasereclamo);
	            $('[name="fechareclamomodal"]').datetimepicker('update',datosreclamo.fechareclamo);
	            $('[name="fecharespuestamodal"]').datetimepicker('update',datosreclamo.fecharespuesta);
	            $('[name="motivomodal"]').val(datosreclamo.motivo);

	            $('#modal_theme_success').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Editar Reclamo'); // Set title to Bootstrap modal title
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error al obtener los datos');
	        }
	    });
	}

	function reload_table()
	{
	    table.ajax.reload(null,false); //reload datatable ajax 
	}

	function update_reclamomodal()
	{
    	// ajax adding data to database
	    $.ajax({
	        url : "<?php echo site_url('Cemergencia/ajax_update_reclamo')?>",
	        type: "POST",
	        data: $('#form_reclamomodal').serialize(),
	        dataType: "JSON",
	        success: function(data)
	        {

	            if(data.status) //if success close modal and reload ajax table
	            {
	                $('#modal_theme_success').modal('hide');
	                reload_table();
	                alert('Los Datos fueron actualizados correctamente');
	            }
	            else
	            {
	            }
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
				alert('Error al actualizar los datos');
	        }
	    });
	}

	function delete_person(id)
	{
	    if(confirm('Are you sure delete this data?'))
	    {
	        // ajax delete data to database
	        $.ajax({
	            url : "<?php echo site_url('person/ajax_delete')?>/"+id,
	            type: "POST",
	            dataType: "JSON",
	            success: function(data)
	            {
	                //if success reload ajax table
	                $('#modal_form').modal('hide');
	                reload_table();
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error deleting data');
	            }
	        });

	    }
	}
	
	$.get('<?php echo base_url('Cemergencia/get_clasereclamo') ?>', function(data) {
		var cr = JSON.parse(data);
		$.each(cr, function(index, val) {
			$('#clasereclamo').append('<option value="'+val.id_clasereclamo+'">'+val.nombreclase+'</option>');
		});
	});
	$.get('<?php echo base_url('Cemergencia/get_formareclamo') ?>', function(data) {
		var fr = $.parseJSON(data);
		$.each(fr, function(index, val) {
			$('#formareclamo').append('<option value="'+val.id_formareclamo+'">'+val.nombreforma+'</option>');
		});
	});
	$.get('<?php echo base_url('Cemergencia/get_tiporeclamo')?>', function(data) {
		var tr = $.parseJSON(data);
		$.each(tr, function(index, val) {
			$('#tiporeclamo').append('<option value="'+val.id_tiporeclamo+'">'+val.nombretiporeclamo+'</option>');
		});
	});

	function cargarselectmodal() {
		$.get('<?php echo base_url('CEmergencia/get_clasereclamo') ?>', function(data) {
			var cr = JSON.parse(data);
			$.each(cr, function(index, val) {
				$('#clasereclamomodal').append('<option value="'+val.id_clasereclamo+'">'+val.nombreclase+'</option>');
			});
		});
		$.get('<?php echo base_url('CEmergencia/get_formareclamo') ?>', function(data) {
			var fr = $.parseJSON(data);
			$.each(fr, function(index, val) {
				$('#formareclamomodal').append('<option value="'+val.id_formareclamo+'">'+val.nombreforma+'</option>');
			});
		});
		$.get('<?php echo base_url('CEmergencia/get_tiporeclamo')?>', function(data) {
			var tr = $.parseJSON(data);
			$.each(tr, function(index, val) {
				$('#tiporeclamomodal').append('<option value="'+val.id_tiporeclamo+'">'+val.nombretiporeclamo+'</option>');
			});
		});
	}

	// funciones para modificar en reclamo
	function fecha(dias){
		var f = toDate(Date());
		// console.log(f);
		$('input#fechareclamo').val(f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear() +' '+ f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds());

		f.setDate(f.getDate()+dias);
		$('input#fecharespuesta').val(f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear() +' '+ f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds());
	}

	$('#tiporeclamo').change(function(e) {
		var idtr = $(this).val();
		// console.log('tiporeclamo: '+idtr);
		if ($(this).val() == '2' || $(this).val() == '3' ) { //|| $(this).val() == '1'
			$('#clasereclamo').val(2);
			fecha(3);
		} else {
			fecha(15);
		}
		if ($(this).val() == '1' || $(this).val() == '4' || $(this).val() == '5') {
			$('#clasereclamo').val(2);
			fecha(15);
		}
	});

	$('#clasereclamo').change(function(event) {
		if (($('#tiporeclamo').val() == '2' || $('#tiporeclamo').val() == '3') && ($(this).val() == '2')) {
			fecha(3);
		} else {
			if (($('#tiporeclamo').val() == '1' || $('#tiporeclamo').val() == '4' || $('#tiporeclamo').val() == '5') && ($(this).val() == '2')) {
				fecha(15);
			} else {
				fecha(1);
			}
		}
	});

	// esto para el formulario modificar 
	function fechamodal(dias){
		var f = toDate(Date());
		// console.log(f);
		$('input#fechareclamomodal').val(f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear() +' '+ f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds());

		f.setDate(f.getDate()+dias);
		$('input#fecharespuestamodal').val(f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear() +' '+ f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds());
	}

	$('#tiporeclamomodal').change(function(e) {
		var idtr = $(this).val();
		console.log('tiporeclamomodal: '+idtr);
		if ($(this).val() == '2' || $(this).val() == '3' ) { //|| $(this).val() == '1'
			$('#clasereclamomodal').val(2);
			fechamodal(3);
		} else {
			fechamodal(15);
		}
		if ($(this).val() == '1' || $(this).val() == '4' ) {
			$('#clasereclamomodal').val(2);
			fechamodal(15);
		}
	});

	$('#clasereclamomodal').change(function(event) {
		if (($('#tiporeclamomodal').val() == '2' || $('#tiporeclamomodal').val() == '3') && ($(this).val() == '2')) {
			fechamodal(3);
		} else {
			if (($('#tiporeclamomodal').val() == '1' || $('#tiporeclamomodal').val() == '4') && ($(this).val() == '2')) {
				fechamodal(15);
			} else {
				fechamodal(1);
			}
		}
	});

	function numero () {
		$.get('<?php echo base_url('Cemergencia/get_numeroreclamo') ?>', function(data) {
			var nr = $.parseJSON(data);
			var f = toDate(Date());
			// $('#numero').val(nr[0].numero + 1+'/'+f.getFullYear());
			$('#numero').val(nr['numero'] + 1);
		});
	}

	// create function para busqueda del abonado
	$('#nombresabonado').autocomplete({
        minLength: 0,
        source: '<?php echo base_url("Cemergencia/get_abonado_by_cuentausuario") ?>',
        focus: function( event, ui ) {
            $( "#nombresabonado" ).val( ui.item.numerocuenta );
            return false;
        },
        select: function( event, ui ) {
            $( "#id_abonado" ).val( ui.item.id_abonado );
            $( "#nombresabonado" ).val( ui.item.nombres +' '+ ui.item.apellidos );

            return false;
        }
    }).autocomplete('instance')._renderItem = function(ul, item) {
        return $( "<li>" )
        .append( "<div>" + item.nombres + "<br>" + item.apellidos + "</div>" )
        .appendTo( ul );
    };

	$("#form_reclamo").on("submit", function(event) {
		event.preventDefault();
		$.ajax({
			url: "<?php echo base_url('Cemergencia/ajax_add_reclamo')?>",
			type: "post",
			dataType: 'JSON',
			data: $(this).serialize(),
			success: function(d) {
				if (d.status) {
					alert('Los datos fueron guardados correctamente');
					numero();
					rep_reclamo();
					reload_table();
					setInterval('cerrar()', 20000); 
					
					// window.location.assign('" + site_url("/controller/method") + "')
					// redirect('Cprincipal', 'refresh');

				}
				else {
					alert("Error al guardar los datos");
				}
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
			    alert('Error al insertar los datos');
			}
		});
	});

	function cerrar(){
		window.location.href='<?php echo base_url() ?>Cprincipal';
	}

	function rep_reclamo(){
		var altura=500;
		var anchura=700;
		cod_reclamo = $('#nombre').val();
		var y=parseInt((window.screen.height/2)-(altura/2));
		var x=parseInt((window.screen.width/2)-(anchura/2));
		// console.log(cod_reclamo);
 		window.open("<?php echo site_url('rep_emergencia/reporte/')?>" + cod_reclamo, "Reporte reclamo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=yes, width=acnhura, height=altura, top=y,left=x");
	};

	// // añade nueva persona en odeco
	// $("form#form_persona_nuevo").on("submit", function(event) {
	// 	event.preventDefault();
	// 	$.ajax({
	// 		url: "<?php echo base_url('persona/ajax_add')?>",
	// 		type: "post",
	// 		dataType: 'JSON',
	// 		data: $(this).serialize(),
	// 		success: function(d) {
	// 			if (d.status) {
	// 				alert('Los datos fueron guardados correctamente');
	// 			}
	// 			else {
	// 				alert("Error al guardar los datos");
	// 			}
	// 		},
	// 		error: function (jqXHR, textStatus, errorThrown)
	// 		{
	// 		    alert('Error al insertar los datos');
	// 		}
	// 	});
	// });

	$("#form_reclamomodal").on("submit", function(event) {
		event.preventDefault();
		var selected = [];
		$(":checkbox[id=subreclamomodal]").each(function() {
			if (this.checked) {
				selected.push($(this).val());
			}
		});
		if (!selected.length) {
			alert('Debes seleccionar al menos una opción.');
		}
		$.ajax({
			url: "<?php echo base_url('CEmergencia/ajax_add_reclamo')?>",
			type: "post",
			dataType: 'JSON',
			data: $(this).serialize(),
			success: function(d) {
				alert('Los datos fueron actualizados correctamente');
				// numero();
				reload_table();
			},
			error: function (jqXHR, textStatus, errorThrown){
				alert('Error al actualizar los datos');
			}
		});
	});

</script>