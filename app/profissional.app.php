<?php
//echo "<meta charset='UTF-8'>";

if($_POST){
require_once ('../class/profissional.class.php');
//instanciar a classe cliente

	$p1 = new Profissional(); 
		
	$p1->nome = $_POST['nome'];
	$p1->sobrenome = $_POST['sobrenome'];
	$p1->email = $_POST['email'];
	$p1->senha = $_POST['senha'];
	$p1->telefone = $_POST['telefone'];
	$p1->celular = $_POST['celular'];
	$p1->sexo = $_POST['sexo'];
	$p1->cpf = $_POST['cpf'];
	$p1->rg = $_POST['rg'];

	$data_nasc = $_POST['datadenascimento'];
	//Formata o dia para a formatação do banco de dados. Ex.: 17-01-2020 fica 2020-01-17
	$data_nasc = substr_replace($data_nasc, "-", 2, 1);
    $data_nasc = substr_replace($data_nasc, "-", 5, 1);
    $data_nasc = date_create($data_nasc);
	$data_nasc = date_format($data_nasc, 'Y-m-d'); 
	$p1->data_nasc = $data_nasc;

	$p1->cep = $_POST['cep'];
	$p1->endereco = $_POST['endereco'];
	$p1->numero = $_POST['numero'];
	$p1->complemento = $_POST['complemento'];
	$p1->bairro = $_POST['bairro'];
	$p1->pontodereferencia = $_POST['pontodereferencia'];
	$p1->cidade = $_POST['cidade'];
	$p1->estado = $_POST['estado'];

	switch($_POST['submit']){
		case 'Alterar':
			$p1->codigo_profissional = $_POST['codigo_profissional'];
			$resultado = $p1->Alterar();
			if($resultado != "Falha ao alterar")
			{
				echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.location.href='../view/aviso.php?mensagem=Alteração+feita+com+sucesso!&p=pcontrole/alteracao.php';
						</SCRIPT>");
			}
			else
			{
				echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.location.href='../view/aviso.php?mensagem=Falha+ao+alterar!+Tente+novamente.&p=goback';
						</SCRIPT>");
			}
		break;
		case 'Alterar Senha':
			$p1->codigo_profissional = $_POST['codigo_profissional'];
			$p1->senhaatual = $_POST['senhaatual'];
			$p1->senha = $_POST['senha'];
			$resultado = $p1->AlterarSenha();
			if($resultado != "Falha ao alterar")
			{
				echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.location.href='../view/aviso.php?mensagem=Alteração+feita+com+sucesso!&p=pcontrole/alteracao-dois.php';
						</SCRIPT>");
			}
			else
			{
				echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.location.href='../view/aviso.php?mensagem=Falha+ao+alterar!+Tente+novamente.&p=goback';
						</SCRIPT>");
			}
		break;
	}
}

?> 