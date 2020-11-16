<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Rep_reclamo extends CI_Controller {
 

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pdf');
        $this->load->model('rep_reclamo_model');
        // $this->load->model('Eso_model');

    }
    // public function prrr(){
    //     $data = $this->rep_reclamo_model->get_reporte($cod_reclamo);
    //     // print_r($data);
    // }

    var $datos;

    public function con_salto($cod_reclamo){

        $id_deuda = $this->rep_reclamo_model->get_deudas($cod_reclamo);        
        $url = 'http://localhost/poseidon/cob_ventas/adeudadas/'.$id_deuda->id.'.json';

      if($id_deuda != null){
            $data = curl_init();
            
            curl_setopt($data, CURLOPT_URL,'http://localhost/poseidon/cob-ventas/adeudadas/'.$id_deuda->id.'.json'); 
            curl_setopt($data, CURLOPT_HEADER, 0);
            curl_setopt($data, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
            curl_setopt($data, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($data);
            // var_dump($data);
            
            curl_close($data);
            echo json_decode($data);
        } else {
            alert('No se encontro el usuario');
        }    

    }
    public function prueba($cod_reclamo){
       $reporte = $this->rep_reclamo_model->get_reporte_detalle($cod_reclamo);
        $data = $this->rep_reclamo_model->get_reporte($cod_reclamo);
        $dato_d = $this->rep_reclamo_model->get_datosDeuda($cod_reclamo);
        print_r($dato_d);
       
        // get_datosDeuda

    }
    
    public function reporte($cod_reclamo)
    {
        // Se carga el modelo alumno
        // $this->load->model('alumno_modelo');
        // Se carga la libreria fpdf
        $fecha_anio = date("Y",strtotime('now'));
        $data['vista'] = 'rep_odeco';   
        $this->load->view($data['vista'],$data);
        $data = $this->rep_reclamo_model->get_reporte($cod_reclamo);
        $reporte = $this->rep_reclamo_model->get_reporte_detalle($cod_reclamo);
        $datoabonado = $reporte->id_abonado;
        $id_abonado = $this->rep_reclamo_model->get_abonado($datoabonado);
        $dato = $reporte->id_funcionario;
        $id_func = $this->rep_reclamo_model->get_datosfunc($dato);
        $dato_d = $this->rep_reclamo_model->get_datosDeuda($cod_reclamo);
        $fecha_reclamo = date("d-m-Y H:i:s",strtotime($reporte->fechareclamo));
        $fecha_respuesta = date("d-m-Y H:i:s",strtotime($reporte->fecharespuesta)); 
        // $datos = $this->con_salto($cod_reclamo);
        // $id_deuda = $this->rep_reclamo_model->get_deudas($cod_reclamo);        
        // $url = 'http://localhost/poseidon/cob_ventas/adeudadas/'.$id_deuda->id.'.json';
        // print_r($datos);

      
         

        // $name = "test";
        // $fields = array(
        //         'name'=>urlencode($name)
        // );

        // $fields_string = "";
        // foreach($fields as $key=>$value) {
        //     $fields_string .= $key.'='.$value.'&';
        // }
        // rtrim($fields_string,'&');

    // //open connection
    //     $ch = curl_init();

    // //set the url, number of POST vars, POST data
    //     curl_setopt($ch,CURLOPT_URL, 'http://localhost/poseidon/cob_ventas/adeudadas/'.$id_deuda->id.'.json');
    //     // curl_setopt($ch,CURLOPT_POST,count($fields));
    //     curl_setopt($ch, CURLOPT_HEADER, 0);
    //     curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
    //     // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    //     // curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // //execute post
    //     $result = curl_exec($ch);
    //      var_dump($result);
    //     // print_r($result);
    // //close connection
    //     curl_close($ch);       

        $w = array(35,15,15,15);
        $c = array('MES', 'L. ANTERIOR', 'L. ACTUAL', 'CONSUMO');

        // print_r($data);
        
     
        // Se obtienen los alumnos de la base de datos
        // $alumnos = $this->alumno_modelo->obtenerListaAlumnos();
     
        // Creacion del PDF
     
        /*
         * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
         * heredó todos las variables y métodos de fpdf

         */
        ob_start();
        // require('pdf.php');
        $this->pdf = new Pdf('letter');
        
        $this->pdf->AddPage();
        
        $this->pdf->AliasNbPages();
     
        /* Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */
        $this->pdf->SetTitle("ELAPAS - Reclamo");
        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetRightMargin(15);
        $this->pdf->SetFillColor(200,200,200);
     
        // Se define el formato de fuente: Arial, negritas, tamaño 9
        $this->pdf->SetFont('Arial', 'B',8);
        /*
         * TITULOS DE COLUMNAS
         *
         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
         */
        /*  Bloque izquierdo*/
        $this->pdf->setXY(10,27);
        $this->pdf->SetFillColor(228, 238, 240);
        $this->pdf->Cell(70,50,'',1,0,'C'); //usuario
        // $this->pdf->SetFont('Arial', 'B',8);
        $this->pdf->setXY(10,27);
        $this->pdf->Cell(20,7,'USUARIO',0,0,'C');
        // $this->pdf->setXY(10,63);
        // $this->pdf->Cell(80,34,'',1,0,'C');
        $this->pdf->setXY(10,78);
        $this->pdf->Cell(140,30,'',1,0,'C',true); //motivo
         $this->pdf->setXY(20,78);
        $this->pdf->Cell(20,7,'MOTIVO DEL RECLAMO',0,0,'C');

        /*  Bloque centro*/
        $this->pdf->setXY(80,27);
        $this->pdf->SetFillColor(228, 238, 240);
        $this->pdf->Cell(70,50,'',1,0,'C'); //solicitante
        $this->pdf->setXY(81,27);
        $this->pdf->Cell(20,7,'SOLICITANTE',0,0,'C');

        // $this->pdf->setXY(90,58);
        // $this->pdf->Cell(60,39,'',1,0,'C');

        /*  Bloque derecho*/
        // $this->pdf->SetTextColor(0,0,0);

        $this->pdf->setXY(177,47);
        $this->pdf->Cell(27,7,'TIPO DE RECLAMO',0,0,'C');
        $this->pdf->setXY(147,47);
        $this->pdf->Cell(27,7,'RECLAMO',0,0,'C');
        $this->pdf->setXY(150,27);
        $this->pdf->SetFillColor(228, 238, 240);
        $this->pdf->Cell(55,20,'',1,0,'C',true); //#reclamo
        // $this->pdf->SetTextColor(0,0,0);
        $this->pdf->setXY(155,27);
         // $this->pdf->Ln('5');
        // $this->pdf->SetFont('Arial', 'B',8);
        $this->pdf->Cell(20,7,'Nro. de Reclamo:',0,0,'C');

        // $this->pdf->Ln('2');
        $this->pdf->setXY(152,34);
        $this->pdf->Cell(25,5,utf8_decode('F. de Recepción:'),0,0,'R');
        $this->pdf->setXY(152,40);
        $this->pdf->Cell(25,5,'F. de Respuesta:',0,0,'R');
        $this->pdf->setXY(179,28);
        $this->pdf->SetFillColor(255, 255, 255);
        $this->pdf->Cell(25,5,'',0,0,'R',true);
        $this->pdf->setXY(176,34);
        $this->pdf->Cell(28,5,'',0,0,'C',true);
        $this->pdf->setXY(176,40);
        $this->pdf->Cell(28,5,'',0,0,'C',true);
        $this->pdf->setXY(92,44);
        $this->pdf->Cell(40,5,('ANTECEDENTES DE CONSUMO'),0,0,'C');
        $this->pdf->setXY(85,47);
        $this->pdf->Cell(70,5,('Mes             L. Ant   L. Act  m3   Monto'),0,0,'C');
         // Row(array('Mes','L. Anterior', 'L.Actual', 'Consumo'));
        // $this->pdf->BasicTable($c, $data);
        //
        
        // foreach($datos->lecturas as $row)
        // foreach($k as $datos)
        // // for($i=0; $iRow(array($datos->concepto, $datos->lectura_anterior, $datos->lectura_actual, $datos->monto_total)))
           
       
        // $this->pdf->setXY(150,47);
        // $this->pdf->SetFillColor(228, 238, 240);
        $this->pdf->setXY(150,47);
        $this->pdf->Cell(55,13,'',1,0,'C');
        $this->pdf->setXY(150,60);
        // $this->pdf->SetFillColor(228, 238, 240);
        
        $this->pdf->Cell(55,48,'',1,0,'C'); //funcionario
        $this->pdf->setXY(167,102);
        $this->pdf->Cell(20,7,'Responsable ATC',0,0,'C');
        
        
        $this->pdf->SetFont('Times','',9);
        
        $this->pdf->setXY(9,32);
        $this->pdf->Cell(20,7,utf8_decode('Código:'),0,0,'C');
        $this->pdf->setXY(23,32);
        $this->pdf->Cell(20,7,$data->codigousuario,0,0,'C');
        $this->pdf->setXY(10,38);
        $this->pdf->Cell(20,7,'Nombre:',0,0,'C');
        $this->pdf->setXY(45,38);
        $this->pdf->Cell(20,7,'Num. Medidor:',0,0,'C');
        $this->pdf->setXY(16,43);
        $this->pdf->Cell(45,7,utf8_decode($data->nombres).' '.utf8_decode($data->apellidos),0,0,'L');
        $this->pdf->setXY(66,38);
        $this->pdf->Cell(45,7,utf8_decode($data->id_medidor),0,0,'L');
        $this->pdf->setXY(11,50);
        $this->pdf->Cell(20,7,utf8_decode('Dirección:'),0,0,'C');
        $this->pdf->setXY(16,56);
        $this->pdf->MultiCell(60,6,utf8_decode($data->direccion),0,'L');
        $this->pdf->setXY(42,32);
        $this->pdf->Cell(20,7,utf8_decode('Categoría:'),0,0,'C'); 
        $this->pdf->setXY(60,32);
        $this->pdf->Cell(19,7,utf8_decode($data->detallecategoria),0,0,'R');
        $this->pdf->setXY(185,28);
        $this->pdf->Cell(10,5,$reporte->numero.'/'.$fecha_anio,0,0,'C');
        $this->pdf->setXY(175,34);
        $this->pdf->Cell(30,5,$fecha_reclamo,0,0,'C');
        $this->pdf->setXY(175,40);
        $this->pdf->Cell(30,5,$fecha_respuesta,0,0,'C');
        $this->pdf->setXY(150,53);
        $this->pdf->Cell(20,5,utf8_decode($reporte->nombreclase),0,0,'C');
        $this->pdf->setXY(175,53);
        $this->pdf->Cell(30,5,utf8_decode($reporte->nombretiporeclamo),0,0,'C');

        $this->pdf->setXY(13,83);
        $this->pdf->MultiCell(125,4,utf8_decode($reporte->motivo),0,'L',false);

        $this->pdf->setXY(155,98);
        $this->pdf->Cell(45,7,utf8_decode($id_func->nombres).' '.utf8_decode($id_func->apellidos),0,0,'C');

        $this->pdf->setXY(95,32);
        $this->pdf->Cell(15,7,utf8_decode($reporte->nombres.' '.$reporte->apellidos),0,0,'L');
        $this->pdf->setXY(98,39);
        $this->pdf->Cell(15,7,$reporte->ci,0,0,'L');
        $this->pdf->setXY(117,39);
        $this->pdf->Cell(15,7,$reporte->telefono,0,0,'L');
        $this->pdf->setXY(136,39);
        $this->pdf->Cell(15,7,$reporte->celular,0,0,'L');
        // $this->pdf->setXY(82,52);
         $x = 82;
        $y = 50;
        $this->pdf->setXY($x, $y);
        foreach ($dato_d as $row) 
        {   
            $num = count(explode(' ', $row->concepto));
            $dat_consumo = explode(' ', $row->concepto);       
            // print_r($dat_consumo);
            $this->pdf->Cell(28,4,$dat_consumo[$num - 1],0, 0, 'L');
             $this->pdf->Cell(9,4,$row->lectura_anterior,0, 0,'C');
              $this->pdf->Cell(9,4,$row->lectura_actual,0, 0,'C');
            $this->pdf->Cell(8,4,$row->consumo,0, 0,'C');
            $this->pdf->Cell(13,4,$row->monto_total,0, 0,'C');
            $this->pdf->Ln();
            $y = $y + 4;
            $this->pdf->setXY($x, $y);
        }
        $this->pdf->setXY(10,105);
        $this->pdf->Cell(195,11,utf8_decode('La empresa tiene 15 días hábiles a partir del reclamo para resolver y tomar decisión sobre el reclamo, en caso de servicios 3 días hábiles. Debiendo'),0,'C', false);
        $this->pdf->setXY(20,109);
        $this->pdf->Cell(195,11,utf8_decode('el Usuario volver a la oficina de plataforma de atención a ser notificado si el reclamo es PROCEDENTE O IMPROCEDENTE.'),0,'C', false);

        // $this->pdf->setXY(100,55);
        // $this->pdf->Cell(15,5,utf8_decode($reporte->fecharespuesta),0,0,'C');

        $this->pdf->setXY(81,32);
        $this->pdf->Cell(15,7,'Persona:',0,0,'L'); 
        $this->pdf->setXY(81,39);
        $this->pdf->Cell(20,7,'C. Identidad:',0,0,'L');
        $this->pdf->setXY(110,39);
        $this->pdf->Cell(10,7,utf8_decode('Telf.:'),0,0,'L');
        $this->pdf->setXY(129,39);
        $this->pdf->Cell(10,7,'Cel.:',0,0,'C');
        
        $this->pdf->Output('Reclamo'.$reporte->codigousuario.$reporte->fechareclamo.'.pdf', 'I');
        ob_end_flush();


      }
      // , $fill=false, $link='', $scale=false, $force=true
   
}
