<?php
	session_start();
	if(!isset($_SESSION['codigo_profissional']))
	{
		header('Location: ../login.php');
		die();
	}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link rel="stylesheet" href="../css/pcontrole/estilopcontrolemeustrabalhos.css">
	<link rel="stylesheet" href="../css/estilomenu.css">
	<link rel="icon" href="../imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Relatórios - BNG Design</title>
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
			<h1 id="titulo">RELATÓRIOS</h1>
		</section>
	</section>

	<!-- ------------------------------------------------------- -->
	<!--                   Botão Voltar                          -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<section id="div">
			<div id="menu-vertical"> <!-- Links para as páginas do site (Desktop) -->
				<a href="pcontrole.php" id="menu-vertical-link"><i class="fas fa-arrow-left" style="margin-right: 5px;"></i> VOLTAR</a>
			</div>

	<!-- ------------------------------------------------------- -->
	<!--                Usuários Cadastrados                     -->
    <!-- ------------------------------------------------------- -->
			<section id="conteudo">
				<h2 id="titulo-grande">Aqui você pode gerar todos os relatórios disponíveis no sistema.</h2><br>
				<table>
					<tr>
						<th>ID</th>
						<th>RELATORIO</th>
                        <th>DATA INICIAL</th>
						<th>DATA FINAL</th>
						<th></th>
					</tr>
				<!-- Relatório de Cliente Físico -->
					<tr>
						<td>1</td>
						<td>Relatório de Cliente Físico</td>
						<td>
						<form action="../../app/Relatorios/relatorioclientefisico.php" method="POST" target="_blank">
							<input type="date" name="data-inicial" id="data-inicial" required>
						</td>
						<td>
							<input type="date" name="data-final" id="data-inicial" required>
						</td>
						<td>
						<input type="submit" id="submit" value="Gerar" >
						</form>
						</td>
					</tr>
				<!-- Relatório de Cliente Jurídico -->
					<tr>
						<td>2</td>
						<td>Relatório de Cliente Jurídico</td>
						<td>
						<form action="../../app/Relatorios/relatorioclientejuridico.php" method="POST" target="_blank">
							<input type="date" name="data-inicial" id="data-inicial" required>
						</td>
						<td>
							<input type="date" name="data-final" id="data-inicial" required>
						</td>
						<td>
						<input type="submit" id="submit" value="Gerar" >
						</form>
						</td>
					</tr>
				
				<!-- Relatório de Pedidos -->
					<tr>
						<td>4</td>
						<td>Relatório de Pedidos</td>
						<td>
						<form action="../../app/Relatorios/relatoriopedido.php" method="POST" target="_blank">
							<input type="date" name="data-inicial" id="data-inicial" required>
						</td>
						<td>
							<input type="date" name="data-final" id="data-inicial" required>
						</td>
						<td>
						<input type="submit" id="submit" value="Gerar" >
						</form>
						</td>
					</tr>
				<!-- Relatório de Serviços -->
					<tr>
						<td>5</td>
						<td>Relatório de Serviços</td>
						<td>
						<form action="../../app/Relatorios/relatorioservico.php" method="POST" target="_blank">
							<input type="date" name="data-inicial" id="data-inicial" required>
						</td>
						<td>
							<input type="date" name="data-final" id="data-final" required>
						</td>
						<td>
							<input type="submit" id="submit" value="Gerar" >
						</form>
						</td>
					</tr>
				<!-- Relatório Social Media -->
					<tr>
						<td>6</td>
						<td>Relatório Social Media</td>
						<td>
						<form action="../../app/Relatorios/relatoriosocialmedia.php" method="POST" target="_blank">
							<input type="date" name="data-inicial" id="data-inicial" required>
						</td>
						<td>
							<input type="date" name="data-final" id="data-inicial" required>
						</td>
						<td>
							<input type="submit" id="submit" value="Gerar" >
						</form>
						</td>
					</tr>
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