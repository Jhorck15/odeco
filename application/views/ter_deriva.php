<div class="panel panel-flat ">
	<div class="panel-heading">
		<h5 class="panel-title">LISTA DE RECLAMOS DERIVADOS</h5>
		<!-- <button class="btn btn-success" id="btnImprimir" onclick=""><i class="glyphicon glyphicon-plus"></i> Añadir Reclamo</button> -->
		<div class="heading-elements">
			<ul class="icons-list">
	    		<li><a data-action="collapse"></a></li>
	    		<li><a data-action="reload"></a></li>
	    		<!-- <li><a data-action="close"></a></li> -->
	    	</ul>
		</div>
	</div>				

	<table class="table datatable-basic table-bordered table-striped table-hover" id="t_reclamo">
	<!-- class="listarra listarrac"   class="listarr" -->
	<thead class="devcolor">
		<tr >
			<td>Nro.</td>
			<td>Cod. Usuario</td>
			<td>Nombre</td>
			<td>Nro. Reclamo</td>
			<td>Fecha Reclamo</td>
			<td>Fecha Respuesta</td>
			<td>Dias</td>
			<td>Tipo de Reclamo</td>
			<td>Derivo a</td>
			<td>Acciones</td>				
		</tr>
	</thead>
	<tbody class="devtabla">
		
		
	</tbody>
	</table>
	<span id="resultado"></span>
</div>

