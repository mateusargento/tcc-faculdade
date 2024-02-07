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
	<link rel="stylesheet" href="../css/minha-pagina/estilominhapaginameusboletos.css">
	<link rel="stylesheet" href="../css/estilomenu.css">
	<link rel="icon" href="../imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Meus Boletos - BNG Design</title>
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
		<section id="conteudo-site">
			<h1 id="titulo">MEUS BOLETOS</h1>
		</section>
	</section>

	<!-- ------------------------------------------------------- -->
	<!--                  Menu do usuário                        -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<section id="div">
			<div id="menu-vertical"> <!-- Links para as páginas do site (Desktop) -->
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
	<!--                Usuários Cadastrados                     -->
    <!-- ------------------------------------------------------- -->
			<section id="conteudo">
				<h2 id="titulo-grande">Aqui você pode gerar todos os boletos disponíveis no sistema.</h2><br>
				<table>
					<?php
					include "../../class/conecta.php";

					if(isset($_SESSION['codigo_cliente_fisico']))
					{
						$sql = "SELECT * FROM pedido
								INNER JOIN pagamento ON pedido.codigo_pedido = pagamento.codigo_pedido_fk
								WHERE pedido.codigo_cliente_fisico_fk = " . $_SESSION['codigo_cliente_fisico'] . "  AND forma_pagamento = 'bb'
								ORDER BY id_pedido_junto DESC";
					}
					elseif(isset($_SESSION['codigo_cliente_juridico']))
					{
						$sql = "SELECT * FROM pedido
								INNER JOIN pagamento ON pedido.codigo_pedido = pagamento.codigo_pedido_fk
								WHERE pedido.codigo_cliente_juridico_fk = " . $_SESSION['codigo_cliente_juridico'] . " AND forma_pagamento = 'bb'
								ORDER BY id_pedido_junto DESC";
					}

					$res = pg_query($sql);

					if(pg_num_rows($res) > 0)
					{
						echo "<tr>
							<th>NUMERO DO PEDIDO</th>
							<th>VALOR TOTAL</th>
							<th></th>
						</tr>";
						$verificador = '';
						$valor_total = 0;
						$primeirainformacao = 0;
						$valor_total_exibir = 0;
						$resultado = pg_fetch_all($res);
						foreach($resultado as $dados)
						{
							$id_pedido_junto = $dados['id_pedido_junto'];
							$valor_total = $dados['valor_total'];

							if($verificador != $id_pedido_junto)
							{
								if($primeirainformacao > 0)
								{
									echo "<tr>
										<td>$verificador</td>
										<td>R$ " . number_format($valor_total_exibir,2,",",".") . "</td>
										<td>
										<form action='../../app/boletophp-master/bngboleto.php' method='post' target='_blank'>
											<input type='hidden' name='id_pedido_junto' value='" . $verificador . "'>
											<input type='submit' id='submit' value='Gerar' >
										</form>
										</td>
									</tr>";
									$valor_total_exibir = 0;
									$verificador = $id_pedido_junto;
								}
								$verificador = $id_pedido_junto;
							}

							$primeirainformacao ++;
							$valor_total_exibir += $valor_total;
						}
						echo "<tr>
							<td>$id_pedido_junto</td>
							<td>R$ " . number_format($valor_total_exibir,2,",",".") . "</td>
							<td>
							<form action='../../app/boletophp-master/bngboleto.php' method='POST' target='_blank'>
								<input type='hidden' name='id_pedido_junto' value='" . $id_pedido_junto . "'>
								<input type='submit' id='submit' value='Gerar' >
							</form>
							</td>
						</tr>";
					}
					else
					{
						echo "<h3 style='text-align: center;'>Você não tem boletos</h3>";
					}
					?>
				</table>
			</section>
		</section>
	</section>
	<!-- ------------------------------------------------------- -->
	<!--                        Rodapé                           -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<footer id="rodape">
			<div id="rodape-logo">
				<img src="../imagens/logotipo/logo-roxo.png" id="rodape-logo-imagem" alt="Nome da empresa"> 
				<!-- ************************* NOME DA EMPRESA PRECISA SER MUDADO ************************* -->
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