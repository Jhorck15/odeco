<div class="panel panel-flat" id="eso">
	<div class="panel-heading">
        <h5 class="panel-title">TERCER FORMULARIO DE INSPECCIÓN</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>
	<form id="form_inspecciontres">
	    <div class="panel-body">
    		<!-- <label for="">ID_:RECLAMO</label> -->
    		<input type="hidden" class="form-control" id="id_reclamo" name="id_reclamo" value="<?php echo $_SESSION['id_reclamosession'] ?>">
    		<!-- <label for="">id_formularioinsepcciontres</label> -->
    		<input type="hidden" class="form-control" id="id_formularioinspecciontres" name="id_formularioinspecciontres" >

	    	<div class="row">
				<div class="col-md-12">
	    			<div class="form-group">
						<label>Fecha de inspección: </label>
	                	<input type="text" class="form-control border-success border-lg" name="fechainspeccion" id="fechainspeccion">
					</div>
				</div>
			</div>
	    		
			<div class="row">
	    		
				
				<div class="col-md-12">
					<div class="content-group">
						<label>Descripción: </label>
						<div class="form-group">
							<textarea rows="1" cols="1" id="descripcion" name="descripcion" class="form-control border-success border-lg elastic text-uppercase" placeholder="Motivos por el que reclama"></textarea>
						</div>
					</div>
				</div>
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
			</div>
				
			<div class="row">
				<input type="hidden" class="form-control" id="estadoreclamo" name="estadoreclamo" value="5">
				<input type="hidden" class="form-control" id="id_funcionario" name="id_funcionario" value="<?php echo $_SESSION['user_id'] ?>">
			</div>

			<div class="row">
				<div class="text-center">
					<button type="submit" id="btnSave"  class="btn bg-success-800">Guardar<i class="icon-arrow-right14 position-right"></i></button>
				</div>
			</div>
	    </div>
	</form>
</div>


<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">Lista de inspecciones</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        	</ul>
    	</div>
	</div>

	<table id="tableformulariotres" class="table datatable-basic dataTable no-footer">
		<thead>
			<tr>
	            <th>Fec. Inspección</th>
	            <th>Descripción</th>
	            <th>Funcionario</th>
	            <th>Reclamo</th>
	            <th style="Actionh:125px;">Acción</th>
	        </tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('upcoming', {packages: ['corechart']});
  // google.charts.setOnLoadCallback(drawChart);
</script> -->


