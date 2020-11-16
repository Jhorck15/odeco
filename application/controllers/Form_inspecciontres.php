<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_inspecciontres extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Form_inspecciontres_model');
	}

		public function index()
	{
	    $data['vista'] = 'form_inspecciontres_view';
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

		$list = $this->Form_inspecciontres_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $person->fechaforminspeccion;
			$row[] = $person->descripcion;
			$row[] = $person->funcionario;
			$row[] = $person->id_reclamo;

			// if($person->photo)
			// 	$row[] = '<a href="'.base_url('upload/'.$person->photo).'" target="_blank"><img src="'.base_url('upload/'.$person->photo).'" class="img-responsive" /></a>';
			// else
			// 	$row[] = '(No photo)';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Editf3" onclick="edit_forminspecciontres('."'".$person->id_formularioinspecciontres."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
				  <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Retornarf3" onclick="retornar_forminspecciontres('."'".$person->id_formularioinspecciontres."'".')"><i class=" icon-reply"></i> Retornar</a>';
		
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Form_inspecciontres_model->count_all(),
			"recordsFiltered" => $this->Form_inspecciontres_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit_forminspecciontres($id)
	{
		$data = $this->Form_inspecciontres_model->get_by_id($id);
		$data->fechaforminspeccion = ($data->fechaforminspeccion == '0000-00-00') ? '' : $data->fechaforminspeccion; // if 0000-00-00 set tu empty for datepicker compatibility

		// $data2 = $this->Form_inspecciontres_model->get_form__archivo($data->id_formularioinspecciontres);
		// $data->archivos = $data2;
		
		// print_r($data2);

		echo json_encode($data);
	}

	public function ajax_add_inspectiontres(){

		if(!empty($_FILES['photo']['name']))
		{
			if (!empty($this->input->post('descripcion'))) {
				$upload = $this->_do_upload();
				$data = array(
					'fechaforminspeccion' => $this->input->post('fechainspeccion'),
					'descripcion' => $this->input->post('descripcion'),
					'funcionario' => $this->input->post('id_funcionario'),
					'id_reclamo' => $this->input->post('id_reclamo'),
				);

				// print_r($upload);

				$id_formularioinspecciontres = $this->Form_inspecciontres_model->save_formularioinspecciontres($data);

				foreach ($upload as $up => $value) {
					foreach ($value as $key => $val) {
						if ($key=='file_name') {
							$dataarchivo = array('nombrearchivo' => $val, 'titulo' => '' );
							$id_archivo = $this->Form_inspecciontres_model->save_archivo($dataarchivo);
							$datos_form_arch = array(
								'id_formularioinspecciontres' => $id_formularioinspecciontres,
								'id_archivo' => $id_archivo
							);
							$this->Form_inspecciontres_model->save_formularioinspecciontres_archivo($datos_form_arch);
						}
					}
				}
				
				// $datar = array(
				// 	'estadoreclamo' => '3'
				// );
				// $this->Form_inspecciontres_model->update_reclamo(array('id_reclamo'=> $this->input->post('id_reclamo')), $datar);
				echo json_encode(array("status" => TRUE));

			}
		} else {
			echo json_encode(array("status" => FALSE));
		}
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


	public function ajax_update_inspectiontres()
	{
		if(!empty($_FILES['photo']['name']))
		{
			
			if (!empty($this->input->post('descripcion'))) {
				$id_forminsptres = $this->input->post('id_formularioinspecciontres');

				$data = array(
					'fechaforminspeccion' => $this->input->post('fechainspeccion'),
					'descripcion' => $this->input->post('descripcion'),
					'funcionario' => $this->input->post('id_funcionario'),
					'id_reclamo' => $this->input->post('id_reclamo'),
				);

				$this->Form_inspecciontres_model->update(array('id_formularioinspecciontres' => $id_forminsptres), $data);
				$datoseliminar = $this->Form_inspecciontres_model->get_archivo($id_forminsptres);
				// $datoseliminar = $this->Form_inspecciontres_model->get_form__archivo(17);

				// print_r($datoseliminar[0]->nombrearchivo);
				// print_r($datoseliminar[0]);

				for ($i=0; $i < count($datoseliminar); $i++) { 
					$this->Form_inspecciontres_model->delete_by_id_forminsptres($id_forminsptres);
				}
				// eliminar archivo
				for ($i=0; $i < count($datoseliminar); $i++) {
					$this->Form_inspecciontres_model->delete_by_id_archivo($datoseliminar[$i]->id_archivo);
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
							$id_archivo = $this->Form_inspecciontres_model->save_archivo($dataarchivo);
							$datos_form_arch = array(
								'id_formularioinspecciontres' => $id_forminsptres,
								'id_archivo' => $id_archivo
							);
							$this->Form_inspecciontres_model->save_formularioinspecciontres_archivo($datos_form_arch);
						}
					}
				}
				
				$datar = array(
					'estadoreclamo' => 3
				);
				$this->Form_inspecciontres_model->update_reclamo(array('id_reclamo'=> $this->input->post('id_reclamo')), $datar);
				echo json_encode(array("status" => TRUE));

			}
		} else {
			echo json_encode(array("status" => FALSE));
		}


		// print_r(count($datoseliminar->id_archivo));

		// $this->Form_inspeccion_model->delete_by_id_formins__archivo($this->input->post('id_formularioinspecciontres'));

		// echo json_encode(array('status' => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		$person = $this->person->get_by_id($id);
		if(file_exists('upload/'.$person->photo) && $person->photo)
			unlink('upload/'.$person->photo);
		
		$this->person->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function get_archivos()
	{
		$archivo = $this->Form_inspecciontres_model->get_archivo($this->input->post('id_archivo'));
		// $datoseliminar = $this->Form_inspecciontres_model->get_archivo(17);

		// print_r($datoseliminar[0]->id_archivo);

		// for ($i=0; $i < count($datoseliminar); $i++) { 
		// 	$this->Form_inspecciontres_model->delete_by_id_archivo($datoseliminar[$i]->id_archivo);
		// 	if(file_exists('upload/'.$archivo[$i]->nombrearchivo) && $archivo[$i]->nombrearchivo)
		// 		unlink('upload/'.$archivo[$i]->nombrearchivo);
		// }

		echo json_encode($archivo);
	}

}
