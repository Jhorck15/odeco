<?php
class Menu_usuarios extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_usuarios_model');
    }

    public function salida($data) {
        $this->load->view('plantilla/header');
        $this->load->view($data['vista'],$data);
        $this->load->view('plantilla/footer');
    }

    public function asignacion()
    {
        $data['vista'] = 'menu_usuarios_view';
        $this->salida($data);
    }
    
    public function funcionario()
    {
        $funcionario = $this->Menu_usuarios_model->get_funcionario();
        echo json_encode($funcionario);
    }

    public function asignacionmenu()
    {
        $id_funcionario = $this->input->post('id_funcionario');
        
        $datos = $this->Menu_usuarios_model->get_menu();
        // print_r($datos);
        $num   = count($datos);
        // $cad ="<form name='form' method='POST' action='".base_url()."Menu_Opciones/guardar'>";
        $cad = "<input type='hidden' name='id_funcionario' value='$id_funcionario'>";
        $cad .= "<div class='form-group'>";
        $i = 1;
        foreach($datos as $d){
            $principal = $d->principal;
            $id_menu = $d->id_menu;
            $nombre  = $d->nombremenu;

            $item = $this->Menu_usuarios_model->get_menu_funcionario($id_menu,$id_funcionario);
            // print_r($item);
            if($item>0){
                $cad .= "<label><input type='checkbox' class='switchery' name='id_menu[]' id='id_menu".$i."' value='$id_menu' checked> $principal - $nombre</label><br>";
            }else{
                $cad .= "<label><input type='checkbox' class='switchery' name='id_menu[]' id='id_menu".$i."' value='$id_menu'> $principal - $nombre</label><br>";
            }
            $i++;
            
        }
        $cad .= "</div>";
        $cad .= "   <div class='row'>
                        <div class='text-center'>
                            <button type='submit' id='btnSavemenu'  class='btn bg-success-800'>Guardar<i class='icon-arrow-right14 position-right'></i></button>
                        </div>
                    </div>
        ";

        echo $cad;
    }
    public function savemenu(){
        $id_funcionario = $this->input->post('id_funcionario');
        $this->Menu_usuarios_model->delete_menu_usuario($id_funcionario);
        $menu = $_POST['id_menu'];
        if ($menu != null) {
            foreach($_POST['id_menu'] as $id_menu) {
                $datos = array('id_menu'=>$id_menu,'id_funcionario'=>$id_funcionario);
                //echo  $id_menu."</br>";
                $this->Menu_usuarios_model->insertar_menu_usuario($datos); 
            }
            // print_r('hola');
        }
    
        echo json_encode(array('status' => TRUE));
    }
}