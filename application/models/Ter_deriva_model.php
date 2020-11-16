<?php
Class Ter_deriva_model extends CI_Model {
var $table = 'reclamo r';
var $usuarioid = '';
var $datoins = 'INSPECTOR';
var $column = array('id_reclamo', 'zona','nombres','numero','ini','fin','nombreforma','zona','numeromanzano','vivienda'); 
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
		$this->db->select('r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, t.nombretiporeclamo, f.nombreforma, (zo.numero*100000000 + ma.numeromanzano*10000 + z.vivienda) as codigousuario, s.id_funcionario as data_func');
		$this->db->from('funcionario fu');
		$this->db->join('reclamo r', 'r.id_funcionario = fu.id_funcionario');
		$this->db->join('persona p', 'p.id_persona = r.id_persona');
		$this->db->join('formareclamo f', 'f.id_formareclamo = r.id_formareclamo');
		$this->db->join('tiporeclamo t', 't.id_tiporeclamo = r.id_tiporeclamo');
		$this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
		$this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
		$this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
		$this->db->join('zona zo', 'zo.id_zona = z.id_zona');
		$this->db->join('manzano ma', 'ma.id_manzano = z.id_manzano');	
		$this->db->join('seguimiento s', 's.id_reclamo = r.id_reclamo');	
		$this->db->where('r.estadoreclamo !=', '0');
		$this->db->where('fu.id_funcionario', $idpersona);
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
		$this->db->select('r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, t.nombretiporeclamo, f.nombreforma, (zo.numero*100000000 + ma.numeromanzano*10000 + z.vivienda) as codigousuario');
		$this->db->from('funcionario fu');
		$this->db->join('reclamo r', 'r.id_funcionario = fu.id_funcionario');
		$this->db->join('persona p', 'p.id_persona = r.id_persona');
		$this->db->join('formareclamo f', 'f.id_formareclamo = r.id_formareclamo');
		$this->db->join('clasereclamo c', 'c.id_clasereclamo = r.id_clasereclamo');
		$this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
		$this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
		$this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
		$this->db->join('zona zo', 'zo.id_zona = z.id_zona');
		$this->db->join('manzano ma', 'ma.id_manzano = z.id_manzano');		
		$this->db->where('r.estadoreclamo !=', '0');
		$this->db->where('fu.id_funcionario', $idpersona);
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
		
		
	}



	public function count_all()
	{
		$idpersona = $_SESSION['user_id'];
		// echo $idpersona;
		$lista = $this->get_dato_usuario($idpersona);
		$idpersona = $lista[0]['id_funcionario'];
		$this->db->select('r.id_reclamo, p.nombres, p.apellidos, r.numero, (date(r.fechareclamo)) as ini, (date(r.fecharespuesta)) as fin, t.nombretiporeclamo, f.nombreforma, (zo.numero*100000000 + ma.numeromanzano*10000 + z.vivienda) as codigousuario');
		$this->db->from('funcionario fu');
		$this->db->join('reclamo r', 'r.id_funcionario = fu.id_funcionario');
		$this->db->join('persona p', 'p.id_persona = r.id_persona');
		$this->db->join('formareclamo f', 'f.id_formareclamo = r.id_formareclamo');
		$this->db->join('clasereclamo c', 'c.id_clasereclamo = r.id_clasereclamo');
		$this->db->join('abonado a', 'a.id_abonado = r.id_abonado');
		$this->db->join('medidor m', 'm.id_medidor = a.id_medidor');
		$this->db->join('zonificacion z', 'z.id_medidor = m.id_medidor');
		$this->db->join('zona zo', 'zo.id_zona = z.id_zona');
		$this->db->join('manzano ma', 'ma.id_manzano = z.id_manzano');		
		$this->db->where('r.estadoreclamo !=', '0');
		$this->db->where('fu.id_funcionario', $idpersona);
		$this->db->order_by('r.numero','desc');
		return $this->db->count_all_results();		
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
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

	public function datoFuncionario($datos){
		$this->db->select('p.id_persona, p.nombres, p.apellidos');
		$this->db->from('persona p');
		$this->db->join('funcionario f','f.id_persona = p.id_persona');
		$this->db->where('f.id_funcionario', $datos);
		// $this->db->order_by('id_funcionario', 'desc');
		$consulta = $this->db->get();
			// printf($consulta['nombres']);
		
		return $consulta->row();
	}

}
?>