


					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Basic initialization</h5>
							<button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Añadir Persona</button>
        					<button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>



							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                	</ul>
		                	</div>


						</div>
	                	<!-- ............................................... -->
						<!-- <form id="form" role="form" method="get">
			                <div class="panel-body">
			                        <div class="form-group">
			                            <label>
			                                <input type="radio" id="campo" name="campo" class="minimal" value="remitente" checked>
			                                Remitente
			                            </label>
			                            <label>
			                                <input type="radio" id="campo" name="campo" class="minimal" value="funcionario_nombre">
			                                Funcionario
			                            </label>
			                            <label>
			                                <input type="radio" id="campo" name="campo" class="minimal" value="numero_cite">
			                                Num. Cite
			                            </label>
			                            <label>
			                                <input type="radio" id="campo" name="campo" class="minimal" value="fecha_ingreso">
			                                Fecha Ingreso
			                            </label>
			                            <label>
			                                <input type="radio" id="campo" name="campo" class="minimal" value="fecha_cite">
			                                Fecha Cite
			                            </label>
			                            <label>
			                                <input type="radio" id="campo" name="campo" class="minimal" value="motivo">
			                                Motivo
			                            </label>
			                            <label>
			                                <input type="radio" id="campo" name="campo" class="minimal" value="proveido">
			                                Proveido
			                            </label>
			                            <label>
			                                <input type="radio" id="campo" name="campo" class="minimal" value="tipo_correspondencia_nombre">
			                                Tipo Correspondencia
			                            </label>
			                            <label>
			                                <input type="radio" id="campo" name="campo" class="minimal" value="unidad_nombre">
			                                Unidad
			                            </label>
			                            <label>
			                                <input type="radio" id="campo" name="campo" class="minimal" value="medio_llegada_nombre">
			                                Medio Llegada
			                            </label>
			                        </div>
			                    <div class="form-group">
			                        <label for="nombre">Datos:</label>
			                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Datos a Buscar" required>
			                    </div>
			                </div>
			                <div class="box-footer">
			                    <button type="button" id="btnSearch" id="btnSearch" class="btn btn-primary">Buscar</button>
			                </div>
			            </form> -->
						<!-- ...............................................-->

						<table class="table">
							<thead>
								<tr>
									<th>Nombres</th>
									<th>Apellidos</th>
									<th>Direccion</th>
									<th>Teléfono</th>
									<th>Celular</th>
									<th>CI</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>

<script type="text/javascript">

	var save_method; //for save method string
	var table;

	$(document).ready(function() {

	    //datatables
	    table = $('.table').DataTable({ 

	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.

	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('persona/ajax_list')?>",
	            "type": "POST"
	        },

	        //Set column definition initialisation properties.
	        "columnDefs": [
	        { 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        },
	        ],
	        // botones 
	        buttons: [
            {
                extend: 'print',
                text: '<i class="icon-printer position-left"></i> Print table',
                className: 'btn bg-blue'
            }
        ]

	    });

	    //datepicker
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



	    // busqueda persona+
	    $('#btnSearch').click(function(){
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
                "campo": $('input[name=campo]:checked','#form').val()
            };
            $.ajax({
                url: '<?php echo base_url()?>Correspondencia_Entrante_Saliente/search',
                type: 'get',
                data: parametros,
                success: function(response) {
                    $('table#resultTable tbody').html(response);
                }
            });
        }

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

	});


	function add_person()
	{
	    save_method = 'add';
	    $('#form_person')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#modal_form').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
	}

	function edit_person(id)
	{
	    save_method = 'update';
	    $('#form_person')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('persona/ajax_edit/')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {

	            $('[name="id_persona"]').val(data.id_persona);
	            $('[name="nombres"]').val(data.nombres);
	            $('[name="apellidos"]').val(data.apellidos);
	            $('[name="direccion"]').val(data.direccion);
	            $('[name="telefono"]').val(data.telefono);
	            $('[name="celular"]').val(data.celular);
	            $('[name="ci"]').val(data.ci);
	            $('[name="nit"]').val(data.nit);
	            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}

	function reload_table(){
	    table.ajax.reload(null,false); //reload datatable ajax 
	}

	function save()
	{
	    $('#btnSave').text('saving...'); //change button text
	    $('#btnSave').attr('disabled',true); //set button disable 
	    var url;

	    if(save_method == 'add') {
	        url = "<?php echo site_url('persona/ajax_add')?>";
	    } else {
	        url = "<?php echo site_url('persona/ajax_update')?>";
	    }

	    // ajax adding data to database
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: $('#form_person').serialize(),
	        dataType: "JSON",
	        success: function(data)
	        {

	            if(data.status) //if success close modal and reload ajax table
	            {
	                $('#modal_form').modal('hide');
	                reload_table();
	            }
	            else
	            {
	                for (var i = 0; i < data.inputerror.length; i++) 
	                {
	                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	                }
	            }
	            $('#btnSave').text('save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable 


	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnSave').text('save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable 

	        }
	    });
	}

	function delete_person(id)
	{
	    if(confirm('Are you sure delete this data?'))
	    {
	        // ajax delete data to database
	        $.ajax({
	            url : "<?php echo site_url('persona/ajax_delete')?>/"+id,
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


</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Formulario Persona</h3>
            </div>
            <div class="modal-body form">
                <form id="form_person">
                	<input type="text" value="" name="id_persona"/> 
				    <div class="panel-body">
				    	<div class="row">
				    		<div class="col-md-4">
				    			<div class="form-group">
									<label>Nombres: </label>
				                	<input type="text" class="form-control" name="nombres" placeholder="Nombres">
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Apellidos: </label>
				                	<input type="text" class="form-control" name="apellidos" placeholder="Apellidos...">
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Carnet de Indentidad: </label>
				                	<input type="text" class="form-control" name="ci" placeholder="Carnet de Identidad">
								</div>
							</div>
						</div>
						<div class="row">
				    		<div class="col-md-4">
				    			<div class="form-group">
									<label>Direccion: </label>
				                	<input type="text" class="form-control" name="direccion" placeholder="Direccion...">
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Telefono Fijo</label>
				                	<input type="text" class="form-control format-phone-fijo" data-mask="4 64 - 99999" name="telefono" placeholder="4 64 - 99999">
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Celular: </label>
				                	<input type="text" class="form-control format-phono-celular" data-mask="(501) 999 99999" name="celular" placeholder="(591) 999 99999">
								</div>
							</div>
						</div>
						<div class="row">
				    		<div class="col-md-4">
				    			<div class="form-group">
									<label>NIT: </label>
				                	<input type="text" class="form-control" name="nit" placeholder="99999999">
								</div>
							</div>
						</div>
				    </div>
				</form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button> -->
                <button type="submit" id="btnSave" onclick="save()" class="btn bg-teal-400">Guardar <i class="icon-arrow-right14 position-right"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->