<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Rep_odeco extends CI_Controller {
 

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pdf');
        $this->load->model('Rep_odeco_model', 'rep_odeco_model');
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
        // $inspec2 = $this->rep_odeco_model->get_datos_inspec($cod_reclamo);
        //  $img = $this->rep_odeco_model->get_images($cod_reclamo);
         $con = $this->rep_odeco_model->get_respuesta(316);   
        print_r($con);
       
        

    }
    
    public function reporte($cod_reclamo)
    {
        // Se carga el modelo alumno
        // $this->load->model('alumno_modelo');
        // Se carga la libreria fpdf
        $fechaactual = date("d-m-Y H:i:s",strtotime('now'));
        $fecha_anio = date("Y",strtotime('now'));
        $data['vista'] = 'rep_odeco';   
        $this->load->view($data['vista'],$data);
        $data = $this->rep_odeco_model->get_reporte($cod_reclamo);
        $reporte = $this->rep_odeco_model->get_reporte_detalle($cod_reclamo);
        $datoabonado = $reporte->id_abonado;
        $id_abonado = $this->rep_odeco_model->get_abonado($datoabonado);
        $dato = $reporte->id_funcionario;
        $id_func = $this->rep_odeco_model->get_datosfunc($dato);
        $inspec = $this->rep_odeco_model->get_datos_ins($reporte->id_reclamo);
        $inspec2 = $this->rep_odeco_model->get_datos_inspec($reporte->id_reclamo);
        $valor = $this->rep_odeco_model->get_datos_subtipo($reporte->id_reclamo);
        $val = $this->rep_odeco_model->get_datos_detalle($reporte->id_reclamo); 
        $img = $this->rep_odeco_model->get_images($reporte->id_reclamo);
        $dato_d = $this->rep_odeco_model->get_datosDeuda($cod_reclamo);
        $con = $this->rep_odeco_model->get_respuesta($reporte->id_reclamo);   
        $Fecha_1 = date("d-m-Y H:i:s",strtotime($con->fechaconclusion)); 
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
        $this->pdf = new Pdf('office');
        
        $this->pdf->AddPage();
        
        $this->pdf->AliasNbPages();
     
        /* Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */
        $this->pdf->SetTitle("ELAPAS - ODECO");
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

        $this->pdf->Cell(70,40,'',1,0,'C');
        $this->pdf->setXY(10,224);
        $this->pdf->Cell(100,38,'',1,0,'L',true); //conclusion
        $this->pdf->setXY(10,143);
        $this->pdf->Cell(195,25,'',1,0,'L',true); //informe inspeccion
        // $this->pdf->SetFont('Arial', 'B',8);
        $this->pdf->setXY(10,27);
        $this->pdf->Cell(20,7,'USUARIO',0,0,'C');
        $this->pdf->setXY(10,93);
        $this->pdf->Cell(65,6,utf8_decode('ANÁLISIS CONSUMO ACTUAL'),1,0,'C');
        $this->pdf->setXY(75,93);
        $this->pdf->Cell(65,6,'GRIFOS CERRADOS',1,0,'C');
        $this->pdf->setXY(140,93);
        $this->pdf->Cell(65,6,'LLAVE DE PASO CERRADO',1,0,'C');
        $this->pdf->setXY(10,108);
        $this->pdf->Cell(100,35,'',1,0,'L');
        $this->pdf->setXY(111,108);
        $this->pdf->Cell(94,35,'',1,0,'L');
        $this->pdf->setXY(111,125);
        $this->pdf->Cell(94,8,'',1,0,'L');
        $this->pdf->setXY(10,172);
        $this->pdf->Cell(65,48,'',1,0,'L');//foto izquierda
        $this->pdf->setXY(75,172);
        $this->pdf->Cell(65,48,'',1,0,'L'); // foto centro
        $this->pdf->setXY(140,172);
        $this->pdf->Cell(65,48,'',1,0,'L'); //foto derecha
        $this->pdf->setXY(110,224);
        $this->pdf->Cell(95,38,'',1,0,'L'); //firmas
        $this->pdf->setXY(50,107);
        $this->pdf->Cell(20,7,utf8_decode('INSPECCIÓN'),0,0,'C');
        $this->pdf->setXY(147,107);
        $this->pdf->Cell(20,7,utf8_decode('DIAGNOSTICO'),0,0,'C');
        $this->pdf->setXY(111,111);
        $this->pdf->Cell(20,7,utf8_decode('Detalle:'),0,0,'L');
        $this->pdf->setXY(111,123);
        $this->pdf->Cell(20,7,utf8_decode('Se encuentra:'),0,0,'L');
        $this->pdf->setXY(151,123);
        $this->pdf->Cell(20,7,utf8_decode('Se recomienda:'),0,0,'L');
        $this->pdf->setXY(111,132);
        $this->pdf->Cell(20,7,utf8_decode('Persona que atendio:'),0,0,'L');
        
        $this->pdf->setXY(11,167);
        $this->pdf->Cell(20,7,utf8_decode('FOTOGRAFÍA 1:'),0,0,'L');
        $this->pdf->setXY(76,167);
        $this->pdf->Cell(20,7,utf8_decode('FOTOGRAFÍA 2:'),0,0,'L');
        $this->pdf->setXY(141,167);
        $this->pdf->Cell(20,7,utf8_decode('FOTOGRAFÍA 3:'),0,0,'L');
        
        $this->pdf->setXY(49,219);
        $this->pdf->Cell(20,7,utf8_decode('CONCLUSIÓN'),0,0,'L');
        $this->pdf->setXY(135,219);
        $this->pdf->Cell(20,7,utf8_decode('CONSTANCIA DE RECEPCIÓN'),0,0,'L');
        // $this->pdf->setXY(16,218);
        // $this->pdf->Cell(20,7,utf8_decode('PROCEDENTE:'),0,0,'L');
        $this->pdf->setXY(15,234);
        $this->pdf->Cell(20,7,utf8_decode('RESPUESTA:'),0,0,'L');
        $this->pdf->setXY(51,253);
        $this->pdf->Cell(30,7,utf8_decode('Fecha de respuesta:'),0,0,'L');
        $this->pdf->setXY(161,224);
        $this->pdf->Cell(40,4,utf8_decode('Fecha:'),0,'L');
        $this->pdf->setXY(130,253);
        $this->pdf->Cell(20,7,'RESPONSABLE ATC',0,0,'C');
        $this->pdf->setXY(170,253);
        $this->pdf->Cell(20,7,'SOLICITANTE',0,0,'C');
        $this->pdf->setXY(130,256);
        $this->pdf->Cell(20,7,'FIRMA',0,0,'C');
        $this->pdf->setXY(170,256);
        $this->pdf->Cell(20,7,'FIRMA',0,0,'C');

        // $this->pdf->setXY(10,63);
        // $this->pdf->Cell(80,34,'',1,0,'C');
        $this->pdf->setXY(10,68);
        $this->pdf->Cell(140,24,'',1,0,'C',true);
        $this->pdf->setXY(20,66);
        $this->pdf->Cell(20,7,'MOTIVO DEL RECLAMO',0,0,'C');
        $this->pdf->setXY(16,228);
        $this->pdf->Cell(20,7,'PROCEDENTE:',0,0,'C');
        $this->pdf->setXY(11,142);
        $this->pdf->Cell(20,7,utf8_decode('DESCRIPCIÓN:'),0,0,'L');
        $this->pdf->setXY(150,27);
        $this->pdf->SetFillColor(228, 238, 240);
        $this->pdf->Cell(55,20,'',1,0,'C',true);

        /*  Bloque centro*/
        $this->pdf->setXY(80,27);
        $this->pdf->SetFillColor(228, 238, 240);
        $this->pdf->Cell(70,40,'',1,0,'C');
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
        
        // $this->pdf->SetTextColor(0,0,0);
        $this->pdf->setXY(155,27);
         // $this->pdf->Ln('5');
        // $this->pdf->SetFont('Arial', 'B',8);
        $this->pdf->Cell(20,7,'Nro. de Reclamo:',0,0,'C');

        // $this->pdf->Ln('2');
        $this->pdf->setXY(152,34);
        $this->pdf->Cell(25,5,utf8_decode('F. de Recepción:'),0,0,'R');
        $this->pdf->setXY(152,40);
        $this->pdf->Cell(25,5,utf8_decode('F. de Respuesta:'),0,0,'R');
        $this->pdf->setXY(35,268);
        $this->pdf->Cell(45,7,utf8_decode('Firma Responsable'),0,0,'R');
        $this->pdf->setXY(179,28);
        $this->pdf->SetFillColor(255, 255, 255);
        $this->pdf->Cell(25,5,'',0,0,'R',true);
        $this->pdf->setXY(176,34);
        $this->pdf->Cell(28,5,'',0,0,'C',true);
        $this->pdf->setXY(176,40);
        $this->pdf->Cell(28,5,'',0,0,'C',true);
        $this->pdf->setXY(92,44);
        $this->pdf->Cell(40,5,utf8_decode('ANTECEDENTES DE CONSUMO'),0,0,'C');
        $this->pdf->setXY(85,47);
        $this->pdf->Cell(70,5,utf8_decode('Mes                           Consumo      Monto'),0,0,'C');
         // Row(array('Mes','L. Anterior', 'L.Actual', 'Consumo'));
        // $this->pdf->BasicTable($c, $data);
        //
        
        // foreach($datos->lecturas as $row)
        // foreach($k as $datos)
        // // for($i=0; $iRow(array($datos->concepto, $datos->lectura_anterior, $datos->lectura_actual, $datos->monto_total)))
        //     // foreach ($row as $key) 
        //     {              
        //     $this->pdf->Cell($w[0],5,$row['concepto'],'LR');
        //     $this->pdf->Cell($w[1],5,$row['lectura_anterior'],'LR');
        //     $this->pdf->Cell($w[2],5,$row['lectura_actual'],'LR',0,'R');
        //     $this->pdf->Cell($w[3],5,$row['monto_total'],'LR',0,'R');
        //     $this->pdf->Ln();
        //     }

    
       
        // $this->pdf->setXY(150,47);
        // $this->pdf->SetFillColor(228, 238, 240);
        $this->pdf->setXY(150,47);
        $this->pdf->Cell(55,13,'',1,0,'C');
        $this->pdf->setXY(150,60);
        // $this->pdf->SetFillColor(228, 238, 240);
        
        $this->pdf->Cell(55,32,'',1,0,'C');
        $this->pdf->setXY(167,86);
        $this->pdf->Cell(20,7,'Responsable ATC',0,0,'C');
        
        
        $this->pdf->SetFont('Times','',9);
        
        $this->pdf->setXY(9,32);
        $this->pdf->Cell(20,7,utf8_decode('Código:'),0,0,'C');
        $this->pdf->setXY(23,32);
        $this->pdf->Cell(20,7,utf8_decode($data->codigousuario),0,0,'C');
        $this->pdf->setXY(10,38);
        $this->pdf->Cell(20,7,utf8_decode('Nombre:'),0,0,'C');
        $this->pdf->setXY(16,43);
        $this->pdf->Cell(45,7,utf8_decode($data->nombres),0,0,'L');
        $this->pdf->setXY(11,50);
        $this->pdf->Cell(20,7,utf8_decode('Dirección:'),0,0,'C');
        $this->pdf->setXY(16,56);
        $this->pdf->MultiCell(60,6,utf8_decode($data->direccion),0,'L');
        $this->pdf->setXY(42,32);
        $this->pdf->Cell(20,7,utf8_decode('Categoría:'),0,0,'C'); 
        $this->pdf->setXY(60,32);
        $this->pdf->Cell(19,7,utf8_decode($data->detallecategoria),0,0,'R');
        $this->pdf->setXY(185,28);
        $this->pdf->Cell(10,5,utf8_decode($reporte->numero.'/'.$fecha_anio),0,0,'C');
        $this->pdf->setXY(175,34);
        $this->pdf->Cell(30,5,utf8_decode($fecha_reclamo),0,0,'C');
        $this->pdf->setXY(175,40);
        $this->pdf->Cell(30,5,utf8_decode($fecha_respuesta),0,0,'C');
        $this->pdf->setXY(150,53);
        $this->pdf->Cell(20,5,utf8_decode($reporte->nombreclase),0,0,'C');
        $this->pdf->setXY(175,53);
        $this->pdf->Cell(30,5,utf8_decode($reporte->nombretiporeclamo),0,0,'C');

        $this->pdf->setXY(11,71);
        $this->pdf->MultiCell(139,3,utf8_decode($reporte->motivo),0,'L',false);

        $this->pdf->setXY(155,82);
        $this->pdf->Cell(45,7,utf8_decode($id_func->nombres).' '.utf8_decode($id_func->apellidos),0,0,'C');

        $x = 82;
        $y = 50;
        $this->pdf->setXY($x, $y);
        foreach ($dato_d as $row) 
        {              
            $this->pdf->Cell(40,4,$row->concepto,0, 0, 'L');
            $this->pdf->Cell(12,4,$row->consumo,0, 0,'C');
            $this->pdf->Cell(15,4,$row->monto_total,0, 0,'C');
            $this->pdf->Ln();
            $y = $y + 4;
            $this->pdf->setXY($x, $y);
        }

        $this->pdf->setXY(95,32);
        $this->pdf->Cell(15,7,utf8_decode($reporte->nombres.' '.$reporte->apellidos),0,0,'L');
        $this->pdf->setXY(100,39);
        $this->pdf->Cell(15,7,$reporte->ci,0,0,'L');
        $this->pdf->setXY(133,39);
        $this->pdf->Cell(15,7,$reporte->telefono,0,0,'L');
        $this->pdf->setXY(10,89);
        $this->pdf->setXY(10,100);
        $this->pdf->Cell(65,7,utf8_decode('Lectura:                      Consumo:'),1,0,'L');
        $this->pdf->setXY(75,100);
        $this->pdf->Cell(65,7,'Medidor girando:',1,0,'L');
        $this->pdf->setXY(140,100);
        $this->pdf->Cell(65,7,'Medidor girando:     ',1,0,'L');
        $this->pdf->setXY(10,113);
        $this->pdf->Cell(45,7,utf8_decode('Tamaño vivienda:.............. '),0,0,'L');
        $this->pdf->setXY(33,113);
        $this->pdf->Cell(20,7,utf8_decode($inspec->tamaniovivienda),0,0,'L');
        $this->pdf->setXY(10,119);
        $this->pdf->Cell(45,7,utf8_decode('Número de habitantes:............... '),0,0,'R');
        $this->pdf->setXY(40,119);
        $this->pdf->Cell(10,7,utf8_decode($inspec->numerohabitantes),0,0,'R');
        $this->pdf->setXY(10,124);
        $this->pdf->Cell(45,7,utf8_decode('Número de baños:............... '),0,0,'R');
        $this->pdf->setXY(40,124);
        $this->pdf->Cell(10,7,utf8_decode($inspec->numerohabitantes),0,0,'R');
        $this->pdf->setXY(10,129);
        $this->pdf->Cell(45,7,utf8_decode('Calibrado:............... '),0,0,'R');
        $this->pdf->setXY(40,129);
        $this->pdf->Cell(10,7,utf8_decode($inspec->calibrado),0,0,'R');
        $this->pdf->setXY(10,134);
        $this->pdf->Cell(45,7,utf8_decode('Ubicación de medidor:............... '),0,0,'R');
        $this->pdf->setXY(44,134);
        $this->pdf->Cell(10,7,utf8_decode($inspec->ubicacionmedidor),0,0,'R');

        $this->pdf->setXY(55,113);
        $this->pdf->Cell(45,7,utf8_decode('Estado tanques baño:............... '),0,0,'R');
        $this->pdf->setXY(85,113);
        $this->pdf->Cell(25,7,utf8_decode($inspec->estadotanquebanio),0,0,'L');
        $this->pdf->setXY(60,119);
        $this->pdf->Cell(45,7,utf8_decode('Presión de agua en la zona:............... '),0,0,'R');
        $this->pdf->setXY(90,119);
        $this->pdf->Cell(15,7,utf8_decode($inspec->presionaguazona),0,0,'C');
        $this->pdf->setXY(60,124);
        $this->pdf->Cell(45,7,utf8_decode('Cuenta con piscina:............... '),0,0,'R');
        $this->pdf->setXY(92,124);
        $this->pdf->Cell(10,7,utf8_decode($inspec->piscina),0,0,'C');
        $this->pdf->setXY(60,129);
        $this->pdf->Cell(45,7,utf8_decode('Filtración:............... '),0,0,'R');
        $this->pdf->setXY(92,129);
        $this->pdf->Cell(10,7,utf8_decode($inspec->filtracioninterna),0,0,'C');
        $this->pdf->setXY(60,134);
        $this->pdf->Cell(45,7,utf8_decode('Marca de medidor:............... '),0,0,'R');
        $this->pdf->setXY(94,134);
        $this->pdf->Cell(10,7,utf8_decode($inspec->marcamedidor),0,0,'C');

        // $this->pdf->setXY(100,55);
        // $this->pdf->Cell(15,5,utf8_decode($reporte->fecharespuesta),0,0,'C');
        $x = 132;
        $y = 112;
        $this->pdf->setXY($x, $y);
        foreach ($valor as $row) 
        {              
            $this->pdf->Image('assets/images/ela/check.png',$x-2,$y,3,0);
            $this->pdf->Cell(60,5,utf8_decode($row->nombresubreclamo));
            $this->pdf->Ln();
            $y = $y + 4;
            $this->pdf->setXY($x, $y);
        }
        $this->pdf->Image('assets/images/ela/check.png',119,128,3,0);
        $this->pdf->Image('assets/images/ela/check.png',162,128,3,0);
        $this->pdf->setXY(121,127);
        $this->pdf->Cell(40,7,utf8_decode($val->inspeccion),0,0,'L');
        $this->pdf->setXY(164,127);
        $this->pdf->Cell(40,7,utf8_decode($val->recomendacion),0,0,'L');
        $this->pdf->setXY(121,136);
        $this->pdf->Cell(60,7,utf8_decode($val->nombrespersona),0,0,'L');
        $this->pdf->setXY(13,146);
        $this->pdf->MultiCell(190,4,utf8_decode($inspec->descripcioninformeinspeccion),0,'L',false);
        $x = 20;
        $y = 173;
        foreach ($img as $row) 
        {              
            $this->pdf->Image('upload/'.$row->nombrearchivo,$x,$y,45,45);
            $x = $x + 65;
            $this->pdf->setXY($x, $y);
        }
        
        
        $this->pdf->setXY(11,223);
        $this->pdf->Cell(20,7,utf8_decode('La conclusión del reclamo menciona:'),0,0,'L');
        $this->pdf->setXY(40,229);
        $this->pdf->Cell(50,5,utf8_decode($con->respuesta),0,0,'L');
        $this->pdf->setXY(11,240);
        $this->pdf->MultiCell(96,3,utf8_decode($con->pronunciamiento),0,'L',false);
        $this->pdf->setXY(80,254.5);
        $this->pdf->Cell(40,4,utf8_decode($Fecha_1),0,'L');
        $this->pdf->setXY(172,224);
        $this->pdf->Cell(40,4,utf8_decode($fechaactual),0,'L');
        
        $this->pdf->setXY(118,251);
        $this->pdf->Cell(45,5,utf8_decode($id_func->nombres).' '.utf8_decode($id_func->apellidos),0,0,'C');

        $this->pdf->setXY(158,251);
        $this->pdf->Cell(45,5,utf8_decode($reporte->nombres.' '.$reporte->apellidos),0,0,'C');
        
        // $this->pdf->Image('upload/imagen.jpg',20,163,40,40);
        $this->pdf->setXY(81,32);
        $this->pdf->Cell(15,7,utf8_decode('Persona:'),0,0,'L'); 
        $this->pdf->setXY(81,39);
        $this->pdf->Cell(20,7,utf8_decode('C. Identidad:'),0,0,'L');
        $this->pdf->setXY(117,39);
        $this->pdf->Cell(20,7,utf8_decode('Telefono:'),0,0,'C');
        
        $this->pdf->Output('Reclamo'.$reporte->codigousuario.$reporte->fechareclamo.'.pdf', 'I');
        ob_end_flush();


      }
      // , $fill=false, $link='', $scale=false, $force=true
   
}