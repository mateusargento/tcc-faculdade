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
	<link rel="stylesheet" href="../css/pcontrole/estilopcontrolelistarservicos.css">
	<link rel="stylesheet" href="../css/estilomenu.css">
	<link rel="icon" href="../imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Listar Serviços - BNG Design</title>
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
			<h1 id="titulo">LISTAR SERVIÇOS</h1>
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
				<h2 id="titulo-grande">Aqui você pode alterar o valor do seu serviço e decidir se ele está disponível para novas solicitações.</h2><br>
				<div id="table">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>SERVIÇO</th>
                        <th>VALOR INICIAL</th>
                        <th>SERVIÇO ATIVO?</th>
                        <th>CONFIRMAR</th>
                    </tr>
					<?php
						include "../../class/servico.class.php";
						include "../../class/socialmedia.class.php";

						$s1 = new Servico;
						$c1 = new Socialmedia;

						$res = $s1->ListarTodos();
						$i = 0;
						$cont = 1;

						foreach($res as $dados)
						{
							echo "<form action='../../app/servico.app.php' method='post'>
							<tr>
								<td>". $cont ."</td>
								<input type='hidden' name='codigo_servico' value='" . $dados['codigo_servico'] . "'>
								<td>" . $dados['tipo'] . "</td>
								<td>
									<input type='text' name='valor' id='select' value=" . number_format($dados['valor_inicial'],2,".","") . " style='text-align: center;'>
								</td>
								<td>";
									if($dados['disponibilidade'] == 'S')
									{
										echo "<select name='disponibilidade' id='select'>
											<option value='S' selected>Sim</option>
											<option value='N'>Não</option>
										</select>";
									}
									if($dados['disponibilidade'] == 'N')
									{
										echo "<select name='disponibilidade' id='select'>
											<option value='S'>Sim</option>
											<option value='N' selected>Não</option>
										</select>";
									}
								echo "</td>
								<td>
									<input type='submit' id='submit' name='submit' value='Alterar'>
								</td>
							</tr>
							</form>";
							$i ++;
							$cont ++;
						}

						$res = $c1->ListarTodos();
						$i = 0;
						$cont = 1;

						foreach($res as $dados)
						{
							echo "<form action='../../app/socialmedia.app.php' method='post'>
							<tr>
								<td>". $cont ."</td>
								<input type='hidden' name='codigo_consultoria' value='" . $dados['codigo_consultoria'] . "'>
								<td>" . $dados['tipo'] . "</td>
								<td>
									<input type='text' name='valor' id='select' value=" . number_format($dados['valor_inicial'],2,".","") . " style='text-align: center;'>
								</td>
								<td>";
									if($dados['disponibilidade'] == 'S')
									{
										echo "<select name='disponibilidade' id='select'>
											<option value='S' selected>Sim</option>
											<option value='N'>Não</option>
										</select>";
									}
									if($dados['disponibilidade'] == 'N')
									{
										echo "<select name='disponibilidade' id='select'>
											<option value='S'>Sim</option>
											<option value='N' selected>Não</option>
										</select>";
									}
								echo "</td>
								<td>
									<input type='submit' id='submit' name='submit' value='Alterar'>
								</td>
							</tr>
							</form>";
							$i ++;
							$cont ++;
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