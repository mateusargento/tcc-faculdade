<?php
//echo "<meta charset='UTF-8'>";

if($_POST){
require_once ('../class/clientefisico.class.php');
//instanciar a classe cliente

	if($_POST['tipodecadastro'] == 'pessoafisica'){  //só vai funcionar se tiver algum dado enviado através do POST
			
		$c1 = new Clientefisico(); 
		
		$c1->nome = $_POST['nome'];
		$c1->sobrenome = $_POST['sobrenome'];
		$c1->email = $_POST['email'];
		$c1->telefone = $_POST['telefone'];
		$c1->celular = $_POST['celular'];
		$c1->sexo = $_POST['sexo'];
		$c1->cpf = $_POST['cpf'];
		$c1->rg = $_POST['rg'];

		$data_nasc = $_POST['datadenascimento'];
		//Formata o dia para a formatação do banco de dados. Ex.: 17-01-2020 fica 2020-01-17
		$data_nasc = substr_replace($data_nasc, "-", 2, 1);
    	$data_nasc = substr_replace($data_nasc, "-", 5, 1);
    	$data_nasc = date_create($data_nasc);
		$data_nasc = date_format($data_nasc, 'Y-m-d'); 
		$c1->data_nasc = $data_nasc;

		$c1->cep = $_POST['cep'];
		$c1->endereco = $_POST['endereco'];
		$c1->numero = $_POST['numero'];
		$c1->complemento = $_POST['complemento'];
		$c1->bairro = $_POST['bairro'];
		$c1->pontodereferencia = $_POST['pontodereferencia'];
		$c1->cidade = $_POST['cidade'];
		$c1->estado = $_POST['estado'];

		date_default_timezone_set('America/Sao_Paulo');
		$c1->datafiltro_fisico = date("Y-m-d");

		switch($_POST['submit']){
			case 'Cadastrar':
				$c1->senha = sha1($_POST['senha']);
				$c1->ativo = 'S';
				$resultado = $c1->Incluir();
				if($resultado == "E-mail já cadastrado")
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Falha+ao+cadastrar!+E-mail+já+cadastrado.&p=goback';
						</SCRIPT>");
				}
				elseif($resultado != "Falha ao incluir")
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Cadastro+feito+com+sucesso!&p=login.php';
						   </SCRIPT>");
				}
				else
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Falha+ao+cadastrar!+Tente+novamente.&p=goback';
						   </SCRIPT>");
				}
			break;
			case 'Alterar':
				$c1->codigo_cliente_fisico = $_POST['codigo_cliente_fisico'];
				$resultado = $c1->Alterar();
				if($resultado == "E-mail já cadastrado")
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Falha+ao+alterar!+E-mail+já+cadastrado.&p=minha-pagina/alteracao.php';
						</SCRIPT>");
				}
				elseif($resultado != "Falha ao alterar")
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Alteração+feita+com+sucesso!&p=minha-pagina/alteracao.php';
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
				$c1->codigo_cliente_fisico = $_POST['codigo_cliente_fisico'];
				$c1->senhaatual = sha1($_POST['senhaatual']);
				$c1->senha = sha1($_POST['senha']);
				$resultado = $c1->AlterarSenha();
				if($resultado != "Falha ao alterar")
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Alteração+feita+com+sucesso!&p=minha-pagina/alteracao-dois.php';
						   </SCRIPT>");
				}
				else
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Falha+ao+alterar!+Tente+novamente.&p=goback';
						   </SCRIPT>");
				}
			break;
			case 'Ativo':
				$c1->codigo_cliente_fisico = $_POST['codigo_cliente_fisico'];
				$c1->ativo = $_POST['conta-ativa'];
				$resultado = $c1->Ativo();
				if($resultado != "Falha ao alterar")
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Alteração+feita+com+sucesso!&p=pcontrole/usuarios-cadastrados.php';
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

	else if($_POST['tipodecadastro'] == 'pessoajuridica'){
	require_once ("../class/clientejuridico.class.php");

		$c2 = new Clientejuridico();

		$c2->razaosocial = $_POST['razaosocial'];
		$c2->nomefantasia = $_POST['nomefantasia'];
		$c2->email = $_POST['email'];
		$c2->telefone = $_POST['telefone'];
		$c2->celular = $_POST['celular'];
		$c2->cnpj = $_POST['cnpj'];
		$c2->inscricaomunicipal = $_POST['inscricaomunicipal'];
		$c2->inscricaoestadual = $_POST['inscricaoestadual'];
		$c2->cep = $_POST['cep'];
		$c2->endereco = $_POST['endereco'];
		$c2->numero = $_POST['numero'];
		$c2->complemento = $_POST['complemento'];
		$c2->bairro = $_POST['bairro'];
		$c2->pontodereferencia = $_POST['pontodereferencia'];
		$c2->cidade = $_POST['cidade'];
		$c2->estado = $_POST['estado'];

		date_default_timezone_set('America/Sao_Paulo');
		$c2->datafiltro_juridico = date("Y-m-d");
		
		switch($_POST['submit']){
			case 'Cadastrar':
				$c2->senha = sha1($_POST['senha']);
				$c2->ativo = 'S';
				$resultado = $c2->Incluir();
				if($resultado == "E-mail já cadastrado")
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Falha+ao+cadastrar!+E-mail+já+cadastrado.&p=goback';
						</SCRIPT>");
				}
				elseif($resultado != "Falha ao incluir")
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Cadastro+feito+com+sucesso!&p=login.php';
						</SCRIPT>");
				}
				else
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Falha+ao+cadastrar!+Tente+novamente.&p=goback';
						</SCRIPT>");
				}
			break;
			case 'Alterar':
				$c2->codigo_cliente_juridico = $_POST['codigo_cliente_juridico'];
				$resultado = $c2->Alterar();
				if($resultado == "E-mail já cadastrado")
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Falha+ao+alterar!+E-mail+já+cadastrado.&p=minha-pagina/alteracao-pessoa-juridica.php';
						</SCRIPT>");
				}
				elseif($resultado != "Falha ao alterar")
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Alteração+feita+com+sucesso!&p=minha-pagina/alteracao-pessoa-juridica.php';
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
				$c2->codigo_cliente_juridico = $_POST['codigo_cliente_juridico'];
				$c2->senhaatual = sha1($_POST['senhaatual']);
				$c2->senha = sha1($_POST['senha']);
				$resultado = $c2->AlterarSenha();
				if($resultado != "Falha ao alterar")
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Alteração+feita+com+sucesso!&p=minha-pagina/alteracao-dois.php';
						   </SCRIPT>");
				}
				else
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Falha+ao+alterar!+Tente+novamente.&p=goback';
						   </SCRIPT>");
				}
			break;
			case 'Ativo':
				$c2->codigo_cliente_juridico = $_POST['codigo_cliente_juridico'];
				$c2->ativo = $_POST['conta-ativa'];
				$resultado = $c2->Ativo();
				if($resultado != "Falha ao alterar")
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Alteração+feita+com+sucesso!&p=pcontrole/usuarios-cadastrados.php';
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
}

?> 