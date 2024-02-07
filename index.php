<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link rel="stylesheet" href="view/css/estiloindex.css">
	<link rel="stylesheet" href="view/css/estilomenu.css">
	<link rel="icon" href="view/imagens/logotipo/logo-icone.png">
	<link rel="icon" href="view/imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>BNG Design</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> <!-- Fonte -->
	<script src='https://kit.fontawesome.com/a076d05399.js'></script> <!-- Ícone -->
	<script src="view/js/scriptjs.js"></script>
</head>
<body>
    <!-- ------------------------------------------------------- -->
	<!--                        Menu                             -->
	<!-- ------------------------------------------------------- -->

	<?php include "menu.php"; ?>
	
	<!-- ------------------------------------------------------- -->
	<!--         Banner da primeira parte (Desktop)          	 -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site"> <!-- Usado para site responsivo -->
		<div id="banner"> <!-- Parte onde fica o banner com anúncios -->
			<a href=""><img src="view/imagens/banner/banner.jpg" id="banner-imagem" alt="Slide 1"></a>
		</div>
	
	<!-- ------------------------------------------------------- -->
	<!--         Banner da primeira parte (Mobile)               -->
	<!-- ------------------------------------------------------- -->
		<div id="banner-mobile"> <!-- Parte onde fica o banner com anúncios -->
			<img src="view/imagens/banner-mobile/banner.jpg" id="banner-imagem" alt="Slide 1">
		</div>
	</section>
	<!-- ------------------------------------------------------- -->
	<!--               Anúncio abaixo dos banner                 -->
	<!-- ------------------------------------------------------- -->
		<div id="banner-anuncio">
			ANIMAÇÃO 3D, LOGOTIPO E MUITO MAIS
		</div>

	<!-- ------------------------------------------------------- -->
	<!--               Apresentação de serviços                  -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<section id="div">
			<section id="servicos">
			<?php
				include "class/servico.class.php";

				$s1 = new Servico();

				//Logotipo
				$s1->codigo_servico = 1;
				$res = $s1->Listar();
				foreach($res as $dado)
				{
					$p1 = $dado['valor_inicial'];
				}

				//Animação 3D
				$s1->codigo_servico = 2;
				$res = $s1->Listar();
				foreach($res as $dado)
				{
					$p2 = $dado['valor_inicial'];
				}

				//Criação de identidade visual
				$s1->codigo_servico = 3;
				$res = $s1->Listar();
				foreach($res as $dado)
				{
					$p3 = $dado['valor_inicial'];
				}

				//Consultoria Social Media
				$c1 = new Servico();
				$c1->codigo_servico = 1;
				$res = $c1->Listar();
				foreach($res as $dado)
				{
					$p4 = $dado['valor_inicial'];
				}
				
				echo "<div id='grid-conteudo'>
					<a href='view/logotipo.php'><img src='view/imagens/figura/logotipo.png' id='servicos-imagens' alt='Animação 3D'></a> <br>
					<div id='grid-informacao'>
						<a href='view/logotipo.php' id='servicos-links'>Logotipo <br><br>
						A partir de R$ <span id='preco'>" . number_format($p1,2,",",".") . "</span> <br>
						10x de R$ " . number_format(($p1 / 10),2,",",".") . "</a>
					</div>
				</div>
				<div id='grid-conteudo'>
					<a href='view/animacaotd.php'><img src='view/imagens/figura/animacao-3d.png' id='servicos-imagens' alt='Animação 3D'></a> <br>
					<div id='grid-informacao'>
						<a href='view/animacaotd.php' id='servicos-links'>Animação 3D <br><br>
						A partir de R$ <span id='preco'>" . number_format($p2,2,",",".") . "</span> <br>
						10x de R$ " . number_format(($p2 / 10),2,",",".") . "</a>
					</div>
				</div>
				<div id='grid-conteudo'>
					<a href='view/criacaoidentidadevisual.php'><img src='view/imagens/figura/identidade-visual.png' id='servicos-imagens' alt='Criação de Identidade Visual'></a> <br>
					<div id='grid-informacao'>
						<a href='view/criacaoidentidadevisual.php' id='servicos-links'>Criação de Identidade Visual <br><br>
						A partir de R$ <span id='preco'>" . number_format($p3,2,",",".") . "</span> <br>
						10x de R$ " . number_format($p3,2,",",".") . "</a>
					</div>
				</div>";
			?>
			</section>
		</section>
	</section>

	<!-- ------------------------------------------------------- -->
	<!--         Quadro informativo Saiba como funciona          -->
	<!-- ------------------------------------------------------- -->
	<section id="informacoes-saiba-como-funciona">
		<section id="conteudo-site">
			<div id="informacoes-conteudo">
				<img src="view/imagens/figura/explicacao.png" id="informacoes-imagem-saiba-como-funciona" title="Dúvidas" alt="Imagem de explicação">
				<div id="informacoes-texto">
					<h1 id="texto-maior">Serviço rápido, atualizado e sem letrinhas pequenas.</h1>
					<p id="texto-menor">Aqui você pode se informar como são desenvolvidos os projetos antes mesmo de contratar, desde a compra do serviço até a finalização dele.</p>
					<a href="view/saiba-como-funciona.php" id="informacoes-link-saiba-como-funciona">Saiba como funciona</a>
				</div>
			</div>
		</section>
	</section>
	
	<!-- ------------------------------------------------------- -->
	<!--            Quadro informativo Fale Conosco              -->
	<!-- ------------------------------------------------------- -->
	<section id="informacoes">
		<section id="conteudo-site">
			<div id="informacoes-conteudo">
				<div id="informacoes-texto">
					<h1 id="texto-maior">Do começo ao fim do serviço, você fica sabendo como funciona antes de contratar.</h1>
					<p id="texto-menor">Caso você tenha alguma dúvida, envie-nos um e-mail e tire sua dúvida.</p>
					<a href="view/fale-conosco.php" id="informacoes-link">Fale conosco</a>
				</div>
				<img src="view/imagens/figura/duvida.png" id="informacoes-imagem" title="Dúvidas" alt="Imagem de dúvida">
			</div>
		</section>
	</section>
	
	<!-- ------------------------------------------------------- -->
	<!--                        Rodapé                           -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<footer id="rodape">
			<div id="rodape-logo">
				<img src="view/imagens/logotipo/logo-roxo.png" id="rodape-logo-imagem" alt="BNG Design">
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