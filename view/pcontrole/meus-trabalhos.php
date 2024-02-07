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
	<link rel="stylesheet" href="../css/pcontrole/estilopcontrolemeustrabalhos.css">
	<link rel="stylesheet" href="../css/estilomenu.css">
	<link rel="icon" href="../imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Meus Trabalhos - BNG Design</title>
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
			<h1 id="titulo">MEUS TRABALHOS</h1>
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
				<h2 id="titulo-grande">Aqui você encontra todos os serviços contratados e pode alterar o status dos serviços.</h2><br>
				<!-- Tabela com dados dos clientes -->
				<form action="meus-trabalhos.php" method="post" id="form-pesquisa">
					<input type="search" name="filtro" id="pesquisa" placeholder="Pesquise por ID, Serviço ou E-mail do cliente">
					<input type="submit" id="botao-pesquisa" value="Pesquisar">
				</form>
				<div id="table">
				<table>
					<tr>
						<th>ID</th>
						<th>SERVIÇO</th>
                        <th>VALOR</th>
						<th>ID PEDIDO JUNTO</th>
						<th>CÓDIGO CLIENTE</th>
						<th>QUEM PEDIU</th>
						<th>STATUS</th>
                        <th>MAIS DETALHES</th>
						<th>CONFIRMAR</th>
					</tr>
				<?php
					include "../../class/pedido.class.php";

					$c1 = new Pedido();
					if($_POST) { $c1->codigo_pedido = $_POST['filtro']; }
					$res = $c1->ListarTodosClienteFisico();

					$c2 = new Pedido();
					if($_POST) { $c2 ->codigo_pedido = $_POST['filtro']; }
					$res2 = $c2->ListarTodosClienteJuridico();
					
					$i = 1;
					if($res != "Sem pedidos cadastrados")
					{
						foreach($res as $dados)
						{
							$codigo_pedido = $dados['codigo_pedido'];
							$tipo_servico = $dados['tipo'];
							$valor_total = $dados['valor_total'];
							$status = $dados['status'];
							$nome_do_negocio = $dados['nome_do_negocio'];
							$ramo_de_atuacao = $dados['ramo_de_atuacao'];
							$caracteristica = $dados['p1_tipo'];
							$tipo = $dados['p2_tipo'];
							$prazo = $dados['p3_tipo'];
							$data_pedido = $dados['data_pedido'];
							$data_de_entrega = $dados['data_entrega'];
							$quantidade = $dados['quantidade'];
							$descricao = $dados['descricao'];
							$forma_pagamento = $dados['forma_pagamento'];
							$id_pedido_junto = $dados['id_pedido_junto'];
							$codigo_cliente = $dados['codigo_cliente_fisico_fk'];
							$nome = $dados['nome'];
							$sobrenome = $dados['sobrenome'];
							$email = $dados['email'];


							echo "<form action='../../app/pedido.app.php' method='post'>
								<tr>
									<td>" . $codigo_pedido . "</td>
									<td>" . $tipo_servico . "</td>
									<td>R$ " . number_format($valor_total,2,",",".") . "</td>
									<td>" . $id_pedido_junto . "</td>
									<td>" . $codigo_cliente . "</td>
									<td>" . $nome . " " . $sobrenome . "</td>
									<td>
									<select name='status' id='select'>";
										switch ($status)
										{
											case 'Pedido realizado':
												echo "<option value='Pedido realizado' selected>Pedido realizado</option>
												<option value='Pagamento aprovado'>Pagamento aprovado</option>
												<option value='Pedido reprovado'>Pedido reprovado</option>
												<option value='Pedido em produção'>Pedido em produção</option>
												<option value='Entregue'>Entregue</option>
												<option value='Pedido cancelado'>Pedido cancelado</option>";
											break;
											case 'Pagamento aprovado':
												echo "<option value='Pedido realizado'>Pedido realizado</option>
												<option value='Pagamento aprovado' selected>Pagamento aprovado</option>
												<option value='Pedido reprovado'>Pedido reprovado</option>
												<option value='Pedido em produção'>Pedido em produção</option>
												<option value='Entregue'>Entregue</option>
												<option value='Pedido cancelado'>Pedido cancelado</option>";
											break;
											case 'Pedido reprovado':
												echo "<option value='Pedido realizado'>Pedido realizado</option>
												<option value='Pagamento aprovado'>Pagamento aprovado</option>
												<option value='Pedido reprovado' selected>Pedido reprovado</option>
												<option value='Pedido em produção'>Pedido em produção</option>
												<option value='Pedido finalizado'>Pedido finalizado</option>
												<option value='Entregue'>Entregue</option>
												<option value='Pedido cancelado'>Pedido cancelado</option>";
											break;
											case 'Pedido em produção':
												echo "<option value='Pedido realizado'>Pedido realizado</option>
												<option value='Pagamento aprovado'>Pagamento aprovado</option>
												<option value='Pedido reprovado'>Pedido reprovado</option>
												<option value='Pedido em produção' selected>Pedido em produção</option>
												<option value='Entregue'>Entregue</option>
												<option value='Pedido cancelado'>Pedido cancelado</option>";
											break;
											case 'Entregue':
												echo "<option value='Pedido realizado'>Pedido realizado</option>
												<option value='Pagamento aprovado'>Pagamento aprovado</option>
												<option value='Pedido reprovado'>Pedido reprovado</option>
												<option value='Pedido em produção'>Pedido em produção</option>
												<option value='Entregue' selected>Entregue</option>
												<option value='Pedido cancelado'>Pedido cancelado</option>";
											break;
											case 'Pedido cancelado':
												echo "<option value='Pedido realizado'>Pedido realizado</option>
												<option value='Pagamento aprovado'>Pagamento aprovado</option>
												<option value='Pedido reprovado'>Pedido reprovado</option>
												<option value='Pedido em produção'>Pedido em produção</option>
												<option value='Entregue'>Entregue</option>
												<option value='Pedido cancelado' selected>Pedido cancelado</option>";
											break;
										}
									echo "</select>
									</td>
									<td style='cursor: pointer;' onclick=exibirQuestao('q" . $i . "')><span id='q" . $i . "1'>Exibir +</span></td>
									</td>
									<input type='hidden' name='id_pedido_junto' value='" . $id_pedido_junto . "'>
									<td><input type='submit' name='submit' id='submit' value='Alterar'></td>
								</tr>";
							// Descrição -->
								echo "<tr>
									<td colspan='10' id='q" . $i . "' style='background: #f2f2f2; display: none; text-align: left;'>
										<ul id='ul-detalhes'>
											<li id='li'>Nome do negócio: " . $nome_do_negocio . "</li>
											<li id='li'>Ramo de atuação: " . $ramo_de_atuacao . "</li>
											<li id='li'>Característica: " . $caracteristica . "</li>
											<li id='li'>Tipo: " . $tipo . "</li>
											<li id='li'>Prazo: " . $prazo . "</li>
											<li id='li'>Data do pedido: " . $data_pedido . "</li>";
											if($tipo_servico == "Consultoria Social Media")
											{
												echo "<li id='li'>Até: " . $data_de_entrega . "</li>";
											}
											else
											{
												echo "<li id='li'>Data de entrega: " . $data_de_entrega . "</li>";
											}
											echo "<li id='li'>Quantidade: " . $quantidade . "</li>
											<li id='li'>Descrição: " . $descricao . "</li>";
											if($forma_pagamento == "bb")
											{
												echo "<li id='li'>Forma de pagamento: Boleto bancário</li>";
											}
											elseif($forma_pagamento == "cc")
											{
												echo "<li id='li'>Forma de pagamento: Cartão de crédito</li>";
											}
											echo "<li id='li'>Tipo de cliente: Pessoa Física</li>
											<li id='li'>E-mail: " . $email . "</li>
										</ul>
									</td>
								</tr>
								</form>";
							$i ++;
						}
					}
					if($res2 != "Sem pedidos cadastrados")
					{
						foreach($res2 as $dados)
						{
							$codigo_pedido = $dados['codigo_pedido'];
							$tipo_servico = $dados['tipo'];
							$valor_total = $dados['valor_total'];
							$status = $dados['status'];
							$nome_do_negocio = $dados['nome_do_negocio'];
							$ramo_de_atuacao = $dados['ramo_de_atuacao'];
							$caracteristica = $dados['p1_tipo'];
							$tipo = $dados['p2_tipo'];
							$prazo = $dados['p3_tipo'];
							$data_pedido = $dados['data_pedido'];
							$data_de_entrega = $dados['data_entrega'];
							$quantidade = $dados['quantidade'];
							$descricao = $dados['descricao'];
							$id_pedido_junto = $dados['id_pedido_junto'];
							$codigo_cliente = $dados['codigo_cliente_juridico_fk'];
							$nome_fantasia = $dados['nome_fantasia'];
							$razao_social = $dados['razao_social'];
							$email = $dados['email'];


							echo "<tr>
									<td>" . $codigo_pedido . "</td>
									<td>" . $tipo_servico . "</td>
									<td>R$ " . number_format($valor_total,2,",",".") . "</td>
									<td>" . $id_pedido_junto . "</td>
									<td>" . $codigo_cliente . "</td>
									<td>" . $nome_fantasia . " <br> " . $razao_social . "</td>
									<td>
									<select name='status' id='select'>";
										switch ($status)
										{
											case 'Pedido realizado':
												echo "<option value='Pedido realizado' selected>Pedido realizado</option>
												<option value='Pagamento aprovado'>Pagamento aprovado</option>
												<option value='Pedido reprovado'>Pedido reprovado</option>
												<option value='Pedido em produção'>Pedido em produção</option>
												<option value='Entregue'>Entregue</option>
												<option value='Pedido cancelado'>Pedido cancelado</option>";
											break;
											case 'Pagamento aprovado':
												echo "<option value='Pedido realizado'>Pedido realizado</option>
												<option value='Pagamento aprovado' selected>Pagamento aprovado</option>
												<option value='Pedido reprovado'>Pedido reprovado</option>
												<option value='Pedido em produção'>Pedido em produção</option>
												<option value='Entregue'>Entregue</option>
												<option value='Pedido cancelado'>Pedido cancelado</option>";
											break;
											case 'Pedido reprovado':
												echo "<option value='Pedido realizado'>Pedido realizado</option>
												<option value='Pagamento aprovado'>Pagamento aprovado</option>
												<option value='Pedido reprovado' selected>Pedido reprovado</option>
												<option value='Pedido em produção'>Pedido em produção</option>
												<option value='Pedido finalizado'>Pedido finalizado</option>
												<option value='Entregue'>Entregue</option>
												<option value='Pedido cancelado'>Pedido cancelado</option>";
											break;
											case 'Pedido em produção':
												echo "<option value='Pedido realizado'>Pedido realizado</option>
												<option value='Pagamento aprovado'>Pagamento aprovado</option>
												<option value='Pedido reprovado'>Pedido reprovado</option>
												<option value='Pedido em produção' selected>Pedido em produção</option>
												<option value='Entregue'>Entregue</option>
												<option value='Pedido cancelado'>Pedido cancelado</option>";
											break;
											case 'Entregue':
												echo "<option value='Pedido realizado'>Pedido realizado</option>
												<option value='Pagamento aprovado'>Pagamento aprovado</option>
												<option value='Pedido reprovado'>Pedido reprovado</option>
												<option value='Pedido em produção'>Pedido em produção</option>
												<option value='Entregue' selected>Entregue</option>
												<option value='Pedido cancelado'>Pedido cancelado</option>";
											break;
											case 'Pedido cancelado':
												echo "<option value='Pedido realizado'>Pedido realizado</option>
												<option value='Pagamento aprovado'>Pagamento aprovado</option>
												<option value='Pedido reprovado'>Pedido reprovado</option>
												<option value='Pedido em produção'>Pedido em produção</option>
												<option value='Entregue'>Entregue</option>
												<option value='Pedido cancelado' selected>Pedido cancelado</option>";
											break;
										}
									echo "</select>
									</td>
									<td style='cursor: pointer;' onclick=exibirQuestao('q" . $i . "')><span id='q" . $i . "1'>Exibir +</span></td>
									<input type='hidden' name='id_pedido_junto' value='" . $id_pedido_junto . "'>
									<td><input type='submit' name='submit' id='submit' value='Alterar'></td>
								</tr>";
							// Descrição -->
								echo "<tr>
									<td colspan='10' id='q" . $i . "' style='background: #f2f2f2; display: none; text-align: left;'>
										<ul id='ul-detalhes'>
											<li id='li'>Nome do negócio: " . $nome_do_negocio . "</li>
											<li id='li'>Ramo de atuação: " . $ramo_de_atuacao . "</li>
											<li id='li'>Característica: " . $caracteristica . "</li>
											<li id='li'>Tipo: " . $tipo . "</li>
											<li id='li'>Prazo: " . $prazo . "</li>
											<li id='li'>Data do pedido: " . $data_pedido . "</li>";
											if($tipo_servico == "Consultoria Social Media")
											{
												echo "<li id='li'>Até: " . $data_de_entrega . "</li>";
											}
											else
											{
												echo "<li id='li'>Data de entrega: " . $data_de_entrega . "</li>";
											}
											echo "<li>Quantidade: " . $quantidade . "</li>
											<li id='li'>Descrição: " . $descricao . "</li>
											<li id='li'>Tipo de cliente: Pessoa Jurídica</li>
											<li id='li'>E-mail: " . $email . "</li>
										</ul>
									</td>
								</tr>";
							$i ++;
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