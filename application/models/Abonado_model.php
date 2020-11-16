<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Abonado_model extends CI_Model {

/*
select *
from persona per, abonado abo, reclamo rec, medidor med, categoria cat, clasereclamo cr
where med.id_medidor = abo.id_medidor
	and per.id_persona = abo.id_persona
    and abo.id_categoria = cat.id_categoria
    and abo.id_abonado = rec.id_abonado
    and rec.id_clasereclamo = cr.id_clasereclamo

*/

	var $table = 'abonado';
	var $column = array('nit','numerocuenta','id_persona','id_categoria','id_medidor'); //set column field database for order and search
	var $order = array('id_abonado' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db1 = $this->load->database('poseidon',TRUE);
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
		$this->db->where('id',$id);
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
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	// public function get_abonado_by_numerocuenta($campo, $dato)
 //    {
 //        $this->db->select('*');
 //        $this->db->from('v_abonado');
 //        $this->db->like($campo, $dato, 'both');
 //        $query = $this->db->get();
 //        return $query->row(0);
 //    }

    public function get_abonado_by_numerocuenta($campo, $dato)
    {
        // $this->db->select('*');
        $this->db->from('v_abonado');
        $this->db->where($campo, $dato);
        $query = $this->db->get();
        return $query->row(0);
    }

    public function get_view_reclamo($id_abonado)
    {
        // $this->db->select('*');
        $this->db->from('v_recalmo');
        $this->db->like('id_abonado', $id_abonado, 'both');
        $query = $this->db->get();
        return $query->row(0);
    }

    public function get_abonado()
    {
        // $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_consulta($campo, $dato)
    {
    	$this->db->from('col_reclamo_odeco');
    	$this->db->where('codigousuario', $dato);
    	$query2 = $this->db->get();
    	return $query2->row();	
    	
    }

    public function get_consulta_odeco ($campo, $dato)
    {
	   	$this->db1->from('v_ode_datosusuario');
    	$this->db1->where($campo, $dato);
    	$query = $this->db1->get();
    	return $query->row();    	
    }

    public function get_consultamanzano($dato)
    {
    	$this->db1->from('cat_manzanos');
		$this->db1->where('id', $dato);
		$query = $this->db1->get();
		// $query->row();

		$this->db->from('manzano');
		$this->db->where('id_manzano', $dato);
		$query1 = $this->db->get();
		if($query1->num_rows() == 0)
		{
			return $query->row();
		} else
		{
			return $query = '100';
		}
		
    }

    public function get_consultamedidor($dato)
    {
		$this->db1->from('com_medidores');
		$this->db1->where('id', $dato);
		$query = $this->db1->get();
		// return $query->row();

		$this->db->from('medidor');
		$this->db->where('id_medidor', $dato);
		$query1 = $this->db->get();
		if($query1->num_rows() == 0)
		{
			return $query->row();
		} else
		{
			return $query = '100';
		}
    }

  //   public function get_consultacategoria($dato)
  //   {
		// $this->db1->from('com_categoria');
		// $this->db1->where('id', $dato);
		// $query = $this->db1->get();
		// return $query->row();
  //   }
    public function get_consultapersona($datos)
    {
    	$this->db->from('persona');
    	$this->db->where('ci', $datos);
    	$query = $this->db->get();

    	// return $query->num_rows();
    	if($query->num_rows() == 0)
		{
			$this->db->from('persona');
	    	// $this->db->where('ci', $datos);
	    	$query = $this->db->get();
			return $query->num_rows();
		} else
		{
			return $query = '100';
		}    	
    }

    public function get_consultaabonado()
    {
    	$this->db->from('abonado');
    	$query = $this->db->get();
    	return $query->num_rows();    	
    }

    public function get_consultazonificacion($datos)
    {
    	$this->db->from('zonificacion');
    	$this->db->where('id_medidor', $datos);
    	$query = $this->db->get();
    	if($query->num_rows() == 0)
		{
			$this->db->from('zonificacion');
	    	// $this->db->where('ci', $datos);
	    	$query1 = $this->db->get();
			return $query1->num_rows();
		} else
		{
			return $query1 = '100';
		}  	
    }

    public function get_consulta_ci($dato)
    {
    	// $this->db1->from('datosusuario');
    	// $this->db1->where('com_nits_numero', $dato);
    	// $query = $this->db1->get();
    	// return $query->row();    
    	$this->db->from('persona');
    	$this->db->where('ci', $dato);
    	$query = $this->db->get();
    	return $query->row();  
    }

    // public function get_consulta_id($dato)
    // {
    // 	$this->db->from('persona');
    // 	$this->db->where('ci', $dato);
    // 	$query = $this->db->get();
    // 	return $query->row();    	
    // }

    public function savemanzano($data)
	{
		$this->db->insert('manzano', $data);
		return $this->db->insert_id();
	}

	public function savemedidor($data)
	{
		$this->db->insert('medidor', $data);
		return $this->db->insert_id();
	}

	public function savepersona($data)
	{
		$this->db->insert('persona', $data);
		return $this->db->insert_id();
	}

	public function saveabonado($data)
	{
		$this->db->insert('abonado', $data);
		return $this->db->insert_id();
	}

	public function savezonificacion($data)
	{
		$this->db->insert('zonificacion', $data);
		return $this->db->insert_id();
	}

}
