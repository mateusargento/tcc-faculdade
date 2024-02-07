<?php
	if($_POST) 
	{
		$email = $_POST['email'];
		$senha = sha1($_POST['senha']);

		//Login Cliente Físico
		include '../class/clientefisico.class.php';
		$c1 = new Clientefisico();
		$c1->email = $email;
		$c1->senha = $senha;
		$res = $c1->Login();
		if($res != false)
		{
			foreach($res as $dado)
			{
				$nome = $dado['nome'];
				$codigo_cliente_fisico = $dado['codigo_cliente_fisico'];
			}
			
			session_start();
			
			$_SESSION['nome'] = $nome;
			$_SESSION['codigo_cliente_fisico'] = $codigo_cliente_fisico;
			echo "Autenticando...";
			header("Location: ../view/minha-pagina/compras.php");
			die();
		}

		//Login Cliente Jurídico
		include '../class/clientejuridico.class.php';
		$c2 = new Clientejuridico();
		$c2->email = $email;
		$c2->senha = $senha;
		$res = $c2->Login();
		if($res != false)
		{
			foreach($res as $dado)
			{
				$nome = $dado['nome_fantasia'];
				$codigo_cliente_juridico = $dado['codigo_cliente_juridico'];
			}
			
			session_start();
			
			$_SESSION['nome'] = $nome;
			$_SESSION['codigo_cliente_juridico'] = $codigo_cliente_juridico;
			echo "Autenticando...";
			header("Location: ../view/minha-pagina/compras.php");
			die();
		}

		//Login Profissional
		include '../class/profissional.class.php';
		$p1 = new Profissional();
		$p1->email = $email;
		$p1->senha = $senha;
		$res = $p1->Login();
		if($res != false)
		{
			foreach($res as $dado)
			{
				$nome = $dado['nome'];
				$codigo_profissional = $dado['codigo_profissional'];
			}
			
			session_start();
			
			$_SESSION['nome'] = $nome;
			$_SESSION['codigo_profissional'] = $codigo_profissional;
			echo "Autenticando...";
			header("Location: ../view/pcontrole/pcontrole.php");
			die();
		}
		else
		{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.location.href='../view/aviso.php?mensagem=Falha+ao+logar!+Tente+novamente.&p=goback';
					</SCRIPT>");
			die();
		}
	}
?>