<script type="text/javascript">

	var save_method; //for save method string
	var table;
	var base_url = '<?php echo base_url();?>';

	var archivos = '';
	// var urlimagen = new Array();
	var urlimagen = [];
	var urlimagenobj = new Object();

	$(document).ready(function() {

	    //datatables
	    table = $('#tableformulariotres').DataTable({
	    	"destroy": true,
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.

	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('form_inspecciontres/ajax_list')?>",
	            "type": "POST"
	        },

	        //Set column definition initialisation properties.
	        "columnDefs": [
	            { 
	                "targets": [ -1 ], //last column
	                "orderable": false, //set not orderable
	            },
	            { 
	                "targets": [ -2 ], //2 last column (photo)
	                "orderable": false, //set not orderable
	            },
	        ],

	    });

	    var f = toDate(Date());
		f.setDate(f.getDate()); 
		// console.log(f);
		$('input#fechainspeccion').val(f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear() +' '+ f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds());

		function toDate(fecha) {
	    	return new Date(fecha.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3") );
		}

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

	});

	$("#form_inspecciontres").on("submit", function(event) {
		event.preventDefault();

		var url;
		// console.log($('#btnSave').text());
		if($('#btnSave').text().trim() == 'Guardar') {
	        url = "<?php echo base_url('form_inspecciontres/ajax_add_inspectiontres')?>";
	    } else {
	        url = "<?php echo base_url('form_inspecciontres/ajax_update_inspectiontres')?>";
	    }

	    var formData = new FormData($('#form_inspecciontres')[0]);
		
		$.ajax({
			url: url,
			type: "post",
			dataType: 'JSON',
			data: formData,
			contentType: false,
			processData: false,
			success: function(data) {
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
		});
	});

	


	function add_person()
	{
	    save_method = 'add';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#modal_form').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title

	    $('#photo-preview').hide(); // hide photo preview modal

	    $('#label-photo').text('Upload Photo'); // label photo upload
	}

	function edit_forminspecciontres(id)
	{
		$('#form_inspecciontres')[0].reset(); // reset form on modals

	    $.ajax({
	        url : "<?php echo site_url('form_inspecciontres/ajax_edit_forminspecciontres')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(dataall)
	        {
	        	// console.log(dataall);
	            $('[name="id_formularioinspecciontres"]').val(dataall.id_formularioinspecciontres);
	            $('[name="fechainspeccion"]').val(dataall.fechaforminspeccion);
				$('[name="descripcion"]').val(dataall.descripcion);
	            $('[name="funcionario"]').val(dataall.id_);
	            $('[name="id_reclamo"]').val(dataall.id_reclamo);
	            // $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Editar inspección'); // Set title to Bootstrap modal title

	            // console.log(dataall.archivos.length);
	            // console.log(dataall.id_formularioinspecciontres);
	            // console.log(dataall.archivos[0].id_archivo);
	            // imagenes(dataall);
	            
	            	// console.log(dataall.archivos[i].id_archivo);
            	$.post('<?php echo base_url("form_inspecciontres/get_archivos") ?>', {id_archivo: dataall.id_formularioinspecciontres}, function(datos, textStatus, xhr) {
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
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error al obtener datos.');
	        }
	    });
	    $('#btnSave').text('Actualizar datos'); //change button text
	}

	function imagenes(imagenes) {
		console.log(typeof(imagenes));
		// console.log(1)

        // var eso = [
        //     	"http://localhost/occv1/upload/eso1.jpg",
        //     	"http://localhost/occv1/upload/eso1.jpg"
        //     ];
        // console.log(typeof(eso));
	    var eso = imagenes;

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
	        initialPreview: imagenes,

	        initialPreviewConfig: [
	            {caption: "Jane.jpg", size: 930321, key: 1, showDrag: false},
	            // {caption: "Anna.jpg", size: 1218822, key: 2, showDrag: false}
	        ],
	        initialPreviewAsData: true,
	        overwriteInitial: true,
	        allowedFileExtensions: ["jpg", "gif", "png", "txt", "pdf", "gif","csv","xlsx","doc","docx","xls","xlsx","xl","csv"],
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

	function retornar_forminspecciontres(id)
	{
		// alert (id);
		// $('#id_reclamo_conf').val(id);
		$('#modal_confirmar').modal('show'); // show bootstrap modal when complete loaded
	}

	function guardar(){
		var id = '<?php echo $_SESSION['id_reclamosession'] ?>';
		// alert(id);
		$('#modal_confirmar').modal('hide');
		$.ajax({
			url: '<?php echo base_url("reclamo/actualizar_inspeccion_retornar") ?>',
			type: 'POST',
			dataType: 'JSON',
			data: {id: id, estado: 4},
		})
		.done(function() {
			console.log("Se guardo con éxito");
			window.location.href = '<?php echo base_url("cencargado/") ?>';
		})
		.fail(function() {
			console.log("No se guardo");
		});
	}



// ---------------------------------------------------------

// --------------------------------------------------------


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
	    </div><div class="sa-icon sa-custom" style="display: none;"></div><h2>¿Estas seguro retornar la inspeccion?</h2>
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
	        <button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(255, 112, 67); box-shadow: rgba(255, 112, 67, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;" onclick="guardar()">Retornar inspeccion</button><div class="la-ball-fall">
	          <div></div>
	          <div></div>
	          <div></div>
	        </div>
	      </div>
	    </div>
	</div>
   </div>
</div>