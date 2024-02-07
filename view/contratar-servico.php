<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link rel="stylesheet" href="css/estilocontratarservico.css">
	<link rel="stylesheet" href="css/estilomenu.css">
	<link rel="icon" href="imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Contratar Serviço - BNG Design</title>
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
	<section id="div">
		<div id="conteudo-site">
			<h2 id="titulo">SERVIÇOS</h2>
		</div>
	</section>

	<!-- ------------------------------------------------------- -->
	<!--               Apresentação de serviços                  -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<section id="div">
			<section id="servicos">
			<?php
				include "../class/servico.class.php";

				$s1 = new Servico();

				//Logotipo
				$s1->codigo_servico = 1;
				$res = $s1->Listar();
				if($res != "Falha ao listar")
				{
					foreach($res as $dado)
					{
						$p1 = $dado['valor_inicial'];
					}

					echo "<div id='grid-conteudo'>
						<a href='logotipo.php'><img src='imagens/figura/logotipo.png' id='servicos-imagens' alt='Criação de Logotipo'></a> <br><br>
						<div id='grid-informacao'>
							<a href='logotipo.php' id='servicos-links'>Criação de Logotipo <br><br>
							A partir de R$ <span id='preco'>" . number_format($p1,2,",",".") . "</span> <br>
							10x de R$ " . number_format(($p1 / 10),2,",",".") . "</a>
						</div>
					</div>";
				}
				
				//Animação 3D
				$s1->codigo_servico = 2;
				$res = $s1->Listar();
				if($res != "Falha ao listar")
				{
					foreach($res as $dado)
					{
						$p2 = $dado['valor_inicial'];
					}

					echo "<div id='grid-conteudo'>
						<a href='animacaotd.php'><img src='imagens/figura/animacao-3d.png' id='servicos-imagens' alt='Animação 3D'></a> <br><br>
						<div id='grid-informacao'>
							<a href='animacaotd.php' id='servicos-links'>Animação 3D<br><br>
							A partir de R$ <span id='preco'>" . number_format($p2,2,",",".") . "</span> <br>
							10x de R$ " . number_format(($p2 / 10),2,",",".") . "</a>
						</div>
					</div>";
				}

				//Criação de identidade visual
				$s1->codigo_servico = 3;
				$res = $s1->Listar();
				if($res != "Falha ao listar")
				{
					foreach($res as $dado)
					{
						$p3 = $dado['valor_inicial'];
					}

					echo "<div id='grid-conteudo'>
						<a href='criacaoidentidadevisual.php'><img src='imagens/figura/identidade-visual.png' id='servicos-imagens' alt='Criação de Identidade Visual'></a> <br>
						<div id='grid-informacao'>
							<a href='criacaoidentidadevisual.php' id='servicos-links'>Criação de Identidade Visual <br><br>
							A partir de R$ <span id='preco'>" . number_format($p3,2,",",".") . "</span> <br>
							10x de R$ " . number_format(($p3 / 10),2,",",".") . "</a>
						</div>
					</div>";
				}

				include "../class/socialmedia.class.php";
				//Consultoria Social Media
				$c1 = new Socialmedia();
				$c1->codigo_consultoria = 1;
				$res = $c1->Listar();
				if($res != "Falha ao listar")
				{
					foreach($res as $dado)
					{
						$p4 = $dado['valor_inicial'];
					}
					echo "<div id='grid-conteudo'>
						<a href='consultoriasocialmedia.php'><img src='imagens/figura/consultoria-social-media.png' id='servicos-imagens' alt='Consultoria Social Media'></a> <br>
						<div id='grid-informacao'>
							<a href='consultoriasocialmedia.php' id='servicos-links'>Consultoria Social Media <br><br>
							A partir de R$ <span id='preco'>" . number_format($p4,2,",",".") . "</span> <br>
							10x de R$ " . number_format(($p4 / 10),2,",",".") . "</a>
						</div>
					</div>";
				}
			?>
			</section>
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