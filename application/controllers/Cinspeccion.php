<?php if (!defined('BASEPATH')) exit('Acceso directo no permitido');

Class CInspeccion extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('inspeccion_model');
		$this->load->model('Encargado_model');
		$this->load->model('Odeco_model');
	}

	
	public function salida($data)
    {
    	$this->load->view('plantilla/header');
        $this->load->view($data['vista'],$data);
		$this->load->view('plantilla/footer');
    }

    public function index()
    {
        $data['vista'] = 'inspeccion';        
        // $data['reclamos'] = $this->lista();
        // $data['listainsp'] = $this->listainspectorr();
       	// $data['usuariocta'] = $this->datos_user();
        $this->salida($data);
        
    }
   

	public function lista()
	{
		$idpersona = $_SESSION['user_id'];
		$usuario = $this->inspeccion_model->get_dato_usuario($idpersona);
		$idcargo = $usuario[0]['detallecargo'];
		// echo $idcargo;
		if ($idcargo == 'INSPECTOR RED DE AGUA'){
		// print_r($_SESSION['user_id']);

				$dataa = $this->inspeccion_model->getReclamo();
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
									<li class="text-primary-600">
										<a href="javascript:void()" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-xs" title="Error, devolver" onclick="errordevolverformuno('."'".$lista->id_reclamo."'".')"><i class="icon-undo2"></i></a>
									</li>
									<li class="text-primary-600">
										<a href="javascript:void()" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-xs" title="Ir a inspeccionar" onclick="concluirinspeccioncuatro('."'".$lista->id_reclamo."'".')"><i class="icon-hammer2"></i></a>

									</li>
									</ul>';			
							
															
							$data[] = $row;
				} 		 

				$output = array("data" => $data,
								// "draw" => $_POST['draw'],
								"numero" => $this->inspeccion_model->count_all(),
								 // "recordsFiltered" => $this->principal_model->count_filtered(),
								// "data" => $listaa,
						);
				// output to json format
				echo json_encode($output);
		}else if ($idcargo == 'INSPECTOR ALCANTARILLADO'){
		// print_r($_SESSION['user_id']);

				$dataa = $this->inspeccion_model->getReclamocuatro();
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
									<li class="text-primary-600">
										<a href="javascript:void()" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-xs" title="Error, devolver" onclick="errordevolverformuno('."'".$lista->id_reclamo."'".')"><i class="icon-undo2"></i></a>
									</li>
									<li class="text-primary-600">
										<a href="javascript:void()" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-xs" title="Ir a inspeccionar" onclick="concluirinspeccioncinco('."'".$lista->id_reclamo."'".')"><i class="icon-hammer2"></i></a>

									</li>
									</ul>';			
							
															
							$data[] = $row;
				} 		 

				$output = array("data" => $data,
								// "draw" => $_POST['draw'],
								"numero" => $this->inspeccion_model->count_all(),
								 // "recordsFiltered" => $this->principal_model->count_filtered(),
								// "data" => $listaa,
						);
				// output to json format
				echo json_encode($output);
		} else 
		{
			$dataa = $this->inspeccion_model->getReclamo();
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
									<li class="text-primary-600">
										<a href="javascript:void()" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-xs" title="Error, devolver" onclick="errordevolverformuno('."'".$lista->id_reclamo."'".')"><i class="icon-undo2"></i></a>
									</li>
									<li class="text-primary-600">
										<a href="javascript:void()" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-xs" title="Ir a inspeccionar" onclick="concluirinspeccionformuno('."'".$lista->id_reclamo."'".')"><i class="icon-hammer2"></i></a>

									</li>
									</ul>';			
							
															
							$data[] = $row;
				} 		 

				$output = array("data" => $data,
								// "draw" => $_POST['draw'],
								"numero" => $this->inspeccion_model->count_all(),
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
		$usuario = $this->principal_model->get_dato_usuario($idpersona);
		$idcargo = $usuario[0]['detallecargo'];
		// echo $idcargo;
		if ($idcargo == 'USUARIO ODECO'){
			$data = $this->principal_model->get_datofuncionario();
			// print_r($data);
			// echo "entro mal";
			echo json_encode($data);
		} else {
			$data = $this->principal_model->getinspector();
			// print_r($data);
			echo json_encode($data);
		}
	}

	public function ajax_editt($id)
	{
		// $data['reclamos'] = $this->principal_model->getdatosins($id);
		// $data['listainsp'] = $this->principal_model->getinspector();
		
		$data = $this->principal_model->getdatosins($id);
		// $data = $this->principal_model->getinspector();
		echo json_encode($data);
	}

	public function numero(){

		$numero = $this->principal_model->count_all();
		echo json_encode($numero);
	}

	public function datos_user()
	{
		$idusuario = $_SESSION['user_id'];
	    $nombreuser = $this->inspeccion_model->get_dato_usuario($idusuario);
	    echo json_encode($nombreuser);
    }

	public function ajax_adicionar($id)
	{
			
		$idpersona = $_SESSION['user_id'];
		$usuario = $this->principal_model->get_dato_usuario($idpersona);
		$idcargo = $usuario[0]['detallecargo'];
		if ($idcargo == 'USUARIO ODECO'){
			$fecha = date("d-m-Y H:i:s",strtotime('now'));
			$data = array(
					'fechaderivacion' => $fecha,
					'estadoseguimiento' => 1,
					'id_funcionario' => $id, 
					'id_reclamo' => $this->input->post('id_reclamo'),
				);
			$insert = $this->principal_model->guardar($data);
			$data = array(
					'estadoreclamo' => 1,
				);
			// print_r($data);
			$this->principal_model->actualizar(array('id_reclamo' => $this->input->post('id_reclamo')),$data);
			
			
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
			$insert = $this->principal_model->guardar($data);
			// print_r($update);
			$data = array(
					'estadoreclamo' => 2,
				);
			// print_r($data);
			$this->principal_model->actualizar(array('id_reclamo' => $this->input->post('id_reclamo')),$data);
			
			
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
		$this->principal_model->actualizar(array('id_reclamo' => $this->input->post('id_reclamo')),$data);
		$data = $this->principal_model->getReclamo();
		return $data;
		$this->index();
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->Persona_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function actualizar_inspeccion_error()
	{
		$id_reclamo = $this->input->post('id');
		$data = array(
			'estadoreclamo' => $this->input->post('estado'),
		);
		$this->Encargado_model->updatereclamo(array('id_reclamo' => $id_reclamo),$data);

		$this->Encargado_model->eliminaseguimiento($id_reclamo);
		echo json_encode(array("status" => TRUE));
	}

	public function actualizar_inspeccion()
	{
		$data = array(
			'estadoreclamo' => $this->input->post('estado')
		);
		$this->Odeco_model->update(array('id_reclamo' => $this->input->post('id')), $data);
		$_SESSION['id_reclamosession'] = (int)$this->input->post('id');
		echo json_encode(array("status" => TRUE));
	}
}

?>