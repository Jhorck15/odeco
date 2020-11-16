
<!-- BUSQUEDA DEL ABONADO -->
<div class="panel panel-flat">
	<div class="panel-heading">
        <h5 class="panel-title">BUSQUEDA DEL USUARIO</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>
	<!-- ............................................... -->
	<form id="form_abonado">
        <div class="panel-body">
	    	<div class="row">
	    		<div class="col-md-4">
					<div class="form-group">
			    		<label>
			        	<input type="radio" id="campo" name="campo" class="styled border-success text-success-600" value="codigousuario" checked>
			        	Codigo Usuario<br>
			    		</label>
			    		<label>
			        	<input  type="radio" id="campo" name="campo" class="styled border-success text-success-600" value="numerocuenta">
			        	Numero de Cuenta
			    		</label>
					</div>
				</div>
			</div>
            <div class="row">
                <div class="col-md-8">
                	<div class="form-group">
                		<label for="nombre">Datos:</label>
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
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">BÚSCAR PERSONA </h5>
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
<div class="panel panel-flat">
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
	                	<input type="text" class="form-control border-success border-lg" id="numero" name="numero" placeholder="99/99/9999">
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Persona que reclama: </label>
						<input type="text" id="id_persona" name="id_persona">
	                	<input type="text" id="nombrereclamante" class="form-control border-success border-lg" value="" placeholder="99/99/9999"></input>
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Dueño de medidor: </label>
						<input type="text" id="id_abonado" name="id_abonado">
	                	<input type="text" class="form-control border-success border-lg" id="nombresabonado" placeholder="">
					</div>
				</div>
			</div>
			<div class="row">
	    		<div class="col-md-4">
	    			<div class="form-group">
						<label>Fecha de Reclamo: </label>
	                	<input type="text" class="form-control border-success border-lg datetimepicker" id="fechareclamo" name="fechareclamo" placeholder="99-99-9999">
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Fecha Aproximada de Respuesta: </label>
	                	<input type="text" class="form-control border-success border-lg datetimepicker" id="fecharespuesta" name="fecharespuesta" placeholder="99/99-9999">
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
						<label>Forma de Reclamo</label>
	                	<select id="formareclamo" name="formareclamo" class="form-control border-success border-lg">
                                <option value="">Seleccione...</option>
                        </select>
					</div>
				</div>
				<div class="col-md-8">
					<div class="content-group">
						<label>Motivo: </label>
						<div class="form-group">
							<textarea rows="1" cols="1" id="motivo" name="motivo" class="form-control border-success border-lg elastic text-uppercase" placeholder="Motivos por el que reclama"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="content-group-lg panel panel-body border-top-success">
						<h6 class="text-semibold">TIPO DE RECLAMO</h6>
						<select id="tiporeclamo" name="tiporeclamo" class="form-control border-success border-lg">
							<option value="">Seleccione...</option>
                        </select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="content-group-lg panel panel-body border-top-success">
						<h6 class="text-semibold">SUBTIPOS</h6>
						<div id="subreclamohtml" name="subreclamohtml" class="checkbox checkbox-switchery switchery-lg">
						</div>
					</div>
				</div>
				<input type="text" class="form-control" id="estadoreclamo" name="estadoreclamo" value="0">
				<input type="text" class="form-control" id="id_funcionario" name="id_funcionario" value="<?php echo $_SESSION['user_id'] ?>">
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
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">RECLAMOS</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>

	<table class="table">
		<thead>
			<tr>
				<th>Numero</th>
				<th>Fech. Reclamo</th>
				<th>Fech. Respuesta</th>
				<th>Motivo</th>
				<th>Persona</th>
				<th>Abonado</th>
				<th>Clase Reclamo</th>
				<th>Forma Reclamo</th>
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
				    		<input type="text" class="form-control" id="id_reclamo" name="id_reclamo">
				    		<div class="col-md-4">
				    			<div class="form-group">
									<label>Numero de reclamo: </label>
									<input type="text" id="numero" name="numero">
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Persona que reclama: </label>
									<input type="text" id="id_persona" name="id_persona" >
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Dueño de medidor: </label>
									<input type="text" id="id_abonado" name="id_abonado">
				                	<!-- <input type="text" class="form-control" id="nombresabonado" placeholder=""> -->
								</div>
							</div>
						</div>
						<div class="row">
				    		<div class="col-md-4">
				    			<div class="form-group">
									<label>Fecha de Reclamo: </label>
				                	<input type="text" class="form-control datetimepicker" id="fechareclamo" name="fechareclamo" placeholder="99-99-9999">
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Fecha Aproximada de Respuesta: </label>
				                	<input type="text" class="form-control datetimepicker" id="fecharespuesta" name="fecharespuesta" placeholder="99-99-9999">
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Clase de reclamo</label>
				                	<select id="clasereclamomodal" name="clasereclamomodal" class="form-control">
										<option value="">Seleccione...</option>
			                        </select>
								</div>
							</div>
						</div>
						<div class="row">
				    		<div class="col-md-4">
				    			<div class="form-group">
									<label>Forma de Reclamo</label>
				                	<select id="formareclamomodal" name="formareclamomodal" class="form-control">
										<option value="">Seleccione...</option>
			                        </select>
								</div>
							</div>
							<div class="col-md-8">
								<div class="content-group">
									<label>Motivo: </label>
									<div class="form-group">
										<textarea rows="1" cols="1" id="motivo" name="motivo" class="form-control text-uppercase elastic " placeholder="Motivos por el que reclama"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<!-- <div class="row">
							<div class="text-center">
								<button type="submit" id="btnSave" class="btn bg-teal-400">Guardar <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</div> -->
				    </div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
				<button id="btnSaveReclamo" type="button" onclick="save_reclamo()" class="btn btn-success">Guardar cambios</button>
			</div>
		</div>
	</div>
