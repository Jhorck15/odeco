	public function ajax_add_inspection(){
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
			$id_formularioinspeccion = $this->Form_inspeccion_model->save_formularioinspeccion($data);

			// $id_tiporeclamo = ;$this->input->post('tiporeclamo')
			foreach ($_POST["subreclamo"] as $sr ) {
				$datos = array(
					'id_tiporeclamo' => $this->input->post('tiporeclamo'),
					'id_subreclamo' => $sr,
					'id_formularioinspeccion' => $id_formularioinspeccion
				);
				$this->Form_inspeccion_model->save_tipreclamo_subreclamo($datos);
			}

			if(!empty($_FILES['photo']['name']))
			{
				$upload = $this->_do_upload();
				// print_r($upload);
				// $dataarchivo = array('nombrearchivo' => $upload );
				// $dataarchivo['nombrearchivo'] = $upload;
				foreach ($upload as $up => $value) {
					foreach ($value as $key => $val) {
						if ($key=='file_name') {
							$dataarchivo = array('nombrearchivo' => $val, 'titulo' => '' );
							$id_archivo = $this->Form_inspeccion_model->save_archivo($dataarchivo);
							$datos_form_arch = array(
								'id_formularioinspeccion' => $id_formularioinspeccion,
								'id_archivo' => $id_archivo
							);
							$this->Form_inspeccion_model->save_formularioinspeccion_archivo($datos_form_arch);
						}
					}
				}
			}

			$datar = array(
				'estadoreclamo' => 4
			);
			$this->Form_inspeccion_model->update_reclamo(array('id_reclamo'=> $this->input->post('id_reclamoo')), $datar);
			echo json_encode(array("status" => TRUE));

		} else {
			echo json_encode(array("status" => FALSE));
		}
	}










	public function ajax_list()
	{
		$list = $this->Form_inspeccion_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $inspeccion) {
			$no++;
			$row = array();
			$row[] = $inspeccion->fechaforminspeccion;
			$row[] = $inspeccion->tamaniovivienda;
			$row[] = $inspeccion->numerohabitantes;
			$row[] = $inspeccion->calibrado;
			$row[] = $inspeccion->ubicacionmedidor;
			$row[] = $inspeccion->estadotanquebanio;
			$row[] = $inspeccion->presionaguazona;
			$row[] = $inspeccion->piscina;
			$row[] = $inspeccion->filtracioninterna;
			$row[] = $inspeccion->marcamedidor;
			$row[] = $inspeccion->descripcioninformeinspeccion;
			// $row[] = $inspeccion->id_reclamo;
			
			$row[] = '<ul class="icons-list">
						<li class="text-primary-600">
							<a href="javascript:void()" title="Editar" onclick="edit_forminscripcion('."'".$inspeccion->id_formularioinspeccion."'".')"><i class="icon-pencil7"></i></a>
						</li>
						<li class="text-danger-600">
							<a href="javascript:void()" title="Eliminar" onclick="delete_forminscripcion('."'".$inspeccion->id_formularioinspeccion."'".')"><i class="icon-trash"></i></a>
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