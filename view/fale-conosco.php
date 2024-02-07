<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link rel="stylesheet" href="css/estilofaleconosco.css">
	<link rel="stylesheet" href="css/estilomenu.css">
	<link rel="icon" href="imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Fale Conosco - BNG Design</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> <!-- Fonte -->
	<script src='https://kit.fontawesome.com/a076d05399.js'></script> <!-- Ícone -->
	<script src="js/scriptjs.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
	<script>
		//Pessoa física e geral
		$('#celular').mask("(00) 00000-0000");
	</script>
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
			<h2 id="titulo">FALE CONOSCO</h2>
		</div>
	</section>

	<!-- ------------------------------------------------------- -->
	<!--            Área de perguntas e respostas                -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<section id="div">
			<h2 id="titulo-grande">Aqui estão algumas perguntas frequentes com respostas.</h2> <br>
			<div id="pergunta"> <!-- Q1 -->
				<div id="pergunta-pergunta" onclick="exibirResposta('q1')">
					<h1 id="texto-grande"><span id="q11">+</span>Como posso pagar minha compra?</h1>
				</div>
				<div id="q1">
					<h2 id="texto-pequeno">Com o cartão de crédito em até 10x sem juros ou por boleto.</h2>
				</div>
			</div>
			<div id="pergunta"> <!-- Q2 -->
				<div id="pergunta-pergunta" onclick="exibirResposta('q2')">
					<h1 id="texto-grande"><span id="q21">+</span>O que eu devo fazer seu eu quiser uma alteração no meu projeto?</h1>
				</div>
				<div id="q2">
					<h2 id="texto-pequeno">Você precisa entrar em contato através do e-mail ou por WhatsApp.</h2>
				</div>
			</div>
			<div id="pergunta"> <!-- Q3 -->
				<div id="pergunta-pergunta" onclick="exibirResposta('q3')">
					<h1 id="texto-grande"><span id="q31">+</span>Existe algum desconto a partir de um valor?</h1>
				</div>
				<div id="q3">
					<h2 id="texto-pequeno">Não. Descontos ainda não são praticados.</h2>
				</div>
			</div>
		</section>

	<!-- ------------------------------------------------------- -->
	<!--            Área de perguntas e respostas                -->
	<!-- ------------------------------------------------------- -->
		<section id="div">
			<h2 id="titulo-grande">Você também pode entrar em contato conosco pelos nossos canais de comunicação. O atendimento fica disponível de segunda a sexta das 08:00h às 18:00h.</h2> <br>
			<h3 id="texto-grande"><i class="fab fa-whatsapp" id="fale-conosco-icones" style="margin-right: 5px; margin-left: 0px;"></i> (21) 98888-8888</h3>
			<h3 id="texto-grande"><i class="far fa-envelope" style="margin-right: 5px; margin-left: 0px;"></i>  bangubngdesign@gmail.com</h3>
		</section>

		<section id="div">
			<form action="../app/faleconosco.app.php" method="post">
				<h2 id="titulo-grande">Ainda não achou a resposta para sua pergunta? <br> Envie sua dúvida preenchendo os campos abaixo.</h2> <br>
				<label for="nome" id="form-label" >Nome completo</label> <br> <input type="text" name="nome" id="nome" maxlength="60" required> <br>
				<label for="email" id="form-label">Seu e-mail</label> <br> <input type="email" name="email" id="email" maxlength="60" required> <br>
				<label for="celular" id="form-label">Celular</label> <br> <input type="text" name="celular" id="celular" required> <br>
				<label for="assunto" id="form-label">Assunto</label> <br> <input type="text" name="assunto" id="assunto" maxlength="60" required> <br>
				<label for="duvida" id="form-label">Dúvida</label><br><textarea name="duvida" id="duvida" rows="10" maxlength="200" required></textarea>
				<input type="submit" name="submit" id="submit" value="Enviar">
			</form>
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