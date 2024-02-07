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
	<link rel="stylesheet" href="../css/pcontrole/estilopcontrolemensagens.css">
	<link rel="stylesheet" href="../css/estilomenu.css">
	<link rel="icon" href="../imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Mensagens - BNG Design</title>
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
			<h1 id="titulo">MENSAGENS</h1>
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
				<h2 id="titulo-grande">Aqui você encontra todas as perguntas enviadas em forma de tickets.</h2><br>
				<!-- Tabela com dados dos clientes -->
				<form action="mensagens.php" method="post" id="form-pesquisa">
					<input type="search" name="filtro" id="pesquisa" placeholder="Pesquise por Ticket, Nome ou E-mail">
					<input type="submit" id="botao-pesquisa" value="Pesquisar">
				</form>
				<div id="table">
				<table>
					<tr>
						<th>TICKET</th>
						<th>NOME</th>
						<th>E-MAIL</th>
						<th>CELULAR</th>
						<th>ASSUNTO</th>
						<th>DÚVIDA</th>
						<th>RESPONDIDO?</th>
						<th>CONFIRMAR</th>
					</tr>
					<?php
						include "../../class/faleconosco.class.php";

						$fc1 = new FaleConosco();
						if($_POST) { $fc1->ticket = $_POST['filtro']; }
						$res = $fc1->Listar();

						if($res != "Falha ao listar")
						{
							$cont = 1;
							foreach($res as $dados)
							{
								$ticket = $dados['ticket'];
								$nome = $dados['nome'];
								$email = $dados['email'];
								$celular = $dados['celular'];
								$assunto = $dados['assunto'];
								$duvida = $dados['duvida'];
								$respondido = $dados['respondido'];

								echo "<form action='../../app/faleconosco.app.php' method='post'>
									<tr>
										<td>" . $ticket . "</td>
										<td>" . $nome . "</td>
										<td><a href='mailto:" . $email . "' id='email'>" . $email . "</a></td>
										<td>" . $celular . "</td>
										<td>" . $assunto . "</td>
										<td style='cursor: pointer;' onclick=exibirQuestao('q" . $cont . "')><span id='q" . $cont . "1'>Exibir +</span></td>
										<td>";
											if($respondido == 'N')
											{
												echo "<select name='respondido' id='select'>
													<option value='S'>Sim</option>
													<option value='N' selected>Não</option>
												</select>";
											}
											else
											{
												echo "<select name='respondido' id='select'>
													<option value='S' selected>Sim</option>
													<option value='N'>Não</option>
												</select>";
											}
										echo "</td>
										<td>
											<input type='hidden' name='ticket' value='" . $ticket . "'>
											<input type='submit' name='submit' id='submit' value='Alterar'>
										</td>
									</tr>";
								// Dúvida -->
									echo "<tr>
										<td colspan='8' id='q" . $cont . "' style='background: #f2f2f2; display: none;'>" . $duvida . "</td>
									</tr>
								</form>";

								$cont ++;
							}
						}
					?>
				</table>
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