</div>
<!-- modal de editar reclamo -->



<script type="text/javascript">

	var save_method; //for save method string
	var table;

	$(document).ready(function() {

		numero();
		table = $('.table').DataTable({ 

	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.

	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('Odeco/ajax_list')?>",
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

  


		// $("#busqueda").keyup(function(e){	        
		// 	var ci = $(this).val();
		// 	console.log(ci);
		// 	$.ajax({
		// 		url: ' <?php echo base_url('persona/personaci') ?> ',
		// 		type: 'POST',
		// 		dataType: 'JSON',
		// 		data: {ci:+ci},
		// 		success: function(respuesta) {
		// 			console.log(respuesta);
		// 			// $('#mostrar').html(respuesta);
		// 		}
		// 	});
		// });


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
                    console.log(persona)
                    if (persona) {
                    	personahtml += 
						'<div class="panel-body">'+
					        // '<form action="">'+
					            '<div class="row">'+
					                '<div class="col-md-4">'+
					                    '<div class="form-group">'+
					                        '<input id="id_personabusq" name="id_personabusq" value="'+persona.id_persona+'" class="form-control" type="text">'+
					                        '<label>Nombres: </label>'+
					                        '<input id="nombres" name="nombres" value="'+persona.nombres+'" class="form-control" type="text">'+
					                    '</div>'+
					                '</div>'+
					                '<div class="col-md-4">'+
					                    '<div class="form-group">'+
					                        '<label>Apellidos: </label>'+
					                        '<input id="apellidos" name="apellidos" value="'+persona.apellidos+'" class="form-control" type="text">'+
					                    '</div>'+
					                '</div>'+
					                '<div class="col-md-4">'+
					                    '<div class="form-group">'+
					                        '<label>Carnet de Indentiad: </label>'+
					                        '<input id="ci" name="ci" value="'+persona.ci+'" class="form-control" type="text">'+
					                    '</div>'+
					                '</div>'+
					            '</div>'+
					            '<div class="row">'+
					                '<div class="col-md-4">'+
					                    '<div class="form-group">'+
					                        '<label>Direccion: </label>'+
					                        '<input id="direccion" name="direccion" value="'+persona.direccion+'" class="form-control" type="text">'+
					                    '</div>'+
					                '</div>'+
					                '<div class="col-md-4">'+
					                    '<div class="form-group">'+
					                        '<label>Teléfono: </label>'+
					                        '<input id="telfono" name="telfono" value="'+persona.telefono+'" class="form-control" type="text">'+
					                    '</div>'+
					                '</div>'+
					                '<div class="col-md-4">'+
					                    '<div class="form-group">'+
					                        '<label>Celular: </label>'+
					                        '<input id="celular" name="celular" value="'+persona.celular+'" class="form-control" type="text">'+
					                    '</div>'+
					                '</div>'+
					            '</div>'+
					            '<div class="row">'+
					                '<div class="col-md-4">'+
					                    '<div class="form-group">'+
					                        '<label>NIT: </label>'+
					                        '<input id="nit" name="nit" value="'+persona.nit+'" class="form-control" type="text">'+
					                    '</div>'+
					                '</div>'+
					            '</div>'+
					            // '<div class="text-right">'+
					            //     '<button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>'+
					            // '</div>'+
					        // '</form>'+
					    '</div>';
                    	$('#reclamante').html(personahtml);
                    	$('#reclamantevacio').html('');
                    	$('#id_persona').val($('#id_personabusq').val());
                    	$('#nombrereclamante').val($('#nombres').val()+' '+$('#apellidos').val());
                    } else {
                    	alerta +=
                    	'<div class="alert bg-info alert-styled-right">'+
							'<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>'+
							'<span class="text-semibold">Registros no encontrados. INGRESE DATOS DE LA PERSONA</span>'+
						'</div>';
                    	personahtml += 
                    	'<div class="panel panel-flat">'+
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
						        '<form action="#">'+
						            '<div class="row">'+
						                '<div class="col-md-4">'+
						                    '<div class="form-group">'+
						                        '<label>Nombres: </label>'+
						                        '<input id="nombres" name="nombres" class="form-control" type="text">'+
						                    '</div>'+
						                '</div>'+
						                '<div class="col-md-4">'+
						                    '<div class="form-group">'+
						                        '<label>Apellidos: </label>'+
						                        '<input id="apellidos" name="apellidos" class="form-control" type="text">'+
						                    '</div>'+
						                '</div>'+
						                '<div class="col-md-4">'+
						                    '<div class="form-group">'+
						                        '<label>Carnet de Indentiad: </label>'+
						                        '<input id="ci" name="ci" class="form-control" type="text">'+
						                    '</div>'+
						                '</div>'+
						            '</div>'+
						            '<div class="row">'+
						                '<div class="col-md-4">'+
						                    '<div class="form-group">'+
						                        '<label>Direccion: </label>'+
						                        '<input id="direccion" name="direccion" class="form-control" type="text">'+
						                    '</div>'+
						                '</div>'+
						                '<div class="col-md-4">'+
						                    '<div class="form-group">'+
						                        '<label>Teléfono: </label>'+
						                        '<input id="telfono" name="telfono" class="form-control" type="text">'+
						                    '</div>'+
						                '</div>'+
						                '<div class="col-md-4">'+
						                    '<div class="form-group">'+
						                        '<label>Celular: </label>'+
						                        '<input id="celular" name="celular" class="form-control" type="text">'+
						                    '</div>'+
						                '</div>'+
						            '</div>'+
						            '<div class="row">'+
						                '<div class="col-md-4">'+
						                    '<div class="form-group">'+
						                        '<label>NIT: </label>'+
						                        '<input id="nit" name="nit" class="form-control" type="text">'+
						                    '</div>'+
						                '</div>'+
						            '</div>'+
						            '<div class="text-center">'+
						                '<button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>'+
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



	// function add_person()
	// {
	//     save_method = 'add';
	//     $('#form_person')[0].reset(); // reset form on modals
	//     $('.form-group').removeClass('has-error'); // clear error class
	//     $('.help-block').empty(); // clear error string
	//     $('#modal_form').modal('show'); // show bootstrap modal
	//     $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
	// }

	function edit_reclamo(id)
	{
	    save_method = 'update';
	    $('#form_reclamo')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('odeco/ajax_edit_reclamo/')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {

	            $('[name="id_reclamo"]').val(data.id_reclamo);
	            $('[name="numero"]').val(data.numero);
	            $('[name="id_persona"]').val(data.id_persona);
	            $('[name="id_abonado"]').val(data.id_abonado);
	            $('[name="fechareclamo"]').datetimepicker('update',data.fechareclamo);
	            $('[name="fecharespuesta"]').datetimepicker('update',data.fecharespuesta);
	            $('[name="clasereclamomodal"]').val(data.clasereclamo);
	            $('[name="formareclamomodal"]').val(data.formareclamo);
	            $('[name="motivo"]').val(data.motivo);
	            $('#modal_theme_success').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Editar Reclamo'); // Set title to Bootstrap modal title

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}

	function reload_table()
	{
	    table.ajax.reload(null,false); //reload datatable ajax 
	}

	function save_reclamo()
	{
		// alert('hola');

	    // ajax adding data to database
	    $.ajax({
	        url : "<?php echo site_url('odeco/ajax_update')?>",
	        type: "POST",
	        data: $('#form_reclamomodal').serialize(),
	        dataType: "JSON",
	        success: function(data)
	        {

	            if(data.status) //if success close modal and reload ajax table
	            {
	                $('#modal_theme_success').modal('hide');
	                reload_table();
	            }
	            else
	            {
	                // for (var i = 0; i < data.inputerror.length; i++) 
	                // {
	                //     $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                //     $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	                // }
	            }
	            $('#btnSaveReclamo').text('Guardar'); //change button text
	            $('#btnSaveReclamo').attr('disabled',false); //set button enable 


	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnSaveReclamo').text('Guardar'); //change button text
	            $('#btnSaveReclamo').attr('disabled',false); //set button enable 

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
	
	$.get('<?php echo base_url('odeco/get_clasereclamo') ?>', function(data) {
		var cr = JSON.parse(data);
		$.each(cr, function(index, val) {
			$('#clasereclamo').append('<option value="'+val.id_clasereclamo+'">'+val.nombreclase+'</option>');
		});
	});
	$.get('<?php echo base_url('odeco/get_clasereclamo') ?>', function(data) {
		var cr = JSON.parse(data);
		$.each(cr, function(index, val) {
			$('#clasereclamomodal').append('<option value="'+val.id_clasereclamo+'">'+val.nombreclase+'</option>');
		});
	});

	$.get('<?php echo base_url('odeco/get_formareclamo') ?>', function(data) {
		var fr = $.parseJSON(data);
		$.each(fr, function(index, val) {
			$('#formareclamo').append('<option value="'+val.id_formareclamo+'">'+val.nombreforma+'</option>');
		});
	});
	$.get('<?php echo base_url('odeco/get_formareclamo') ?>', function(data) {
		var fr = $.parseJSON(data);
		$.each(fr, function(index, val) {
			$('#formareclamomodal').append('<option value="'+val.id_formareclamo+'">'+val.nombreforma+'</option>');
		});
	});


	function numero () {
		$.get('<?php echo base_url('odeco/get_numeroreclamo') ?>', function(data) {
			var nr = $.parseJSON(data);
				$('#numero').val(nr[0].numero + 1);
		});
	}

	// create function para busqueda del abonado
	// $('#nombre').autocomplete({
	$('#nombresabonado').autocomplete({
        minLength: 0,
        source: '<?php echo base_url("odeco/get_abonado_by_cuentausuario") ?>',
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
       var selected = [];
		$(":checkbox[id=subreclamo]").each(function() {
			if (this.checked) {
				selected.push($(this).val());
			}
		});
		if (!selected.length) {
			alert('Debes seleccionar al menos una opción.');
		} else
       $.ajax({
           url: "<?php echo base_url('odeco/ajax_add_reclamo')?>",
           type: "post",
           dataType: 'JSON',
           data: $(this).serialize(),
           success: function(d) {
               alert('Los datos fueron guardados correctamente');
               numero();
               reload_table();
           },
			error: function (jqXHR, textStatus, errorThrown)
			{
			    alert('Error al insertar los datos');
			}
       });
	});

	$('input#fechareclamo').change(function(event) {
		var fa = $(this).val();
		var f = toDate(fa);
		f.setDate(f.getDate() + 15); 
		console.log(f);
		$('input#fecharespuesta').val(f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear() +' '+ f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds());
	});

	function toDate(dateStr) {
    	return new Date(dateStr.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3") );
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

	
	// $('#btnSave').click(function() {
	// 	var selected = [];
	// 	$(":checkbox[name=subreclamo]").each(function() {
	// 		if (this.checked) {
	// 			selected.push($(this).val());
	// 		}
	// 	});
	// 	if (selected.length) {
	// 	  	$.ajax({
	// 			cache: false,
	// 			type: 'post',
	// 			dataType: 'json', // importante para que 
	// 			data: selected, // jQuery convierta el array a JSON
	// 			url: 'roles/paginas',
	// 			success: function(data) {
	// 				alert('Datos enviados');
	// 			}
	// 		});
	// 		alert(JSON.stringify(selected));
	// 	} else
	// 		alert('Debes seleccionar al menos una dddddopción.');
	// 	return false;
	// });



	// lista de tiporecalmo con su subreclamo
	// $.get('<?php echo base_url('odeco/get_tiporeclamo')?>', function(data) {
	// 	var tr = $.parseJSON(data);
	// 	$.each(tr, function(index, valtr) {
	// 		var tri = valtr.id_tiporeclamo;
	// 		// console.log(tri);
	// 		var idtr = valtr.nombretiporeclamo.split(" ").join("");
	// 		var idtiporeclamo = idtr.toLowerCase()
	// 		if (idtiporeclamo == 'técnica') {
	// 			idtiporeclamo = 'tecnica';
	// 		}
	// 		// console.log();
	// 		$.post('<?php echo base_url('odeco/get_subreclamo') ?>',
	// 			{id_tiporeclamo: tri}, 
	// 			function(data, textStatus, xhr) {
	// 				var sr = $.parseJSON(data);
	// 				// console.log(sr);
	// 				var textohtml = '';
	// 				$.each(sr, function(index, val) {
	// 					textohtml+=
	// 					'<label>'+
	// 						'<input value="'+val.id_subreclamo+'" type="checkbox" class="switchery" >'+
	// 						val.nombresubreclamo+
	// 					'</label>';
	// 				});
	// 				// console.log(textohtml);
	// 				$('#'+idtiporeclamo).html(textohtml);
	// 			}
	// 		)
	// 	});
	// });


	



</script>