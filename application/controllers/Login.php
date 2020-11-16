<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Login extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->model('Autenticacion_model');
		$this->load->model('Principal_model');
	}
	
	public function index()
	{
		$this->vistaSalida('login');
		// $this->login();
	}

	public function vistaSalida($template) {
        $this->load->view($template);
    }

    private function menu_activo($opcion) {
        $opcion1 = '';
        $opcion2 = '';
        $opcion3 = '';
        $opcion4 = '';
        $opcion5 = '';
        $opcion6 = '';
        $opcion7 = '';
        $opcion8 = '';
        $opcion9 = '';
        switch($opcion)
        {
            case 1:$opcion1='active';break;
            case 2:$opcion2='active';break;
            case 3:$opcion3='active';break;
            case 4:$opcion4='active';break;
            case 5:$opcion5='active';break;
            case 6:$opcion6='active';break;
            case 7:$opcion7='active';break;
            case 8:$opcion8='active';break;
            case 9:$opcion9='active';break;

        }
        $data = array('opcion1'=>$opcion1,
                      'opcion2'=>$opcion2,
                      'opcion3'=>$opcion3,
                      'opcion4'=>$opcion4,
                      'opcion5'=>$opcion5,
                      'opcion6'=>$opcion6,
                      'opcion7'=>$opcion7,
                      'opcion8'=>$opcion8,
                      'opcion9'=>$opcion9
                     );

        return $data;
    }

    public function login() {
		
		// create the data object
		$dato = new stdClass();
		
		// load form helper and validation library
		// $this->load->helper('form');
		// $this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
			// $this->load->view('plantilla/header');
			$this->load->view('login');
			// $this->load->view('plantilla/footer');
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->Autenticacion_model->resolve_user_login($username, $password)) {
				
				$user_id = $this->Autenticacion_model->get_user_id_from_username($username);
				$user    = $this->Autenticacion_model->get_user($user_id);
				$funcionario = $this->Autenticacion_model->get_funcionario($user_id);

				
				// /////////////////////////OPCIONES DE ACTIVACION
	   //          $i=0;
    //             $opciones['opcion0']='';
    //             $opciones['opcion1']='';
    //             $opciones['opcion2']='';
    //             $opciones['opcion3']='';
    //             $opciones['opcion4']='';
    //             $opciones['opcion5']='';
    //             $opciones['opcion6']='';
    //             $opciones['opcion7']='';
    //             $opciones['opcion8']='';
    //             $opciones['opcion9']='';
    //             $opciones['opcion10']='';
    //             $opciones['opcion11']='';
    //             $opciones['opcion12']='';
    //             $opciones['opcion13']='';
    //             $opciones['opcion14']='';
    //             $opciones['opcion15']='';
				////////////////////////

				// menu start-------------------------------------------------------
				$cadmenu = "";
	            $sqlmp = "SELECT * FROM menu 
	            		  WHERE padre=0
	            		  order by id_menu";
	            $querymp = $this->db->query($sqlmp);
	            // $id_funcionario = $funcionario->id_funcionario;
	            foreach ($querymp->result() as $row){
	                $padre = $row->id_menu;
	                $nombrep = $row->nombremenu;
	                $enlacep = $row->enlace;
	                $iconop  = $row->icono;

	                $sqlm = "SELECT m.id_menu, m.nombremenu, m.enlace, m.icono, m.padre 
							    FROM menu m, funcionario_menu mu 
							   WHERE m.id_menu = mu.id_menu 
							     AND mu.id_funcionario = $funcionario->id_funcionario
							     AND m.padre = $padre 
							     order by m.id_menu";

	                $querym = $this->db->query($sqlm);
	                $cont  = count($querym->result());
	                if($cont>0){
	                	$cadmenu .= "<li>";
                        $cadmenu .= "<a href='".$enlacep."'><i class='".$iconop."'></i> <span>".$nombrep."</span></a>";
                        $cadmenu .= "<ul>";
                        
                            foreach ($querym->result() as $r){
                                $nombre = $r->nombremenu;
                                $enlace = $r->enlace;
                                $icono  = $r->icono;
                                
                                // $cadmenu .= "<li><a href=".base_url().$enlace.">".$nombre."</a></li>";
                                $cadmenu .= "<li class='' ><a href=".base_url().$enlace."><i class=".$iconop."></i> <span>".$nombre."</span></a></li>";
                                //$cadmenu .= "<li class='".$opciones['opcion'.$i.'']."' ><a href=".base_url().$enlace."><i class=".$iconop."></i> <span>".$nombre."</span></a></li>";
                            }
                        $cadmenu .= "</ul>";
                        $cadmenu .= "</li>";
	                }

	            } 
				// menu end -------------------------------------------------------
				
				// set session user datas
				$_SESSION['user_id']      = (int)$user->id_cuenta;
				$_SESSION['username']     = (string)$user->usuario;
				$_SESSION['logged_in']    = (bool)true;
				$_SESSION['menu'] 		  = (string)$cadmenu;
				// $_SESSION['is_admin']     = (bool)$user->is_admin;
				
				// user login ok
				// $this->load->view('plantilla/header');
				// $this->load->view('principal', $dato);
				// $this->load->view('plantilla/footer');
				$this->inicio();
				
				
			} else {
				
				// login failed
				$dato->error= 'Nombre de usuario incorrecto o contraseña incorrecta.';
				
				// send error to the view
				// $data['opciones']  = $this->menu_activo(0);
				// $this->load->view('plantilla/header');
				$this->load->view('login', $dato);
				// $this->load->view('plantilla/footer');
			}
			// echo json_encode(array('status' => TRUE));
		}

	}

	public function logout() {
		
		// create the data object
		$data = new stdClass();
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			// $this->load->view('header');
			$this->load->view('login', $data);
			// $this->load->view('footer');
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('/');
			
		}
	}

	// public function lista(){
	// 	$data = $this->principal_model->getReclamo();
	// 	return $data;
	// }

	// public function listainspector(){
	// 	$data = $this->principal_model->getInspector();
	// 	return $data;
	// }

	
	public function inicio()
    {
  //   	$data['listamenu']=$this->menu_model->getmenu();
		// $data['listasubmenu']=$this->menu_model->getsubmenu();

    	$data['opciones']  = $this->menu_activo(1);
        $data['vista']   = 'principal';
        // $data['usuariocta']   = $this->principal_model->get_dato_usuario($_SESSION['user_id']);
        $datoinspeccion = $this->Principal_model->get_dato_usuario($_SESSION['user_id']);
		$idpersona = $datoinspeccion[0]['id_funcionario'];
		$_SESSION['id_persona'] = (int)$idpersona;
		$idcargo = $datoinspeccion[0]['detallecargo'];
		if ($idcargo == 'INSPECTOR'){
			$this->load->view('plantilla/header',$data);
        	$this->load->view('inspeccion',$data);
        	$this->load->view('plantilla/footer');

		} else if ($idcargo == 'ENCARGADO CATASTRO DE USUARIOS'){
					$this->load->view('plantilla/header',$data);
        			$this->load->view('encargado',$data);
        			$this->load->view('plantilla/footer');							
		} else if($idcargo == 'ENCARGADO BANCO DE MEDIDORES'){
					$this->load->view('plantilla/header',$data);
        			$this->load->view('encargado',$data);
        			$this->load->view('plantilla/footer');
		} else if($idcargo == 'ENCARGADO CORTES'){
					$this->load->view('plantilla/header',$data);
        			$this->load->view('encargado',$data);
        			$this->load->view('plantilla/footer');
        }else if($idcargo == 'INSPECTOR RED DE AGUA'){
					$this->load->view('plantilla/header',$data);
        			$this->load->view('inspeccion',$data);
        			$this->load->view('plantilla/footer');
        }else if($idcargo == 'INSPECTOR ALCANTARILLADO'){
					$this->load->view('plantilla/header',$data);
        			$this->load->view('inspeccion',$data);
        			$this->load->view('plantilla/footer');
        }else if($idcargo == 'CENTRO DE EMERGENCIA'){
					$this->load->view('plantilla/header',$data);
        			$this->load->view('centro',$data);
        			$this->load->view('plantilla/footer');
        }else if($idcargo == 'GERENTE COMERCIAL'){
					$this->load->view('plantilla/header',$data);
        			$this->load->view('seguimiento',$data);
        			$this->load->view('plantilla/footer');
        }else {
			$this->load->view('plantilla/header',$data);
        	$this->load->view($data['vista'],$data);
       		$this->load->view('plantilla/footer');
		}
        // $data['listainspector']   = $this->listainspector();
        // $this->load->view('plantilla/header',$data);
        // $this->load->view($data['vista'],$data);
        // $this->load->view('plantilla/footer');
    }
}
