
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Odeco extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->helper(array('url', 'form'));
		// $this->load->library('form_validation');
		$this->load->model('Odeco_model','odeco_model');
		$this->load->model('Odecovista_model');
		$this->load->model('Persona_model');
		$this->load->model('Abonado_model');
	}

	public function salida($data)
    {
        $this->load->view('plantilla/header');
        $this->load->view($data['vista'],$data);
        $this->load->view('plantilla/footer');
    }
    public function index()
    {
    	$data['vista'] = 'odeco_view';
    	$data['opciones']  = $this->menu_activo(0);
        $this->salida($data);
    }
    private function menu_activo($opcion) {
        $opcion1 = '';
        $opcion2 = '';
        $opcion3 = '';
        $opcion4 = '';
        $opcion5 = '';
        $opcion6 = '';
        $opcion7 = '';
        $opcion8 = '';
        $opcion9 = '';
        switch($opcion)
        {
            case 1:$opcion1='active';break;
            case 2:$opcion2='active';break;
            case 3:$opcion3='active';break;
            case 4:$opcion4='active';break;
            case 5:$opcion5='active';break;
            case 6:$opcion6='active';break;
            case 7:$opcion7='active';break;
            case 8:$opcion8='active';break;
            case 9:$opcion9='active';break;

        }
        $data = array('opcion1'=>$opcion1,
                      'opcion2'=>$opcion2,
                      'opcion3'=>$opcion3,
                      'opcion4'=>$opcion4,
                      'opcion5'=>$opcion5,
                      'opcion6'=>$opcion6,
                      'opcion7'=>$opcion7,
                      'opcion8'=>$opcion8,
                      'opcion9'=>$opcion9
                     );

        return $data;
    }

	public function ajax_listvista()
	{
		$list = $this->Odecovista_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $reclamo) {
			$no++;
			$row = array();
			$row[] = $reclamo->numero;
			$row[] = $reclamo->fechareclamo;
			$row[] = $reclamo->fecharespuesta;
			// $row[] = $reclamo->motivo;
			$row[] = $reclamo->reclamante;
			$row[] = $reclamo->abonado;
			$row[] = $reclamo->nombreclase;
			$row[] = $reclamo->nombreforma;
			$row[] = $reclamo->nombretiporeclamo;

			$row[] = '<ul class="icons-list">
						<li class="text-primary-600">
							<a href="javascript:void()" title="Editar" onclick="edit_reclamo('."'".$reclamo->id_reclamo."'".')"><i class="icon-pencil7"></i></a>
						</li>
						<li class="text-danger-600">
							<a href="javascript:void()" title="Eliminar" onclick="delete_reclamo('."'".$reclamo->id_reclamo."'".')"><i class="icon-trash"></i></a>
						</li>
					</ul>';
		
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->odeco_model->count_all(),
			"recordsFiltered" => $this->odeco_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_list()
	{
		$list = $this->odeco_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $reclamo) {
			$no++;
			$row = array();
			$row[] = $reclamo->numero;
			$row[] = $reclamo->fechareclamo;
			$row[] = $reclamo->fecharespuesta;
			$row[] = $reclamo->motivo;
			$row[] = $reclamo->id_persona;
			$row[] = $reclamo->id_abonado;
			$row[] = $reclamo->id_clasereclamo;
			$row[] = $reclamo->id_formareclamo;
			$row[] = $reclamo->id_tiporeclamo;

			$row[] = '<ul class="icons-list">
						<li class="text-primary-600">
							<a href="javascript:void()" title="Edit" onclick="edit_reclamo('."'".$reclamo->id_reclamo."'".')"><i class="icon-pencil7"></i></a>
						</li>
						<li class="text-danger-600">
							<a href="javascript:void()" title="Hapus" onclick="delete_reclamo('."'".$reclamo->id_reclamo."'".')"><i class="icon-trash"></i></a>
						</li>
					</ul>';
		
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->odeco_model->count_all(),
			"recordsFiltered" => $this->odeco_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	
	public function get_clasereclamo()
	{
		$clasereclamo = $this->odeco_model->get_clasereclamo();
		echo json_encode($clasereclamo);
	}
	public function get_formareclamo()
	{
    	$formareclamo = $this->odeco_model->get_formareclamo();
    	echo json_encode($formareclamo);
	}

	public function get_numeroreclamo()
	{
    	$numero = $this->odeco_model->get_numeroreclamo();
    	echo json_encode($numero);
	}

	public function get_abonado_by_cuentausuario()
	{
		$co = $this->input->get('term');
		$list = $this->odeco_model->get_abonado_by_cuenta_usuario($co);
		echo json_encode($list);
	}

	public function ajax_add_reclamo(){
		// $this->_validate();
		// get_numeroreclamo();
		$numero = $this->odeco_model->get_numeroreclamo();
		$buscar = $this->odeco_model->get_reclamo_usuario($this->input->post('cod_usu_odeco'));
		// printf($buscar);

		// $dos = json_encode($numero);
		// echo $numero->numero;
		// $numero = $numero + 1; 
		
		// if ( !empty($_POST["tiporeclamo"]) && is_array($_POST["tiporeclamo"]) ) { 
			if ($buscar == 0) {
				$data = array(
					'numero' => $numero->numero + 1,
					'fechareclamo' => $this->input->post('fechareclamo'),
					'fecharespuesta' => $this->input->post('fecharespuesta'),
					'motivo' => $this->input->post('motivo'),
					'id_persona' => $this->input->post('id_persona'),
					'id_abonado' => $this->input->post('id_abonado'),
					'id_clasereclamo' => $this->input->post('clasereclamo'),
					'id_formareclamo' => $this->input->post('formareclamo'),
					'estadoreclamo' => $this->input->post('estadoreclamo'),
					'id_funcionario' => $this->input->post('id_funcionario'),
					'id_tiporeclamo' => $this->input->post('tiporeclamo')
				);
				// print_r($data);
				$this->odeco_model->save_reclamo($data);
				
				echo json_encode(array("status" => TRUE));
			} 			else {
				echo json_encode(array('status' => '100'));
			};
		
	}

	// public function ajax_add_reclamodos(){
	// 	// $this->_validate();
	// 	// get_numeroreclamo();
	// 	$numero = $this->odeco_model->get_numeroreclamo();
	// 	$buscar = $this->odeco_model->get_reclamo_odeco($this->input->post('cod_usu_odeco'));
	// 	// printf($buscar);

	// 	// $dos = json_encode($numero);
	// 	// echo $numero->numero;
	// 	// $numero = $numero + 1; 
		
	// 	// if ( !empty($_POST["tiporeclamo"]) && is_array($_POST["tiporeclamo"]) ) { 
	// 		if ($buscar == 0) {
	// 			$data = array(
	// 				'numero' => $numero->numero + 1,
	// 				'fechareclamo' => $this->input->post('fechareclamo'),
	// 				'fecharespuesta' => $this->input->post('fecharespuesta'),
	// 				'motivo' => $this->input->post('motivo'),
	// 				'id_persona' => $this->input->post('id_persona'),
	// 				'id_abonado' => $this->input->post('id_abonado'),
	// 				'id_clasereclamo' => $this->input->post('clasereclamo'),
	// 				'id_formareclamo' => $this->input->post('formareclamo'),
	// 				'estadoreclamo' => $this->input->post('estadoreclamo'),
	// 				'id_funcionario' => $this->input->post('id_funcionario'),
	// 				'id_tiporeclamo' => $this->input->post('tiporeclamo')
	// 			);
	// 			// print_r($data);
	// 			$this->odeco_model->save_reclamo($data);
				
	// 			echo json_encode(array("status" => TRUE));
	// 		} 			else {
	// 			echo json_encode(array('status' => '100'));
	// 		};
		
	// }
	
	public function get_tiporeclamo_subreclamo(){
		$list = $this->odeco_model->get_tiporeclamo_subreclamo();
		// print_r($list);
		echo json_encode($list);
	}

	public function get_tiporeclamo(){
		$list = $this->odeco_model->get_tiporeclamo();
		echo json_encode($list);
	}

	public function get_subreclamo(){
		$id_tiporeclamo = $this->input->post('id_tiporeclamo');
		$list = $this->odeco_model->get_subreclamo($id_tiporeclamo);
		echo json_encode($list);
	}

	public function ajax_edit_reclamo($id)
	{
		$data = $this->odeco_model->get_by_id($id);
		$data->fechareclamo = ($data->fechareclamo == '0000-00-00') ? '' : $data->fechareclamo;
		$data->fecharespuesta = ($data->fecharespuesta == '0000-00-00') ? '' : $data->fecharespuesta;

		// $data2 = $this->odeco_model->get_by_idreclamo($id);

		// foreach ($data2 as $valor) {
		// array_push ($data , $data2);
		// $data->trsr = $data2;
		// }
		echo json_encode($data);
	}

	public function ajax_update_reclamo(){
		if ( !empty($_POST["formareclamomodal"]) || !empty($_POST["tiporeclamomodal"]) || !empty($_POST["clasereclamomodal"]) ) { 
			$data = array(
				'numero' => $this->input->post('numeromodal'),
				'id_persona' => $this->input->post('id_personamodal'),
				'id_abonado' => $this->input->post('id_abonadomodal'),
				'id_formareclamo' => $this->input->post('formareclamomodal'),
				'id_tiporeclamo' => $this->input->post('tiporeclamomodal'),
				'id_clasereclamo' => $this->input->post('clasereclamomodal'),
				'fechareclamo' => $this->input->post('fechareclamomodal'),
				'fecharespuesta' => $this->input->post('fecharespuestamodal'),
				'motivo' => $this->input->post('motivomodal'),
				'id_funcionario' => $this->input->post('id_funcionariomodal')
			);
			
			$this->odeco_model->update(array('id_reclamo' => $this->input->post('id_reclamomodal')), $data);
			echo json_encode(array("status" => TRUE));
		} else {
			echo json_encode(array("status" => FALSE));
		}
	}
	/*


	public function ajax_delete($id)
	{
		$this->odeco_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('firstName') == '')
		{
			$data['inputerror'][] = 'firstName';
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('lastName') == '')
		{
			$data['inputerror'][] = 'lastName';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('dob') == '')
		{
			$data['inputerror'][] = 'dob';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('gender') == '')
		{
			$data['inputerror'][] = 'gender';
			$data['error_string'][] = 'Please select gender';
			$data['status'] = FALSE;
		}

		if($this->input->post('address') == '')
		{
			$data['inputerror'][] = 'address';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	*/

}

