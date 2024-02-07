<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link rel="stylesheet" href="css/estiloaviso.css">
	<link rel="stylesheet" href="css/estilomenu.css">
	<link rel="icon" href="imagens/logotipo/logo-icone.png">
	<link rel="icon" href="imagens/logotipo/logo-roxo.png" sizes="16x16">
	<meta charset="UTF-8">
	<title>Aviso - BNG Design</title>
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
	<!--                       Mensagem                          -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<section id="div">
			<?php
			if($_GET)
			{
				if($_GET['p'] != "goback")
				{
					$onclick = "window.location.href='" . $_GET['p'] . "'";
				}
				else
				{
					$onclick = "Voltar()";
				}

				echo "<h3 id='mensagem'>" . $_GET['mensagem'] . "</h3>
				
				<button name='submit' id='submit' onclick=" . $onclick . ">Voltar</button>";
			}
			?>
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