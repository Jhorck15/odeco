<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_inspeccion_model extends CI_Model {

	var $table = 'formularioinspeccion';
	var $column = array('fechaforminspeccion','tamaniovivienda', 'numerohabitantes', 'ubicacionmedidor', 'estadotanquebanio', 'presionaguazona', 'filtracioninterna', 'marcamedidor', 'descripcioninformeinspeccion', 'id_abonado', 'id_reclamo'); //set column field database for order and search
	var $order = array('id_formularioinspeccion' => 'desc'); // default order 

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

	public function save_formularioinspeccion($data){
    	$this->db->insert($this->table, $data);
		return $this->db->insert_id();
    }

    public function save_tipreclamo_subreclamo($data){
    	$this->db->insert('tiporeclamo_subreclamo', $data);
    }

    public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_formularioinspeccion',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_by_idformularioinspeccion($id)
    {
		$this->db->from('tiporeclamo_subreclamo');
		$this->db->where('id_formularioinspeccion',$id);
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

    public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id_tiporeclamosubreclamo($id)
	{
		$this->db->where('id_formularioinspeccion', $id);
		$this->db->delete('tiporeclamo_subreclamo');
	}

	public function update_reclamo($where, $data)
	{
		$this->db->update('reclamo', $data, $where);
		return $this->db->affected_rows();
	}

	public function save_archivo($data)
	{
		$this->db->insert('archivo', $data);
		return $this->db->insert_id();
	}

	public function save_formularioinspeccion_archivo($data)
	{
		$this->db->insert('formularioinspeccion_archivo', $data);
	}

	// public function get_by_idformularioinspeccion_archivo($id)
 //    {
	// 	$this->db->from('formularioinspeccion_archivo');
	// 	$this->db->where('id_formularioinspeccion',$id);
	// 	$query = $this->db->get();
	// 	return $query->result();
 //    }

	public function get_archivo($id)
	{
		$this->db->select('ar.nombrearchivo, fa.id_archivo');
		$this->db->from('archivo ar');
		$this->db->join('formularioinspeccion_archivo fa','ar.id_archivo = fa.id_archivo');
		$this->db->where('fa.id_formularioinspeccion',$id);
		$query = $this->db->get();

		return $query->result();
	}

	public function delete_by_id_forminsp($id)
	{
		$this->db->where('id_formularioinspeccion', $id);
		$this->db->delete('formularioinspeccion_archivo');
	}

	public function delete_by_id_archivo($id)
	{
		// $this->db->from('archivo')
		$this->db->where('id_archivo', $id);
		$this->db->delete('archivo');
	}

}
