<?php
//echo "<meta charset='UTF-8'>";

require_once ('../class/socialmedia.class.php');
//instanciar a classe cliente

	if($_POST){  //só vai funcionar se tiver algum dado enviado através do POST
		switch($_POST['submit']){
			case 'Alterar':

				$s1 = new Socialmedia(); 
				
				$s1->codigo_consultoria = $_POST['codigo_consultoria'];
				$s1->valor_inicial = $_POST['valor'];
				$s1->disponibilidade = $_POST['disponibilidade'];
	
				$resultado = $s1->Alterar();
				if($resultado != "Falha ao alterar")
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Alteração+feita+com+sucesso!&p=pcontrole/listar-servicos.php';
						   </SCRIPT>");
				}
				else
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Erro+ao+alterar!+Tente+novamente.&p=pcontrole/listar-servicos.php';
						   </SCRIPT>");
				}
				break;
		}
		
	}
?>