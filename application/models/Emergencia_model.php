<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emergencia_model extends CI_Model {

	var $table = 'reclamo';
	var $column = array('numero','fechareclamo','fecharespuesta','motivo','id_persona','id_abonado','id_clasereclamo','id_formareclamo','estadoreclamo','id_funcionario','id_tiporeclamo'); //set column field database for order and search
	var $order = array('id_reclamo' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

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

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_reclamo',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id_reclamo', $id);
		$this->db->delete($this->table);
	}

	public function get_clasereclamo()
    {
        $this->db->select('*');
        $this->db->from('clasereclamo');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_formareclamo()
    {
        $this->db->select('*');
        $this->db->from('formareclamo');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_numeroreclamo()
    {
        $this->db->select('numero');
        $this->db->from('reclamo');
        $this->db->limit(1);
        $this->db->order_by('numero', 'DESC');
        $query = $this->db->get();
        return $query->row();		
    }

    public function get_abonado_by_cuenta_usuario($dato)
    {
        $this->db->select('*');
        $this->db->from('v_abonado');
        $this->db->where('numerocuenta', $dato);
        // $this->db->like('codigousuario', $dato, 'both');
        $query = $this->db->get();
        return $query->result();
    }

    public function save_reclamo($data){
    	$this->db->insert('reclamo', $data);
		return $this->db->insert_id();
    }

    public function get_tiporeclamo_subreclamo()
    {
    	$this->db->select('tiporeclamo.id_tiporeclamo');
    	$this->db->select('tiporeclamo.nombretiporeclamo');
    	$this->db->select('subreclamo.nombresubreclamo');
        $this->db->from('tiporeclamo');
        $this->db->join('subreclamo', 'tiporeclamo.id_tiporeclamo = subreclamo.id_tiporeclamo');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_tiporeclamo()
    {
    	$this->db->from('tiporeclamo');
    	$query = $this->db->get();
        return $query->result();
    }

    public function get_subreclamo($id)
    {
        $this->db->select('nombresubreclamo');
        $this->db->select('id_subreclamo');
        $this->db->from('subreclamo');
        $this->db->where('id_tiporeclamo', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_idreclamo($id)
    {
		$this->db->from('tiporeclamo_subreclamo');
		$this->db->where('id_reclamo',$id);
		$query = $this->db->get();
		return $query->result();
    }

    public function delete_by_id_tiporeclamosubreclamo($id)
	{
		$this->db->where('id_reclamo', $id);
		$this->db->delete('tiporeclamo_subreclamo');
	}

	public function get_by_id_reclamo($id_reclamo)
	{
		$this->db->from('v_reclamo_only');
		$this->db->where('id_reclamo',$id_reclamo);
		$query = $this->db->get();

		return $query->row();
	}

	public function busquedaseguimiento($estado)
	{
		$this->db->select('id_seguimiento');
		$this->db->from('seguimiento');
		$this->db->where('id_reclamo',$_SESSION['id_reclamosession']);
		$this->db->where('id_funcionario',$_SESSION['id_persona']);
		$this->db->where('estadoseguimiento',$estado);

		$query = $this->db->get();

		return $query->row();
	}
	
	public function updateseguimiento($where, $data)
	{
		$this->db->update('seguimiento', $data, $where);
		return $this->db->affected_rows();
	}

	public function insertar_seguimiento($data)
	{
		$this->db->insert('seguimiento', $data);
		return $this->db->insert_id();
	}

	public function get_id_funcionario($reclamo){
// 		select s.id_funcionario from reclamo r
// join seguimiento s on s.id_reclamo = r.id_reclamo
// where s.id_reclamo = 74 and s.estadoseguimiento = '1'
		$this->db->select('s.id_funcionario');
		$this->db->from('reclamo r');
		$this->db->join('seguimiento s', 's.id_reclamo = r.id_reclamo'); 
		$this->db->where('s.id_reclamo', $reclamo);
		$this->db->where('s.estadoseguimiento', '1');

		$id_func = $this->db->get(); 

		// print_r($id_func->result());

		return  $id_func->result();
	}

	

}
