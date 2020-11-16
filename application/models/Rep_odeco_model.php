<?php
Class Rep_odeco_model extends CI_Model {
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
	
    public function get_datos_ins($dato){
        $this->db->from('reclamo r');
        $this->db->join('formularioinspeccion f', 'f.id_reclamo = r.id_reclamo');
        $this->db->where('r.id_reclamo', $dato);
        $cons = $this->db->get();
        return $cons->row();
    }

    
    public function get_datos_inspec($dato){
        $this->db->select('ts.id_subreclamo');
        $this->db->from('reclamo r');
        $this->db->join('formularioinspeccion f', 'f.id_reclamo = r.id_reclamo');
        $this->db->join('tiporeclamo_subreclamo ts', 'ts.id_formularioinspeccion = f.id_formularioinspeccion');
        $this->db->where('r.id_reclamo', $dato);
        $con = $this->db->get();
         return $con->result();
    }

    public function get_datos_subtipo($dato){
        $aux = "select nombresubreclamo from subreclamo
                where id_subreclamo in (
                select ts.id_subreclamo from reclamo r
                join formularioinspeccion f on f.id_reclamo = r.id_reclamo
                join tiporeclamo_subreclamo ts on ts.id_formularioinspeccion = f.id_formularioinspeccion
                where r.id_reclamo = ".$dato.")";
        $valor = $this->db->query($aux);
        return $valor->result();
    }

    public function get_datos_detalle($dato){
        $this->db->from('formularioinspecciondos');
        $this->db->where('id_reclamo', $dato);
        $val = $this->db->get();
        return $val->row();
    }

    public function get_images($dato){
       
        $this->db->select('a.nombrearchivo');
        $this->db->from('formularioinspeccion_archivo f');
        $this->db->join('archivo a', 'a.id_archivo = f.id_archivo');
        $this->db->join('formularioinspeccion fo', 'fo.id_formularioinspeccion = f.id_formularioinspeccion');
        $this->db->where('fo.id_reclamo', $dato);
        $con = $this->db->get();
        return $con->result();
    }

    public function get_respuesta($dato){
        $this->db->from('conclusion');
        $this->db->where('id_reclamo', $dato);
        $con = $this->db->get();
        return $con->row();
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
        return $cons->result();

    }
}
?>