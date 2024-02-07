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
	<link rel="stylesheet" href="../css/pcontrole/estilopcontrolealteracaodois.css">
	<link rel="stylesheet" href="../css/estilomenu.css">
	<link rel="icon" href="../imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Alteração - BNG Design</title>
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
			<h1 id="titulo">ALTERAÇÃO DE SENHA</h1>
		</section>
	</section>

	<!-- ------------------------------------------------------- -->
	<!--                   Botão Voltar                          -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<section id="div">
			<div id="menu-vertical"> <!-- Links para as páginas do site (Desktop) -->
				<a href="pcontrole.php" id="menu-vertical-link"><i class="fas fa-arrow-left" id="icone-voltar" style="margin-right: 5px;"></i> VOLTAR</a>
			</div>

	<!-- ------------------------------------------------------- -->
	<!--                     Alteração                           -->
	<!-- ------------------------------------------------------- -->
			<form action="../../app/profissional.app.php" method="post">
				<h2 id="titulo-grande">Aqui é possível fazer a alteração da sua senha.
				</h2> <br>
				<input type="hidden" name="codigo_profissional" value="<?php echo $_SESSION['codigo_profissional'] ?>">
	 <!-- Senha Atual -->
			 	<label for="senhaatual" id="form-label">Sua senha atual</label> <br> <input type="password" name="senhaatual" id="senhaatual" required>
    <!-- Senha -->
				<label for="senha" id="form-label">Senha</label> <br> <input type="password" name="senha" id="senha" maxlength="256" required>
	<!-- Confirmar Senha -->
				<label for="confirmarsenha" id="form-label">Confirmar Senha</label> <br> <input type="password" name="confirmarsenha" id="confirmarsenha" maxlength="256" onblur="confereSenha()" required>
				<input type="submit" name="submit" id="submit" value="Alterar Senha">
			</form>
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