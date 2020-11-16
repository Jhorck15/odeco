<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH.'third_party/fpdf/fpdf.php';
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
        // El encabezado del PDF
        public function Header(){
            // html_entity_decode("&aacute;");
            header("Content-Type: text/html; charset=iso-8859-1 ");
            // $this->CreateTextBox(utf8_decode("ATENCIÓN AL CONSUMIDOR"));
            // $temp = "\nCat".html_entity_decode("&aacute;")."logo de productos de\n".$row["nombre"]."\n";
            $this->Image('assets/images/logo_elapas.jpg',8,3,35,0);
            $this->Image('assets/images/AAPS.png',178,3,27,0);
            $this->SetFont('Arial','B',15);
            $this->Cell(30);
            $this->Cell(135,-3,utf8_decode('ODECO - ATENCIÓN AL CONSUMIDOR'),0,0,'C');
            $this->Ln('5');
            $this->SetFont('Arial','B',8);
            $this->Cell(30);
            $this->Cell(135,-3,utf8_decode('INFORMACIÓN DE CONTACTO'),0,0,'C');
            $this->Cell(30);
            $this->Ln('5');
            $this->Cell(196,-3,utf8_decode('Telefóno ODECO: 64 35396, Linea piloto: 64 61919, Int. 105 y 110'),0,0,'C');
            $this->Line(10,22,200,22);
            $this->Ln('5');
            $this->SetFont('Arial','B',9);
            $this->Cell(195,0,'REGISTRO UNICO DE RECLAMOS',0,0,'C');

            // $this->Ln(20);
       }
       // El pie del pdf
        public function Footer(){

           $this->Line(10,283,200,283);
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(180,6,utf8_decode('Si usted no está de acuerdo con la respuesta de la EPSA puede recurrir a la AAPS'),0,0,'C');
           $this->Ln('3');
            $this->Cell(180,6,utf8_decode('Teléfono Gratutito 800 10 3600 - www.aaps.gob.bo'),0,0,'C');
            $this->Ln('3');
            // $this->Cell(180,6,'www.aaps.gob.bo',0,0,'C');
            // $this->Ln('3');
           $this->Cell(0,6,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
        }

      var $tablewidths;
      var $footerset;

    public function _beginpage($orientation, $size, $rotation) {
         $this->page++;
        // Resuelve el problema de sobrescribir una página si ya existe.
         if(!isset($this->pages[$this->page])) 
            $this->pages[$this->page] = '';
          $this->state  =2;
         $this->x = $this->lMargin;
         $this->y = $this->tMargin;
         $this->FontFamily = '';

         // Compruebe el tamaño y la orientación.
         if($orientation=='')
            $orientation = $this->DefOrientation;
         else
            $orientation = strtoupper($orientation[0]);
         if($size=='')
            $size = $this->DefPageSize;
         else
            $size = $this->_getpagesize($size);
         if($orientation!=$this->CurOrientation || $size[0]!=$this->CurPageSize[0] || $size[1]!=$this->CurPageSize[1])
         {

          // Nuevo tamaño o la orientación
              if($orientation=='P')
              {
               $this->w = $size[0];
               $this->h = $size[1];
              }
              else
              {
               $this->w = $size[1];
               $this->h = $size[0];
              }
              $this->wPt = $this->w*$this->k;
              $this->hPt = $this->h*$this->k;
              $this->PageBreakTrigger = $this->h-$this->bMargin;
              $this->CurOrientation = $orientation;
              $this->CurPageSize = $size;
         }
         if($orientation!=$this->DefOrientation || $size[0]!=$this->DefPageSize[0] || $size[1]!=$this->DefPageSize[1])
          $this->PageSizes[$this->page] = array($this->wPt, $this->hPt);
    }

    
    public function morepagestable($datas, $lineheight=13) {
     // Algunas cosas para establecer y ' recuerdan '
         $l = $this->lMargin;
         $startheight = $h = $this->GetY();
         $startpage = $currpage = $maxpage = $this->page;

         // Calcular todo el ancho
         $fullwidth = 0;
         foreach($this->tablewidths AS $width) {
            $fullwidth += $width;
         }

         // Ahora vamos a empezar a escribir la tabla
          foreach($datas AS $row => $data) {
              $this->page = $currpage;

              // Escribir los bordes horizontales
              $this->Line($l,$h,$fullwidth+$l,$h);

              // Escribir el contenido y recordar la altura de la más alta columna
              foreach($data AS $col => $txt) {
                 $this->page = $currpage;
                 $this->SetXY($l,$h);
                 $this->MultiCell($this->tablewidths[$col],$lineheight,$txt);
                 $l += $this->tablewidths[$col];

                 if(!isset($tmpheight[$row.'-'.$this->page]))
                    $tmpheight[$row.'-'.$this->page] = 0;
                    if($tmpheight[$row.'-'.$this->page] < $this->GetY()) {
                        $tmpheight[$row.'-'.$this->page] = $this->GetY();
                    }
                    if($this->page > $maxpage)
                        $maxpage = $this->page;
              }

              // Obtener la altura estábamos en la última página utilizada
              $h = $tmpheight[$row.'-'.$maxpage];

              //Establecer el "puntero " al margen izquierdo
              $l = $this->lMargin;

              // Establecer el "$currpage en la ultima paginia
              $currpage = $maxpage;
         }

         // Dibujar las fronteras
         // Empezamos a añadir una línea horizontal en la última página
         $this->page = $maxpage;
         $this->Line($l,$h,$fullwidth+$l,$h);
         // Ahora empezamos en la parte superior del documento
         for($i = $startpage; $i <= $maxpage; $i++) {
              $this->page = $i;
              $l = $this->lMargin;
              $t  = ($i == $startpage) ? $startheight : $this->tMargin;
              $lh = ($i == $maxpage)   ? $h : $this->h-$this->bMargin;
              $this->Line($l,$t,$l,$lh);
              foreach($this->tablewidths AS $width) {
                 $l += $width;
                 $this->Line($l,$t,$l,$lh);
              }
          }
         // Establecerlo en la última página , si no que va a causar algunos problemas
         $this->page = $maxpage;
    }
    
  };

     function CellJ($w, $h, $txt, $border, $ln, $align, $fill, $link, $scale=false, $force=true)
        {
            //Get string width
            $str_width=$this->GetStringWidth($txt);
     
            //Calculate ratio to fit cell
            if($w==0)
                $w = $this->w-$this->rMargin-$this->x;
            $ratio = ($w-$this->cMargin*2)/$str_width;
     
            $fit = ($ratio < 1 || ($ratio > 1 && $force));
            if ($fit)
            {
                if ($scale)
                {
                    //Calculate horizontal scaling
                    $horiz_scale=$ratio*100.0;
                    //Set horizontal scaling
                    $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
                }
                else
                {
                    //Calculate character spacing in points
                    $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                    //Set character spacing
                    $this->_out(sprintf('BT %.2F Tc ET',$char_space));
                }
                //Override user alignment (since text will fill up cell)
                $align='';
            }
     
            //Pass on to Cell method
            $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);
     
            //Reset character spacing/horizontal scaling
            if ($fit)
                $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
        }
 
  // $fill=false, $link=''
        function Cell_Reclamo($w, $h, $txt, $border, $ln, $align, $fill=false,
               $link='')
        {               
            $this->CellJ($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
        }

       function MBGetStringLength($s)
        {
            if($this->CurrentFont['type']=='Type0')
            {
                $len = 0;
                $nbbytes = strlen($s);
                for ($i = 0; $i < $nbbytes; $i++)
                {
                    if (ord($s[$i])<128)
                        $len++;
                    else
                    {
                        $len++;
                        $i++;
                    }
                }
                return $len;
            }
            else
                return strlen($s);
        }
    



          // public function SetWidths($w)
          // {
          //     //Set the array of column widths
          //     $this->widths=$w;
          // }

          // public function SetAligns($a)
          // {
          //     //Set the array of column alignments
          //     $this->aligns=$a;
          // }

          // public function Row($data)
          // {
          //     //Calculate the height of the row
          //     $nb=0;
          //     for($i=0;$i<count($data);$i++)
          //         $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
          //     $h=5*$nb;
          //     //Issue a page break first if needed
          //     $this->CheckPageBreak($h);
          //     //Draw the cells of the row
          //     for($i=0;$i<count($data);$i++)
          //     {
          //         $w=$this->widths[$i];
          //         $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
          //         //Save the current position
          //         $x=$this->GetX();
          //         $y=$this->GetY();
          //         //Draw the border
          //         $this->Rect($x,$y,$w,$h);
          //         //Print the text
          //         $this->MultiCell($w,5,$data[$i],0,$a);
          //         //Put the position to the right of the cell
          //         $this->SetXY($x+$w,$y);
          //     }
          //     //Go to the next line
          //     $this->Ln($h);
          // }

          // public function CheckPageBreak($h)
          // {
          //     //If the height h would cause an overflow, add a new page immediately
          //     if($this->GetY()+$h>$this->PageBreakTrigger)
          //         $this->AddPage($this->CurOrientation);
          // }

          // public function NbLines($w,$txt)
          // {
          //     //Computes the number of lines a MultiCell of width w will take
          //     $cw=&$this->CurrentFont['cw'];
          //     if($w==0)
          //         $w=$this->w-$this->rMargin-$this->x;
          //     $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
          //     $s=str_replace("\r",'',$txt);
          //     $nb=strlen($s);
          //     if($nb>0 and $s[$nb-1]=="\n")
          //         $nb--;
          //     $sep=-1;
          //     $i=0;
          //     $j=0;
          //     $l=0;
          //     $nl=1;
          //     while($i<$nb)
          //     {
          //         $c=$s[$i];
          //         if($c=="\n")
          //         {
          //             $i++;
          //             $sep=-1;
          //             $j=$i;
          //             $l=0;
          //             $nl++;
          //             continue;
          //         }
          //         if($c==' ')
          //             $sep=$i;
          //         $l+=$cw[$c];
          //         if($l>$wmax)
          //         {
          //             if($sep==-1)
          //             {
          //                 if($i==$j)
          //                     $i++;
          //             }
          //             else
          //                 $i=$sep+1;
          //             $sep=-1;
          //             $j=$i;
          //             $l=0;
          //             $nl++;
          //         }
          //         else
          //             $i++;
          //     }
          //     return $nl;
          // }
        
?>