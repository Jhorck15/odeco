<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Autenticacion_model extends CI_Model {

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {
        
        parent::__construct();
        $this->load->database();
        
    }
    
    /**
     * create_user function.
     * 
     * @access public
     * @param mixed $username
     * @param mixed $email
     * @param mixed $password
     * @return bool true on success, false on failure
     */
    public function create_user($username, $email, $password) {
        
        $data = array(
            'nombre'    => 'nombreprueba',
            'nombre_usuario'   => $username,
            'email'      => $email,
            'contrasenia'   => $this->hash_password($password),
            'creacion' => date('Y-m-j H:i:s'),
        );
        
        return $this->db->insert('usuario', $data);
        
    }
    
    /**
     * resolve_user_login function.
     * 
     * @access public
     * @param mixed $username
     * @param mixed $password
     * @return bool true on success, false on failure
     */
    public function resolve_user_login($username, $password) {
        
        $this->db->select('contrasenia');
        $this->db->from('cuenta');
        $this->db->where('usuario', $username);
        $hash = $this->db->get()->row('contrasenia');
        
        return $this->verify_password_hash($password, $hash);
        
    }
    
    /**
     * get_user_id_from_username function.
     * 
     * @access public
     * @param mixed $username
     * @return int the user id
     */
    public function get_user_id_from_username($username) {
        
        $this->db->select('id_cuenta');
        $this->db->from('cuenta');
        $this->db->where('usuario', $username);

        return $this->db->get()->row('id_cuenta');
        
    }
    
    /**
     * get_user function.
     * 
     * @access public
     * @param mixed $user_id
     * @return object the user object
     */
    public function get_user($user_id) {
        
        $this->db->from('cuenta');
        $this->db->where('id_cuenta', $user_id);
        return $this->db->get()->row();
        
    }

    /**
    mio--> obtiene al funcionario
    **/
    public function get_funcionario($idusuario){
        $this->db->select('id_funcionario, p.nombres, p.apellidos, detallecargo, nombrerol, usuario');
        $this->db->from('funcionario f');
        $this->db->join('persona p', 'f.id_persona = p.id_persona');
        $this->db->join('cargo c','c.id_cargo = f.id_cargo');
        $this->db->join('rol r',  'f.id_rol = r.id_rol');
        $this->db->join('cuenta cu', 'f.id_cuenta = cu.id_cuenta');
        $this->db->where('cu.id_cuenta',$idusuario);
        $consulta = $this->db->get();
        
        return $consulta->row();
    }
    
    /**
     * hash_password function.
     * 
     * @access private
     * @param mixed $password
     * @return string|bool could be a string on success, or bool false on failure
     */
    private function hash_password($password) {
        
        return password_hash($password, PASSWORD_BCRYPT);
        
    }
    
    /**
     * verify_password_hash function.
     * 
     * @access private
     * @param mixed $password
     * @param mixed $hash
     * @return bool
     */
    private function verify_password_hash($password, $hash) {
        
        return password_verify($password, $hash);
        
    }
    
}
