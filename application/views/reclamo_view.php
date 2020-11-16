

<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">Reclamos</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>
	<div class="panel-heading">
		<a href=" <?php echo base_url('odeco') ?> ">
			<button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Añadir Reclamo</button>
		</a>
	</div>
	<div class="table-responsive"">
		<!-- <table class="table"> -->
		<table id="table" class="table table-bordered table-hover datatable-highlight">
            <thead>
                <tr>
					<th>Numero</th>
					<th>Fecha Reclamo</th>
					<th>Fecha respuesta</th>
					<th>Dias</th>
					<th>motivo</th>
					<th>Persona</th>
					<th>Abonado</th>
					<th>Clase Reclamo</th>
					<th>Forma Reclamo</th>
					<th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
	</div>
</div>
					<!-- /basic initialization -->
<!-- ...................................................................... -->

<style>
	.pink {background-color: red !important;}
</style>

<script type="text/javascript">

	var save_method; //for save method string
	var table;

	$(document).ready(function() {

	    //datatables
	    table = $('.table').DataTable({ 
	    	"rowCallback": function( row, data, index ) {
				var fechareclamo = data[1],
				$node = this.api().row(row).nodes().to$();
				var fechahoy = new Date();
				var fechareclamo = toDate(fechareclamo);

				console.log(restaFechas(fechareclamo,fechahoy));
				if (restaFechas(fechareclamo,fechahoy)>=0 && restaFechas(fechareclamo,fechahoy)<=5) {
					// $node.addClass('bg-success');
				} else {
					if (restaFechas(fechareclamo,fechahoy)>5 && restaFechas(fechareclamo,fechahoy)<=10) {
						// $node.addClass('bg-orange');
					}
					// $node.addClass('bg-danger');
				}
			},
			"destroy": true,
			"searching": false,
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.

	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('reclamo/ajax_list_reclamos')?>",
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

	    function toDate(dateStr) {
	    	return new Date(dateStr.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3") );
		}
		function restaFechas(f1,f2){
			// var aFecha1 = f1.split('-'); 
			// var aFecha2 = f2.split('-'); 
			// var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
			// var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
			// console.log(aFecha1);
			// console.log(aFecha2);
			// var dif = fFecha2 - fFecha1;
			// var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
			// console.log(dias);
			// return dias;
			// console.log(f1);
			// console.log(f2);
			var dif = f2 - f1;
			var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
			// console.log(dias);
			return dias;
		}

	});



	function add_person()
	{
	    save_method = 'add';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#modal_form').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
	}

	function edit_person(id)
	{
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('person/ajax_edit/')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {

	            $('[name="id"]').val(data.id);
	            $('[name="firstName"]').val(data.firstName);
	            $('[name="lastName"]').val(data.lastName);
	            $('[name="gender"]').val(data.gender);
	            $('[name="address"]').val(data.address);
	            $('[name="dob"]').datepicker('update',data.dob);
	            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

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

	function save()
	{
	    $('#btnSave').text('saving...'); //change button text
	    $('#btnSave').attr('disabled',true); //set button disable 
	    var url;

	    if(save_method == 'add') {
	        url = "<?php echo site_url('person/ajax_add')?>";
	    } else {
	        url = "<?php echo site_url('person/ajax_update')?>";
	    }

	    // ajax adding data to database
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: $('#form').serialize(),
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

</script>



<div id="modal_theme_success" class="modal fade">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h6 class="modal-title">Success header</h6>
			</div>

			<div class="modal-body">
				<form action="" id="form_reclamo">
				    <div class="">
				    	<div class="row">
				    		<div class="col-md-4">
				    			<div class="form-group">
									<label>Numero de reclamo: </label>
				                	<input type="text" class="form-control" id="numero" name="numero" placeholder="99/99/9999">
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Persona que reclama: </label>
									<!-- <input type="text" id="id_persona" value="<?php echo $persona->id_persona ?>"  name="id_persona" >
				                	<input type="text" class="form-control" value="<?php echo $persona->nombres.' '.$persona->apellidos ?>"  placeholder="99/99/9999"></input>-->
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Dueño de medidor: </label>
									<input type="text" id="id_abonado" name="id_abonado">
				                	<input type="text" class="form-control" id="nombresabonado" placeholder="">
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
				                	<input type="text" class="form-control datetimepicker" id="fecharespuesta" name="fecharespuesta" placeholder="99/99-9999">
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Clase de reclamo</label>
				                	<select id="clasereclamo" name="clasereclamo" class="form-control">
										<option value="">Seleccione...</option>
			                        </select>
								</div>
							</div>
						</div>
						<div class="row">
				    		<div class="col-md-4">
				    			<div class="form-group">
									<label>Forma de Reclamo</label>
				                	<select id="formareclamo" name="formareclamo" class="form-control">
			                                <option value="">Seleccione...</option>
			                        </select>
								</div>
							</div>
							<div class="col-md-8">
								<div class="content-group">
									<label>Motivo: </label>
									<div class="form-group">
										<textarea rows="1" cols="1" id="motivo" name="motivo" class="form-control elastic" placeholder="Motivos por el que reclama"></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<!-- <div class="row">
							<div class="text-center">
								<button type="submit" id="btnSave" class="btn bg-teal-400">Guardar <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</div> -->
						<div class="modal-footer">
							<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-success">Save changes</button>
						</div>
				    </div>
				</form>
			</div>

		</div>
	</div>
</div>
