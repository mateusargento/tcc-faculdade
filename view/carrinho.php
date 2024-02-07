<?php
	session_start();
	if($_POST) //Caso seja enviado algum formulário vindo das páginas de serviços
	{
		if(!isset($_SESSION['carrinho'])) //Caso seja o primeiro produto a ser colocado no carrinho
		{
			if($_POST['codigo_servico'])
			{
				$_SESSION['carrinho'][1] = array( //Preenche o serviço no espaço disponível encontrado no array
					"id" => 1, //Utilizado para o botão de excluir do carrinho funcionar
					"codigo_servico" => $_POST['codigo_servico'],
					"servico" => $_POST['servico'],
					"nome_do_negocio" => $_POST['nome_do_negocio'],
					"ramo_de_atuacao" => $_POST['ramo_de_atuacao'],
					"caracteristica" => $_POST['p1'],
					"tipo" => $_POST['p2'],
					"prazo" => $_POST['p3'],
					"quantidade" => $_POST['quantidade'],
					"descricao" => $_POST['descricao'],
					"preco_final" => $_POST['preco_final'],
					"url_foto" => $_POST['url_foto']
				);
			}
			elseif($_POST['codigo_consultoria'])
			{
				$_SESSION['carrinho'][1] = array( //Preenche o serviço no espaço disponível encontrado no array
					"id" => 1, //Utilizado para o botão de excluir do carrinho funcionar
					"codigo_consultoria" => $_POST['codigo_consultoria'],
					"servico" => $_POST['servico'],
					"nome_do_negocio" => $_POST['nome_do_negocio'],
					"ramo_de_atuacao" => $_POST['ramo_de_atuacao'],
					"caracteristica" => $_POST['p1'],
					"tipo" => $_POST['p2'],
					"prazo" => $_POST['p3'],
					"quantidade" => $_POST['quantidade'],
					"descricao" => $_POST['descricao'],
					"preco_final" => $_POST['preco_final'],
					"url_foto" => $_POST['url_foto']
				);
			}
			header("Location: carrinho.php");
		}
		else //Se não, ou seja, for o segundo ou algum depois disso
		{
			$n = 1; //Número a somar no sizeof, para incluir o serviço no carrinho depois do último que foi inserido
			$existe = true; //Verifica se esse valor do array já está preenchido
			while($existe == true)
			{
				$sizeof = (sizeof($_SESSION['carrinho']) + $n);
				if(isset($_SESSION['carrinho'][$sizeof])) //Se o valor já estiver preenchido
				{
					$n ++; //Soma mais um a variável para que possa somar mais +2 e assim sucessivamente no sizeof até achar um espaço disponível
				}
				else //Se o valor espaço do array não estiver preenchido
				{
					$existe = false; //Informa que não existem dados no espaço do array e sai do while (loop)
				}
			}

			if($_POST['codigo_servico'])
			{
				$_SESSION['carrinho'][$sizeof] = array( //Preenche o serviço no espaço disponível encontrado no array
					"id" => $sizeof, //Utilizado para o botão de excluir do carrinho funcionar
					"codigo_servico" => $_POST['codigo_servico'],
					"servico" => $_POST['servico'],
					"nome_do_negocio" => $_POST['nome_do_negocio'],
					"ramo_de_atuacao" => $_POST['ramo_de_atuacao'],
					"caracteristica" => $_POST['p1'],
					"tipo" => $_POST['p2'],
					"prazo" => $_POST['p3'],
					"quantidade" => $_POST['quantidade'],
					"descricao" => $_POST['descricao'],
					"preco_final" => $_POST['preco_final'],
					"url_foto" => $_POST['url_foto']
				);
			}
			elseif($_POST['codigo_consultoria'])
			{
				$_SESSION['carrinho'][$sizeof] = array( //Preenche o serviço no espaço disponível encontrado no array
					"id" => $sizeof, //Utilizado para o botão de excluir do carrinho funcionar
					"codigo_consultoria" => $_POST['codigo_consultoria'],
					"servico" => $_POST['servico'],
					"nome_do_negocio" => $_POST['nome_do_negocio'],
					"ramo_de_atuacao" => $_POST['ramo_de_atuacao'],
					"caracteristica" => $_POST['p1'],
					"tipo" => $_POST['p2'],
					"prazo" => $_POST['p3'],
					"quantidade" => $_POST['quantidade'],
					"descricao" => $_POST['descricao'],
					"preco_final" => $_POST['preco_final'],
					"url_foto" => $_POST['url_foto']
				);
			}
			header("Location: carrinho.php");
		}
	}
	if($_GET)
	{
		$get = $_GET['removeritem'];
		unset($_SESSION['carrinho'][$get]);
		header("Location: carrinho.php");
	}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link rel="stylesheet" href="css/estilocarrinho.css">
	<link rel="stylesheet" href="css/estilomenu.css">
	<link rel="icon" href="imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Carrinho - BNG Design</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> <!-- Fonte -->
	<script src='https://kit.fontawesome.com/a076d05399.js'></script> <!-- Ícone -->
	<script src="js/scriptjs.js"></script>
