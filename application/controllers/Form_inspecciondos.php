<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_inspecciondos extends CI_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('Form_inspecciondos_model');
		$this->load->model('Odeco_model');
	}

	public function index()
	{	

	    $data['vista'] = 'form_inspecciondos_view' ;
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
		$this->load->helper('url');

		$list = $this->Form_inspecciondos_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $forminspecciondos) {
			$no++;
			$row = array();
			$row[] = $forminspecciondos->fechaforminspeccion;
			$row[] = $forminspecciondos->nombrespersona;
			$row[] = $forminspecciondos->codigo;
			$row[] = $forminspecciondos->direccion;
			$row[] = $forminspecciondos->inspeccion;
			$row[] = $forminspecciondos->recomendacion;
			$row[] = $forminspecciondos->id_funcionario;
			$row[] = $forminspecciondos->id_reclamo;

			//add html for action
			$row[] = '<ul class="icons-list">
						<li class="text-primary-600">
							<a href="javascript:void()" title="Editar
							" onclick="edit_inspecciondos('."'".$forminspecciondos->id_formularioinspecciondos."'".')"><i class="icon-pencil7"></i></a>
						</li>
						<li class="text-success-600">
							<a href="javascript:void()" title="Derivar" onclick="retornar_inspeccionformdos('."'".$forminspecciondos->id_reclamo."'".')"><i class="icon-reply"></i></a>
						</li>
					</ul>';

			// <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_inspecciondos('."'".$forminspecciondos->id_formularioinspecciondos."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			// 	  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_inspecciondos('."'".$forminspecciondos->id_formularioinspecciondos."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
		
			$data[] = $row;
		}

		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->Form_inspecciondos_model->count_all(),
				"recordsFiltered" => $this->Form_inspecciondos_model->count_filtered(),
				"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function cargarcodigo()
	{
		$abonado = $this->Form_inspecciondos_model->abonado($_SESSION['user_id']);
		print_r('hola'.$abonado);
		$codigo = $this->Form_inspecciondos_model->codigo_abonado($abonado->id_abonado);
		echo json_encode($codigo);
	}

	public function ajax_add_inspeccion()
	{		
		$data = array(
			'id_reclamo' => $this->input->post('id_reclamo'),
			// 'id_formularioinspecciondos' => $this->input->post('id_formularioinspecciondos'),
			'fechaforminspeccion' => $this->input->post('fechainspeccion'),
			'nombrespersona' => $this->input->post('personaqueatendio'),
			'codigo' => $this->input->post('codigo'),
			'direccion' => $this->input->post('direccion'),
			'inspeccion' => $this->input->post('observaciones'),
			'recomendacion' => $this->input->post('recomendacion'),
			'id_funcionario' => $this->input->post('id_funcionario'),
		);

		// print_r($data);

		$insert = $this->Form_inspecciondos_model->save($data);

		$datar = array(
			'estadoreclamo' => 3
		);
		$this->Form_inspecciondos_model->update_reclamo(array('id_reclamo'=> $this->input->post('id_reclamo')), $datar);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit_forminspecciondos($id)
	{
		$data = $this->Form_inspecciondos_model->get_by_id($id);
		$data->fechaforminspeccion = ($data->fechaforminspeccion == '0000-00-00') ? '' : $data->fechaforminspeccion; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_update_inspeccion()
	{
		$data = array(
			'id_reclamo' => $this->input->post('id_reclamo'),
			// 'id_formularioinspecciondos' => $this->input->post('id_formularioinspecciondos'),
			'fechaforminspeccion' => $this->input->post('fechainspeccion'),
			'nombrespersona' => $this->input->post('personaqueatendio'),
			'direccion' => $this->input->post('direccion'),
			'inspeccion' => $this->input->post('observaciones'),
			'recomendacion' => $this->input->post('recomendacion'),
			'id_funcionario' => $this->input->post('id_funcionario'),
		);

		$this->Form_inspecciondos_model->update(array('id_formularioinspecciondos' => $this->input->post('id_formularioinspecciondos')), $data);
		echo json_encode(array('status' => TRUE));
	}

	public function actualizar_inspeccion_retornar()
	{
		date_default_timezone_set('America/La_Paz');

		$id_func = $this->Odeco_model->get_id_funcionario($this->input->post('id_reclamo'));

		$data = array(
			'estadoreclamo' => $this->input->post('estado')
		);
		$this->Form_inspecciondos_model->update_reclamo(array('id_reclamo' => $this->input->post('id_reclamo')), $data);

		$id_seguimiento = $this->Form_inspecciondos_model->busquedaseguimiento('2');
		$dataseguimiento = array(
			'estadoseguimiento' => '3',
			'fechadevolucion' => date("Y-m-d H:i:s")
		);
		$this->Form_inspecciondos_model->updateseguimiento(array('id_seguimiento' => $id_seguimiento->id_seguimiento), $dataseguimiento);

		$dataseguimientoaniadir = array(
			'fechaderivacion' => date("Y-m-d H:i:s"),
			// 'fechadevolucion' => '',
			'estadoseguimiento' => '4',
			//'id_funcionario' => $_SESSION['id_persona'],
			'id_funcionario' => $id_func[0]->id_funcionario,
			'id_reclamo' => $_SESSION['id_reclamosession'],
		);
		$this->Form_inspecciondos_model->insertar_seguimiento($dataseguimientoaniadir);

		echo json_encode(array("status" => TRUE));
	}

	public function cargar_reclamo(){
		$data = $this->Form_inspecciondos_model->get_by_id_reclamo($_SESSION['id_reclamosession']);
		// $data = $this->Odeco_model->get_codigo($data->reclamo);
		// print_r($data->id_reclamo);
		echo json_encode($data);
	}

}
