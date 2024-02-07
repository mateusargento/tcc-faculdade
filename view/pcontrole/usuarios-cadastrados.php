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
	<link rel="stylesheet" href="../css/pcontrole/estilopcontroleusuarioscadastrados.css">
	<link rel="stylesheet" href="../css/estilomenu.css">
	<link rel="icon" href="../imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Usuários Cadastrados - BNG Design</title>
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
			<h1 id="titulo">USUÁRIOS CADASTRADOS</h1>
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
				<h2 id="titulo-grande">Aqui você pode desativar a conta e visualizar um usuário.</h2><br>
                <!-- Tabela com dados dos clientes -->
                <form action="usuarios-cadastrados.php" method="post" id="form-pesquisa">
                    <input type="search" name="filtro" id="pesquisa" placeholder="Pesquise por ID, Nome, Razão Social ou E-mail">
                    <input type="submit" id="botao-pesquisa" value="Pesquisar">
				</form>
				<div id="table">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>E-MAIL</th>
						<th>CELULAR</th>
						<th>TIPO DE CLIENTE</th>
                        <th>CONTA ATIVA?</th>
                        <th>CONFIRMAR</th>
                    </tr>
				<?php
					include "../../class/clientefisico.class.php";

					$c1 = new Clientefisico;
					if($_POST) { $c1->nome = $_POST['filtro']; }
					$res = $c1->ListarTodosFiltro();

					include "../../class/clientejuridico.class.php";

					$c2 = new Clientejuridico;
					if($_POST) { $c2->razaosocial = $_POST['filtro']; }
					$res2 = $c2->ListarTodosFiltro();

			//Cliente Físico
					if($res != "Nenhum resultado encontrado")
					{
						foreach($res as $dados)
						{
							$codigo_cliente = $dados['codigo_cliente_fisico'];
							$nome = $dados['nome'];
							$sobrenome = $dados['sobrenome'];
							$email = $dados['email'];
							$celular = $dados['celular'];
							$ativo = $dados['ativo'];
							echo "<form action='../../app/clientepost.app.php' method='post'>
								<tr>
									<input type='hidden' name='tipodecadastro' value='pessoafisica'>
									<input type='hidden' name='codigo_cliente_fisico' value='" . $codigo_cliente . "'>
									<td>" . $codigo_cliente . "</td>
									<td>" . $nome . " " . $sobrenome . "</td>
									<td>" . $email . "</td>
									<td>" . $celular . "</td>
									<td>Pessoa Física</td>
									<td>
										<select name='conta-ativa' id='select'>";
											if($ativo == "S")
											{
												echo "<option value='S' selected>Sim</option>
												<option value='N'>Não</option>";
											}
											else
											{
												echo "<option value='S'>Sim</option>
												<option value='N' selected>Não</option>";
											}
										echo "</select>
									</td>
									<td>
										<input type='submit' name='submit' id='submit' value='Ativo'>
									</td>
								</tr>
							</form>";
						}
					}
			//Cliente Jurídico
					if($res2 != "Nenhum resultado encontrado")
					{
						foreach($res2 as $dados)
						{
							$codigo_cliente = $dados['codigo_cliente_juridico'];
							$razao_social = $dados['razao_social'];
							$nome_fantasia = $dados['nome_fantasia'];
							$email = $dados['email'];
							$celular = $dados['celular'];
							$ativo = $dados['ativo'];
							echo "<form action='../../app/clientepost.app.php' method='post'>
								<tr>
									<input type='hidden' name='tipodecadastro' value='pessoajuridica'>
									<input type='hidden' name='codigo_cliente_juridico' value='" . $codigo_cliente . "'>
									<td>" . $codigo_cliente . "</td>
									<td>" . $razao_social . " <br> " . $nome_fantasia . "</td>
									<td>" . $email . "</td>
									<td>" . $celular . "</td>
									<td>Pessoa Jurídica</td>
									<td>
										<select name='conta-ativa' id='select'>";
											if($ativo == "S")
											{
												echo "<option value='S' selected>Sim</option>
													<option value='N'>Não</option>";
											}
											else
											{
												echo "<option value='S'>Sim</option>
												<option value='N' selected>Não</option>";
											}
										echo "</select>
									</td>
									<td>
										<input type='submit' name='submit' id='submit' value='Ativo'>
									</td>
								</tr>
							</form>";
						}
					}
				?>
				</table>
				</div>
		    </section>
            <!-- ----------------------------------------------------------------------------------- -->
            <!-- ----------------------- FIM TRECHO APENAS PARA TESTE ------------------------------ -->
            <!-- ----------------------------------------------------------------------------------- -->
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