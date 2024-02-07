<?php
	session_start();
	if((!isset($_SESSION['codigo_cliente_fisico'])) && (!isset($_SESSION['codigo_cliente_juridico'])))
	{
		header('Location: ../login.php');
		die();
	}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link rel="stylesheet" href="../css/minha-pagina/estilominhapaginacompras.css">
	<link rel="stylesheet" href="../css/estilomenu.css">
	<link rel="icon" href="../imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Minhas Compras - BNG Design</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> <!-- Fonte -->
	<script src='https://kit.fontawesome.com/a076d05399.js'></script> <!-- Ícone -->
	<script src="../js/scriptjs.js"></script>
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
		<div id="conteudo-site">
			<h2 id="titulo">MINHAS COMPRAS</h2>
		</div>
	</section>

	<!-- ------------------------------------------------------- -->
	<!--                  Menu do usuário                        -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<section id="div">
			<div id="menu-vertical"> <!-- Links para as páginas do site -->
				<ul id="menu-vertical-ul">
					<h2 id="texto-grande">MEUS DADOS</h2>
					<?php
						if(isset($_SESSION['codigo_cliente_fisico']))
						{
							echo "<li id='menu-vertical-li'><a href='../minha-pagina/alteracao.php' id='menu-vertical-link'>Alterar dados cadastrais</a></li>";
						}
						if(isset($_SESSION['codigo_cliente_juridico']))
						{
							echo "<li id='menu-vertical-li'><a href='../minha-pagina/alteracao-pessoa-juridica.php' id='menu-vertical-link'>Alterar dados cadastrais</a></li>";
						}
					?>
					<li id="menu-vertical-li"><a href="../minha-pagina/alteracao-dois.php" id="menu-vertical-link">Alterar senha</a></li> <br>
					<h2 id="texto-grande">MEUS PEDIDOS</h2>
					<li id="menu-vertical-li"><a href="../minha-pagina/compras.php" id="menu-vertical-link">Pedidos</a></li>
					<li id="menu-vertical-li"><a href="../minha-pagina/boleto.php" id="menu-vertical-link">Meus boletos</a></li>
				</ul>
			</div>

	<!-- ------------------------------------------------------- -->
	<!--                   Área das compras                      -->
	<!-- ------------------------------------------------------- -->

	<!-- Usar repetição neste trecho -->

		<?php
			include "../../class/pedido.class.php";

			$p1 = new Pedido;

			if(isset($_SESSION['codigo_cliente_fisico']))
			{
				$p1->codigo_cliente_fisico_fk = $_SESSION['codigo_cliente_fisico'];
				$resultado = $p1->Listar();
			}
			if(isset($_SESSION['codigo_cliente_juridico']))
			{
				$p1->codigo_cliente_juridico_fk = $_SESSION['codigo_cliente_juridico'];
				$resultado = $p1->Listar();
			}

			if($resultado != "Sem pedidos cadastrados")
			{
				$id_pedido_junto_verificador = '';
				$cont = 0;
				$valortotalgeral = 0;
				$primeirainformacao = true;
				$jainformado = false;
				foreach ($resultado as $dados)
				{
					$id_pedido_junto = $dados['id_pedido_junto'];
					$codigo_pedido = $dados['codigo_pedido'];
					$servico = $dados['tipo'];
					$nome_do_negocio = $dados['nome_do_negocio'];
					$ramo_de_atuacao = $dados['ramo_de_atuacao'];
					$caracteristica = $dados['p1_tipo'];
					$tipo = $dados['p2_tipo'];
					$prazo = $dados['p3_tipo'];
					$descricao = $dados['descricao'];
					$quantidade = $dados['quantidade'];
					$valor_total = $dados['valor_total'];
					$data_pedido = $dados['data_pedido'];
					$data_entrega = $dados['data_entrega'];
					$forma_pagamento = $dados['forma_pagamento'];
					$codigo_cliente_fisico_fk = $dados['codigo_cliente_fisico_fk'];
					$codigo_cliente_juridico_fk = $dados['codigo_cliente_juridico_fk'];
					$codigo_profissional_fk = $dados['codigo_profissional_fk'];
					$codigo_servico_fk = $dados['codigo_servico_fk'];
					$codigo_consultoria_fk = $dados['codigo_consultoria_fk'];
				
					echo "<section id='compras'>";
			// Número do pedido -->
					if($id_pedido_junto_verificador != $id_pedido_junto)
					{
							if($primeirainformacao == false)
							{
								// Status da compra -->
							switch($status)
							{
								case 'Pedido realizado':
									echo "<div id='compras-status'> 
											<img src='../imagens/figura/status-1-pedido-realizado.png' id='status-da-compra'>
									</div>";
								break;
								case 'Pagamento aprovado':
									echo "<div id='compras-status'> 
											<img src='../imagens/figura/status-2-pagamento-aprovado.png' id='status-da-compra'>
									</div>";
								break;
								case 'Pedido reprovado':
									echo "<div id='compras-status'> 
											<img src='../imagens/figura/status-3-pagamento-reprovado.png' id='status-da-compra'>
									</div>";
								break;
								case 'Pedido cancelado':
									echo "<div id='compras-status'> 
											<img src='../imagens/figura/status-4-pedido-cancelado.png' id='status-da-compra'>
									</div>";
								break;
								case 'Pedido em produção':
									echo "<div id='compras-status'> 
											<img src='../imagens/figura/status-5-em-producao.png' id='status-da-compra'>
									</div>";
								break;
								case 'Entregue':
									echo "<div id='compras-status'> 
											<img src='../imagens/figura/status-6-entregue.png' id='status-da-compra'>
									</div>";
								break;

								$jainformado = true;
							}
							echo "<br>";
							echo "<h1 id='titulo-grande' style='text-align: center;'><strong>Total Geral: </strong>R$ " . number_format($valortotalgeral,2,",",".")  . "</h1>";
							$valortotalgeral = 0;
						}
						echo "<div id='compras-numero-do-pedido'>
							<h1 id='titulo-grande'><strong>Número do pedido: </strong>" . $id_pedido_junto . "</h1>
						</div>";
						$id_pedido_junto_verificador = $id_pedido_junto;
					}

					$status = $dados['status'];
					$jainformado = false;
					$primeirainformacao = false;

		// Foto -->
				echo "<div id='compras-descricao'>
						<div id='compras-foto'>";
							if($servico == "Logotipo")
							{
								echo "<img src='../imagens/figura/logotipo.png' id='servico'>";
							}
							else if($servico == "Criação de Identidade Visual")
							{
								echo "<img src='../imagens/figura/identidade-visual.png' id='servico'>";
							}
							else if($servico == "Animação 3D")
							{
								echo "<img src='../imagens/figura/animacao-3d.png' id='servico'>";
							}
							else if($servico == "Consultoria Social Media")
							{
								echo "<img src='../imagens/figura/consultoria-social-media.png' id='servico'>";
							}
						echo "</div>";
		// Serviço e detalhes -->
					echo "<div id='compras-produto'>
							<ul id='compras-ul'>";
			// Tipo de serviço -->
								echo "<li id='texto-grande'>
									#" . $codigo_pedido . "
								</li>";
								echo "<li id='texto-grande'>
									" . $servico . "
								</li>";
			// Nome do negócio -->
								echo "<li id='texto-grande'>
									<span style='font-weight: bold;'>Nome do negócio:</span>
									" . $nome_do_negocio . "
								</li>";
			// Área de atuação -->
								echo "<li id='texto-grande'>
									<span style='font-weight: bold;'>Ramo de atuação: </span>
									" . $ramo_de_atuacao . "
								</li>";
			// Personalização 1 e 2 -->
								echo "<li id='texto-grande'>
									<span style='font-weight: bold;'>Característica: </span>" . $caracteristica . " | 
									<span style='font-weight: bold;'>Tipo: </span>" . $tipo . "
								</li>";
			// Personalização 3 -->
								echo " <li id='texto-grande'>
									<span style='font-weight: bold;'>Prazo: </span>" . $prazo . "
								</li>";
								echo " <li id='texto-grande'>
									<span style='font-weight: bold;'>Descrição: </span>" . $descricao . "
								</li>";
								echo " <li id='texto-grande'>
									<span style='font-weight: bold;'>Data do pedido: </span>" . $data_pedido . "
								</li>";
			// Quantidade, valor do serviço, forma de pagamento e data da entrega -->
								echo "<li id='texto-grande'>
									<span style='font-weight: bold;'>Quantidade: </span>" . $quantidade . " | 
									<span style='font-weight: bold;'>Valor: </span>R$ " . number_format($valor_total,2,",",".") . " <br>
									<span style='font-weight: bold;'>Forma de pagamento: </span>";
									if($forma_pagamento == "cc")
									{
										echo "Cartão de Crédito";
									}
									else if($forma_pagamento == "bb")
									{
										echo "Boleto Bancário";
									}
								echo "</li>
								<li id='texto-grande'>";
									if($servico == "Consultoria Social Media")
									{
										echo "<i class='far fa-calendar-alt' id='entrega'></i> <span style='color: #660094'>Adesão até " . $data_entrega . "</span>";
									}
									else
									{
										echo "<i class='far fa-calendar-alt' id='entrega'></i> <span style='color: #660094'>Entrega até " . $data_entrega . "</span>";
									}
								echo "</li>
							</ul>
						</div>
					</div>";
					$valortotalgeral += $valor_total;
				echo "</section>
				<section></section>";// Não remover, para funcionar com o PHP -->

				}
				if($jainformado == false)
				{
			// Status da compra -->
					switch($status)
					{
						case 'Pedido realizado':
							echo "<div id='compras-status'> 
									<img src='../imagens/figura/status-1-pedido-realizado.png' id='status-da-compra'>
							</div>";

							echo "<div id='compras-status-mobile'> 
									<img src='../imagens/figura-mobile/status-1-pedido-realizado-mobile.png' id='status-da-compra'>
							</div>";
						break;
						case 'Pagamento aprovado':
							echo "<div id='compras-status'> 
									<img src='../imagens/figura/status-2-pagamento-aprovado.png' id='status-da-compra'>
							</div>";

							echo "<div id='compras-status-mobile'> 
									<img src='../imagens/figura-mobile/status-2-pagamento-aprovado-mobile.png' id='status-da-compra'>
							</div>";
						break;
						case 'Pedido reprovado':
							echo "<div id='compras-status'> 
									<img src='../imagens/figura/status-3-pagamento-reprovado.png' id='status-da-compra'>
							</div>";

							echo "<div id='compras-status-mobile'> 
									<img src='../imagens/figura-mobile/status-3-pagamento-reprovado-mobile.png' id='status-da-compra'>
							</div>";
						break;
						case 'Pedido cancelado':
							echo "<div id='compras-status'> 
									<img src='../imagens/figura/status-4-pedido-cancelado.png' id='status-da-compra'>
							</div>";

							echo "<div id='compras-status-mobile'> 
									<img src='../imagens/figura-mobile/status-4-pedido-cancelado-mobile.png' id='status-da-compra'>
							</div>";
						break;
						case 'Pedido em produção':
							echo "<div id='compras-status'> 
									<img src='../imagens/figura/status-5-em-producao.png' id='status-da-compra'>
							</div>";

							echo "<div id='compras-status-mobile'> 
									<img src='../imagens/figura-mobile/status-5-em-producao-mobile.png' id='status-da-compra'>
							</div>";
						break;
						case 'Entregue':
							echo "<div id='compras-status'> 
									<img src='../imagens/figura/status-6-entregue.png' id='status-da-compra'>
							</div>";

							echo "<div id='compras-status-mobile'> 
									<img src='../imagens/figura-mobile/status-6-entregue-mobile.png' id='status-da-compra'>
							</div>";
						break;
					}
					echo "<br>";
					echo "<h1 id='titulo-grande'><strong>Total Geral: </strong>R$ " . number_format($valortotalgeral,2,",",".")  . "</h1>";

					$valortotalgeral = 0;
				}
			}
			else
			{
				echo "<h1 id='titulo-grande'>Você não tem compras ainda.</h1>";
			}
		?>
	<!-- Usar repetição neste trecho até aqui -->

		</section>
	</section>
	

	<!-- ------------------------------------------------------- -->
	<!--                        Rodapé                           -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<footer id="rodape" style="margin-top: 20%">
			<div id="rodape-logo">
				<img src="../imagens/logotipo/logo-roxo.png" id="rodape-logo-imagem" alt="Nome da empresa"> 
				<!-- ************************* NOME DA EMPRESA PRECISA SER MUDADOs ************************* -->
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