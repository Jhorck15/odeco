<!-- Form horizontal -->
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">Lista de inspecciones a concluir</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>

	<form action="" id="form_coclusion">
	    <div class="panel-body">
	    	<div class="row">
	    		<input type="hidden" class="form-control border-success border-lg" id="id_conclusion" name="id_conclusion">
	    		<div class="col-md-4">
	    			<div class="form-group">
						<label>Fecha de conclusión: </label>
	                	<input type="text" class="form-control border-success border-lg" id="fechaconclusion" name="fechaconclusion" readonly="true">
					</div>
				</div>
				
				<div class="col-md-4">
	    			<div class="form-group">
						<label>Respuesta: </label>
						<select id="respuesta" name="respuesta" class="form-control border-success border-lg">
							<option value="">Seleccione...</option>
							<option value="SI">SI</option>
							<option value="NO">NO</option>
                        </select>
	                	
					</div>
				</div>
			</div>
			<!-- <div class="row"> -->
				<!-- <div class="col-md-4">
	    			<div class="form-group">
						<label>ID_Inspeccion</label>
	                	<input type="text" class="form-control border-success border-lg" id="id_inspeccion" name="id_inspeccion" readonly="true">
					</div>
				</div> -->
				<div class="col-md-4">
					<div class="form-group">
						<!-- <label type="hidden" >ID_Funcionario</label> -->
						<input type="hidden" class="form-control border-success border-lg" id="id_funcionario" name="id_funcionario" readonly="true" value="<?php echo $_SESSION['id_persona'] ?>">
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="form-group">
						<!-- <label type="hidden">ID_Reclamo</label> -->
						<input type="hidden" class="form-control border-success border-lg" id="id_reclamo" name="id_reclamo" value="<?php echo $_SESSION['id_reclamo_concluir']; ?>" readonly="true">
					</div>
				</div>
			<!-- </div> -->
			<div class="row">
				<div class="col-md-12">
	    			<div class="form-group">
						<label>Pronunciamiento: </label>
	                	<textarea rows="1" cols="1" id="pronunciamiento" name="pronunciamiento" class="form-control text-uppercase elastic border-success border-lg" placeholder=""></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="text-center">
					<button type="submit" id="btnSave" class="btn bg-teal-400">Guardar <i class="icon-floppy-disk position-right"></i></button>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">Inspecciones concluidas</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>
	<table id="lista_conclusion" class="table datatable-basic">
		<thead>
			<tr>
				<th>Fecha conclusion</th>
				<th>pronunciamiento</th>
				<th>Respuesta</th>
				<th>id_funcionario</th>
				<th>IDreclamo</th>
				<th class="text-center">Acciones</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	var save_method;
	$(document).ready(function() {


		table = $('#lista_conclusion').DataTable({ 
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
	                url: "<?php echo site_url('conclusion/ajax_list')?>",
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

		var f = toDate(Date());
		f.setDate(f.getDate()); 
		// console.log(f);
		$('input#fechaconclusion').val(f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear() +' '+ f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds());

		function toDate(fecha) {
	    	return new Date(fecha.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3") );
		}
	});

	$("body").on("submit", "#form_coclusion", function(e){
		e.preventDefault();
		var url;
		save_method = 'add';

		if(save_method == 'add') {
	        url = "<?php echo base_url('conclusion/ajax_add')?>";
	    } else {
	        url = "<?php echo site_url('persona/ajax_update')?>";
	    }

		$.ajax({
			url: url,
			type: "POST",
			dataType: 'JSON',
			data: $('#form_coclusion').serialize(),
			success: function(d) {
				// if (d.status) {
					alert('Los datos fueron guardados correctamente');
					reload_table();
					rep_reclamo(d.codigo);
					// console.log(d.codigo);
					// $('#id_persona').val(d.persona.id_persona);
					// $('#nombrereclamante').val(d.persona.nombres+' '+d.persona.apellidos);
				// }
				// else {
				// 	alert("Error al guardar los datos");
				// }
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
			    alert('Error al insertar los datos');
			}
		});

    });
	function reload_table()
	{
	    table.ajax.reload(null,false); //reload datatable ajax 
	}
    function rep_reclamo(codigo){
		var altura=500;
		var anchura=700;
		// var cod_reclamo = codigo;
		var y=parseInt((window.screen.height/2)-(altura/2));
		var x=parseInt((window.screen.width/2)-(anchura/2));

 		window.open("<?php echo site_url('rep_odeco/reporte/')?>" + codigo, "Reporte reclamo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=yes, width=acnhura, height=altura, top=y,left=x");
	}

    function edit_conclusion(id){
    	save_method = 'update';
	    $('#form_coclusion')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('conclusion/ajax_edit/')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {

	            $('[name="id_conclusion"]').val(data.id_conclusion);
	            $('[name="fechaconclusion"]').val(data.fechaconclusion);
	            $('[name="pronunciamiento"]').val(data.pronunciamiento);
	            $('[name="respuesta"]').val(data.respuesta);
	            $('[name="id_funcionario"]').val(data.id_funcionario);
	            $('[name="id_reclamo"]').val(data.id_reclamo);
	            // $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error al obtener datos');
	        }
	    });
    }


</script>