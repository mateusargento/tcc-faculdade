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
	<link rel="stylesheet" href="../css/pcontrole/estilopcontrole.css">
	<link rel="stylesheet" href="../css/estilomenu.css">
	<link rel="icon" href="../imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>P Controle - BNG Design</title>
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
			<h1 id="titulo">PAINEL DE CONTROLE</h1>
		</section>
	</section>

    <!-- ------------------------------------------------------- -->
	<!--               Apresentação de serviços                  -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<section id="div">
			<section id="funcoes">
				<div id="grid-conteudo">
					<a href="meus-trabalhos.php"><img src="../imagens/figura/carrinho.png" id="funcoes-imagens" alt="Carrinho de compras"></a> <br>
					<div id="grid-informacao">
						<a href="meus-trabalhos.php" id="funcoes-links">Meus Trabalhos</a>
					</div>
				</div>
				<div id="grid-conteudo">
					<a href="listar-servicos.php"><img src="../imagens/figura/lista.png" id="funcoes-imagens" alt="Lista"></a> <br>
					<div id="grid-informacao">
						<a href="listar-servicos.php" id="funcoes-links">Listar Serviços</a>
					</div>
				</div>
				<!-- <div id="grid-conteudo">
					<a href="alteracao-anuncio.php"><img src="../imagens/figura/anuncio.png" id="funcoes-imagens" alt="Megafone"></a> <br>
					<div id="grid-informacao">
						<a href="alteracao-anuncio.php" id="funcoes-links">Alterar Anúncio Inicial</a>
					</div>
				</div> -->
				<div id="grid-conteudo">
					<a href="usuarios-cadastrados.php"><img src="../imagens/figura/usuarios.png" id="funcoes-imagens" alt="Usuários"></a> <br>
					<div id="grid-informacao">
						<a href="usuarios-cadastrados.php" id="funcoes-links">Usuários Cadastrados</a>
					</div>
				</div>
				<div id="grid-conteudo">
					<a href="mensagens.php"><img src="../imagens/figura/mensagem.png" id="funcoes-imagens" alt="Mensagens"></a> <br>
					<div id="grid-informacao">
						<a href="mensagens.php" id="funcoes-links">Mensagens</a>
					</div>
				</div>
				<!-- <div id="grid-conteudo">
					<a href="alteracao-imagens.php"><img src="../imagens/figura/imagem.png" id="funcoes-imagens" alt="Imagem"></a> <br>
					<div id="grid-informacao">
						<a href="alteracao-imagens.php" id="funcoes-links">Alterar Imagens</a>
					</div>
                </div> -->
				<div id="grid-conteudo">
					<a href="alteracao.php"><img src="../imagens/figura/dados.png" id="funcoes-imagens" alt="Alterando dados"></a> <br>
					<div id="grid-informacao">
						<a href="alteracao.php" id="funcoes-links">Meus Dados Cadastrais</a>
					</div>
				</div>
                <div id="grid-conteudo">
					<a href="alteracao-dois.php">
                    <img src="../imagens/figura/senha.png" id="funcoes-imagens" alt="Chave"></a> <br>
					<div id="grid-informacao">
						<a href="alteracao-dois.php" id="funcoes-links">Minha Senha</a>
					</div>
				</div>
				<div id="grid-conteudo">
					<a href="cartao_de_credito.php">
                    <img src="../imagens/figura/cartao-de-credito.png" id="funcoes-imagens" alt="Cartão de Crédito"></a> <br>
					<div id="grid-informacao">
						<a href="cartao_de_credito.php" id="funcoes-links">Pagamentos Cartão de Crédito</a>
					</div>
				</div>
				<div id="grid-conteudo">
					<a href="relatorios.php">
                    <img src="../imagens/figura/relatorio.png" id="funcoes-imagens" alt="Relatorio"></a> <br>
					<div id="grid-informacao">
						<a href="relatorios.php" id="funcoes-links">Relatórios</a>
					</div>
                </div>
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