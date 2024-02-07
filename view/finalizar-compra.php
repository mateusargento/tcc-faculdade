<?php
	session_start();

	if(!isset($_SESSION['nome']))
	{
		header('Location: login.php');
		die();
	}

	if($_POST) //Caso seja enviado algum formulário vindo das páginas de serviços
	{
		if(!isset($_SESSION['carrinho'])) //Caso seja o primeiro produto a ser colocado no carrinho
		{
			$_SESSION['carrinho'][1] = array( //Iniciar com 1 para funcionar corretamente
				"id" => 1, //Utilizado para o botão de excluir do carrinho funcionar
				"servico" => $_POST['servico'],
				"nome_do_negocio" => $_POST['nome_do_negocio'],
				"ramo_de_atuacao" => $_POST['ramo_de_atuacao'],
				"caracteristica" => $_POST['p1'],
				"tipo" => $_POST['p2'],
				"prazo" => $_POST['p3'],
				"quantidade" => $_POST['quantidade'],
				"descricao" => $_POST['descricao'],
				"preco_final" => $_POST['preco_final'],
				"url_foto" => $_POST['url_foto']
			);
			header("Location: carrinho.php");
		}
		else //Se não, ou seja, for o segundo ou algum depois disso
		{
			$n = 1; //Número a somar no sizeof, para incluir o serviço no carrinho depois do último que foi inserido
			$existe = true; //Verifica se esse valor do array já está preenchido
			while($existe == true)
			{
				$sizeof = (sizeof($_SESSION['carrinho']) + $n);
				if(isset($_SESSION['carrinho'][$sizeof])) //Se o valor já estiver preenchido
				{
					$n ++; //Soma mais um a variável para que possa somar mais +2 e assim sucessivamente no sizeof até achar um espaço disponível
				}
				else //Se o valor espaço do array não estiver preenchido
				{
					$existe = false; //Informa que não existem dados no espaço do array e sai do while (loop)
				}
			}

			$_SESSION['carrinho'][$sizeof] = array( //Preenche o serviço no espaço disponível encontrado no array
				"id" => $sizeof, //Utilizado para o botão de excluir do carrinho funcionar
				"servico" => $_POST['servico'],
				"nome_do_negocio" => $_POST['nome_do_negocio'],
				"ramo_de_atuacao" => $_POST['ramo_de_atuacao'],
				"caracteristica" => $_POST['p1'],
				"tipo" => $_POST['p2'],
				"prazo" => $_POST['p3'],
				"quantidade" => $_POST['quantidade'],
				"descricao" => $_POST['descricao'],
				"preco_final" => $_POST['preco_final'],
				"url_foto" => $_POST['url_foto']
			);
			header("Location: carrinho.php");
		}
	}
	if($_GET)
	{
		$get = $_GET['removeritem'];
		unset($_SESSION['carrinho'][$get]);
		header("Location: carrinho.php");
	}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link rel="stylesheet" href="css/estilofinalizarcompra.css">
	<link rel="stylesheet" href="css/estilomenu.css">
	<link rel="icon" href="imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Carrinho - BNG Design</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> <!-- Fonte -->
	<script src='https://kit.fontawesome.com/a076d05399.js'></script> <!-- Ícone -->
    <script>
		var width = window.screen.width
		if(width <= 992)
		{
			var imported = document.createElement('script');
			imported.src = 'js/scriptjsmobile.js';
			document.head.appendChild(imported); 
		}
		else
		{
			var imported = document.createElement('script');
			imported.src = 'js/scriptjs.js';
			document.head.appendChild(imported); 
		}
	</script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
	<script src="js/plugin-viacep.js"></script>
	<script>
		//Pessoa física e geral
		$('#numerocartao').mask("0000 0000 0000 0000");
		$('#datadevencimento').mask("00/00");
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
	<section id="div-titulo">
		<section id="conteudo-site">
			<h1 id="titulo">FINALIZAR COMPRA</h1>
		</section>
	</section>

	<!-- ------------------------------------------------------- -->
	<!--                  Finalizar Compra                       -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<section id="conteudo">
			<table>
				<tr>
					<th></th>
					<th></th>
					<th>Serviço</th>
					<th>Valor final</th>
					<th>Mais detalhes</th>
				</tr>
				<?php
				$valortotal = 0;
				$parcelas = 0;
				if(isset($_SESSION['carrinho']))
				{
					$cont = 1;
					$i = 0;
					$session = $_SESSION['carrinho'];
					foreach($session as $dados)
					{
						echo "<tr>
							<td>". $cont ."</td>
							<td style='width: 10%;'>
								<img src='" . $dados['url_foto'] . "' width='70%' id='foto'>
								</td>
							<td>Logotipo</td>
							<td>R$ " . number_format($dados['preco_final'],2,",",".") . "</td>
							</td>
							<td style='cursor: pointer;' onclick=exibirQuestao('q" . ($i+1) . "')>
								<span id='q" . ($i+1) . "1'>Exibir +</span></td>
						</tr>
						
						<tr>
							<td colspan='8' id='q". ($i+1) ."' style='background: #f2f2f2; display: none; text-align: left;'>
								<ul>
									<li id='li'>Nome do negócio: " . $dados['nome_do_negocio'] . "</li>
									<li id='li'>Ramo de atuação: " .  $dados['ramo_de_atuacao'] . "</li>
									<li id='li'>Característica: " .  $dados['caracteristica'] . "</li>
									<li id='li'>Tipo: " .  $dados['tipo'] . "</li>
									<li id='li'>Prazo: " .  $dados['prazo'] . "</li>
									<li id='li'>Quantidade: " .  $dados['quantidade'] . "</li>
									<li id='li'>Descrição: " .  $dados['descricao'] . "</li>
								</ul>
							</td>
						</tr>";
						$cont ++;
						$i ++;
						$valortotal += $dados['preco_final'];
					}
					$parcelas = $valortotal / 10;
				}
				?>
            </table>
        
        <!-- Pessoa física e Pessoa jurídica -->
            <form action="../app/pedido.app.php" method="post">
                <h2 id="titulo-grande">Para finalizar a compra, escolha a forma de pagamento e finalize a compra.</h2> <br>
                <div id="dividir-para-dois-formularios">
                    <div id="dividir-para-dois-formularios-lado-esquerdo">
                        <input type="radio" name="tipodepagamento" id="cartaodecredito" value="cartaodecredito" onchange="cartaoDeCredito()" checked><label for="cartaodecredito" id="form-label-cartao-de-credito">Cartão de Crédito</label>
                    </div>
                    <div id="dividir-para-dois-formularios-lado-direito">
                        <input type="radio" name="tipodepagamento" id="boletobancario" value="boletobancario" onchange="boletoBancario()"><label for="boletobancario" id="form-label-boleto-bancario">Boleto Bancário</label>
                    </div>
                </div>
                <label for="tipodecadastro-mobile" id="form-label-tipodecadastro">Tipo de Cadastro</label> 
                <select id="tipodecadastro-mobile" name="tipodecadastro-mobile" onchange="cadastroMobile()">
                    <option value="pessoafisica">Pessoa Física</option>
                    <option value="pessoajuridica">Pessoa Jurídica</option>
                </select>
        <!-- Nome no cartão e Número do cartão -->
                <div id="dividir-para-dois-formularios">
                    <div id="dividir-para-dois-formularios-lado-esquerdo">
                        <label for="nomecartao" id="form-label">Nome no cartão</label> <br> <input type="text" name="nomecartao" id="nomecartao" maxlength="70" required>
                    </div>
                    <div id="dividir-para-dois-formularios-lado-direito">
                        <label for="numerocartao" id="form-label">Número do cartão</label> <br> <input type="text" name="numerocartao" id="numerocartao" required>
                    </div>
                </div>
        <!-- Data de vencimento e CVV -->
                <div id="dividir-para-dois-formularios">
                    <div id="dividir-para-dois-formularios-lado-esquerdo">
                        <label for="datadevencimento" id="form-label">Data de Vencimento</label> <br> <input type="text" name="datadevencimento" id="datadevencimento" required>
                    </div>
                    <div id="dividir-para-dois-formularios-lado-direito">
                        <label for="cvv" id="form-label">CVV</label> <br> <input type="text" name="cvv" id="cvv" maxlength="60" required> 
                    </div>
                </div>
                <label for="parcelas" id="form-label-parcelas">Parcelas</label> <br> <select name="parcelas" id="parcelas">
                    <?php 
                        for ($i=1; $i<=10; $i++)
                        {
                            echo "<option value='" . $i . "'>" . $i . "X - R$ " . number_format($valortotal / $i,2,",",".") . "</option>";
                        }
                    ?>
                </select> <br>
				<?php
					if($quantidadeitensnocarrinho == 0)
					{
						echo "<input type='submit' name='submit' id='submit' value='Finalizar Compra' disabled>";
					}
					else
					{
						echo "<input type='submit' name='submit' id='submit' value='Finalizar Compra'>";
					}
				?>
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