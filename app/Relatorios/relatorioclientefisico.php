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

//$this->Image('logotipo-01.png',10,20,33,0,'','');



# Criar uma célula - na ordem : tamanho da célula, altura da célula, o que será exibido, se # terá borda (1) ou não (0), se vai saltar linha (1) ou não (0), alinhamento (L,C,R)


//$pdf->SetTextColor(112, 17, 155); MAIS ROXO

$pdf->SetFont('Arial','B',16); 
$pdf->SetTextColor(88, 42, 192);
/*$pdf->Ln(0);
$pdf->setY("15");
$pdf->setX("60");
*/
$pdf->Ln();
$pdf->Cell(0,6,utf8_decode(''),0,1,'C');
$pdf->Ln();
$pdf->Ln();

$pdf->Line(10,30,200,30);





$pdf->Ln();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,utf8_decode('Dados dos Serviços'),0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(88, 42, 192);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(30,6,'Codigo',1,0,'C', 1);
$pdf->Cell(30,6,'Nome',1,0,'C', 1);
$pdf->Cell(35,6,'Sobrenome',1,0,'C', 1);
$pdf->Cell(35,6,'CPF',1,0,'C', 1);
$pdf->Cell(30,6,'Celular',1,0,'C', 1);
$pdf->Cell(30,6,'Data Cadastro',1,1,'C', 1);

$pdf->Image('logotipocortada.jpg',7,7,90);

$sql = "SET DATESTYLE TO 'SQL, DMY';
SELECT * FROM cliente_fisico
WHERE 
		datafiltro_fisico >= '$datainicial' AND datafiltro_fisico <= '$datafinal'";
$res = @pg_query($sql);


$pdf->SetFont('Arial','',10); # formtação de Fonte : Tipo Arial, Nomral, Tamanho 10

$total = 0;
if(pg_num_rows($res) > 0){
$dados = pg_fetch_all($res);
foreach ($dados as $dad) {
	$codigo_cliente_fisico 	= $dad['codigo_cliente_fisico'];
	$nome 				    = $dad['nome'];
	$sobrenome   		    = $dad['sobrenome'];
	$cpf   				    = $dad['cpf'];
	$celular   				= $dad['celular'];
	$datafiltro_fisico   	= $dad['datafiltro_fisico'];

$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(30,6,$codigo_cliente_fisico,1,0,'C');
$pdf->Cell(30,6,utf8_decode($nome),1,0,'C');
$pdf->Cell(35,6,utf8_decode($sobrenome),1,0,'C');
$pdf->Cell(35,6,$cpf,1,0,'C');
$pdf->Cell(30,6,$celular,1,0,'C');
$pdf->Cell(30,6,$datafiltro_fisico,1,1,'C');


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





$nomearquivo = 'clientefisico.pdf';
# Exportar para arquivo
$pdf->Output('i', $nomearquivo);
}
?>	

