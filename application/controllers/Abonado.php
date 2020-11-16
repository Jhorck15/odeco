<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Abonado extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->library('form_validation');
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
        $data['vista'] = 'abonado_view';
        $this->salida($data);
    }

	public function ajax_list()
	{
		$list = $this->Abonado_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $abonado) {
			$no++;
			$row = array();
			$row[] = $abonado->nombres;
			$row[] = $abonado->apellidos;
			$row[] = $abonado->direccion;
			$row[] = $abonado->telefono;
			$row[] = $abonado->celular;
			$row[] = $abonado->ci;

			//add html for action
			$row[] = '<ul class="icons-list">
						<li class="text-primary-600">
							<a href="javascript:void()" title="Editar" onclick="edit_person('."'".$abonado->id_abonado."'".')"><i class="icon-pencil7"></i></a>
						</li>
						<li class="text-danger-600">
							<a href="javascript:void()" title="Eliminar" onclick="delete_person('."'".$abonado->id_abonado."'".')"><i class="icon-trash"></i></a>
						</li>
					</ul>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Abonado_model->count_all(),
						"recordsFiltered" => $this->Abonado_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_add()
	{
		// $this->_validate();
		$data = array(
				'nombres' => $this->input->post('nombres'),
				'apellidos' => $this->input->post('apellidos'),
				'direccion' => $this->input->post('direccion'),
				'telefono' => $this->input->post('telefono'),
				'celular' => $this->input->post('celular'),
				'ci' => $this->input->post('ci'),
				'nit' => $this->input->post('nit'),
			);
		$insert = $this->Abonado_model->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Abonado_model->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_update()
	{
		// $this->_validate();
		$data = array(
				'nombres' => $this->input->post('nombres'),
				'apellidos' => $this->input->post('apellidos'),
				'direccion' => $this->input->post('direccion'),
				'telefono' => $this->input->post('telefono'),
				'celular' => $this->input->post('celular'),
				'ci' => $this->input->post('ci'),
				'nit' => $this->input->post('nit'),
			);
		$this->Abonado_model->update(array('id_persona' => $this->input->post('id_persona')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->Abonado_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function search()
	{
		// $this->verifica_logueo();
  		// $this->load->model('Abonado_model');

        $campo = $this->input->get('campo');
        $dato  = strtoupper($this->input->get('name'));

        $datos = $this->Abonado_model->get_abonado_by_numerocuenta($campo,$dato);
        // print_r($datos);

        if(count($datos)==0)
        {
            echo "<tr>";
            echo "<td colspan='5'>Registros no encontrados</td>";
            echo "</tr>";
        }else{
        	echo '<div class="panel-body">';
		    	echo '<div class="row">';
		    		echo '<div class="col-md-4">';
		    			echo '<div class="form-group">';
							echo '<label>Nombres: </label>';
		                	echo '<input type="text" class="form-control" value="<?php echo $datos->nombres ?>" name="nombres" placeholder="99/99/9999">';
						echo '</div>';
					echo '</div>';
					echo '<div class="col-md-4">';
		    			echo '<div class="form-group">';
							echo '<label>Apellidos: </label>';
		                	echo '<input type="text" class="form-control" value="<?php echo $datos->apellidos ?>" name="apellidos" placeholder="99/99/9999">';
						echo '</div>';
					echo '</div>';
					echo '<div class="col-md-4">';
		    			echo '<div class="form-group">';
							echo '<label>Carnet de Indentidad: </label>';
		                	echo '<input type="text" class="form-control" value="<?php echo $datos->ci ?>" name="ci" placeholder="99/99/9999">';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="row">';
		    		echo '<div class="col-md-4">';
		    			echo '<div class="form-group">';
							echo '<label>Direccion: </label>';
		                	echo '<input type="text" class="form-control" value="<?php echo $datos->direccion ?>" name="direccion" placeholder="99/99/9999">';
						echo '</div>';
					echo '</div>';
					echo '<div class="col-md-4">';
		    			echo '<div class="form-group">';
							echo '<label>Telefono Fijo</label>';
		                	echo '<input type="text" class="form-control" value="<?php echo $datos->telefono ?>" name="telefono" placeholder="99/99/9999">';
						echo '</div>';
					echo '</div>';
					echo '<div class="col-md-4">';
		    			echo '<div class="form-group">';
							echo '<label>Celular: </label>';
		                	echo '<input type="text" class="form-control" value="<?php echo $datos->celular ?>" name="celular" placeholder="99/99/9999">';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="row">';
		    		echo '<div class="col-md-4">';
		    			echo '<div class="form-group">';
							echo '<label>NIT: </label>';
		                	echo '<input type="text" class="form-control" value="<?php echo $datos->nit ?>" name="nit" placeholder="99/99/9999">';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				// echo '<div class="row">';
				// 	echo '<div class="text-center">';
				// 		echo '<button type="submit" id="btnSave" onclick="save()" class="btn bg-teal-400">Guardar <i class="icon-arrow-right14 position-right"></i></button>';
				// 	echo '</div>';
				// echo '</div>';
		    echo '</div>';

        }
        $data['asdfasdf'] = $datos;
        $data['vista'] = 'odeco_view';
        $this->salida($data);
	}



	public function reclamo(){
        $id_persona = $this->input->get('id_persona');
        $data['persona'] = $this->Abonado_model->get_by_id($id_persona);
        $data['vista'] = 'odeco_view';
        $this->salida($data);
    }

    
}
