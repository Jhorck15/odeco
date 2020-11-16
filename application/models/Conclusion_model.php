<?php
Class Conclusion_model extends CI_Model {
var $table = 'reclamo r';
var $usuarioid = '';
var $datoins = 'INSPECTOR';
var $column = array('id_reclamo', 'zona','nombres','numero','ini','fin','motivo','nombreforma','zona','numeromanzano','vivienda'); 
var $lista = array();

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
	}

	public function getReclamo(){
		
		$idpersona = $_SESSION['user_id'];
		// echo $idpersona;
		$lista = $this->get_dato_usuario($idpersona);
		$idpersona = $lista[0]['id_funcionario'];
		// $primerid = $this->get_primero($idpersona);
		$this->db->select('r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, r.motivo, f.nombreforma, (zo.numero*100000000 + ma.numeromanzano*10000 + z.vivienda) as codigousuario');
		$this->db->from('seguimiento s');
		$this->db->join('funcionario fu', 'fu.id_funcionario = s.id_funcionario');
		$this->db->join('reclamo r', 'r.id_reclamo = s.id_reclamo');
		$this->db->join('persona p', 'p.id_persona = r.id_persona');
		$this->db->join('formareclamo f', 'f.id_formareclamo = r.id_formareclamo');
		$this->db->join('clasereclamo c', 'c.id_clasereclamo = r.id_clasereclamo');
		$this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
		$this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
		$this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
		$this->db->join('zona zo', 'zo.id_zona = z.id_zona');
		$this->db->join('manzano ma', 'ma.id_manzano = z.id_manzano');		
		$this->db->where('r.estadoreclamo', '4');
		$this->db->where('s.id_funcionario', $idpersona);
		$this->db->where('s.estadoseguimiento', '4');
		$this->db->order_by('r.numero','desc');
		// $this->db->where('',)
		$consulta=$this->db->get();
		
		if($consulta->num_rows()>0){
			return $consulta->result();
		} else{ echo 'No existen reclamos';}

	}



	private function _get_datatables_query()
	{
			$idpersona = $_SESSION['user_id'];
		// echo $idpersona;
		$lista = $this->get_dato_usuario($idpersona);
		$idpersona = $lista[0]['id_funcionario'];
		$idcargo = $lista[0]['detallecargo'];
		// if ($idcargo == 'USUARIO ODECO') {
			$this->db->select('r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, r.motivo, f.nombreforma, (zo.numero*100000000 + ma.numeromanzano*10000 + z.vivienda) as codigousuario');
			$this->db->from('seguimiento s');
			$this->db->join('funcionario fu', 'fu.id_funcionario = s.id_funcionario');
			$this->db->join('reclamo r', 'r.id_reclamo = s.id_reclamo');
			$this->db->join('persona p', 'p.id_persona = r.id_persona');
			$this->db->join('formareclamo f', 'f.id_formareclamo = r.id_formareclamo');
			$this->db->join('clasereclamo c', 'c.id_clasereclamo = r.id_clasereclamo');
			$this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
			$this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
			$this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
			$this->db->join('zona zo', 'zo.id_zona = z.id_zona');
			$this->db->join('manzano ma', 'ma.id_manzano = z.id_manzano');		
			$this->db->where('r.estadoreclamo', '4');
			$this->db->where('s.id_funcionario', $idpersona);
			$this->db->where('s.estadoseguimiento', '4');
			$this->db->order_by('r.numero','desc');
			// $this->db->from($this->table);

			$i = 0;
		
			foreach ($this->column as $item) // loop column 
			{
				if($_POST['search']['value']) // if datatable send POST for search
				{
					
					if($i===0) // first loop
					{
						$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
						$this->db->like($item, $_POST['search']['value']);
					}
					else
					{
						$this->db->or_like($item, $_POST['search']['value']);
					}

					if(count($this->column) - 1 == $i) //last loop
						$this->db->group_end(); //close bracket
				}
				$column[$i] = $item; // set column array variable to order processing
				$i++;
			}
			
			if(isset($_POST['order'])) // here order processing
			{
				$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} 
			else if(isset($this->order))
			{
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
		// }else{
		// 	$this->db->select('r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, r.motivo, f.nombreforma, zo.numero as zona, ma.numeromanzano, z.vivienda');
		// $this->db->from('seguimiento s');
		// $this->db->join('funcionario fu', 'fu.id_funcionario = s.id_funcionario');
		// $this->db->join('reclamo r', 'r.id_reclamo = s.id_reclamo');
		// $this->db->join('persona p', 'p.id_persona = r.id_persona');
		// $this->db->join('formareclamo f', 'f.id_formareclamo = r.id_formareclamo');
		// $this->db->join('clasereclamo c', 'c.id_clasereclamo = r.id_clasereclamo');
		// $this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
		// $this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
		// $this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
		// $this->db->join('zona zo', 'zo.id_zona = z.id_zona');
		// $this->db->join('manzano ma', 'ma.id_manzano = z.id_manzano');		
		// $this->db->where('r.estadoreclamo', '2');
		// $this->db->where('s.id_funcionario', $idpersona);
		// $this->db->where('s.estadoseguimiento', '2');
		// $this->db->order_by('r.numero','desc');
		// 	// $this->db->from($this->table);

		// 	$i = 0;
		
		// 	foreach ($this->column as $item) // loop column 
		// 	{
		// 		if($_POST['search']['value']) // if datatable send POST for search
		// 		{
					
		// 			if($i===0) // first loop
		// 			{
		// 				$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
		// 				$this->db->like($item, $_POST['search']['value']);
		// 			}
		// 			else
		// 			{
		// 				$this->db->or_like($item, $_POST['search']['value']);
		// 			}

		// 			if(count($this->column) - 1 == $i) //last loop
		// 				$this->db->group_end(); //close bracket
		// 		}
		// 		$column[$i] = $item; // set column array variable to order processing
		// 		$i++;
		// 	}
			
		// 	if(isset($_POST['order'])) // here order processing
		// 	{
		// 		$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		// 	} 
		// 	else if(isset($this->order))
		// 	{
		// 		$order = $this->order;
		// 		$this->db->order_by(key($order), $order[key($order)]);
		// 	}
		// }
		
	}


	public function count_all()
	{

		$idpersona = $_SESSION['user_id'];
		// echo $idpersona;
		$lista = $this->get_dato_usuario($idpersona);
		$idpersona = $lista[0]['id_funcionario'];
		$idcargo = $lista[0]['detallecargo'];
		
		// if ($idcargo == 'USUARIO ODECO') {
		$this->db->select('r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, r.motivo, f.nombreforma, (zo.numero*100000000 + ma.numeromanzano*10000 + z.vivienda) as codigousuario');
		$this->db->from('seguimiento s');
		$this->db->join('funcionario fu', 'fu.id_funcionario = s.id_funcionario');
		$this->db->join('reclamo r', 'r.id_reclamo = s.id_reclamo');
		$this->db->join('persona p', 'p.id_persona = r.id_persona');
		$this->db->join('formareclamo f', 'f.id_formareclamo = r.id_formareclamo');
		$this->db->join('clasereclamo c', 'c.id_clasereclamo = r.id_clasereclamo');
		$this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
		$this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
		$this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
		$this->db->join('zona zo', 'zo.id_zona = z.id_zona');
		$this->db->join('manzano ma', 'ma.id_manzano = z.id_manzano');		
		$this->db->where('r.estadoreclamo', '4');
		$this->db->where('s.id_funcionario', $idpersona);
		$this->db->where('s.estadoseguimiento', '4');
		$this->db->order_by('r.numero','desc');
			return $this->db->count_all_results();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getdatosins($id)
	{
		$this->db->select('r.id_reclamo, r.fechareclamo, r.motivo, c.nombreclase, p.nombres, p.apellidos');
		$this->db->from('reclamo r');
		$this->db->join('persona p', 'p.id_persona = r.id_persona');
		$this->db->join('clasereclamo c', 'c.id_clasereclamo = r.id_clasereclamo');
		$this->db->where('r.id_reclamo',$id);
		// $this->db->where('r.estadoreclamo', '1');
		$consulta = $this->db->get();

		return $consulta->row();
	}
	
	public function get_primero($idreclamo, $idpersona)
	{
		$this->db->select('id_funcionario'); 
		$this->db->from('seguimiento');
		$this->db->where('id_reclamo',$idreclamo);
		$this->db->where('id_funcionario !=', $idfunc);

		$consulta = $this->db->get();

		return $consulta->row();

	}

	public function getinspector(){
		$this->db->select('f.id_funcionario, p.nombres, p.apellidos, c.detallecargo');
		$this->db->from('persona p');
		$this->db->join('funcionario f','f.id_persona = p.id_persona');
		$this->db->join('cargo c','c.id_cargo = f.id_cargo');
		$this->db->where('c.detallecargo','INSPECTOR');
		$consulta = $this->db->get();
		
		return $consulta->result_array();
	}

	public function get_dato_usuario($idusuario){
		$this->db->select('p.id_persona, p.nombres, p.apellidos, c.detallecargo, f.id_funcionario');
		$this->db->from('persona p');
		$this->db->join('funcionario f','f.id_persona = p.id_persona');
		$this->db->join('cargo c','c.id_cargo = f.id_cargo');
		$this->db->join('cuenta cta','cta.id_cuenta = f.id_cuenta');
		$this->db->where('cta.id_cuenta',$idusuario);
		$consulta = $this->db->get();
		
		return $consulta->result_array();
	}


	public function get_datofuncionario(){
		$this->db->select('f.id_funcionario, p.nombres, p.apellidos, c.detallecargo');
		$this->db->from('persona p');
		$this->db->join('funcionario f','f.id_persona = p.id_persona');
		$this->db->join('cargo c','c.id_cargo = f.id_cargo');
		$this->db->where('c.detallecargo','JEFE RED DE AGUA');
		$this->db->or_where('c.detallecargo','JEFE ALCANTARILLADO');
		$this->db->or_where('c.detallecargo','JEFE MEDICION Y FACTURACION');
		$this->db->or_where('c.detallecargo','JEFE ATENCION AL CLIENTE');
		$consulta = $this->db->get();
		
		return $consulta->result_array();
	}


	public function guardar($data)
	{
		$idpersona = $_SESSION['user_id'];
		// echo $idpersona;
		$lista = $this->get_dato_usuario($idpersona);
		$idpersona = $lista[0]['id_funcionario'];
		$idcargo = $lista[0]['detallecargo'];
		
		if ($idcargo == 'USUARIO ODECO') {
			// print_r($data);
			$this->db->insert('seguimiento', $data);
			return $this->db->insert_id();
		} else {
			// $idseguimiento = $this->get_dato_seguimiento($data->id_reclamo);
			// $this->db->where('id_seguimiento', $idseguimiento);
			// $this->db->update('seguimiento', $data);
			// return $this->db->update();
			$this->db->insert('seguimiento', $data);
			return $this->db->insert_id();
		}
	}


	public function guardarr($data)
	{
		
			$this->db->where('id_seguimiento', $data['id_reclamo']);
			return $this->db->update('seguimiento', $data);
			// return $this->db->update();
		
	}


	
	public function actualizar($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id_persona', $id);
		$this->db->delete($this->table);
	}

	public function get_dato_seguimiento($idreclamo)
	{
		$this->db->select('s.id_seguimiento');
		$this->db->from('seguimiento s');
		$this->db->join('reclamo r','r.id_reclamo=s.id_reclamo');
		$this->db->where('s.id_reclamo',$idreclamo);
		$consulta = $this->db->get();

		return $consulta;
	}

	public function getReclamoInsp(){

		$idpersona = $_SESSION['user_id'];
		// echo $idpersona.' este otro';
		$lista = $this->get_dato_usuario($idpersona);
		$idpersona = $lista[0]['id_funcionario'];
		// echo $idpersona;
		$this->db->select('r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, r.motivo, f.nombreforma, (zo.numero*100000000 + ma.numeromanzano*10000 + z.vivienda) as codigousuario, fi.descripcioninformeinspeccion');
		$this->db->from('seguimiento s');
		$this->db->join('funcionario fu', 'fu.id_funcionario = s.id_funcionario');
		$this->db->join('reclamo r', 'r.id_reclamo = s.id_reclamo');
		$this->db->join('persona p', 'p.id_persona = r.id_persona');
		$this->db->join('formularioinspeccion fi', 'fi.id_reclamo = r.id_reclamo');
		$this->db->join('formareclamo f', 'f.id_formareclamo = r.id_formareclamo');
		$this->db->join('clasereclamo c', 'c.id_clasereclamo = r.id_clasereclamo');
		$this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
		$this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
		$this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
		$this->db->join('zona zo', 'zo.id_zona = z.id_zona');
		$this->db->join('manzano ma', 'ma.id_manzano = z.id_manzano');		
		$this->db->where('r.estadoreclamo', '4');
		$this->db->where('s.id_funcionario', $idpersona);
		$this->db->where('s.estadoseguimiento', '4');
		$this->db->order_by('r.numero','desc');
		// $this->db->where('',)
		$consulta=$this->db->get();
		
		if($consulta->num_rows()>0){
			return $consulta->result();
		} else{ echo 'No existen reclamos';}

	}

	// --------------------------------- desde aqui
	public function updatereclamo($where, $data)
	{
		$this->db->update('reclamo', $data, $where);
		return $this->db->affected_rows();
	}

	public function eliminaseguimiento($id)
	{
		$this->db->where('id_reclamo', $id);
		$this->db->where('estadoseguimiento', '2');
		$this->db->delete('seguimiento');
	}

// --------------------------------------------------
	public function eliminaseguimientocuatro($id)
	{
		$this->db->where('id_reclamo', $id);
		$this->db->where('estadoseguimiento', '4');
		$this->db->delete('seguimiento');
	}

	public function busquedaseguimiento($id_reclamo)
	{
		$this->db->select('id_seguimiento');
		$this->db->from('seguimiento');
		$this->db->where('id_reclamo',$id_reclamo);
		$this->db->where('id_funcionario !=',$_SESSION['id_persona']);
		$this->db->where('estadoseguimiento','3');

		$query = $this->db->get();

		return $query->result();
	}

	public function updateseguimientocuatro($where, $data){
		$this->db->update('seguimiento', $data, $where);
		return $this->db->affected_rows();
	}

	public function insertar_seguimiento($data)
	{
		$this->db->insert('seguimiento', $data);
		return $this->db->insert_id();
	}

	public function save($data)
	{
		$this->db->insert('conclusion', $data);
		return $this->db->insert_id();
	}

	public function lista_conclusion(){
		$this->db->from('conclusion');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_by_id_conclusion($id)
	{
		$this->db->from('conclusion');
		$this->db->where('id_conclusion',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function buscarcodigousuario($data)
	{
		$this->db->from('col_reclamo');
		$this->db->where('id_reclamo',$data);
		$query = $this->db->get();

		return $query->row();
	}


	
}
?>