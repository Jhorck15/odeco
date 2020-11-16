<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reclamo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->helper(array('url', 'form'));
		// $this->load->library('form_validation');
		$this->load->model('Inspeccion_model');
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
        $data['vista'] = 'reclamo_view';
        $this->salida($data);
    }

    public function ajax_list_reclamos()
	{
		$list = $this->Odeco_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $reclamo) {
			$no++;
			$row = array();
			$row[] = $reclamo->numero;
			$row[] = $reclamo->fechareclamo;
			$row[] = $reclamo->fecharespuesta;
			$row[] = (date("d-m-Y",strtotime('now')))-(date("d-m-Y", strtotime($reclamo->fechareclamo)));
			$row[] = $reclamo->motivo;
			$row[] = $reclamo->id_persona;
			$row[] = $reclamo->id_abonado;
			$row[] = $reclamo->id_clasereclamo;
			$row[] = $reclamo->id_formareclamo;

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
						"recordsTotal" => $this->Odeco_model->count_all(),
						"recordsFiltered" => $this->Odeco_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_list()
	{
		$list = $this->Inspeccion_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $inspeccion) {
			$no++;
			$row = array();
			$row[] = $inspeccion->fechainspeccion;
			$row[] = $inspeccion->observaciones;
			$row[] = $inspeccion->fechaemision;
			$row[] = $inspeccion->estadogrifos;
			$row[] = $inspeccion->estadollave;
			$row[] = $inspeccion->lecturaactual;
			$row[] = $inspeccion->metrocubicos;
			$row[] = $inspeccion->id_odeco;

			//add html for action
			// $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_odeco('."'".$odeco->id_odeco."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			// 	  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_odeco('."'".$odeco->id_odeco."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$row[] = '<ul class="icons-list">
						<li class="text-primary-600">
							<a href="javascript:void()" title="Edit" onclick="edit_inspeccion('."'".$inspeccion->id_inspeccion."'".')"><i class="icon-pencil7"></i></a>
						</li>
						<li class="text-danger-600">
							<a href="javascript:void()" title="Hapus" onclick="delete_inspeccion('."'".$inspeccion->id_inspeccion."'".')"><i class="icon-trash"></i></a>
						</li>
					</ul>';
		
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

	public function actualizar_inspeccion()
	{
		$data = array(
			'estadoreclamo' => $this->input->post('estado')
		);
		$this->Odeco_model->update(array('id_reclamo' => $this->input->post('id')), $data);
		$_SESSION['id_reclamosession'] = (int)$this->input->post('id');
		echo json_encode(array("status" => TRUE));
	}
	public function actualizar_inspeccion_retornar()
	{
		date_default_timezone_set('America/La_Paz');

		$id_func = $this->Odeco_model->get_id_funcionario($this->input->post('id'));

		$data = array(
			'estadoreclamo' => $this->input->post('estado')
		);
		$this->Odeco_model->update(array('id_reclamo' => $this->input->post('id')), $data);

		$id_seguimiento = $this->Odeco_model->busquedaseguimiento('2');
		$dataseguimiento = array(
			'estadoseguimiento' => '3',
			'fechadevolucion' => date("Y-m-d H:i:s")
		);
		$this->Odeco_model->updateseguimiento(array('id_seguimiento' => $id_seguimiento->id_seguimiento), $dataseguimiento);

		$dataseguimientoaniadir = array(
			'fechaderivacion' => date("Y-m-d H:i:s"),
			// 'fechadevolucion' => '',
			'estadoseguimiento' => '4',
			'id_funcionario' => $id_func[0]->id_funcionario,
			'id_reclamo' => $_SESSION['id_reclamosession']
		);
		$this->Odeco_model->insertar_seguimiento($dataseguimientoaniadir);

		echo json_encode(array("status" => TRUE));
	}
}
