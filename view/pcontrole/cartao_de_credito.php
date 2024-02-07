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
	<link rel="stylesheet" href="../css/pcontrole/estilopcontrolecartaodecredito.css">
	<link rel="stylesheet" href="../css/estilomenu.css">
	<link rel="icon" href="../imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Cartão de Crédito - BNG Design</title>
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
			<h1 id="titulo">CARTÃO DE CRÉDITO</h1>
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
				<h2 id="titulo-grande">Aqui você encontra os dados do cartão de crédito usado na compra e altera o status do pagamento e serviço.</h2><br>
				<!-- Tabela com dados dos clientes -->
				<form action="cartao_de_credito.php" method="post" id="form-pesquisa">
					<input type="search" name="filtro" id="pesquisa" placeholder="Pesquise por ID, Total da compra ou Parcelas">
					<input type="submit" id="botao-pesquisa" value="Pesquisar">
				</form>
				<div id="table">
				<table>
					<tr>
						<th>ID</th>
                        <th>NOME NO CARTÃO</th>
                        <th>NÚMERO DO CARTÃO</th>
                        <th>CVV</th>
						<th>DATA DE VENCIMENTO</th>
						<th>TOTAL DA COMPRA</th>
						<th>PARCELAS</th>
						<th>STATUS</th>
						<th>ID PEDIDO JUNTO</th>
                        <th>CONFIRMAR</th>
					</tr>
					<?php
						include "../../class/cartao.class.php";

						$c1 = new Cartao();
						if($_POST) { $c1->codigo_cartao_de_credito = $_POST['filtro']; }
						$res = $c1->Listar();

						if($res != "Falha ao listar")
						{
							$cont = 1;
							foreach($res as $dados)
							{
								$codigo_cartao_de_credito = $dados['codigo_cartao_de_credito'];
								$nomecartao = openssl_decrypt($dados['nomecartao'],'aes-256-cfb8','senhaquecriamosparacriptografarosdados123@',0,'$fjkaE@sawh*86f9');
								$numerocartao = openssl_decrypt($dados['numerocartao'],'aes-256-cfb8','senhaquecriamosparacriptografarosdados123@',0,'$fjkaE@sawh*86f9');
								$datadevencimento = openssl_decrypt($dados['datadevencimento'],'aes-256-cfb8','senhaquecriamosparacriptografarosdados123@',0,'$fjkaE@sawh*86f9');
								$cvv = openssl_decrypt($dados['cvv'],'aes-256-cfb8','senhaquecriamosparacriptografarosdados123@',0,'$fjkaE@sawh*86f9');
								$valor_total_cartao = $dados['valor_total_cartao'];
								$parcelas = $dados['parcelas'];
								$status = $dados['status'];
								$id_pedido_junto = $dados['id_pedido_junto'];
								$codigo_pedido = $dados['codigo_pedido_fk'];

								echo "<form action='../../app/pedido.app.php' method='post'>
									<tr>
										<td>" . $codigo_cartao_de_credito . "</td>
										<td>" . $nomecartao . "</td>
										<td>" . $numerocartao . "</td>
										<td>" . $cvv	 . "</td>
										<td>" . $datadevencimento . "</td>
										<td>R$ " . number_format($valor_total_cartao,2,",",".") . "</td>
										<td>" . $parcelas . "</td>
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
										<td>" . $id_pedido_junto . "</td>
									</td>
										<td>
											<input type='hidden' name='id_pedido_junto' value='" . $id_pedido_junto  . "'>
											<input type='submit' name='submit' id='submit' value='Alterar'>
										</td>
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