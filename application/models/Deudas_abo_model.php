<?php
Class Deudas_abo_model extends CI_Model {
var $table = 'reclamo';
var $usuarioid = '';
var $datoins = 'INSPECTOR';
var $column = array('id_reclamo', 'zona','nombres','numero','ini','fin','motivo','nombreforma','zona','numeromanzano','vivienda'); 
var $lista = array();

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->db1 = $this->load->database('poseidon',TRUE);
	}

	// public function getReclamo(){
		
	// 	$idpersona = $_SESSION['user_id'];
	// 	// echo $idpersona;
	// 	$lista = $this->get_dato_usuario($idpersona);
	// 	$idpersona = $lista[0]['id_funcionario'];
	// 	$this->db->select('r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, r.motivo, f.nombreforma, (zo.numero*100000000 + ma.numeromanzano*10000 + z.vivienda) as codigousuario');
	// 	$this->db->from('funcionario fu');
	// 	$this->db->join('reclamo r', 'r.id_funcionario = fu.id_funcionario');
	// 	$this->db->join('persona p', 'p.id_persona = r.id_persona');
	// 	$this->db->join('formareclamo f', 'f.id_formareclamo = r.id_formareclamo');
	// 	$this->db->join('clasereclamo c', 'c.id_clasereclamo = r.id_clasereclamo');
	// 	$this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
	// 	$this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
	// 	$this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
	// 	$this->db->join('zona zo', 'zo.id_zona = z.id_zona');
	// 	$this->db->join('manzano ma', 'ma.id_manzano = z.id_manzano');		
	// 	$this->db->where('r.estadoreclamo', '0');
	// 	$this->db->where('fu.id_funcionario', $idpersona);
	// 	$this->db->order_by('r.numero','desc');
	// 	// $this->db->where('',)
	// 	$consulta=$this->db->get();
		
	// 	if($consulta->num_rows()>0){
	// 		return $consulta->result();
	// 	} else{ echo 'No existen reclamos';}

	// }



	// private function _get_datatables_query()
	// {
	// 	$idpersona = $_SESSION['user_id'];
	// 	// echo $idpersona;
	// 	$lista = $this->get_dato_usuario($idpersona);
	// 	$idpersona = $lista[0]['id_funcionario'];
	// 	$idcargo = $lista[0]['detallecargo'];
	// 	if ($idcargo == 'USUARIO ODECO') {
	// 		$this->db->select('r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, r.motivo, f.nombreforma, (zo.numero*100000000 + ma.numeromanzano*10000 + z.vivienda) as codigousuario');
	// 		$this->db->from('funcionario fu');
	// 		$this->db->join('reclamo r', 'r.id_funcionario = fu.id_funcionario');
	// 		$this->db->join('persona p', 'p.id_persona = r.id_persona');
	// 		$this->db->join('formareclamo f', 'f.id_formareclamo = r.id_formareclamo');
	// 		$this->db->join('clasereclamo c', 'c.id_clasereclamo = r.id_clasereclamo');
	// 		$this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
	// 		$this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
	// 		$this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
	// 		$this->db->join('zona zo', 'zo.id_zona = z.id_zona');
	// 		$this->db->join('manzano ma', 'ma.id_manzano = z.id_manzano');		
	// 		$this->db->where('r.estadoreclamo', '0');
	// 		$this->db->where('fu.id_funcionario', $idpersona);
	// 		$this->db->order_by('r.numero','desc');
	// 		// $this->db->from($this->table);

	// 		$i = 0;
		
	// 		foreach ($this->column as $item) // loop column 
	// 		{
	// 			if($_POST['search']['value']) // if datatable send POST for search
	// 			{
					
	// 				if($i===0) // first loop
	// 				{
	// 					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
	// 					$this->db->like($item, $_POST['search']['value']);
	// 				}
	// 				else
	// 				{
	// 					$this->db->or_like($item, $_POST['search']['value']);
	// 				}

	// 				if(count($this->column) - 1 == $i) //last loop
	// 					$this->db->group_end(); //close bracket
	// 			}
	// 			$column[$i] = $item; // set column array variable to order processing
	// 			$i++;
	// 		}
			
	// 		if(isset($_POST['order'])) // here order processing
	// 		{
	// 			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	// 		} 
	// 		else if(isset($this->order))
	// 		{
	// 			$order = $this->order;
	// 			$this->db->order_by(key($order), $order[key($order)]);
	// 		}
	// 	}else{
	// 		$this->db->select('r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, r.motivo, f.nombreforma, (zo.numero*100000000 + ma.numeromanzano*10000 + z.vivienda) as codigousuario');
	// 		$this->db->from('seguimiento s');
	// 		$this->db->join('funcionario fu', 'fu.id_funcionario = s.id_funcionario');
	// 		$this->db->join('reclamo r', 'r.id_reclamo = s.id_reclamo');
	// 		$this->db->join('persona p', 'p.id_persona = r.id_persona');
	// 		$this->db->join('formareclamo f', 'f.id_formareclamo = r.id_formareclamo');
	// 		$this->db->join('clasereclamo c', 'c.id_clasereclamo = r.id_clasereclamo');
	// 		$this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
	// 		$this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
	// 		$this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
	// 		$this->db->join('zona zo', 'zo.id_zona = z.id_zona');
	// 		$this->db->join('manzano ma', 'ma.id_manzano = z.id_manzano');		
	// 		$this->db->where('r.estadoreclamo', '1');
	// 		$this->db->where('s.id_funcionario', $idpersona);
	// 		$this->db->where('s.estadoseguimiento', '1');
	// 		$this->db->order_by('r.numero','desc');
	// 		// $this->db->from($this->table);

	// 		$i = 0;
		
	// 		foreach ($this->column as $item) // loop column 
	// 		{
	// 			if($_POST['search']['value']) // if datatable send POST for search
	// 			{
					
	// 				if($i===0) // first loop
	// 				{
	// 					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
	// 					$this->db->like($item, $_POST['search']['value']);
	// 				}
	// 				else
	// 				{
	// 					$this->db->or_like($item, $_POST['search']['value']);
	// 				}

	// 				if(count($this->column) - 1 == $i) //last loop
	// 					$this->db->group_end(); //close bracket
	// 			}
	// 			$column[$i] = $item; // set column array variable to order processing
	// 			$i++;
	// 		}
			
	// 		if(isset($_POST['order'])) // here order processing
	// 		{
	// 			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	// 		} 
	// 		else if(isset($this->order))
	// 		{
	// 			$order = $this->order;
	// 			$this->db->order_by(key($order), $order[key($order)]);
	// 		}
	// 	}
		
	// }



	// public function count_all()
	// {

	// 	$idpersona = $_SESSION['user_id'];
	// 	// echo $idpersona;
	// 	$lista = $this->get_dato_usuario($idpersona);
	// 	$idpersona = $lista[0]['id_funcionario'];
	// 	$idcargo = $lista[0]['detallecargo'];
	// 	// print_r($lista);
		
	// 	if ($idcargo == 'USUARIO ODECO') {
	// 		$this->db->select('r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, r.motivo, f.nombreforma, (zo.numero*100000000 + ma.numeromanzano*10000 + z.vivienda) as codigousuario');
	// 		$this->db->from('funcionario fu');
	// 		$this->db->join('reclamo r', 'r.id_funcionario = fu.id_funcionario');
	// 		$this->db->join('persona p', 'p.id_persona = r.id_persona');
	// 		$this->db->join('formareclamo f', 'f.id_formareclamo = r.id_formareclamo');
	// 		$this->db->join('clasereclamo c', 'c.id_clasereclamo = r.id_clasereclamo');
	// 		$this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
	// 		$this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
	// 		$this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
	// 		$this->db->join('zona zo', 'zo.id_zona = z.id_zona');
	// 		$this->db->join('manzano ma', 'ma.id_manzano = z.id_manzano');		
	// 		$this->db->where('r.estadoreclamo', '0');
	// 		$this->db->where('fu.id_funcionario', $idpersona);
	// 		$this->db->order_by('r.numero','desc');

	// 		return $this->db->count_all_results();
	// 	} elseif ($idcargo == 'INSPECTOR') {
	// 		$this->db->select('r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, r.motivo, f.nombreforma, (zo.numero*100000000 + ma.numeromanzano*10000 + z.vivienda) as codigousuario');
	// 		$this->db->from('seguimiento s');
	// 		$this->db->join('funcionario fu', 'fu.id_funcionario = s.id_funcionario');
	// 		$this->db->join('reclamo r', 'r.id_reclamo = s.id_reclamo');
	// 		$this->db->join('persona p', 'p.id_persona = r.id_persona');
	// 		$this->db->join('formareclamo f', 'f.id_formareclamo = r.id_formareclamo');
	// 		$this->db->join('clasereclamo c', 'c.id_clasereclamo = r.id_clasereclamo');
	// 		$this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
	// 		$this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
	// 		$this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
	// 		$this->db->join('zona zo', 'zo.id_zona = z.id_zona');
	// 		$this->db->join('manzano ma', 'ma.id_manzano = z.id_manzano');		
	// 		$this->db->where('r.estadoreclamo', '2');
	// 		$this->db->where('s.id_funcionario', $idpersona);
	// 		$this->db->where('s.estadoseguimiento', '2');
	// 		$this->db->order_by('r.numero','desc');

	// 		return $this->db->count_all_results();
	// 	} else {

	// 		$this->db->select('r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, r.motivo, f.nombreforma, (zo.numero*100000000 + ma.numeromanzano*10000 + z.vivienda) as codigousuario');
	// 		$this->db->from('seguimiento s');
	// 		$this->db->join('funcionario fu', 'fu.id_funcionario = s.id_funcionario');
	// 		$this->db->join('reclamo r', 'r.id_reclamo = s.id_reclamo');
	// 		$this->db->join('persona p', 'p.id_persona = r.id_persona');
	// 		$this->db->join('formareclamo f', 'f.id_formareclamo = r.id_formareclamo');
	// 		$this->db->join('clasereclamo c', 'c.id_clasereclamo = r.id_clasereclamo');
	// 		$this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
	// 		$this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
	// 		$this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
	// 		$this->db->join('zona zo', 'zo.id_zona = z.id_zona');
	// 		$this->db->join('manzano ma', 'ma.id_manzano = z.id_manzano');		
	// 		$this->db->where('r.estadoreclamo', '1');
	// 		$this->db->where('s.id_funcionario', $idpersona);
	// 		$this->db->where('s.estadoseguimiento', '1');
	// 		$this->db->order_by('r.numero','desc');
			
	// 		return $this->db->count_all_results();
	// 	}
	// }

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

	public function getinspector(){
		$this->db->select('f.id_funcionario, p.nombres, p.apellidos, c.detallecargo');
		$this->db->from('persona p');
		$this->db->join('funcionario f','f.id_persona = p.id_persona');
		$this->db->join('cargo c','c.id_cargo = f.id_cargo');
		$this->db->where('c.detallecargo','INSPECTOR');
		$consulta = $this->db->get();
		
		return $consulta->result_array();
	}


	public function getjefaturas(){
		$this->db->select('f.id_funcionario, p.nombres, p.apellidos, c.detallecargo');
		$this->db->from('persona p');
		$this->db->join('funcionario f','f.id_persona = p.id_persona');
		$this->db->join('cargo c','c.id_cargo = f.id_cargo');
		$this->db->where('c.detallecargo','ENCARGADO CATASTRO DE USUARIOS');
		$this->db->or_where('c.detallecargo', 'ENCARGADO CORTES');
		$this->db->or_where('c.detallecargo', 'ENCARGADO BANCO DE MEDIDORES');
		$consulta = $this->db->get();
		
		return $consulta->result_array();
	}

	public function get_dato_usuario($idusuario){
		$this->db->select('p.id_persona, p.nombres, p.apellidos, p.direccion, p.direccion, p.telefono, p.celular, c.detallecargo, f.id_funcionario');
		$this->db->from('persona p');
		$this->db->join('funcionario f','f.id_persona = p.id_persona');
		$this->db->join('cargo c','c.id_cargo = f.id_cargo');
		$this->db->join('cuenta cta','cta.id_cuenta = f.id_cuenta');
		$this->db->where('cta.id_cuenta',$idusuario);
		$consulta = $this->db->get();
		
		return $consulta->result_array();
	}


	public function get_datofuncionario(){
		// $this->db->select('f.id_funcionario, p.nombres, p.apellidos, c.detallecargo');
		$this->db->select('f.id_funcionario, p.nombres, p.apellidos, c.detallecargo');
		$this->db->from('persona p');
		$this->db->join('funcionario f','f.id_persona = p.id_persona');
		$this->db->join('cargo c','c.id_cargo = f.id_cargo');
		$this->db->where('c.detallecargo','JEFE RED DE AGUA');
		$this->db->or_where('c.detallecargo','JEFE ALCANTARILLADO');
		$this->db->or_where('c.detallecargo','JEFE CONTROL DE CALIDAD');
		$this->db->or_where('c.detallecargo','JEFE MEDICION Y FACTURACION');
		$this->db->or_where('c.detallecargo','JEFE ATENCION AL CLIENTE');		
		$this->db->or_where('c.detallecargo','JEFE ADMINISTRATIVA Y DE PERSONAL');
		$this->db->or_where('c.detallecargo','JEFE ADUCCIÓN');
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
			$this->db->insert('seguimiento', $data);
			return $this->db->insert_id();
			// print_r($data);
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

// 		select r.id_reclamo, p.nombres, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, r.motivo, f.nombreforma, zo.numero as zona, ma.numeromanzano, z.vivienda
// from seguimiento s
// join funcionario fu on fu.id_funcionario = s.id_funcionario
// join reclamo r on r.id_reclamo = s.id_reclamo
// join persona p on p.id_persona = r.id_persona
// join formareclamo f on f.id_formareclamo = r.id_formareclamo
// join clasereclamo c on c.id_clasereclamo = r.id_clasereclamo
// join abonado a on a.id_abonado = r.id_abonado
// join medidor m on m.id_medidor = a.id_medidor
// join zonificacion z on z.id_medidor = m.id_medidor
// join zona zo on zo.id_zona = z.id_zona
// join manzano ma on ma.id_manzano = z.id_manzano

// where r.estadoreclamo = '1' and s.id_funcionario = 4 and s.estadoseguimiento = '1'
// order by r.numero desc

		$idpersona = $_SESSION['user_id'];
		// echo $idpersona.' este otro';
		$lista = $this->get_dato_usuario($idpersona);
		$idpersona = $lista[0]['id_funcionario'];
		// echo $idpersona;
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
		$this->db->where('r.estadoreclamo', '1');
		$this->db->where('s.id_funcionario', $idpersona);
		$this->db->where('s.estadoseguimiento', '1');
		$this->db->order_by('r.numero','desc');
		// $this->db->where('',)
		$consulta=$this->db->get();
		
		if($consulta->num_rows()>0){
			return $consulta->result();
		} else{ echo 'No existen reclamos';}

	}


	public function get_abonado_by_numerocuenta($campo, $dato)
    {
              // $this->db->select('');
        $this->db->from('v_abonado');
        $this->db->where('codigousuario', $dato);
        $consult = $this->db->get();
        return $consult->row();

    }

    public function get_reclamo_usuario($dato)
    {
 // select p.nombres, p.apellidos, r.estadoreclamo, p.direccion, p.telefono, p.ci, p.nit, r.motivo, r.numero, r.fechareclamo, r.fecharespuesta,a.id_persona,
	// c.detallecategoria,(zon.numero * 100000000 + man.numeromanzano * 10000 + z.vivienda)::text AS codigousuario
 // from reclamo r
 // join persona p on p.id_persona = r.id_persona
 // join abonado a on a.id_abonado = r.id_abonado
 // join categoria c on c.id_categoria = a.id_categoria
 // JOIN medidor m ON m.id_medidor = a.id_medidor
 // JOIN zonificacion z ON z.id_medidor = m.id_medidor
 // JOIN zona zon ON zon.id_zona = z.id_zona
 // JOIN manzano man ON man.id_manzano = z.id_manzano
 // order by r.id_reclamo

 //    	$this->db->select('p.nombres, p.apellidos, r.estadoreclamo, p.direccion, p.telefono, p.ci, p.nit, r.motivo, r.numero, r.fechareclamo, r.fecharespuesta,a.id_persona,
	// c.detallecategoria,(zon.numero * 100000000 + man.numeromanzano * 10000 + z.vivienda)::text as codigousuario');
 //    	$this->db->from('reclamo r');
 //    	$this->db->join('persona p', 'p.id_persona = r.id_persona');
 //    	$this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
 //    	$this->db->join('categoria c', 'c.id_categoria = a.id_categoria');
 //    	$this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
 //    	$this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
 //    	$this->db->join('zona zon', 'zon.id_zona = z.id_zona');
 //    	$this->db->join('manzano man', 'man.id_manzano = z.id_manzano');
 //    	$this->db->where('codigousuario', $dato);
    	// $this->db->order_by('r.id_reclamo')
    	$this->db->select('estadoreclamo');
    	$this->db->from('col_reclamo');
    	$this->db->where('codigousuario', $dato);
    	$cons = $this->db->get();
    	// if($consulta->num_rows()>0){
			return $cons->row();
		// } else{ echo 'No existen reclamos';}
    }

     public function get_odecos(){
    	$this->db->from('reclamo');
    	$this->db->where('estadoreclamo', '5');
    	$cons = $this->db->get();
    	$num_odeco = $cons->num_rows();
    	return $num_odeco;
    }

    public function get_datosDeuda($dato)
    {
        $this->db1->select('concepto,consumo, monto_total');
        $this->db1->from('public.cob_ventas v');
        $this->db1->join('v_com_usuarios u', 'u.id=v.com_usuario_id');
        $this->db1->where('u.codigo_catastral', $dato);
        $this->db1->where('pagado', 'N');
        $this->db1->order_by('fecha_venta', 'desc');
        $cons = $this->db1->get();
        // print_r($cons);
        return $cons->result();

    }
	
}
?>