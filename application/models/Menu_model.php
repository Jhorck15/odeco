<?php
class Menu_model extends CI_Model {
  public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }

    public function getMenu(){
        $this->db->from('menu');
       $consulta1=$this->db->get();     
        if ($consulta1->num_rows() > 0){
           return $consulta1->result();
        }
    }
     public function getsubMenu(){
        $this->db->from('submenu');
       $consulta2=$this->db->get();
       if ($consulta2->num_rows() > 0){
            return $consulta2->result();
        }
    }
}
