<?php if (!defined('BASEPATH')) exit('Acceso directo no permitido');

Class Cterm_odeco extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('term_odeco_model');
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
        $data['vista'] = 'ter_odeco';        
        // $data['reclamos'] = $this->lista();
        // $data['listainsp'] = $this->listainspectorr();
       	// $data['usuariocta'] = $this->datos_user();
        $this->salida($data);
        
    }
   

	public function lista()
	{
		$dataa = $this->term_odeco_model->getReclamo();
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
		   
					$row = array();
					$row[] = $i;
					$row[] = $lista->codigousuario;
					$row[] = $lista->nombres.' '.$lista->apellidos;
					$row[] = $lista->numero;
					$row[] = $fechaini;
					$row[] = $fechafinal;
					$row[] = $dias;
					$row[] = $lista->nombretiporeclamo;	
					if($lista->id_tiporeclamo == 1) {
						$row[] = '<ul class="icons-list">
								<li >
									<a href="javascript:void()" class="btn border-teal-400 text-teal btn-flat btn-rounded btn-icon btn-xs" title="Imprimir" onclick="edit_inspectorr('."'".$lista->codigousuario."'".')"><i class="icon-printer"></i></a>
								</li>							
								</ul>';					
					} else {
						$row[] = '<ul class="icons-list">
								<li >
									<a href="javascript:void()" class="btn border-teal-400 text-teal btn-flat btn-rounded btn-icon btn-xs" title="Imprimir" onclick="edit_inspectortecnico('."'".$lista->codigousuario."'".')"><i class="icon-printer"></i></a>
								</li>							
								</ul>';	
					}									
					$data[] = $row;
		} 		 

		$output = array("data" => $data,
						// "draw" => $_POST['draw'],
						"numero" => $this->term_odeco_model->count_all(),
						 // "recordsFiltered" => $this->principal_model->count_filtered(),
						// "data" => $listaa,
				);
		// output to json format
		echo json_encode($output);
	}

	

	
	
}

?>