<?php
Class Rep_emergencia_model extends CI_Model {
var $table = 'reclamo r';
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


	public function get_reporte($dato)
    {
              // $this->db->select('');
        $this->db->from('v_abonado');
        $this->db->where('codigousuario', $dato);
        $consult = $this->db->get();
        return $consult->row();

    }

    public function get_reporte_detalle($dato)
    {
 
    	// $this->db->select('estadoreclamo');
    	$this->db->from('col_reclamo');
    	$this->db->where('codigousuario', $dato);
    	$this->db->order_by('numero', 'desc');
    	$cons = $this->db->get();
    	// if($consulta->num_rows()>0){
			return $cons->row();
		// } else{ echo 'No existen reclamos';}
    }

    public function get_abonado($dato){
    	$this->db->select('p.nombres, p.apellidos, p.telefono, p.ci');
    	$this->db->from('abonado a');
    	$this->db->join('persona p', 'p.id_persona = a.id_persona');
    	$this->db->where('a.id_abonado', $dato);
    	$cons = $this->db->get();
    	return $cons->row(); 
    }

    public function get_datosfunc($dato){
    	$this->db->select('p.nombres, p.apellidos');
    	$this->db->from('funcionario f');
    	$this->db->join('persona p', 'p.id_persona = f.id_persona');
    	$this->db->where('f.id_funcionario', $dato);
    	$cons = $this->db->get();
    	return $cons->row();
    }

    public function get_datosDeuda($dato)
    {
 
        $this->db1->select('concepto,lectura_anterior, lectura_actual,consumo, monto_total');
        $this->db1->from('public.cob_ventas v');
        $this->db1->join('v_com_usuarios u', 'u.id=v.com_usuario_id');
        $this->db1->where('u.codigo_catastral', $dato);
        $this->db1->where('pagado', 'N');
        // $this->db1->order_by('fecha_venta', 'desc');

        $cons = $this->db1->get();
        return $cons->result();

    }
	
}
?>