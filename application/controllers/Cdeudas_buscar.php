<?php if (!defined('BASEPATH')) exit('Acceso directo no permitido');

Class Cdeudas_buscar extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Deudas_buscar_model', 'deudas_buscar_model');
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
        $data['vista'] = 'deudas_buscar';        
        // $data['reclamos'] = $this->lista();
        // $data['listainsp'] = $this->listainspectorr();
       	// $data['usuariocta'] = $this->datos_user();
        $this->salida($data);
        
    }
   

	public function lista()
	{
		
		$dato  = $this->input->post('numero');
		$dataa = $this->deudas_buscar_model->getReclamo($dato);
		// print_r('1 ES');
		$data = array();
	
		// print_r($data);

		$i = 0;	
		foreach($dataa as $lista){
			$i++;
			$row = array();
			$row[] = $i;
			$row[] = $lista->concepto;
			$row[] = $lista->lectura_anterior;
			$row[] = $lista->lectura_actual;
			$row[] = $lista->consumo;
			$row[] = $lista->monto_total;						
			$data[] = $row;
		} 		 

		$output = array("data" => $data,
						// "draw" => $_POST['draw'],
						"numero" => $this->deudas_buscar_model->count_all($dato),
				);
		// output to json format
		echo json_encode($output);
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
		} else if ($idcargo == 'JEFE ATENCION AL CLIENTE'){
			$data = $this->principal_model->getjefaturas();
			echo json_encode($data);
		} 
		else {
			$data = $this->principal_model->getinspector();
			// print_r($data);
			echo json_encode($data);			
		}		
	}

	public function listaagua()
	{
		$idcargo = '';
		$idpersona = $_SESSION['user_id'];
		$usuario = $this->principal_model->get_dato_usuario($idpersona);
		$idcargo = $usuario[0]['detallecargo'];
		// echo $idcargo;
		if ($idcargo == 'USUARIO ODECO'){
			$data = $this->principal_model->get_datoaguas();
			// print_r($data);
			// echo "entro mal";
			echo json_encode($data);
		} 	
	}

	public function listaalc()
	{
		$idcargo = '';
		$idpersona = $_SESSION['user_id'];
		$usuario = $this->principal_model->get_dato_usuario($idpersona);
		$idcargo = $usuario[0]['detallecargo'];
		// echo $idcargo;
		if ($idcargo == 'USUARIO ODECO'){
			$data = $this->principal_model->get_datoalc();
			// print_r($data);
			// echo "entro mal";
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
	    $data = $this->principal_model->get_dato_usuario($idusuario);
	    echo json_encode($data);
    }

   	public function searchh()
	{

        $campo = 'codigousuario';
        $dato  = $this->input->get('numero');
        $reclamo_detalle = '';

        // print_r($campo);

        $datos = $this->principal_model->get_abonado_by_numerocuenta($campo,$dato);
       
        if(count($datos) > 0){
        	$cons_reclamo = $this->principal_model->get_reclamo_usuario($dato);
       
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
		$this->principal_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function imprimir_reporte($id){
		$this->principal_model->buscar_odeco($id);
	}

	public function odecos(){
		$data = $this->principal_model->get_odecos();
		echo $data;
	}
	
}

?>