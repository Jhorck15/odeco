<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_ins_tecnica extends CI_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('Inspeccion_model');
		// $this->load->model('Poseidon_model');
		$this->load->model('Odeco_model');
		$this->load->model('Form_ins_tecnica_model');
	}

	public function index()
	{
	    $data['vista'] = 'form_ins_tecnica_view';
	    $this->salida($data);
	}

	public function salida($data)
    {
    	
        $this->load->view('plantilla/header');
        $this->load->view($data['vista'],$data);
        $this->load->view('plantilla/footer');
    }

	public function ajax_list()
	{
		$list = $this->Form_ins_tecnica_model->get_datatables();
		// print_r($list);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $inspeccion) {
			$no++;
			$row = array();
			$row[] = $inspeccion->fechaforinspcuatro;
			$row[] = $inspeccion->presionaguazona;
			$row[] = $inspeccion->faltaagua;
			$row[] = $inspeccion->faltapresion;
			$row[] = $inspeccion->fugaredmatriz;
			$row[] = $inspeccion->llavemal;
			$row[] = $inspeccion->cambioacometida;
			$row[] = $inspeccion->personaqueatendio;			
			$row[] = '<ul class="icons-list">
						<li class="text-primary-600">
							<a href="javascript:void()" title="Edit" onclick="edit_forminscripcion('."'".$inspeccion->id_forinscuatro."'".')"><i class="icon-pencil7"></i></a>
						</li>
						
					</ul>';
					// <li class="text-success-600">
					// 		<a href="javascript:void()" title="Devolver" onclick="devolver_inspeccionformuno('."'".$inspeccion->id_formularioinspeccion."'".')"><i class="icon-reply"></i></a>
					// 	</li>
		
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Form_ins_tecnica_model->count_all(),
			"recordsFiltered" => $this->Form_ins_tecnica_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function cargar_reclamo(){
		// $_SESSION['id_reclamosession'] = 120;
		$data = $this->Odeco_model->get_by_id_reclamo($_SESSION['id_reclamosession']);
		// $data = $this->Odeco_model->get_codigo($data->reclamo);
		// print_r($data->id_reclamo);
		echo json_encode($data);
	}

	function Redirect($url, $permanent = false)
	{
	    if (headers_sent() === false)
	    {
	        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
	    }

	    exit();
	}


	public function ajax_add_inspection(){
		// if ( !empty($_POST["subreclamo"]) && is_array($_POST["subreclamo"]) ) {
		// 	if(!empty($_FILES['photo']['name']))
		// 	{
				$upload = $this->_do_upload();
				
				// print_r($upload);
				$dataarchivo = array('nombrearchivo' => $upload );
				$dataarchivo['nombrearchivo'] = $upload;
				

				$data = array(
					'fechaforinspcuatro' => $this->input->post('fechaforinspcuatro'),
					'presionaguazona' => $this->input->post('presionaguazona'),
					'faltaagua' => $this->input->post('faltaagua'),
					'fugaintra' => $this->input->post('fugaintra'),
					'faltapresion' => $this->input->post('faltapresion'),
					'fugaredmatriz' => $this->input->post('fugaredmatriz'),
					'reinsreconexion' => $this->input->post('reinsreconexion'),
					'llavemal' => $this->input->post('llavemal'),
					'fugaacometida' => $this->input->post('fugaacometida'),
					'nivemedidor' => $this->input->post('nivemedidor'),
					'malaagua' => $this->input->post('malaagua'),
					'cambioacometida' => $this->input->post('cambioacometida'),
					'trasmedidor' => $this->input->post('trasmedidor'),
					'personaqueatendio' => $this->input->post('personaqueatendio'),
					'descripcioninformeinspeccion' => $this->input->post('descripcioninformeinspeccion'),
					'id_reclamo' => $this->input->post('id_reclamoo'),
				);
				// print_r($data);
				$id_forinscuatro = $this->Form_ins_tecnica_model->save_formularioinspeccion($data);

				foreach ($upload as $up => $value) {
					foreach ($value as $key => $val) {
						if ($key=='file_name') {
							$dataarchivo = array('nombrearchivo' => $val, 'titulo' => '' );
							$id_archivo = $this->Form_ins_tecnica_model->save_archivo($dataarchivo);
							$datos_form_arch = array(
								'id_forinscuatro' => $id_forinscuatro,
								'id_archivo' => $id_archivo
							);
							$this->Form_ins_tecnica_model->save_formularioinspeccion_archivo($datos_form_arch);
						}
					}
				}

				// $id_tiporeclamo = ;$this->input->post('tiporeclamo')
				// foreach ($_POST["subreclamo"] as $sr ) {
				// 	$datos = array(
				// 		'id_tiporeclamo' => $this->input->post('tiporeclamo'),
				// 		'id_subreclamo' => $sr,
				// 		'id_forinscuatro' => $id_forinscuatro
				// 	);
				// 	$this->Form_ins_tecnica_model->save_tipreclamo_subreclamo($datos);
				// }
				
				$datar = array(
					'estadoreclamo' => 4
				);
				$this->Form_ins_tecnica_model->update_reclamo(array('id_reclamo'=> $this->input->post('id_reclamoo')), $datar);
				echo json_encode(array("status" => TRUE));
		// 	}

		// } else {
		// 	echo json_encode(array("status" => FALSE));
		// }
	}

	private function _do_upload()
	{
		$config['upload_path']          = 'upload/';
        $config['allowed_types']        = 'gif|png|jpg|jpeg|csv|xlsx|pdf|doc|docx|xls|xlsx|xl|csv';
        $config['max_size']             = 1000; //set max size allowed in Kilobyte
        $config['max_width']            = 3000; // set max width image allowed
        $config['max_height']           = 3000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        // $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if(!$this->upload->do_multi_upload('photo')) //upload and validate
        {
        	// print_r('Upload error: '.$this->upload->display_errors('',''));
			// $data['inputerror'][] = 'photo';
			$error = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			echo json_encode(array("error" => $error, "status" => FALSE));
			// echo json_encode($data);
			exit();
		}
		return $this->upload->get_multi_upload_data();
	}
	

	public function ajax_edit_forminspeccion($id)
	{
		// print_r($id);
		$data = $this->Form_ins_tecnica_model->get_by_id($id);
		$data->fechaforinspcuatro = ($data->fechaforinspcuatro == '0000-00-00') ? '' : $data->fechaforinspcuatro;

		$data2 = $this->Form_ins_tecnica_model->get_by_idformularioinspeccion($data->id_forinscuatro);
		// $data3 = $this->Form_inspeccion_model->get_by_idformularioinspeccion_archivo($data->id_formularioinspeccion);
		// // $data->form_isn_arch = $data3;

		// print_r($data3);
		// foreach ($data2 as $valor) {
		// array_push ($data , $data2);
		$data->trsr = $data2;
		// }
		// print_r($data);
		echo json_encode($data);
	}

	public function get_subreclamo(){
		$id_tiporeclamo = $this->input->post('id_tiporeclamo');
		$list = $this->Form_ins_tecnica_model->get_subreclamo($id_tiporeclamo);
		echo json_encode($list);
	}

	public function ajax_update_inspection()
	{
		$id_forminsp = $this->input->post('id_formularioinspeccion');
		if(!empty($_FILES['photo']['name']))
		{
			if ( !empty($_POST["subreclamo"]) && is_array($_POST["subreclamo"]) ) { 
				$data = array(
					'fechaforminspeccion' => $this->input->post('fechainspeccion'),
					'tamaniovivienda' => $this->input->post('tamaniovivienda'),
					'numerohabitantes' => $this->input->post('numerohabitantes'),
					'calibrado' => $this->input->post('calibrado'),
					'ubicacionmedidor' => $this->input->post('ubicacionmedidor'),
					'estadotanquebanio' => $this->input->post('estadotanquebanio'),
					'presionaguazona' => $this->input->post('presionzona'),
					'piscina' => $this->input->post('piscina'),
					'filtracioninterna' => $this->input->post('filtracioninterna'),
					'marcamedidor' => $this->input->post('marcamedidor'),
					'descripcioninformeinspeccion' => $this->input->post('descripcionmedidor'),
					'id_reclamo' => $this->input->post('id_reclamoo')
				);
				$this->Form_inspeccion_model->update(array('id_formularioinspeccion'=> $this->input->post('id_formularioinspeccion')), $data);
				$this->Form_inspeccion_model->delete_by_id_tiporeclamosubreclamo($this->input->post('id_formularioinspeccion'));
				$id_tiporeclamo = $this->input->post('tiporeclamo');
				foreach ($_POST["subreclamo"] as $sr ) {
					$datos = array(
						'id_tiporeclamo' => $id_tiporeclamo,
						'id_subreclamo' => $sr,
						'id_formularioinspeccion' => $this->input->post('id_formularioinspeccion')
					);
					$this->Form_inspeccion_model->save_tipreclamo_subreclamo($datos);
				}

				// // actualiza las imagenes
				$datoseliminar = $this->Form_inspeccion_model->get_archivo($id_forminsp);
				// $datoseliminar = $this->Form_inspecciontres_model->get_form__archivo(17);

				// print_r($datoseliminar[0]->nombrearchivo);
				// print_r($datoseliminar[0]);

				for ($i=0; $i < count($datoseliminar); $i++) { 
					$this->Form_inspeccion_model->delete_by_id_forminsp($id_forminsp);
				}
				// eliminar archivo
				for ($i=0; $i < count($datoseliminar); $i++) {
					$this->Form_inspeccion_model->delete_by_id_archivo($datoseliminar[$i]->id_archivo);
					if(file_exists('upload/'.$datoseliminar[$i]->nombrearchivo) && $datoseliminar[$i]->nombrearchivo)
						unlink('upload/'.$datoseliminar[$i]->nombrearchivo);
					// print_r('adfasdfa');
				}

				$upload = $this->_do_upload();
				// print_r($upload);
				foreach ($upload as $up => $value) {
					foreach ($value as $key => $val) {
						if ($key=='file_name') {
							$dataarchivo = array('nombrearchivo' => $val, 'titulo' => '' );
							$id_archivo = $this->Form_inspeccion_model->save_archivo($dataarchivo);
							$datos_form_arch = array(
								'id_formularioinspeccion' => $id_forminsp,
								'id_archivo' => $id_archivo
							);
							$this->Form_inspeccion_model->save_formularioinspeccion_archivo($datos_form_arch);
						}
					}
				}
				echo json_encode(array("status" => TRUE));
			}
		} else {
			echo json_encode(array("status" => FALSE));
		}
	}

	public function get_archivos()
	{
		$archivo = $this->Form_ins_tecnica_model->get_archivo($this->input->post('id_archivo'));
		// $datoseliminar = $this->Form_inspeccion_model->get_archivo(64);

		// print_r($datoseliminar[0]->id_archivo);

		// for ($i=0; $i < count($datoseliminar); $i++) { 
		// 	$this->Form_inspecciontres_model->delete_by_id_archivo($datoseliminar[$i]->id_archivo);
		// 	if(file_exists('upload/'.$archivo[$i]->nombrearchivo) && $archivo[$i]->nombrearchivo)
		// 		unlink('upload/'.$archivo[$i]->nombrearchivo);
		// }

		echo json_encode($archivo);
	}











/*
	public function ajax_list_form_inspeccion()
	{
		$list = $this->Inspeccion_model->get_datatables_form_inspeccion();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $form_inscripcion) {
			$no++;
			$row = array();
			$row[] = $form_inscripcion->fechaforminspeccion;
			$row[] = $form_inscripcion->tamaniovivienda;
			$row[] = $form_inscripcion->numerohabitantes;
			$row[] = $form_inscripcion->calibrado;
			$row[] = $form_inscripcion->ubicacionmedidor;
			$row[] = $form_inscripcion->estadotanquebanio;
			$row[] = $form_inscripcion->presionaguazona;
			$row[] = $form_inscripcion->piscina;
			$row[] = $form_inscripcion->filtracioninterna;
			$row[] = $form_inscripcion->marcamedidor;
			$row[] = $form_inscripcion->descripcioninformeinspeccion;
			$row[] = $form_inscripcion->id_abonado;
			$row[] = $form_inscripcion->id_reclamo;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_forminscripcion('."'".$form_inscripcion->id_formularioinspeccion."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_forminscripcion('."'".$form_inscripcion->id_formularioinspeccion."'".')"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
		
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Inspeccion_model->count_all(),
			"recordsFiltered" => $this->Inspeccion_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->person->get_by_id($id);
		$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'firstName' => $this->input->post('firstName'),
				'lastName' => $this->input->post('lastName'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'dob' => $this->input->post('dob'),
			);
		$insert = $this->person->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'firstName' => $this->input->post('firstName'),
				'lastName' => $this->input->post('lastName'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'dob' => $this->input->post('dob'),
			);
		$this->person->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->person->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	public function prueba()
	{
		// $this->Poseidon_model->get_vista();
		echo json_encode($this->Poseidon_model->get_vista());
	}
	*/
/*
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
