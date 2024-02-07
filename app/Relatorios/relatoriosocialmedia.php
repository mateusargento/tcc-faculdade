<?php
include "conecta.php";

require_once("../fpdf/fpdf.php");

if($_POST){
	$datainicial = $_POST['data-inicial'];
	$datafinal = $_POST['data-final'];

# Intancia da classe PDF
$pdf = new FPDF('P', 'mm', 'A4'); 

# Abrir um documento
//$pdf->Open();

# Abrir nova página no documento
$pdf->addpage();

$pdf->SetFont('Arial','B',16); # formtação de Fonte : Tipo Arial, Bold, Tamanho 16 
$pdf->SetTextColor(88, 42, 192);

# Criar uma célula - na ordem : tamanho da célula, altura da célula, o que será exibido, se # terá borda (1) ou não (0), se vai saltar linha (1) ou não (0), alinhamento (L,C,R)

$pdf->Ln();
$pdf->Cell(0,6,utf8_decode(''),0,1,'C');
$pdf->Ln();
$pdf->Ln();

$pdf->Line(10,30,200,30);



$pdf->Ln();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,utf8_decode('Dados Consultoria social media'),0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(88, 42, 192);
$pdf->SetTextColor(255, 255, 255);
$pdf->Image('logotipocortada.jpg',7,7,90);

$pdf->Cell(20,6,utf8_decode('Código'),1,0,'C', 1);
$pdf->Cell(50,6,'Tipo',1,0,'C', 1);
$pdf->Cell(40,6,'Valor',1,0,'C', 1);
$pdf->Cell(40,6,'Disponibilidade',1,0,'C', 1);
$pdf->Cell(40,6,'Data',1,1,'C', 1);
;


 $sql = "SET DATESTYLE TO 'SQL, DMY';
 SELECT * FROM consultoria_social_media
WHERE 
		datafiltro_socialmedia >= '$datainicial' AND datafiltro_socialmedia <= '$datafinal'";
$res = @pg_query($sql);
$dados = pg_fetch_all($res);

$pdf->SetFont('Arial','',10); # formtação de Fonte : Tipo Arial, Nomral, Tamanho 10

$total = 0;
if(pg_num_rows($res) > 0){
foreach ($dados as $dad) {
	$codigo_consultoria 	    = $dad['codigo_consultoria'];
	$tipo 				        = $dad['tipo'];
	$valor_inicial		        = $dad['valor_inicial'];
	$disponibilidade   		    = $dad['disponibilidade'];
	$datafiltro   		    = $dad['datafiltro_socialmedia'];

$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(20,6,$codigo_consultoria,1,0,'C');
$pdf->Cell(50,6,$tipo,1,0,'C');
$pdf->Cell(40,6,number_format($valor_inicial,2,",","."),1,0,'C');
$pdf->Cell(40,6,$disponibilidade,1,0,'C');
$pdf->Cell(40,6,$datafiltro,1,1,'C');

	$total = $total + 1;
}
}
$pdf->Cell(30,6,'',0,1,'R');
$pdf->Cell(190,6,"Total de dados: $total",0,0,'R');

$data = date("d/m/Y"); 
$pdf->Ln(0);
$pdf->setY("20");
$pdf->setX("125");
$pdf->Cell(70, 4,utf8_decode( 'Data de emissão: ').$data, 0, 0, 'R');



$nomearquivo = 'socialmedia.pdf';
# Exportar para arquivo
$pdf->Output('i', $nomearquivo);
}
?>	

