<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link rel="stylesheet" href="css/estiloservico.css">
	<link rel="stylesheet" href="css/estilomenu.css">
	<link rel="icon" href="imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Consultoria Social Media - BNG Design</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> <!-- Fonte -->
	<script src='https://kit.fontawesome.com/a076d05399.js'></script> <!-- Ícone -->
	<script src="js/scriptjs.js"></script>
	<script src="js/precos.js"></script>
</head>
<body>
	<!-- ------------------------------------------------------- -->
	<!--                        Menu                             -->
	<!-- ------------------------------------------------------- -->

	<?php include "menu.php"; ?>
	
	<!-- ------------------------------------------------------- -->
	<!--               Apresentação do serviços                  -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<section id="div">
			<div id="servico">
				<img src="imagens/figura/consultoria-social-media.png" alt="Consultoria Social Media" id="servico-imagem"> <br>
				<div id="servico-informacao">
			<?php
				include "../class/socialmedia.class.php";

				$s1 = new Socialmedia;
	
				$resultado = $s1->ListarTodos();
				foreach ($resultado as $dados)
				{
					$codigo_consultoria = $dados['codigo_consultoria'];
					$tipo_servico = $dados['tipo'];
					$valor_inicial = $dados['valor_inicial'];
					$disponibilidade = $dados['disponibilidade'];
				}
			?>
					<h1 id="servico-texto"><?php echo $tipo_servico; ?> <br> 
					<span id="servico-preco-inicial">Preço inicial de R$ <?php echo number_format($valor_inicial,2,",","."); ?></span></h1> <br>
				</div>
			</div>
			<div id="servico-personalizacao">
				<h2 id="titulo-grande">Aqui você personaliza seu projeto, preencha <br> os campos e selecione as opções abaixo.</h2>
				<form action="carrinho.php" method="post">

			<!-- Nome do negócio -->
					<label for="nome_do_negocio" id="titulo-personalizacao">Nome do negócio:</label> <br> 
					<input type="text" name="nome_do_negocio" id="nome_do_negocio" maxlength="70" required> <br>

			<!-- Nome do negócio -->
					<label for="ramo_de_atuacao" id="titulo-personalizacao">Ramo de atuação:</label> <br> 
					<input type="text" name="ramo_de_atuacao" id="ramo_de_atuacao" maxlength="60" required> <br><br>

			<!-- Personalização 1 -->
					<label for="p1"><span id="titulo-personalizacao">Característica do serviço:</span></label><br>

			<?php
				include "../class/personalizacao.class.php";

				$p = new Personalizacao;
	
				$p->categoria = 'p1';
				$primeirainformacao = true;
				$resultado = $p->ListarConsultoriaSocialMedia();
				foreach ($resultado as $dados)
				{
					$tipo = $dados['tipo'];
					$valor = $dados['valor'];

					if($primeirainformacao == true)
					{
						echo "<label><input type='radio' name='p1' id='" . number_format($valor,2,".","") . "' value='" . $tipo . "' onchange=precosPersonaliza() required checked>" . $tipo . "(+ R$ " . number_format($valor,2,",",".") . ")</label> <br>";
					}
					else
					{
						echo "<label><input type='radio' name='p1' id='" . number_format($valor,2,".","") . "' value='" . $tipo . "' onchange=precosPersonaliza() required>" . $tipo . "(+ R$ " . number_format($valor,2,",",".") . ")</label> <br>";
					}
					$primeirainformacao = false;
				}
				echo "<br>";
			?>

			<!-- Personalização 2 -->		
					<label for="p2"><span id="titulo-personalizacao">O tipo de serviço:</span></label><br>

			<?php
				$p->categoria = 'p2';
				$primeirainformacao = true;
				$resultado = $p->ListarConsultoriaSocialMedia();
				foreach ($resultado as $dados)
				{
					$tipo = $dados['tipo'];
					$valor = $dados['valor'];

					if($primeirainformacao == true)
					{
						echo "<label><input type='radio' name='p2' id='" . number_format($valor,2,".","") . "' value='" . $tipo . "' onchange=precosPersonaliza() required checked>" . $tipo . "(+ R$ " . number_format($valor,2,",",".") . ")</label> <br>";
					}
					else
					{
						echo "<label><input type='radio' name='p2' id='" . number_format($valor,2,".","") . "' value='" . $tipo . "' onchange=precosPersonaliza() required>" . $tipo . "(+ R$ " . number_format($valor,2,",",".") . ")</label> <br>";
					}
					$primeirainformacao = false;
				}
				echo "<br>";
			?>

			<!-- Personalização 3 -->
					<label for="p3"><span id="titulo-personalizacao">Prazo:</span></label><br>

			<?php
				$p->categoria = 'p3';
				$primeirainformacao = true;
				$resultado = $p->ListarConsultoriaSocialMedia();
				foreach ($resultado as $dados)
				{
					$tipo = $dados['tipo'];
					$valor = $dados['valor'];

					if($primeirainformacao == true)
					{
						echo "<label><input type='radio' name='p3' id='" . number_format($valor,2,".","") . "' value='" . $tipo . "' onchange=precosPersonaliza() required checked>" . $tipo . "(+ R$ " . number_format($valor,2,",",".") . ")</label> <br>";
					}
					else
					{
						echo "<label><input type='radio' name='p3' id='" . number_format($valor,2,".","") . "' value='" . $tipo . "' onchange=precosPersonaliza() required>" . $tipo . "(+ R$ " . number_format($valor,2,",",".") . ")</label> <br>";
					}
					$primeirainformacao = false;
				}
				echo "<br>";
			?>

			<!-- Quantidade -->
					<label for="p4"><span id="titulo-personalizacao">Quantidade:</span></label><br>

					<select name="quantidade" id="p4" onchange="precosPersonaliza()">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select> <br><br>

			<!-- Descrição -->
					<label for="descricao" id="titulo-personalizacao">Agora descreva, com o máximo de detalhes, o seu projeto:</label><br><textarea name="descricao" id="text_area" rows="5" maxlength="200" required></textarea>
					<div id="preco_descricao">
						<h3 id="servico-texto">Preço com a personalização:</h3>
						<span id="preco">R$ <?php echo number_format($valor_inicial,2,",","."); ?></span> <br>
						<span id="numero_parcelas">ou 10x de <span id="parcela">R$ <?php echo number_format(($valor_inicial / 10),2,",","."); ?></span></span><br>
						<?php
							if($disponibilidade == 'S')
							{
								echo "<input type='submit' name='submit' id='submit' value='Comprar' onclick='precosPersonaliza()'>";
							}
							else
							{
								echo "<input type='submit' name='submit' id='submit' value='Indisponível' onclick='precosPersonaliza()' style='background-color: #707070' disabled>";
							}
						?>
					</div>

			<!-- Inputs utilizados para funcionar o Javascript, mudando o preço conforme opção -->
					<input type="hidden" name="codigo_consultoria" value="<?php echo $codigo_consultoria; ?>">
					<input type="hidden" id="preco_produto" value="<?php echo number_format($valor_inicial,2,".",""); ?>" readonly>
					<input type="hidden"  name="preco_final" id="preco_final" value="<?php echo number_format($valor_inicial,2,",","."); ?>">
					<input type="hidden" name="servico" value="Consultoria Social Media">
					<input type="hidden" name="url_foto" value="imagens/figura/consultoria-social-media.png">
				</form>
			</div>

	<!-- ------------------------------------------------------- -->
	<!--                Descrição do serviços                    -->
	<!-- ------------------------------------------------------- -->
			<div id="descricao">
				<hr>
				<h3 id="texto-grande">Descrição do serviço</h3>
				<p>Quer engajar seu público nas redes sociais mas não sabe como? Deixa com a BNG Design, o trabalho consiste em toda a parte de administração, posts e edição de fotos para postar.
				<ul id="ul-descricao">
					<li>Básico - Posts de cinco (5) em cinco (5) dias.</li>
					<li>Básico-Intermediário - Posts de três (3) em três (3) dias.</li>
					<li>Intermediário - Posts de dois (2) em dois (2) dias. Exceto final de semana.</li>
					<li>Avançado - Posts todos os dias, final de semana somente sábado.</li>
				</ul></p>

				<p>O tipo do serviço:
				<ul id="ul-descricao">
					<li>Facebook - Inclui textos e fotos.</li>
					<li>Twitter - Inclui textos e fotos.</li>
					<li>Instagram - Inclui fotos.</li>
					<li>Todos (Facebook, Twitter e Instagram) ou dois deles - Se você está em todas estas redes sociais, essa é a melhor opção.</li>
				</ul></p>

				<p>Prazo:
				É o tempo de duração da consultoria.</p>

				<p>Surgiu uma dúvida? Envia uma mensagem ou entre contato conosco pelo WhatsApp. <a href="fale-conosco.php" style="color: #660094;">Para isso clique aqui.</a></p>
			</div>
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