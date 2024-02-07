<?php
//echo "<meta charset='UTF-8'>";

if($_POST){
require_once ('../class/faleconosco.class.php');
//instanciar a classe cliente

	switch($_POST['submit']){
		case 'Enviar':
			
		$fc1 = new FaleConosco(); 
			
		$fc1->nome = $_POST['nome'];
		$fc1->email = $_POST['email'];
		$fc1->celular = $_POST['celular'];
		$fc1->assunto = $_POST['assunto'];
		$fc1->duvida = $_POST['duvida'];
		$fc1->respondido = "N";
		$fc1->datafiltro_fale_conosco = date("Y-m-d");

		$resultado = $fc1->Incluir();
		if($resultado != "Falha ao incluir")
		{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
  				   		window.location.href='../view/aviso.php?mensagem=Mensagem+enviada+com+sucesso!&p=fale-conosco.php';
 				   	</SCRIPT>");
		}
		else
		{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
  				   		window.location.href='../view/aviso.php?mensagem=Falha+ao+enviar+a+mensagem!+Tente+novamente.&p=fale-conosco.php';
 				    </SCRIPT>");
		}
		break;
		case 'Alterar':

			$fc1 = new FaleConosco(); 

			$fc1->ticket = $_POST['ticket'];
			$fc1->respondido = $_POST['respondido'];

			$resultado = $fc1->Alterar();
			if($resultado != "Falha ao alterar")
			{
				echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.location.href='../view/aviso.php?mensagem=Alteração+feita+com+sucesso!&p=pcontrole/mensagens.php';
						</SCRIPT>");
			}
			else
			{
				echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.location.href='../view/aviso.php?mensagem=Erro+ao+alterar!+Tente+novamente.&p=pcontrole/mensagens.php';
						</SCRIPT>");
			}
		break;
	}
}

?> 