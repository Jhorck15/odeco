<?php if (!defined('BASEPATH')) exit('Acceso directo no permitido');

Class CLista_func extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Lista_func_model','lista_func_model');
		$this->load->library('form_validation');
		// $this->load->library('bcrypt');

	}

	
	public function salida($data)
    {
        $this->load->view('plantilla/header');
        $this->load->view($data['vista'],$data);
        $this->load->view('plantilla/footer');
    }

    public function index()
    {
        $data['vista'] = 'list_func';        
        // $data['reclamos'] = $this->lista();
        // $data['listainsp'] = $this->listainspectorr();
       	// $data['usuariocta'] = $this->datos_user();
        $this->salida($data);
        
    }
   

	public function lista()
	{
		$dataa = $this->lista_func_model->getLista();
		// print_r('1 ES');
		$data = array();
	
		// print_r($data);

		$i = 0;	
		$fechaactual = strtotime('now');
		// $no = $_POST['start'];
		foreach($dataa as $lista){
			$i++;
			// $no++;				   
			$row = array();
			$row[] = $lista->ci;
			$row[] = $lista->nombres;
			$row[] = $lista->apellidos;
			$row[] = $lista->direccion;
			$row[] = $lista->telefono;
			$row[] = $lista->celular;
			$row[] = $lista->nit;
			$row[] = '<ul class="icons-list">
					<li >
						<a href="javascript:void()" class="btn border-teal-400 text-teal btn-flat btn-rounded btn-icon btn-xs" title="Editar" onclick="edit_funcionario('."'".$lista->id_funcionario."'".')"><i class="icon-file-text3"></i></a>
					</li>							
					</ul>';								
			$data[] = $row;
		} 		 

		$output = array("data" => $data,
						// "draw" => $_POST['draw'],
						"numero" => $this->lista_func_model->count_all(),
						 // "recordsFiltered" => $this->principal_model->count_filtered(),
						// "data" => $listaa,
				);
		// output to json format
		echo json_encode($output);
	}

	
	public function ajax_editt($id)
	{
		$data = $this->lista_func_model->getdatosfunc($id);
		echo json_encode($data);
	}

	public function listage(){

		$datos = $this->lista_func_model->getListage();
		
		echo json_encode($datos);
	}

	public function listaro(){

		$datos = $this->lista_func_model->getListaro();
		
		echo json_encode($datos);
	}

	public function listaje($id){

		$datos = $this->lista_func_model->getListaje($id);
		
		echo json_encode($datos);
	}

	public function listaca($id){

		$datos = $this->lista_func_model->getListaca($id);
		
		echo json_encode($datos);
	}

	public function ajax_adicionar()
	{
		$dato = $this->lista_func_model->contar();	
		
		$fecha = date("d-m-Y H:i:s",strtotime('now'));
			
			$da = $this->lista_func_model->con();
			$data1 = array(
					'id_cuenta' => $da + 36,
					'usuario' => strtoupper($this->input->post('ctafunc')),
					'contrasenia' => $this->input->post('password'),
					'creacion' => $fecha,
				);
			print_r($data1);		
			$this->lista_func_model->guardar_cta($data1);

			$data = array(
					'id_persona' => $dato + 43,
					'nombres' => strtoupper($this->input->post('nfunc')),
					'apellidos' => strtoupper($this->input->post('afunc')),
					'direccion' => strtoupper($this->input->post('difunc')), 
					'telefono' => $this->input->post('telefunc'),
					'celular' => $this->input->post('celfunc'), 
					'ci' => $this->input->post('cifunc'),
					'nit' => $this->input->post('nitfunc'),
				);
			print_r($data);
			$insert = $this->lista_func_model->guardar($data);

						

			$dat = $this->lista_func_model->conta();
			$data2 = array(
					'id_funcionario' => $dat + 7,
					'id_persona' => $dato + 43,
					'id_cargo' => $this->input->post('listaca'),
					'id_rol' => $this->input->post('listaro'),
					'id_cuenta' => $da + 36 ,
				);
			print_r($data2);
			$this->lista_func_model->guardar_func($data2);
			echo json_encode(array("status" => TRUE));
	}
}

?>