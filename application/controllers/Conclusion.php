<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conclusion extends CI_Controller {

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
        $data['vista'] = 'conclusion_view';
        $this->salida($data);
    }

	public function ajax_list()
	{
		$list = $this->Conclusion_model->lista_conclusion();
		$data = array();
		// $no = $_POST['start'];
		foreach ($list as $persona) {
			// $no++;
			$row = array();
			$row[] = $persona->fechaconclusion;
			$row[] = $persona->pronunciamiento;
			$row[] = $persona->respuesta;
			$row[] = $persona->id_funcionario;
			$row[] = $persona->id_reclamo;

			//add html for action
			$row[] = '<ul class="icons-list">
						<li class="text-primary-600">
							<a href="javascript:void()" title="Editar" onclick="edit_conclusion('."'".$persona->id_conclusion."'".')"><i class="icon-pencil7"></i></a>
						</li>
						
					</ul>';
					// <li class="text-danger-600">
					// 		<a href="javascript:void()" title="Eliminar" onclick="delete_person('."'".$persona->id_conclusion."'".')"><i class="icon-trash"></i></a>
					// 	</li>
						// <li class="text-success-600">
						// 	<a href="'.base_url().'Persona/reclamo?id_persona='.$persona->id_conclusion.'" title="Reclamar"><i class="icon-stack"></i></a>
						// </li>
		
			$data[] = $row;
		}

		$output = array(
						// "draw" => $_POST['draw'],
						// "recordsTotal" => $this->Persona_model->count_all(),
						// "recordsFiltered" => $this->Persona_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$data2 = $this->Conclusion_model->buscarcodigousuario($this->input->post('id_reclamo'));
		//$data2 = $this->Conclusion_model->buscarcodigousuario(83);
		// print_r($data2);
		// $this->_validate();
		$data = array(
				'fechaconclusion' => $this->input->post('fechaconclusion'),
				'pronunciamiento' => $this->input->post('pronunciamiento'),
				'respuesta' => $this->input->post('respuesta'),
				'id_funcionario' => $this->input->post('id_funcionario'),
				'id_reclamo' => $this->input->post('id_reclamo'),
			);
		$insert = $this->Conclusion_model->save($data);
		echo json_encode(array("status" => TRUE, "codigo" => $data2->codigousuario));
	}

	public function ajax_edit($id)
	{
		$data = $this->Conclusion_model->get_by_id_conclusion($id);
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
		$this->Persona_model->update(array('id_persona' => $this->input->post('id_persona')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->Persona_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function reclamo(){
        $id_persona = $this->input->get('id_persona');
        $data['persona'] = $this->Persona_model->get_by_id($id_persona);
        $data['vista'] = 'odeco_view';
        $this->salida($data);
    }

    public function searchh()
	{

        $campo = $this->input->get('campo');
        $dato  = strtoupper($this->input->get('name'));

        // print_r($campo);

        $datos = $this->Abonado_model->get_abonado_by_numerocuenta($campo,$dato);
        // print_r($datos);

        if(count($datos)==0)
        {
            // echo "<tr>";
            // echo "<td colspan='5'>Registros no encontrados</td>";
            // echo "</tr>";
            echo '<div class="alert bg-info alert-styled-right">';
			    echo '<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>';
			    echo '<span class="text-semibold">Registros no encontrados.</span>';
			echo '</div>';
        }else{
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
							echo '<label>Direccion: </label>';
		                	echo '<input type="text" class="form-control" value="'.$datos->direccion.'" id="direccionb" name="direccion" placeholder="Direccion...">';
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
					echo '<div class="col-md-4">';
						echo '<div class="form-group">';
							echo '<label>Categoria: </label>';
		                	echo '<input type="text" class="form-control format-phono-celular" value="'.$datos->detallecategoria.'" id="celularb" name="celular" placeholder="(591) 999 99999">';
						echo '</div>';
					echo '</div>';
				echo '</div>';
		    echo '</div>';
		 //    echo '<div class="row">';
			// 	echo '<div class="text-center">';
			// 		echo '<button type="submit" id="btnSave" onclick="save()" class="btn bg-teal-400">Guardar <i class="icon-arrow-right14 position-right"></i></button>';
			// 	echo '</div>';
			// echo '</div>';

        }
	}

    
}
