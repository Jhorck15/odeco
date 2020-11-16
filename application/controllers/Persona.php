<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->library('form_validation');
		$this->load->model('Persona_model');
		$this->load->model('Abonado_model');
	}

	public function salida($data)
    {
        $this->load->view('plantilla/header');
        $this->load->view($data['vista'],$data);
        $this->load->view('plantilla/footer');
    }
    public function salidaaa($data)
    {
        $this->load->view('plantilla/header');
        $this->load->view($data[],$data);
        $this->load->view('plantilla/footer');
    }
    public function index()
    {
        $data['vista'] = 'persona_view';
        $this->salida($data);
    }

	public function ajax_list()
	{
		$list = $this->Persona_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $persona) {
			$no++;
			$row = array();
			$row[] = $persona->nombres;
			$row[] = $persona->apellidos;
			$row[] = $persona->direccion;
			$row[] = $persona->telefono;
			$row[] = $persona->celular;
			$row[] = $persona->ci;

			//add html for action
			$row[] = '<ul class="icons-list">
						<li class="text-primary-600">
							<a href="javascript:void()" title="Editar" onclick="edit_person('."'".$persona->id_persona."'".')"><i class="icon-pencil7"></i></a>
						</li>
						<li class="text-danger-600">
							<a href="javascript:void()" title="Eliminar" onclick="delete_person('."'".$persona->id_persona."'".')"><i class="icon-trash"></i></a>
						</li>
						<li class="text-success-600">
							<a href="'.base_url().'Persona/reclamo?id_persona='.$persona->id_persona.'" title="Reclamar"><i class="icon-stack"></i></a>
						</li>
					</ul>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Persona_model->count_all(),
						"recordsFiltered" => $this->Persona_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_add()
	{
		// $this->_validate();
		// echo $this->input->post('ci');
		$buscar = $this->Persona_model->get_buscar($this->input->post('ci'));
		// echo($buscar);

		if ($buscar == 0) {
			$data = array(
					'nombres' => $this->input->post('nombres'),
					'apellidos' => $this->input->post('apellidos'),
					'direccion' => $this->input->post('direccion'),
					'telefono' => $this->input->post('telefono'),
					'celular' => $this->input->post('celular'),
					'ci' => $this->input->post('ci'),
					'nit' => $this->input->post('nit'),
				);
			$insert = $this->Persona_model->save($data);
			$datos = $this->Persona_model->get_by_id($insert);   
			echo json_encode(array('status' => TRUE, 'persona'=>$datos->nombres, 'id_persona'=>$datos->id_persona));
		} 
		else {
			echo json_encode(array('status' => '100'));
		}
	}

	public function ajax_edit($id)
	{
		$data = $this->Persona_model->get_by_id($id);
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

    public function pruebaa($dato)
    {
    	 $consulta = $this->Abonado_model->get_consulta('codigo_catastral',$dato);
    	 $data = [];
    	 $data1 = [];
    	 $data2 = [];
    	 $data3 = [];
    	 $data4 = [];

        if(count($consulta) == 0)
        {
        	$datos = $this->Abonado_model->get_consulta_odeco('codigo_catastral',$dato);
	    	// print_r($datos);
	    	// echo $datos;
	    	// echo $datos->manzano_id;
        	if(count($datos)<> 0)
        	{


		  		if ($datos->manzano_id <> '0')
		    	{
		    		// $this->db->from('v_abonado');
			    	// $this->db->where('codigousuario', $dato);
			    	// $query2 = $this->db->get();
			    	// // $query2->num_rows();
			    	// return $query2->row();

			    	//MANZANO
			    	$idmanzano = $this->Abonado_model->get_consultamanzano($datos->manzano_id);
			    	
			    	if($idmanzano <> '100')
			    	{
			    		$data = array(
							'id_manzano' => $datos->manzano_id,
							'numeromanzano' => $idmanzano->numero,
							'detallemanzano' => $idmanzano->descripcion,
							'estadomanzano' => $idmanzano->estado						
						);
						$manzano = $this->Abonado_model->savemanzano($data);
			    		echo json_encode($manzano);	
			    	}
			    	printf($data);		

					//MEDIDOR
					$idmedidor = $this->Abonado_model->get_consultamedidor($datos->medidor_id);
					if($idmedidor <> '100')
			    	{
						$data1 = array(
							'id_medidor' => $datos->medidor_id,
							'seriefabrica'=> $idmedidor->numero,
							'marca'=> $idmedidor->marca,
							'digitos' => $idmedidor->digitos,
							'id_imagen' => 0						
						);
						// $medidor = $this->Abonado_model->savemedidor($data1);
			    		echo json_encode($medidor);
					}
					printf($data1);	
					// $idcategoria = $this->Abonado_model->get_consultacategoria($datos->com_categoria_id);
					//PERSONA
					$idpersona = $this->Abonado_model->get_consultapersona($datos->com_nits_numero);
					// print_r($idpersona);
					if($idpersona <> '100')
			    	{
						$data2 = array(
							// 'id_persona' => $idpersona + 45,
							'nombres'=> $datos->nombres,
							'apellidos'=> $datos->primer_apellido.' '.$datos->segundo_apellido,
							'direccion' => $datos->direccion,
							'telefono' => $datos->telefono,
							'celular' => $datos->movil,
							'ci' => $datos->com_nits_numero						
						);
						// $persona = $this->Abonado_model->savepersona($data2);
						// print_r($persona);
						printf($data2);	
			    		echo json_encode($persona);
						//ABONADO
						$idabonado = $this->Abonado_model->get_consultaabonado();
						$data3 = array(
							// 'id_abonado' => $idabonado + 1,
							'numerocuenta'=> $datos->com_cuentas_nro_cuenta,
							'id_persona'=> $persona,
							'id_categoria' => $datos->com_categoria_id,
							'id_medidor' => $datos->medidor_id									
						);
						// $abonado = $this->Abonado_model->saveabonado($data3);
			    		echo json_encode($abonado);
			    		//ZONIFICACIÓN
						$idzonificacion = $this->Abonado_model->get_consultazonificacion($datos->medidor_id);
						if($idzonificacion <> '100')
			    		{
							$data4 = array(
								// 'id_zonificacion' => $idzonificacion + 1,
								'id_medidor' => $datos->medidor_id,
								'id_zona' => $datos->zona,	
								'id_manzano'=> $datos->manzano_id,		
								'vivienda' => $datos->medidor 								
							);	
							// $zonificacion = $this->Abonado_model->savezonificacion($data4);
				    		echo json_encode($zonificacion);					
						}
						printf($data4);	
					}
				}
			}
		}	
    	// printf($datos);
    }

    public function searchh()
	{

        $campo = $this->input->get('campo');
        $dato  = trim(strtoupper($this->input->get('name')));

        // print_r($campo);
        if($campo == 'codigousuario') 
        {
        	$consulta = $this->Abonado_model->get_consulta('codigo_catastral',$dato);

	        if(count($consulta) == 0)
	        {
	        	$datos = $this->Abonado_model->get_consulta_odeco('codigo_catastral',$dato);
		    	// print_r($datos);
		    	// echo $datos;
		    	// echo $datos->manzano_id;
	        	if(count($datos)<> 0)
	        	{


			  		if ($datos->manzano_id <> '0')
			    	{
			    		// $this->db->from('v_abonado');
				    	// $this->db->where('codigousuario', $dato);
				    	// $query2 = $this->db->get();
				    	// // $query2->num_rows();
				    	// return $query2->row();

				    	//MANZANO
				    	$idmanzano = $this->Abonado_model->get_consultamanzano($datos->manzano_id);
				    	
				    	if($idmanzano <> '100')
				    	{
				    		$data = array(
								'id_manzano' => $datos->manzano_id,
								'numeromanzano' => $idmanzano->numero,
								'detallemanzano' => $idmanzano->descripcion,
								'estadomanzano' => $idmanzano->estado						
							);
							$manzano = $this->Abonado_model->savemanzano($data);
				    		echo json_encode($manzano);	
				    		// print_r($data);
				    	}
				    			

						//MEDIDOR
						$idmedidor = $this->Abonado_model->get_consultamedidor($datos->medidor_id);
						if($idmedidor <> '100')
				    	{
							$data1 = array(
								// 'id_medidor' => $datos->medidor_id,
								'seriefabrica'=> $idmedidor->numero,
								'marca'=> $idmedidor->marca,
								'digitos' => $idmedidor->digitos,
								'id_imagen' => 0						
							);
							$medidor = $this->Abonado_model->savemedidor($data1);
				    		echo json_encode($medidor);
				    		// print_r($data1);
						}
						
						// $idcategoria = $this->Abonado_model->get_consultacategoria($datos->com_categoria_id);
						//PERSONA
						$idpersona = $this->Abonado_model->get_consultapersona($datos->com_nits_numero);
						// print_r($idpersona);
						if($idpersona <> '100')
				    	{
							$data2 = array(
								// 'id_persona' => $idpersona + 45,
								'nombres'=> $datos->nombres,
								'apellidos'=> $datos->primer_apellido.' '.$datos->segundo_apellido,
								'direccion' => $datos->direccion,
								'telefono' => $datos->telefono,
								'celular' => $datos->movil,
								'ci' => $datos->com_nits_numero						
							);
							$persona = $this->Abonado_model->savepersona($data2);
							// print_r($persona);
				    		echo json_encode($persona);
				    		// print_r($data2);
							//ABONADO
							$idabonado = $this->Abonado_model->get_consultaabonado();
							$data3 = array(
								// 'id_abonado' => $idabonado + 1,
								'numerocuenta'=> $datos->com_cuentas_nro_cuenta,
								'id_persona'=> $persona,
								'id_categoria' => $datos->com_categoria_id,
								'id_medidor' => $medidor									
							);
							$abonado = $this->Abonado_model->saveabonado($data3);
				    		echo json_encode($abonado);
				    		// print_r($data3);
				    		//ZONIFICACIÓN
							$idzonificacion = $this->Abonado_model->get_consultazonificacion($datos->medidor_id);
							if($idzonificacion <> '100')
				    		{
								$data4 = array(
									// 'id_zonificacion' => $idzonificacion + 1,
									'id_medidor' => $medidor,
									'id_zona' => $datos->zona,	
									'id_manzano'=> $datos->manzano_id,		
									'vivienda' => $datos->medidor 								
								);	
								$zonificacion = $this->Abonado_model->savezonificacion($data4);
					    		echo json_encode($zonificacion);
					    		// print_r($data4);					
							}
						}
						echo '<div class="panel-body">';
					    	echo '<div class="row">';
					    		echo '<div class="col-md-4">';
					    			echo '<div class="form-group">';
					    				// echo '<label>ID_abonado: </label>';
										echo '<input type="hidden" value="'.$datos->sis_persona_id.'" id="id_abonadobusq" name="id_abonadob"/>';
										// echo '<br>';
										echo '<label>Nombres: </label>';
					                	echo '<input type="text" class="form-control" value="'.$datos->nombres.'" id="nombresbusq" name="nombres" placeholder="Ingrese su nombre">';
									echo '</div>';
								echo '</div>';
								echo '<div class="col-md-4">';
					    			echo '<div class="form-group">';
										echo '<label>Apellidos: </label>';
					                	echo '<input type="text" class="form-control" value="'.$datos->primer_apellido.' '.$datos->segundo_apellido.'" id="apellidosb" name="apellidos" placeholder="Ingrese su apellido">';
									echo '</div>';
								echo '</div>';
								echo '<div class="col-md-4">';
					    			echo '<div class="form-group">';
										echo '<label>Carnet de Indentidad: </label>';
					                	echo '<input type="text" class="form-control" value="'.$datos->com_nits_numero.'" id="cib" name="ci" placeholder="Numero de CI">';
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
					                	echo '<input type="text" class="form-control format-phono-celular" value="'.$datos->movil.'" id="celularb" name="celular" placeholder="(591) 999 99999">';
									echo '</div>';
								echo '</div>';
							echo '</div>';
							echo '<div class="row">';
								echo '<div class="col-md-4">';
									echo '<div class="form-group">';
										echo '<label>Categoria: </label>';
					                	echo '<input type="text" class="form-control format-phono-celular" value="'.$datos->com_categoria_nombre.'" id="celularb" name="celular" placeholder="(591) 999 99999">';
									echo '</div>';
								echo '</div>';
							echo '</div>';
					    echo '</div>';
					} else
			    	{
			    		return $query->row();
			    	}
		    	}else
		    	{
		    		echo '<div class="alert bg-info alert-styled-right">';
					    echo '<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>';
					    echo '<span class="text-semibold">Registros no encontrados.</span>';
					echo '</div>';
		    	}
	    	} else 
	    	{
	        // print_r($datos);

		        if(count($consulta)==0)
		        {
		            // echo "<tr>";
		            // echo "<td colspan='5'>Registros no encontrados</td>";
		            // echo "</tr>";
		            echo '<div class="alert bg-info alert-styled-right">';
					    echo '<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>';
					    echo '<span class="text-semibold">Registros no encontrados.</span>';
					echo '</div>';
		        }else
		        {
		        	echo '<div class="panel-body">';
				    	echo '<div class="row">';
				    		echo '<div class="col-md-4">';
				    			echo '<div class="form-group">';
				    				// echo '<label>ID_abonado: </label>';
									echo '<input type="hidden" value="'.$consulta->id_abonado.'" id="id_abonadobusq" name="id_abonadob"/>';
									// echo '<br>';
									echo '<label>Nombres: </label>';
				                	echo '<input type="text" class="form-control" value="'.$consulta->nombres.'" id="nombresbusq" name="nombres" placeholder="Ingrese su nombre">';
								echo '</div>';
							echo '</div>';
							echo '<div class="col-md-4">';
				    			echo '<div class="form-group">';
									echo '<label>Apellidos: </label>';
				                	echo '<input type="text" class="form-control" value="'.$consulta->apellidos.'" id="apellidosb" name="apellidos" placeholder="Ingrese su apellido">';
								echo '</div>';
							echo '</div>';
							echo '<div class="col-md-4">';
				    			echo '<div class="form-group">';
									echo '<label>Carnet de Indentidad: </label>';
				                	echo '<input type="text" class="form-control" value="'.$consulta->ci.'" id="cib" name="ci" placeholder="Numero de CI">';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="row">';
				    		echo '<div class="col-md-4">';
				    			echo '<div class="form-group">';
									echo '<label>Direccion: </label>';
				                	echo '<input type="text" class="form-control" value="'.$consulta->direccion.'" id="direccionb" name="direccion" placeholder="Direccion...">';
								echo '</div>';
							echo '</div>';
							echo '<div class="col-md-4">';
				    			echo '<div class="form-group">';
									echo '<label>Telefono Fijo</label>';
				                	echo '<input type="text" class="form-control format-phone-fijo" value="'.$consulta->telefono.'" id="telefonob" name="telefono" placeholder="4 64 - 99999">';
								echo '</div>';
							echo '</div>';
							echo '<div class="col-md-4">';
				    			echo '<div class="form-group">';
									echo '<label>Celular: </label>';
				                	echo '<input type="text" class="form-control format-phono-celular" value="'.$consulta->celular.'" id="celularb" name="celular" placeholder="(591) 999 99999">';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="row">';
							echo '<div class="col-md-4">';
								echo '<div class="form-group">';
									echo '<label>Categoria: </label>';
				                	echo '<input type="text" class="form-control format-phono-celular" value="'.$consulta->detallecategoria.'" id="celularb" name="celular" placeholder="(591) 999 99999">';
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
        }else if($campo == 'ci')
        {
        	$consulta = $this->Abonado_model->get_consulta_ci($dato);
        	if(count($consulta) == 0)
	        {
	        	$datos = $this->Abonado_model->get_consulta_odeco('com_nits_numero',$dato);
	        	print_r($datos);
	        	if(count($datos) <> 0)
	        	{
    				echo '<div class="panel-body">';
			    	echo '<div class="row">';
			    		echo '<div class="col-md-4">';
			    			echo '<div class="form-group">';
			    				// echo '<label>ID_abonado: </label>';
								echo '<input type="hidden" value="'.$datos->sis_persona_id.'" id="id_abonadobusq" name="id_abonadob"/>';
								// echo '<br>';
								echo '<label>Nombres: </label>';
			                	echo '<input type="text" class="form-control" value="'.$datos->nombres.'" id="nombresbusq" name="nombres" placeholder="Ingrese su nombre">';
							echo '</div>';
						echo '</div>';
						echo '<div class="col-md-4">';
			    			echo '<div class="form-group">';
								echo '<label>Apellidos: </label>';
			                	echo '<input type="text" class="form-control" value="'.$datos->primer_apellido.' '.$datos->segundo_apellido.'" id="apellidosb" name="apellidos" placeholder="Ingrese su apellido">';
							echo '</div>';
						echo '</div>';
						echo '<div class="col-md-4">';
			    			echo '<div class="form-group">';
								echo '<label>Carnet de Indentidad: </label>';
			                	echo '<input type="text" class="form-control" value="'.$datos->com_nits_numero.'" id="cib" name="ci" placeholder="Numero de CI">';
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
			                	echo '<input type="text" class="form-control format-phono-celular" value="'.$datos->movil.'" id="celularb" name="celular" placeholder="(591) 999 99999">';
							echo '</div>';
						echo '</div>';
					echo '</div>';
					echo '<div class="row">';
						echo '<div class="col-md-4">';
							echo '<div class="form-group">';
								echo '<label>Categoria: </label>';
			                	echo '<input type="text" class="form-control format-phono-celular" value="'.$datos->com_categoria_nombre.'" id="celularb" name="celular" placeholder="(591) 999 99999">';
							echo '</div>';
						echo '</div>';
					echo '</div>';
			    	echo '</div>';	
	        	}else
	        	{
	        		echo '<div class="alert bg-info alert-styled-right">';
					    echo '<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>';
					    echo '<span class="text-semibold">Registros no encontrados.</span>';
					echo '</div>';	
	        	}	        				
	        }else
	        {
	        	echo '<div class="alert bg-info alert-styled-right">';
					    echo '<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>';
					    echo '<span class="text-semibold">Registros no encontrados.</span>';
				echo '</div>';
	        }	
        }

       
	}

	public function personaci()
	{
        $dato  = trim(strtoupper($this->input->post('ci')));
        // $datos = $this->Persona_model->get_persona_by_ci($dato);
        $datos = $this->Abonado_model->get_consulta_ci($dato);

        // $datos1 = $this->Abonado_model->get_consulta_id($dato);


        echo json_encode($datos);

   //      if(count($datos)==0)
   //      {
   //      	echo '<div class="alert bg-info alert-styled-right">';
			//     echo '<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>';
			//     echo '<span class="text-semibold">Registros no encontrados. INGRESE DATOS</span>';
			// echo '</div>';
			// echo '<div class="panel-body">';
			// 	echo '<form id="personareclamante">';
			//     	echo '<div class="row">';
			//     		echo '<div class="col-md-4">';
			//     			echo '<div class="form-group">';
			// 					echo '<label>Nombres: </label>';
			//                 	echo '<input type="text" class="form-control" id="nombresb" name="nombres" placeholder="Nombres">';
			// 				echo '</div>';
			// 			echo '</div>';
			// 			echo '<div class="col-md-4">';
			//     			echo '<div class="form-group">';
			// 					echo '<label>Apellidos: </label>';
			//                 	echo '<input type="text" class="form-control" id="apellidosb" name="apellidos" placeholder="Apellidos">';
			// 				echo '</div>';
			// 			echo '</div>';
			// 			echo '<div class="col-md-4">';
			//     			echo '<div class="form-group">';
			// 					echo '<label>Carnet de Indentidad: </label>';
			//                 	echo '<input type="text" class="form-control" id="cib" name="ci" placeholder="CI">';
			// 				echo '</div>';
			// 			echo '</div>';
			// 		echo '</div>';
			// 		echo '<div class="row">';
			//     		echo '<div class="col-md-4">';
			//     			echo '<div class="form-group">';
			// 					echo '<label>Direccion: </label>';
			//                 	echo '<input type="text" class="form-control" id="direccionb" name="direccion" placeholder="Direccion">';
			// 				echo '</div>';
			// 			echo '</div>';
			// 			echo '<div class="col-md-4">';
			//     			echo '<div class="form-group">';
			// 					echo '<label>Telefono Fijo</label>';
			//                 	echo '<input type="text" class="form-control" id="telefonob" name="telefono" placeholder="4 64 - 99999">';
			// 				echo '</div>';
			// 			echo '</div>';
			// 			echo '<div class="col-md-4">';
			//     			echo '<div class="form-group">';
			// 					echo '<label>Celular: </label>';
			//                 	echo '<input type="text" class="form-control" id="celularb" name="celular" placeholder="(591) 999 99999">';
			// 				echo '</div>';
			// 			echo '</div>';
			// 		echo '</div>';
			// 		echo '<div class="row">';
			//     		echo '<div class="col-md-4">';
			//     			echo '<div class="form-group">';
			// 					echo '<label>NIT: </label>';
			//                 	echo '<input type="text" class="form-control" id="nit" name="nit" placeholder="9999999999">';
			// 				echo '</div>';
			// 			echo '</div>';
			// 		echo '</div>';
			// 		echo '<div class="row">';
			//     		echo '<div class="col-md-4">';
			//     			echo '<div class="form-group">';
		 //                		echo '<button type="submit" id="btnSavePersona" onclick="save()" class="btn btn-success btn-labeled btn-labeled-right  btn-labeled btn-xlg">';
	  //                               echo '<b><i class="icon-floppy-disk position-right"></i></b> Guardar';
	  //                           echo '</button>';
			// 				echo '</div>';
			// 			echo '</div>';
			// 		echo '</div>';
			// 	echo '</form>';
		 //    echo '</div>';
   //      }else{
   //       	echo '<div class="panel-body">';
		 //    	echo '<div class="row">';
		 //    		echo '<div class="col-md-4">';
		 //    			echo '<div class="form-group">';
		 //    				echo '<label>ID_abonado: </label>';
			// 				echo '<input type="text" value="'.$datos->id_persona.'" id="id_abonadob" name="id_abonadob"/>';
			// 				echo '<br>';
			// 				echo '<label>Nombres: </label>';
		 //                	echo '<input type="text" disabled="disabled" class="form-control border-success border-lg text-success text-semibold" value="'.$datos->nombres.'" id="nombresb" name="nombres" placeholder="99/99/9999">';
			// 			echo '</div>';
			// 		echo '</div>';
			// 		echo '<div class="col-md-4">';
		 //    			echo '<div class="form-group">';
			// 				echo '<label>Apellidos: </label>';
		 //                	echo '<input type="text" disabled="disabled" class="form-control border-success border-lg text-success text-semibold" value="'.$datos->apellidos.'" id="apellidosb" name="apellidos" placeholder="99/99/9999">';
			// 			echo '</div>';
			// 		echo '</div>';
			// 		echo '<div class="col-md-4">';
		 //    			echo '<div class="form-group">';
			// 				echo '<label>Carnet de Indentidad: </label>';
		 //                	echo '<input type="text" disabled="disabled" class="form-control border-success border-lg text-success text-semibold" value="'.$datos->ci.'" id="cib" name="ci" placeholder="99/99/9999">';
			// 			echo '</div>';
			// 		echo '</div>';
			// 	echo '</div>';
			// 	echo '<div class="row">';
		 //    		echo '<div class="col-md-4">';
		 //    			echo '<div class="form-group">';
			// 				echo '<label>Direccion: </label>';
		 //                	echo '<input type="text" disabled="disabled" class="form-control border-success border-lg text-success text-semibold" value="'.$datos->direccion.'" id="direccionb" name="direccion" placeholder="99/99/9999">';
			// 			echo '</div>';
			// 		echo '</div>';
			// 		echo '<div class="col-md-4">';
		 //    			echo '<div class="form-group">';
			// 				echo '<label>Telefono Fijo</label>';
		 //                	echo '<input type="text" disabled="disabled" class="form-control border-success border-lg text-success text-semibold" value="'.$datos->telefono.'" id="telefonob" name="telefono" placeholder="99/99/9999">';
			// 			echo '</div>';
			// 		echo '</div>';
			// 		echo '<div class="col-md-4">';
		 //    			echo '<div class="form-group">';
			// 				echo '<label>Celular: </label>';
		 //                	echo '<input type="text" disabled="disabled" class="form-control border-success border-lg text-success text-semibold" value="'.$datos->celular.'" id="celularb" name="celular" placeholder="99/99/9999">';
			// 			echo '</div>';
			// 		echo '</div>';
			// 	echo '</div>';
			// 	echo '<div class="row">';
		 //    		echo '<div class="col-md-4">';
		 //    			echo '<div class="form-group">';
			// 				echo '<label>NIT: </label>';
		 //                	echo '<input type="text" disabled="disabled" class="form-control border-success border-lg text-success text-semibold" value="'.$datos->nit.'" id="nitb" name="nitb" placeholder="9999999999">';
			// 			echo '</div>';
			// 		echo '</div>';
			// 	echo '</div>';
		 //    echo '</div>';
        	
        // }

        // json_encode(array('status' => TRUE, 'data'=>$datos));

	}

    
}
