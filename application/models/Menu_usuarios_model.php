<?php

class Menu_usuarios_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_funcionario()
    {
        $this->db->select('id_funcionario, p.nombres, p.apellidos, detallecargo, nombrerol, usuario');
        $this->db->from('funcionario f');
        $this->db->join('persona p', 'f.id_persona = p.id_persona');
        $this->db->join('cargo c','c.id_cargo = f.id_cargo');
        $this->db->join('rol r',  'f.id_rol = r.id_rol');
        $this->db->join('cuenta cu', 'f.id_cuenta = cu.id_cuenta');
        $consulta = $this->db->get();
        
        return $consulta->result();
    }

    public function get_menu(){
        $sql = "SELECT p.nombremenu as principal,m.id_menu,m.nombremenu,m.enlace,m.icono,m.padre
                  FROM menu m,menu p
                 WHERE m.padre = p.id_menu
                 order by id_menu";
        $query = $this->db->query($sql);
        return $query->result();       
    }
    public function get_menu_funcionario($id_menu,$id_persona_cargo){
        $this->db->from('funcionario_menu');
        $this->db->where('id_menu',$id_menu);
        $this->db->where('id_funcionario',$id_persona_cargo);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function delete_menu_usuario($id_persona_cargo){
        $this->db->where('id_funcionario',$id_persona_cargo);
        $this->db->delete('funcionario_menu');
    }
    public function insertar_menu_usuario($datos){
        $this->db->insert('funcionario_menu',$datos);
    }

}