</head>
<body>
	<!-- ------------------------------------------------------- -->
	<!--                        Menu                             -->
	<!-- ------------------------------------------------------- -->

	<?php include "menu.php"; ?>

	<!-- ------------------------------------------------------- -->
	<!--                      Título                             -->
	<!-- ------------------------------------------------------- -->
	<section id="div-titulo">
		<section id="conteudo-site">
			<h1 id="titulo">CARRINHO</h1>
		</section>
	</section>

	<!-- ------------------------------------------------------- -->
	<!--                      Carrinho                           -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<section id="conteudo">
			<table>
				<tr>
					<th></th>
					<th></th>
					<th>Serviço</th>
					<th>Valor final</th>
					<th>Mais detalhes</th>
					<th></th>
				</tr>
				<?php
				$valortotal = 0;
				$parcelas = 0;
				if(isset($_SESSION['carrinho']))
				{
					$cont = 1;
					$i = 0;
					$session = $_SESSION['carrinho'];
					foreach($session as $dados)
					{
						echo "<tr>
							<td>". $cont ."</td>
							<td style='width: 10%;'>
								<img src='" . $dados['url_foto'] . "' width='70%' id='foto'>
								</td>
							<td>" . $dados['servico'] . "</td>
							<td>R$ " . number_format($dados['preco_final'],2,",",".") . "</td>
							</td>
							<td style='cursor: pointer;' onclick=exibirQuestao('q" . ($i+1) . "')>
								<span id='q" . ($i+1) . "1'>Exibir +</span></td>
							<td>
								<button id='submit' onclick=window.location.href='carrinho.php?removeritem=" . $dados['id'] . "'><i class='fas fa-trash' id='lixeira'></i></button>
							</td>
						</tr>
						
						<tr>
							<td colspan='8' id='q". ($i+1) ."' style='background: #f2f2f2; display: none; text-align: left;'>
								<ul>
									<li>Nome do negócio: " . $dados['nome_do_negocio'] . "</li>
									<li>Ramo de atuação: " .  $dados['ramo_de_atuacao'] . "</li>
									<li>Característica: " .  $dados['caracteristica'] . "</li>
									<li>Tipo: " .  $dados['tipo'] . "</li>
									<li>Prazo: " .  $dados['prazo'] . "</li>
									<li>Quantidade: " .  $dados['quantidade'] . "</li>
									<li>Descrição: " .  $dados['descricao'] . "</li>
								</ul>
							</td>
						</tr>";
						$cont ++;
						$i ++;
						$valortotal += $dados['preco_final'];
					}
					$parcelas = $valortotal / 10;
				}
				?>
			</table>
		</section>

		<section id="conteudo">
			<table id="valor-final">
				<tr>
					<?php
					if((isset($valortotal)) && (isset($parcelas)))
					{
						echo "<td style='text-align: left'>
							<span style='font-weight: bold;'>Total R$ " . number_format($valortotal,2,",",".") . "</span> <br> em até 10X de R$ " . number_format($parcelas,2,",",".") . "
						</td>
						<td style='text-align: right'>";
						if($valortotal != 0)
						{
							echo "<button id='submit' onclick=window.location.href='finalizar-compra.php'>Finalizar Compra</i></button>";
						
						}
						echo "</td>";
					}
					?>
				</tr>
			</table>
		</section>
	</section>
	<!-- ------------------------------------------------------- -->
	<!--                        Rodapé                           -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<footer id="rodape">
			<div id="rodape-logo">
				<img src="imagens/logotipo/logo-roxo.png" id="rodape-logo-imagem" alt="BNG Design">
			</div>
			<div id="rodape-texto">
				<p>
					Bangu Design LTDA / 400.289.220-00 <br>
					Av. Rio Branco, 156 - Rio de Janeiro, RJ - 20040-003
				</p>
			</div>
			<div id="rodape-texto-dois"></div>
				<i class="fab fa-cc-mastercard" style="font-size: 32pt; color: #660094;"></i>
				<i class="fab fa-cc-visa" style="font-size: 32pt; color: #660094;"></i>
				<i class="fab fa-cc-amex" style="font-size: 32pt; color: #660094;"></i>
				<i class="fas fa-credit-card" style="font-size: 32pt; color: #660094;"></i>
				<i class="fas fa-money-bill-alt" style="font-size: 32pt; color: #660094; margin: 3px solid;"></i>
			</div>
		</footer>
	</section>
</body>
</html>