<script type="text/javascript">
	var save_method; //for save method string
	var table;
	var campo,
		datocod;
	// var append = (append === undefined ? false   true);
		 
	$(document).ready(function() {

			$('#btnbuscarabonado').click(function(){
				// alert('se activo el boton');
				campo = $('#codusuario').val();
				if(campo != '') {
					$('#btnbuscarabonado').html('<div id="cargando"><img style="with:50px; height:20px;" src="<?php echo base_url()?>assets/images/ela/loading.gif"></div>');
					 // $('#btnbuscarabonado').hide();
					 $('#btnbuscarabonado').attr('disabled', true);
				    makeAjaxRequest();
					
				} else {	
					$('[name="abonadores"]').html('<div class="alert bg-info alert-styled-right">										<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button><span class="text-semibold">Vacio!</span> Debe ingresar el codigo de usuario... <a href="#" class="alert-link">super importante</a>.</div>');
					 	
				}
			});
		
			// $('body').on('hidden.bs.modal', '.modal', function () {
			// 	$(this).removeData('bs.modal');
			// 	$(this).removeData('modal');
			// 	$(this).find('form')[0].reset();
			// 	$('#abonadores').empty();
			// });

			$("#modal_imprimir").on('hidden.bs.modal', function () {
               	$(this).removeData('bs.modal');
				$(this).removeData('modal');
				$(this).find('form')[0].reset();
				$('#abonadores').empty();
    		});
			
					
			// $(document).keypress(function(e) {
			// // keypress(function(e)){	
   //  			if(e.which == 13) {

   //  				$('#codusuario').focus(function(){
   //  					alert('dasdasd');
			// 			$('#btnbuscarabonado').click();	});
       			
			// 	}
			// });


			//Esta línea llama a la funcion InicializarEventos
			addEvent(window,'load',inicializarEventos,false);


			function inicializarEventos()
			{
			// Aquie obtienes mediante DOM el control a traves de ID 
			  var ob1=document.getElementById('codusuario');

			// Se le agrega al objeto el evento (keypress), y la funcion que se va a ejecutar al presionar cualquie tecla...('presionar')
			  addEvent(ob1,'keypress',presionar,false);
			}


			function presionar(e)
				{
				//Esta parrte es para IE
				if (window.event)
				  {
				           if (window.event.keyCode==13)
					{$('#btnbuscarabonado').click();}// Aqui escribe el nombre tu funcion que hace la busqueda...
				  }
				  else
			                    //Esto es para Firefox y creo otros navegadores
					if (e)
					{
					  if(e.which==13)
					  	{$('#btnbuscarabonado').click();}//Igual que arriba
					}
				}
				

		
			function addEvent(elemento,nomevento,funcion,captura)
			{
			  if (elemento.attachEvent)
			  {
			    elemento.attachEvent('on'+nomevento,funcion);
			    return true;
			  }
			  else  
			    if (elemento.addEventListener)
			    {
			      elemento.addEventListener(nomevento,funcion,captura);
			      return true;
			    }
			    else
			      return false;
			}



	  	 table = $('#t_reclamo').DataTable({ 
	   		"rowCallback": function( row, data, index ) {
					
				var fechareclamo = data[6];
				$node = this.api().row(row).nodes().to$();
	

			},

			
	        "processing":  true, 
	     
	        "destroy":  true,

	        "responsive": true,
	        

	
			"language": {
	           
	            "info" : "Mostrar pagina _START_ de _END_ de _TOTAL_ reclamos",
	            "loadingRecords":  "No hay reclamos...",
	     		"processing" :     "Procesando...",
	            "sSearch" :      "Buscar ",
            	"ZeroRecords":  "No se encontraron resultados",
	            "infoEmpty":  "No hay reclamos",
	            "lengthMenu":  "Mostrar _MENU_ registros",
           
       		},
	
			
			"ajax": {
		            url: "<?php echo site_url('cter_deriva/lista')?>",	
		            type: "POST",
		         
		            error: function (jqXHR, textStatus, errorThrown)
			        {
			            
			        }   

		      },

	    
			
	//         //Set column definition initialisation properties.
	        "columnDefs" : [
	        { 
	            // "targets" : [ -1 ], //last column
	            "orderable" : false, //set not orderable
	          	"createdCell" : function (td, cellData, rowData, row, col) {
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
	//         // botones 
			
	    });
	   // $('#t_reclamo').dataTable().fnAjaxUpdate();
	   // $('#t_reclamo').dataTable().ajax.reload();
	   // $('#t_reclamo').dataTable()._fnAjaxUpdate();
	    // table.ajax.reload(null,false); 
	    // $('#t_reclamo').dataTable().reload();


 			$('#btnImprimir').click(function(){
     		    rep_reclamo();
        	});

        	$('#btnImprimirC').click(function(){
     		    imprimirodeco();
        	});


			function rep_reclamo(){
				var altura=500;
				var anchura=700;
				cod_reclamo = 400170700;
				var y=parseInt((window.screen.height/2)-(altura/2));
				var x=parseInt((window.screen.width/2)-(anchura/2));

		 		window.open("<?php echo site_url('rep_reclamo/index/')?>" + cod_reclamo, "Reporte reclamo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=yes, width=acnhura, height=altura, top=y,left=x");
			};

	    // datepicker
	    $('.datepicker').datepicker({
	        autoclose : true,
	        format:  "yyyy-mm-dd",
	        todayHighlight:  true,
	        orientation:  "top auto",
	        todayBtn:  true,
	        todayHighlight:  true,  
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


		 	function makeAjaxRequest() {
			    var parametros = {
			        "numero" :  $('#codusuario').val(),
			        // "campo"  $('input[name=campo] checked','#form_abonado').val(),
			    };
			    $.ajax({
			        url : '<?php echo site_url('cprincipal/searchh')?>',
			        type : 'get',
			        data : parametros,
			        // beforeSend: function(){
			        // 	$('#btnbuscarabonado').text('Buscando...');
			        	// $('#btnbuscarabonado').attr('disabled', true);

			        // },
			        success:  function(data) {
			        	$('#btnbuscarabonado').append('<div style="color:black;">Buscar </div>');
			         	$('#btnbuscarabonado').text('Buscar ');
			         	$('#abonadores').empty();
			         	$('#btnbuscarabonado').attr('disabled', false);
			            $('#abonadores').html(data);
			       		           
			        },
			        error: function (jqXHR, textStatus, errorThrown)
			        {
			            alert('Error al cargar los datos');
			        }
			    });
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

		function inspectorr()
		{
		    save_method = 'add';
		    $('#form_inspector')[0].reset(); // reset form on modals
		    $('.form-group').removeClass('has-error'); // clear error class
		    $('.help-block').empty(); // clear error string
		    $('#modal_inspector').modal('show'); // show bootstrap modal
		    $('.modal-title').text('Derivar '); // Set Title to Bootstrap modal title
		}

		function odeco()
		{
		    // save_method = 'add';
		    var index = 0;
		     if(!('autofocus' in document.createElement('input'))){
		     	// alert('asdasdsads');
		     	document.form_imprimir.codusuario.focus();
		     }
				
		    $('#form_imprimir')[0].reset(); // reset form on modals
		    $('.form-group').removeClass('has-error'); // clear error class
		    $('.help-block').empty(); // clear error string
		    $('#modal_imprimir').modal('show', function () {index = 1;});
		    if(index)
		    {
					$('input:text:visible:first').focus();
				};
			
		    $('.modal-title').text('Imprimir ODECO'); // Set Title to Bootstrap modal title
		}

		// function edit_inspectorr(id)
		// {
		// 	// alert (usuarioid);
		//     save_method = 'add';
		//     $('#form_inspector')[0].reset(); 
		//     $('.form-group').removeClass('has-error'); 
		//     $('.help-block').empty(); 

		   
		//     $.ajax({
		//         url:  "<?php echo site_url('cprincipal/ajax_editt')?>/" + id,
		//         type: "GET",
		//         dataType: "JSON",
		//         success: function(data)
		//         {
		//         	$('[name="id_reclamo"]').val(data.id_reclamo);
		//             $('[name="fechareclamo"]').val(data.fechareclamo);
		//             $('[name="motivo"]').val(data.motivo);
		//             $('[name="nombreclase"]').val(data.nombreclase);
		//             $('[name="nombres"]').val(data.nombres);
		//             $('[name="apellidos"]').val(data.apellidos);
		//             $('#modal_inspector').modal('show'); 
		//             $('.modal-title').text('Derivar'); 

		//         },
		//         error: function (jqXHR, textStatus, errorThrown)
		//         {
		//             alert('Error al cargar los datos');
		//         }
		//     });
		// }

		function edit_inspectorr(id)
		{
			var altura=500;
			var anchura=700;
			cod_reclamo = id;
			var y=parseInt((window.screen.height/2)-(altura/2));
			var x=parseInt((window.screen.width/2)-(anchura/2));
			// alert(id);
	 		window.open("<?php echo site_url('Rep_reclamo/reporte/')?>" + id, "Reporte reclamo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=yes, width=acnhura, height=altura, top=y,left=x");
			
		}

		function reload_table(){ 
		    table.ajax.reload(null,false); 

		}

		function imprimirodeco()
		{
			var id = $('#codusuario').val();
		    	
		    var $imp = $('#estado').val();
		    alert($imp);
		    if ($imp == '6')
		    {
			    $('#btnImprimirC').text('imprimiendo...'); 
			    $('#btnImprimirC').attr('disabled',true); 
			    var url;

			    if(save_method == 'add') 
			    {
			        url = "<?php echo site_url('rep_reclamo/index/')?>" + id;
			    } 
			    
			    $.ajax({
			        url:  url,
			        type: "POST",
			        data: $('#form_imprimir').serialize(),
			        contentType: 'application/pdf',

			        success: function(data)
			        {
			        	
			            $('#btnImprimirC').text('Imprimir',false); //set button enable 
			            var altura=500;
						var anchura=700;
						cod_reclamo = 400170700;
						var y=parseInt((window.screen.height/2)-(altura/2));
						var x=parseInt((window.screen.width/2)-(anchura/2));

				 		window.open("<?php echo site_url('rep_reclamo/index/')?>" + id, "Reporte reclamo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=yes, width=acnhura, height=altura, top=y,left=x");
				
			        },
			        
			        error : function (jqXHR, textStatus, errorThrown)
			        {
			            alert('Error adicionar / actualizar datos');
			            $('#btnImprimirC').text('Imprimir'); //change button text
			            $('#btnImprimirC').attr('disabled',false); //set button enable 

			        }
			    });
			} else if (id == '')
				{
					alert('No puede imprimir!!! debe llenar el campo codigo usuario');
				} else 
				{
					alert('No puede imprimir!!! el reclamo esta en proceso');
				}
				
		}
				
			function confirmar(){
				  $('#modal_confirmar').modal('show'); 
			}

			function cerrar(){
				  $('#modal_confirmar').modal('hide'); 
			}

			function guardar()
			{
			    var id = $('#listainsp').val();
			    	// nombrefunc = $('#listainsp').attr('value');
			    // alert (nombrefunc);
			    $('#btnSave').text('guardando...'); //change button text
			    $('#btnSave').attr('disabled',true); //set button disable 
			    var url;

			    if(save_method == 'add') {
			        url = "<?php echo site_url('cprincipal/ajax_adicionar')?>/" + id;
			    } 
			    // else {
			    //     url = "<?php echo site_url('cprincipal/ajax_update')?>";
			    // }

			    // ajax adding data to database()
			    $.ajax({
			        url:  url,
			        type:  "POST",
			        data: $('#form_inspector').serialize(),
			        dataType : "JSON",

			        success: function(data)
			        {
			        	// alert(data);

			            if(data.status) //if success close modal and reload ajax table
			            {
			                $('#modal_confirmar').modal('hide');
			                $('#modal_inspector').modal('hide');
			             //    $('#btnSave').text('Guardar'); //change button text
			            	// $('#btnSave').attr('disabled',false); //set button enable 

			                reload_table();
			                funcnumero();
			                // get_jsonp();
			            } else
			            {
			                for (var i = 0; i < data.inputerror.length; i++) 
			                {
			                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
			                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
			                }
			            }
			            $('#btnSave').text('Enviar'); //change button text
			            $('#btnSave').attr('disabled',false); //set button enable 

						// reload_table(null,false);
			   //          funcnumero();
			        },
			        
			        error : function (jqXHR, textStatus, errorThrown)
			        {
			            alert('Error adicionar / actualizar datos');
			            $('#btnSave').text('Enviar'); //change button text
			            $('#btnSave').attr('disabled',false); //set button enable 

			        }
			    });
			}
			setInterval('reload_table()', 100000); 
			function delete_person(id)
			{
			    if(confirm('Are you sure delete this data?'))
			    {
			        // ajax delete data to database
			        $.ajax({
			            url :  "<?php echo site_url('cprincipal/ajax_delete')?>/"+id,
			            type :  "POST",
			            dataType : "JSON",
			            success : function(data)
			            {
			                //if success reload ajax table
			                $('#modal_inspector').modal('hide');
			                reload_table();
			            },
			            error : function (jqXHR, textStatus, errorThrown)
			            {
			                alert('Error deleting data');
			            }
			        });

			    }
			}
			// function funclistado(){


			$.get('<?php echo base_url('cprincipal/listainspectorr') ?>', function(data) {
					// alert(data);
				var fr = $.parseJSON(data);
				$.each(fr, function(index, val) {
						// $('#listainsp').append('<option value="'+val.id_funcionario+'">'+val.nombres +' '+ val.apellidos+ '</option>');
					if(val.detallecargo == 'USUARIO ODECO'){
						$('#listainsp').append('<option value="'+val.id_funcionario+'">'+val.detallecargo+'</option>');
					} 
				
					else {
						$('#listainsp').append('<option value="'+val.id_funcionario+'">'+val.detallecargo+' '+val.nombres+' '+val.apellidos+'</option>');
					}
					// }
				});
			});
			// }

			$.get('<?php echo base_url('cprincipal/datos_user') ?>', function(data) {
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
                	<input type="hidden"  name="id_reclamo" id="id_reclamo"> 
				    <div class="panel-body">
				    	<div class="row">
				    		<div class="col-md-4">
				    			<div class="form-group">
									<label>Fecha reclamo  </label>
				                	<input type="text" class="form-control" name="fechareclamo" placeholder="99/99/9999" cols="4" readonly="true">
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Abonado  </label>
				                	<input type="text" class="form-control " name="nombres" placeholder="99/99/9999" readonly="true">
								</div>
							</div>
							<div class="col-md-4">
				    			<div class="form-group">
									<label>Apellidos  </label>
				                	<input type="text" class="form-control " name="apellidos" placeholder="99/99/9999" readonly="true" >
								</div>
							</div>
						</div>
						<div class="row">
				    		<div class="col-md-4">
				    			<div class="form-group">
									<label>Reclamo  </label>
				                	<!-- <input type="text" name="motivo" placeholder="99/99/9999"> -->
				                	<textarea name="motivo" id="motivo" cols="67" rows="5" class="bg-success" readonly="true"></textarea>
								</div>
							</div>
							
						</div>
						
						<div class="row">
							<div class="text-center">
								<!-- <button type="submit" id="btnSave" onclick="save()" class="btn bg-teal-4  ">Guardar <i class="icon-arrow-right14 position-right"></i></button> -->
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
                <button type="submit" id="btnSave" onclick="confirmar()" class="btn bg-teal-400">Enviar <i class="icon-arrow-right14 position-right"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<!-- <div class="modal fade" id="modal_confirmar" role="dialog">
    <div class="modal-dialog">
		<div class="ui-pnotify  ui-pnotify-fade-normal ui-pnotify-mobile-able ui-pnotify-in ui-pnotify-fade-in ui-pnotify-move" style="display  none; width  3  px; right  356px; top  20px; cursor  auto;" aria-live="assertive" aria-role="alertdialog">
			<div class="brighttheme ui-pnotify-container brighttheme-notice ui-pnotify-shadow" role="alert" style="min-height  16px;">
		        <div class="ui-pnotify-closer" aria-role="button" tabindex="0" title="Close" style="cursor  pointer; visibility  hidden; display  none;">
		            		<span class="brighttheme-icon-closer"></span>
		        </div>
		        <div class="ui-pnotify-sticker" aria-role="button" aria-pressed="true" tabindex="0" title="Unstick" style="cursor  pointer; visibility  hidden; display  none;">
		            		<span class="brighttheme-icon-sticker brighttheme-icon-stuck" aria-pressed="true"></span>
		        </div>
		        <div class="ui-pnotify-icon">
		            		<span class="brighttheme-icon-notice"></span>
		        </div>
		        <h4 class="ui-pnotify-title">Confirmación</h4>
		        <div class="ui-pnotify-text" aria-role="alert">
		            		<p>Usted esta seguro de enviar el reclamo  ?</p>
		        </div>
		        <div class="ui-pnotify-action-bar" style="margin-top  5px; clear  both; text-align  right;">
		        <button type="button" class="ui-pnotify-action-button btn btn-sm btn-primary" onclick="guardar()">Si</button> 
		        <button type="button" class="ui-pnotify-action-button btn btn-sm btn-link" data-dismiss="modal">Cancelar</button></div></div>

		</div>
	</div>
</div> -->

<div class="modal fade" id="modal_confirmar" role="dialog">
    <div class="modal-dialog">
<div class="sweet-alert showSweetAlert visible" data-custom-class="" data-has-cancel-button="true" data-has-confirm-button="true" data-allow-outside-click="false" data-has-done-function="false" data-animation="pop" data-timer="null" style="display:  block; margin-top:  -5px;"><div class="sa-icon sa-error" style="display:  none;">
      <span class="sa-x-mark">
        <span class="sa-line sa-left"></span>
        <span class="sa-line sa-right"></span>
      </span>
    </div><div class="sa-icon sa-warning pulseWarning" style="display:  block;">
      <span class="sa-body pulseWarningIns"></span>
      <span class="sa-dot pulseWarningIns"></span>
    </div><div class="sa-icon sa-info" style="display:  none;"></div><div class="sa-icon sa-success" style="display:  none;">
      <span class="sa-line sa-tip"></span>
      <span class="sa-line sa-long"></span>

      <div class="sa-placeholder"></div>
      <div class="sa-fix"></div>
    </div><div class="sa-icon sa-custom" style="display: none;"></div><h2>Estas seguro?</h2>
    <p style="display:  block;">De enviar el reclamo!</p>
    
    <fieldset>
      <input tabindex="3" placeholder="" type="text">
      <div class="sa-input-error"></div>
    </fieldset><div class="sa-error-container">
      <div class="icon">!</div>
      <p>Not valid!</p>
    </div><div class="sa-button-container">
      <button class="cancel" tabindex="2" style="display:  inline-block; box-shadow:  none;" data-dismiss="modal">Cancelar</button>
      <div class="sa-confirm-button-container">
        <button class="confirm" tabindex="1" style="display:  inline-block; background-color:  rgb(255, 112, 67); box-shadow:  rgba(255, 112, 67, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;" onclick="guardar()">Si, envio el reclamo!</button><div class="la-ball-fall">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    </div></div>
   </div>
</div>


<div class="modal fade" id="modal_funcionario" role="dialog">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" bgcolor="green">Datos Personales</h3>
            </div>
            <div class="modal-body form">
                <form id="form_funcionario">
				    <div class="panel-body">
				    	<div class="row">
				    		<div class="col-md-6">
				    			<div class="form-group">
									<label>Nombres  </label>
				                	<input type="text" class="form-control" name="nombrefunc" id="nombrefunc" cols="4" readonly="true">
								</div>
							</div>
							<div class="col-md-6">
				    			<div class="form-group">
									<label>Apellidos  </label>
				                	<input type="text" class="form-control " name="apellidofunc" id="apellidofunc"  readonly="true">
								</div>
							</div>
							
						</div>
						<div class="row">
				    		<div class="col-md-6">
				    			<div class="form-group">
									<label>Telefono  </label>
				                	<input type="text" class="form-control" name="telefonofunc" id="telefonofunc" placeholder="64 46526" cols="4" readonly="true">
								</div>
							</div>
							<div class="col-md-6">
				    			<div class="form-group">
									<label>Celular  </label>
				                	<input type="text" class="form-control " name="celularfunc" id="celularfunc" placeholder="72854321" readonly="true">
								</div>
							</div>
							
						</div>
						<div class="row">
				    		<div class="col-md-12">
				    			<div class="form-group">
									<label>Direccion  </label>
				                	<input type="text" class="form-control" name="direccfunc" id="direccfunc" placeholder="Sin dirección" cols="4" readonly="true">
								</div>
							</div>
							
						</div>
						
						
						
				    </div>
				</form>
				<!-- <button type="button" class="btn btn-default btn-sm" id="pnotify-confirm">Launch <i class="icon-play3 position-right"></i></button> -->
            </div>
            <div class="modal-footer">
                <!-- <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button> -->
                <!-- <button type="submit" id="btnSave" onclick="confirmar()" class="btn bg-teal-4  ">Guardar <i class="icon-arrow-right14 position-right"></i></button> -->
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="modal fade" id="modal_imprimir" role="dialog" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" bgcolor="green">Imprimir ODECO</h3>
            </div>
            <div class="modal-body form">
                <form id="form_imprimir">
				    <div class="panel-body">
				    	<div class="row">
				    		<div class="col-md-6">
				    			<div class="form-group">
									<label>Ingresar codigo de usuario  </label>
				                	<input autofocus type="text" class="form-control" name="codusuario" id="codusuario" placeholder="No hay nombre" cols="4" >				                	
				                </div>				               
							</div>
							<div class="col-md-6">
									<div  class="form-group"><div> </div> <div> </div><div style="color:white;"> jhorck</div> <div> </div>
				                	<button type="button" id="btnbuscarabonado" class="btn bg-teal-4  ">Buscar <i class=" icon-search4" ></i></button>
				                	</div>
				                </div>							
						</div>
						</form>						
						 <div id="abonadores" name="abonadores" class="panel-body">
						 </div>
						
				    </div>
				
				<!-- <button type="button" class="btn btn-default btn-sm" id="pnotify-confirm">Launch <i class="icon-play3 position-right"></i></button> -->
            </div>
            <div class="modal-footer">
                <!-- <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button> -->
                <button type="submit" id="btnImprimirC" class="btn bg-teal-4  ">Imprimir <i class="icon-arrow-right14 position-right"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->