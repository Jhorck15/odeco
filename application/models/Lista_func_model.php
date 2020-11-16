<?php
Class Lista_func_model extends CI_Model {
var $table = 'reclamo r';
var $usuarioid = '';
var $datoins = 'INSPECTOR';
var $column = array('ci', 'nombres','apellidos','dirección','telefono','celular', 'nit'); 
var $lista = array();

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
	}

	public function getLista(){
		
		
		$this->db->from('list_func');
		$this->db->order_by('id_funcionario','desc');
		$consulta=$this->db->get();
		
		if($consulta->num_rows()>0){
			return $consulta->result();
		} else{ echo 'No cargo la lista de funcionarios';}

	}



	private function _get_datatables_query()
	{
		
			$this->db->from('list_func');
			$consulta=$this->db->get();
			
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
		$this->db->from('list_func');
		$consulta=$this->db->get();

		return $this->db->count_all_results();		
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getListage()
	{
		$this->db->from('gerencia');
		$dato = $this->db->get();
		return $dato->result();
	}

	public function getListaro()
	{
		$this->db->from('rol');
		$dato = $this->db->get();
		return $dato->result();
	}

	public function getListaje($id)
	{
		$this->db->from('jefatura j');
		$this->db->join('gerencia g', 'g.id_gerencia = j.id_gerencia');
		$this->db->where('g.id_gerencia', $id);

		$dato = $this->db->get();
		return $dato->result();
	}

	
	public function getListaca($id)
	{
		$this->db->from('cargo c');
		$this->db->join('jefatura j', 'j.id_jefatura = c.id_jefatura');
		$this->db->where('j.id_jefatura', $id);

		$dato = $this->db->get();
		return $dato->result();
	}

	public function contar(){
		$this->db->from('persona');
		$num = $this->db->get();
		return $num->num_rows();
	}

	public function conta(){
		$this->db->from('funcionario');
		$num = $this->db->get();
		return $num->num_rows();
	}

	public function con(){
		$this->db->from('cuenta');
		$num = $this->db->get();
		return $num->num_rows();
	}

	public function guardar($data)
	{
		
		$this->db->insert('persona', $data);		
	}

	public function guardar_cta($data)
	{
		$this->db->insert('cuenta', $data);		
	}

	public function guardar_func($data)
	{
		$this->db->insert('funcionario', $data);		
	}

	public function getdatosfunc($id)
	{
		$this->db->from('list_func');
		$this->db->where('id_funcionario',$id);
		// $this->db->where('r.estadoreclamo', '1');
		$consulta = $this->db->get();

		return $consulta->row();
		
	}

}
?>