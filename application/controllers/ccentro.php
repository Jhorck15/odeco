<?php if (!defined('BASEPATH')) exit('Acceso directo no permitido');

Class CCentro extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('centro_model');
		// $this->load->model('Eso_model');

	}

	
	public function salida($data)
    {
    	$this->load->view('plantilla/header');
        $this->load->view($data['vista'],$data);
		$this->load->view('plantilla/footer');
        
    }

    public function index()
    {
        $data['vista'] = 'centro';        
        // $data['reclamos'] = $this->lista();
        // $data['listainsp'] = $this->listainspectorr();
       	// $data['usuariocta'] = $this->datos_user();
        $this->salida($data);
        
    }
   

	public function lista()
	{
		$idpersona = $_SESSION['user_id'];
		$usuario = $this->centro_model->get_dato_usuario($idpersona);

		$idcargo = $usuario[0]['detallecargo'];
		// echo $idcargo;
		if ($idcargo == 'USUARIO ODECO'){

				$dataa = $this->centro_model->getReclamo();
				// print_r('1 ES');
				$data = array();
			
				// print_r($data);

				$i = 0;	
				$fechaactual = strtotime('now');
				// $no = $_POST['start'];
				foreach($dataa as $lista){
					$i++;
					// $no++;
					$fechaini=date("d-m-Y", strtotime($lista->ini));
					$fechafinal=date("d-m-Y", strtotime($lista->fin));
					$fecha= strtotime($lista->ini); 
				    $dia=date("d",$fecha); 
				    $mes=date("m",$fecha); 
				    $ano=date("Y",$fecha);
				    $diaactual=date("d",$fechaactual);
				    $mesactual=date("m",$fechaactual);
				    $anoactual=date("Y",$fechaactual);
				    				  			    
				    $fecha1=mktime(0,0,0,$mesactual,$diaactual,$anoactual);
				    $fecha2=mktime(0,0,0,$mes,$dia,$ano);
				 
				    $diferencia=$fecha1-$fecha2;
				    $dias=$diferencia/(60*60*24);
				    $dias=floor($dias);
				    // echo 'dias diferencia'+$dias;
						
					if($dias>10){
						$color="color:red";
					} elseif ($dias>5) {
						$color="color:#e6e600";
					} else {$color="color:green";}
							$row = array();
							$row[] = $i;
							$row[] = $lista->codigousuario;
							$row[] = $lista->nombres.' '.$lista->apellidos;
							$row[] = $lista->numero;
							$row[] = $fechaini;
							$row[] = $fechafinal;
							$row[] = $dias;
							$row[] = $lista->motivo;
							$row[] = $lista->nombreforma;	
							$row[] = '<ul class="icons-list">
									<li >
										<a href="javascript:void()" class="btn border-teal-400 text-teal btn-flat btn-rounded btn-icon btn-xs" title="Derivarmar" onclick="edit_inspectorr('."'".$lista->id_reclamo."'".')"><i class="icon-redo2"></i></a>
									</li>
									
									</ul>';			
							

							
							$data[] = $row;
				} 		 

				$output = array("data" => $data,
								// "draw" => $_POST['draw'],
								"numero" => $this->centro_model->count_all(),
								 // "recordsFiltered" => $this->principal_model->count_filtered(),
								// "data" => $listaa,
						);
				// output to json format
				echo json_encode($output);

		} else{
				// print_r('2');
				$dataa = $this->centro_model->getReclamoInsp();
				// print_r($data);
				$data = array();
			
				 // print_r($data);

				$i = 0;	
				$fechaactual = strtotime('now');
				// $no = $_POST['start'];
				foreach($dataa as $lista){
					$i++;
					// $no++;
					$fechaini=date("d-m-Y", strtotime($lista->ini));
					$fechafinal=date("d-m-Y", strtotime($lista->fin));
					$fecha= strtotime($lista->ini); 
				    $dia=date("d",$fecha); 
				    $mes=date("m",$fecha); 
				    $ano=date("Y",$fecha);
				    $diaactual=date("d",$fechaactual);
				    $mesactual=date("m",$fechaactual);
				    $anoactual=date("Y",$fechaactual);
				    				  			    
				    $fecha1=mktime(0,0,0,$mesactual,$diaactual,$anoactual);
				    $fecha2=mktime(0,0,0,$mes,$dia,$ano);
				 
				    $diferencia=$fecha1-$fecha2;
				    $dias=$diferencia/(60*60*24);
				    $dias=floor($dias);

					if($dias>10){
						$color="color:red";
					} elseif ($dias>5) {
						$color="color:#e6e600";
					} else {$color="color:green";}
							// $unir = 
							$row = array();
							$row[] = $i;
							$row[] = $lista->codigousuario;
							$row[] = $lista->nombres.' '.$lista->apellidos;
							$row[] = $lista->numero;
							$row[] = $fechaini;
							$row[] = $fechafinal;
							$row[] = $dias;
							$row[] = $lista->motivo;
							$row[] = $lista->nombreforma;	
							$row[] = '<ul class="icons-list">
									<li >
										<a href="javascript:void()" class="btn border-teal-400 text-teal btn-flat btn-rounded btn-icon btn-xs" title="Derivarmar1" onclick="edit_inspectorr('."'".$lista->id_reclamo."'".')"><i class="icon-redo2"></i></a>
									</li>
									<li class="text-danger-600">
										<a href="javascript:void()" class="btn border-danger text-danger btn-flat btn-rounded btn-icon btn-xs" title="Error devolver" onclick="errordevolver('."'".$lista->id_reclamo."'".')"><i class="icon-undo2"></i></a>
										</li>
									</ul>';			
							

							
							$data[] = $row;
						} 		 

				$output = array("data" => $data,
								// "draw" => $_POST['draw'],
								"numero" => $this->centro_model->count_all(),
								 // "recordsFiltered" => $this->principal_model->count_filtered(),
								// "data" => $listaa,
						);
				// output to json format
				echo json_encode($output);

		}

	}

	

	public function listainspectorr()
	{
		$idcargo = '';
		$idpersona = $_SESSION['user_id'];
		$usuario = $this->centro_model->get_dato_usuario($idpersona);
		$idcargo = $usuario[0]['detallecargo'];
		// echo $idcargo;
		if ($idcargo == 'USUARIO ODECO'){
			$data = $this->centro_model->get_datofuncionario();
			// print_r($data);
			// echo "entro mal";
			echo json_encode($data);
		} else if ($idcargo == 'JEFE ATENCION AL CLIENTE'){
			$data = $this->centro_model->getjefaturas();
			echo json_encode($data);
		} else if ($idcargo == 'JEFE RED DE AGUA'){
			$data = $this->centro_model->getRedAgua();
			echo json_encode($data);
		} else if ($idcargo == 'JEFE ALCANTARILLADO'){
			$data = $this->centro_model->getRedAlcantarillado();
			echo json_encode($data);
		}
		else {
			$data = $this->centro_model->getinspector();
			// print_r($data);
			echo json_encode($data);			
		}
		
	}

	public function ajax_editt($id)
	{
		// $data['reclamos'] = $this->principal_model->getdatosins($id);
		// $data['listainsp'] = $this->principal_model->getinspector();
		
		$data = $this->centro_model->getdatosins($id);
		// $data = $this->principal_model->getinspector();
		echo json_encode($data);
	}

	public function numero(){

		$numero = $this->centro_model->count_all();
		echo json_encode($numero);
	}

	public function datos_user()
	{
		$idusuario = $_SESSION['user_id'];
	    $data = $this->centro_model->get_dato_usuario($idusuario);
	    echo json_encode($data);
    }

   	public function searchh()
	{

        $campo = 'codigousuario';
        $dato  = $this->input->get('numero');
        $reclamo_detalle = '';

        // print_r($campo);

        $datos = $this->centro_model->get_abonado_by_numerocuenta($campo,$dato);
       
        if(count($datos) > 0){
        	$cons_reclamo = $this->centro_model->get_reclamo_usuario($dato);

       // print_r($cons_reclamo);
       
        	if ($cons_reclamo != null){
	        switch ($cons_reclamo->estadoreclamo) {
	        	case '0':
	        		$reclamo_detalle = 'EL RECLAMO SE ENCUENTRA EN ATC';
	        		break;
	        	case '1':
	        		$reclamo_detalle = 'EL RECLAMO SE ENCUENTRA EN JEFATURA';
	        		break;
	        	case '2':
	        		$reclamo_detalle = 'SE ESTÁ ELABORANDO EL INFORME TÉCNICO';
	        		break;
	        	case '3':
	        		$reclamo_detalle = 'SE TERMINO EL INFORME TÉCNICO';
	        		break;
	        	case '4':
	        		$reclamo_detalle = 'SE ENCUENTRA EN JEFATURA PARA ELABORACIÓN DE CONCLUSIÓN';
	        		break;	
	        	case '5':
	        		$reclamo_detalle = 'ELABORACIÓN DE CONCLUSIÓN';
	        		break;	
	        	case '6':
	        		$reclamo_detalle = 'PROCESO TERMINADO';
	        		break;	
	        	// default:
	        	
	        	// 	break;
	        };
	        echo '<div class="alert bg-info alert-styled-right">										<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button><span class="text-semibold">'.$reclamo_detalle.'</div>';
        	echo '<div class="panel-body">';
		    	echo '<div class="row">';
		    		echo '<div class="col-md-4">';
		    			echo '<div class="form-group">';
		    				// echo '<label>ID_abonado: </label>';
							echo '<input type="hidden" value="'.$datos->id_abonado.'" id="id_abonadobusq" name="id_abonadob"/>';
							// echo '<br>';
							echo '<label>Nombres: </label>';
		                	echo '<input type="text" class="form-control" value="'.$datos->nombres.'" id="nombresbusq" name="nombres" placeholder="Ingrese su nombre">';
						echo '</div>';
					echo '</div>';
					echo '<div class="col-md-4">';
		    			echo '<div class="form-group">';
							echo '<label>Apellidos: </label>';
		                	echo '<input type="text" class="form-control" value="'.$datos->apellidos.'" id="apellidosb" name="apellidos" placeholder="Ingrese su apellido">';
						echo '</div>';
					echo '</div>';
					echo '<div class="col-md-4">';
		    			echo '<div class="form-group">';
							echo '<label>Carnet de Indentidad: </label>';
		                	echo '<input type="text" class="form-control" value="'.$datos->ci.'" id="cib" name="ci" placeholder="Numero de CI">';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="row">';
		    		echo '<div class="col-md-4">';
						echo '<div class="form-group">';
							echo '<label>Categoria: </label>';
		                	echo '<input type="text" class="form-control format-phono-celular" value="'.$datos->detallecategoria.'" id="celularb" name="celular" placeholder="(591) 999 99999">';
						echo '</div>';
					echo '</div>';
					echo '<div class="col-md-4">';
		    			echo '<div class="form-group">';
							echo '<label>Telefono Fijo</label>';
		                	echo '<input type="text" class="form-control format-phone-fijo" value="'.$datos->telefono.'" id="telefonob" name="telefono" placeholder="4 64 - 99999">';
						echo '</div>';
					echo '</div>';
					echo '<div class="col-md-4">';
		    			echo '<div class="form-group">';
							echo '<label>Celular: </label>';
		                	echo '<input type="text" class="form-control format-phono-celular" value="'.$datos->celular.'" id="celularb" name="celular" placeholder="(591) 999 99999">';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="row">';
					echo '<div class="col-md-8">';
		    			echo '<div class="form-group">';
							echo '<label>Direccion: </label>';
		                	echo '<input type="text" class="form-control" value="'.$datos->direccion.'" id="direccionb" name="direccion" placeholder="Direccion...">';
						echo '</div>';
					echo '</div>';
					echo '<div class="col-md-2">';
		    			echo '<div class="form-group">';
							echo '<label>Estado: </label>';
		                	echo '<input type="text" class="form-control" value="'.$cons_reclamo->estadoreclamo.'" id="estado" name="estado">';
						echo '</div>';
					echo '</div>';
				echo '</div>';
		    echo '</div>';
	        
	   		// } else {
	   		//  	$reclamo_detalle = 'NO TIENE RECLAMOS REGISTRADOS';
	   		//  }
        	}else {
        	$reclamo_detalle = 'NO SE ENCONTRARON RECLAMOS';
        	echo '<div class="alert bg-info alert-styled-right">										<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button><span class="text-semibold">'.$reclamo_detalle.'</div>';
        	}
    	} else {
        	$reclamo_detalle = 'NO SE ENCONTRÓ EL CODIGO DE USUARIO';
        	echo '<div class="alert bg-info alert-styled-right">										<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button><span class="text-semibold">'.$reclamo_detalle.'</div>';
        	}          
     
	}

	// añade riglesias
	public function ajax_adicionar($id)
	{
		$idpersona = $_SESSION['user_id'];
		$usuario = $this->centro_model->get_dato_usuario($idpersona);
		$idcargo = $usuario[0]['detallecargo'];
		// print_r($id);
		if ($idcargo == 'USUARIO ODECO'){
			$fecha = date("d-m-Y H:i:s",strtotime('now'));
			$data = array(
					'fechaderivacion' => $fecha,
					'estadoseguimiento' => 1,
					'id_funcionario' => $id, 
					'id_reclamo' => $this->input->post('id_reclamo'),
				);
			// print_r($data);
			$insert = $this->centro_model->guardar($data);
			$data = array(
					'estadoreclamo' => 1,
				);
			// print_r($data);
			$this->centro_model->actualizar(array('id_reclamo' => $this->input->post('id_reclamo')),$data);
			
			
			echo json_encode(array("status" => TRUE));
		} else {

			$fecha = date("d-m-Y H:i:s",strtotime('now'));
			$data = array(
					'fechaderivacion' => $fecha,
					'estadoseguimiento' => 2,
					'id_funcionario' => $id, 
					// 'id_seguimiento' => $idseguimiento, 
					'id_reclamo' => $this->input->post('id_reclamo'),
				);
			$insert = $this->centro_model->guardar($data);
			// print_r($update);
			$data = array(
					'estadoreclamo' => 2,
				);
			// print_r($data);
			$this->centro_model->actualizar(array('id_reclamo' => $this->input->post('id_reclamo')),$data);
			
			
			echo json_encode(array("status" => TRUE));
		}

	}

	public function ajax_actualizar()
	{
		// $this->_validate();
		// print_r("el reclamo es:".$rec);
		$data = array(
				'id_reclamo' => $this->input->post('id_reclamo'),
				'estadoreclamo' => 0,
			);
		// print_r($data);
		$this->centro_model->actualizar(array('id_reclamo' => $this->input->post('id_reclamo')),$data);
		$data = $this->centro_model->getReclamo();
		return $data;
		$this->index();
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->Persona_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function odecos(){
		$data = $this->centro_model->get_odecos();
		echo $data;
	}

	public function actualizar_inspeccion_error()
	{
		$id_reclamo = $this->input->post('id_reclamo');
		$data = array(
			'estadoreclamo' => $this->input->post('estado'),
		);
		$this->centro_model->updatereclamo(array('id_reclamo' => $id_reclamo),$data);

		// $this->principal_model->eliminaseguimiento($id_reclamo);
		echo json_encode(array("status" => TRUE));
	}
}

?>