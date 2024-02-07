<?php
error_reporting(0);

ini_set('display_errors', FALSE);

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

$pdf->SetFont('Arial','B',16); 
$pdf->SetTextColor(88, 42, 192);
$pdf->SetFont('Arial','B',16); # formtação de Fonte : Tipo Arial, Bold, Tamanho 16 

# Criar uma célula - na ordem : tamanho da célula, altura da célula, o que será exibido, se # terá borda (1) ou não (0), se vai saltar linha (1) ou não (0), alinhamento (L,C,R)

$pdf->Ln();
$pdf->Cell(0,6,utf8_decode(''),0,1,'C');
$pdf->Ln();
$pdf->Ln();

$pdf->Line(10,30,200,30);



$pdf->SetFont('Arial','B',16); 

$pdf->Cell(0,10,utf8_decode('Dados dos Clientes Jurídicos'),0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(88, 42, 192);
$pdf->SetTextColor(255, 255, 255);
$pdf->Image('logotipocortada.jpg',7,7,90);

$pdf->Cell(30,6,'Codigo',1,0,'C', 1);
$pdf->Cell(30,6,'Razao social',1,0,'C', 1);
$pdf->Cell(35,6,'Nome Fantasia',1,0,'C', 1);
$pdf->Cell(35,6,'CNPJ',1,0,'C', 1);
$pdf->Cell(30,6,'Celular',1,0,'C', 1);
$pdf->Cell(30,6,'Data Cadastro',1,1,'C', 1);


$sql = "SET DATESTYLE TO 'SQL, DMY';
SELECT * FROM cliente_juridico
WHERE 
		datafiltro_juridico >= '$datainicial' AND datafiltro_juridico <= '$datafinal'";
$res = @pg_query($sql);

$pdf->SetFont('Arial','',10); # formtação de Fonte : Tipo Arial, Nomral, Tamanho 10

$total = 0;
if(pg_num_rows($res) > 0){
$dados = pg_fetch_all($res);
foreach ($dados as $dad) {
	$codigo_cliente_juridico = $dad['codigo_cliente_juridico'];
	$razao_social 			 = $dad['razao_social'];
	$nome_fantasia   		 = $dad['nome_fantasia'];
	$cnpj   				 = $dad['cnpj'];
	$celular   				 = $dad['celular'];
	$datafiltro   			 = $dad['datafiltro_juridico'];

$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(30,6,$codigo_cliente_juridico,1,0,'C');
$pdf->Cell(30,6,$razao_social,1,0,'C');
$pdf->Cell(35,6,utf8_decode($nome_fantasia),1,0,'C');
$pdf->Cell(35,6,$cnpj,1,0,'C');
$pdf->Cell(30,6,$celular,1,0,'C');
$pdf->Cell(30,6,$datafiltro,1,1,'C');

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




$nomearquivo = 'clientejuridico.pdf';
# Exportar para arquivo
$pdf->Output('i', $nomearquivo);
}
?>	
