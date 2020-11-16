<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listaconclusiones extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Conclusion_model');
	}

	public function salida($data)
    {
        $this->load->view('plantilla/header');
        $this->load->view($data['vista'],$data);
        $this->load->view('plantilla/footer');
    }

    public function index()
    {
        $data['vista'] = 'listaconclusiones_view';
        $this->salida($data);
    }

	public function ajax_list()
	{
		// print_r('2');
		$dataa = $this->Conclusion_model->getReclamoInsp();
		// print_r($_SESSION['id_persona']);
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
					$row[] = $lista->descripcioninformeinspeccion;
					$row[] = $lista->nombreforma;	
					$row[] = '<ul class="icons-list">
							<li >
								<a href="javascript:void()" class="btn border-teal-400 text-teal btn-flat btn-rounded btn-icon btn-xs" title="Derivar" onclick="terminar_reclamo('."'".$lista->id_reclamo."'".')"><i class="icon-finish"></i></a>
							</li>
							<li >
								<a href="javascript:void()" class="btn border-teal-400 text-teal btn-flat btn-rounded btn-icon btn-xs" title="Derivar" onclick="devolver_inspeccioninspector('."'".$lista->id_reclamo."'".')"><i class="icon-forward"></i></a>
							</li>
							
							</ul>';

					$data[] = $row;
				} 		 

		$output = array("data" => $data,
						// "draw" => $_POST['draw'],
						"numero" => $this->Conclusion_model->count_all(),
						 // "recordsFiltered" => $this->principal_model->count_filtered(),
						// "data" => $listaa,
				);
		// output to json format
		echo json_encode($output);
	}

	public function actualizar_inspeccion_error()
	{
		$id_reclamo = $this->input->post('id_reclamo');
		// print_r($this->input->post('eso'));
		$data = array(
			'estadoreclamo' => $this->input->post('estado'),
		);
		$this->Conclusion_model->updatereclamo(array('id_reclamo' => $id_reclamo),$data);

		$this->Conclusion_model->eliminaseguimientocuatro($id_reclamo);
		$id_seguimiento = $this->Conclusion_model->busquedaseguimiento($id_reclamo);
		// print_r($id_seguimiento[0]->id_seguimiento);
		$dataupdate = array(
			'estadoseguimiento' => '2',
			'fechadevolucion' => null
		);
		$this->Conclusion_model->updateseguimientocuatro(array('id_seguimiento' => $id_seguimiento[0]->id_seguimiento), $dataupdate);
		
		echo json_encode(array("status" => TRUE));
	}

	public function concluir(){
		date_default_timezone_set('America/La_Paz');

		$id_reclamo = $this->input->post('id_reclamo');
		$_SESSION['id_reclamo_concluir']=$id_reclamo;
		$data = array(
			'estadoreclamo' => $this->input->post('estado'),
		);
		$this->Conclusion_model->updatereclamo(array('id_reclamo' => $id_reclamo),$data);

		// ----------------------
		$dataseguimientoaniadir = array(
			'fechaderivacion' => date("Y-m-d H:i:s"),
			// 'fechadevolucion' => '',
			'estadoseguimiento' => '5',
			'id_funcionario' => $_SESSION['id_persona'],
			'id_reclamo' => $id_reclamo,
		);
		$this->Conclusion_model->insertar_seguimiento($dataseguimientoaniadir);

		echo json_encode(array("status" => TRUE));
	}


	// public function ajax_add()
	// {
	// 	// $this->_validate();
	// 	$data = array(
	// 			'nombres' => $this->input->post('nombres'),
	// 			'apellidos' => $this->input->post('apellidos'),
	// 			'direccion' => $this->input->post('direccion'),
	// 			'telefono' => $this->input->post('telefono'),
	// 			'celular' => $this->input->post('celular'),
	// 			'ci' => $this->input->post('ci'),
	// 			'nit' => $this->input->post('nit'),
	// 		);
	// 	$insert = $this->Conclusion_model->save($data);
	// 	$nombres = $this->Conclusion_model->get_by_id($insert);
	// 	echo json_encode(array("status" => TRUE, "persona"=>$nombres));
	// }

	// public function ajax_edit($id)
	// {
	// 	$data = $this->Conclusion_model->get_by_id($id);
	// 	// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
	// 	echo json_encode($data);
	// }

	// public function ajax_update()
	// {
	// 	// $this->_validate();
	// 	$data = array(
	// 			'nombres' => $this->input->post('nombres'),
	// 			'apellidos' => $this->input->post('apellidos'),
	// 			'direccion' => $this->input->post('direccion'),
	// 			'telefono' => $this->input->post('telefono'),
	// 			'celular' => $this->input->post('celular'),
	// 			'ci' => $this->input->post('ci'),
	// 			'nit' => $this->input->post('nit'),
	// 		);
	// 	$this->Conclusion_model->update(array('id_persona' => $this->input->post('id_persona')), $data);
	// 	echo json_encode(array("status" => TRUE));
	// }

	// public function ajax_delete($id)
	// {
	// 	$this->Conclusion_model->delete_by_id($id);
	// 	echo json_encode(array("status" => TRUE));
	// }

    
}
