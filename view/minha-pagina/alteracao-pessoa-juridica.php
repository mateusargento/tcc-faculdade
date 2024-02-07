<?php
	session_start();
	if(!isset($_SESSION['codigo_cliente_juridico']))
	{
		header('Location: ../login.php');
		die();
	}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link rel="stylesheet" href="../css/minha-pagina/estilominhapaginaalteracaopessoajuridica.css">
	<link rel="stylesheet" href="../css/estilomenu.css">
	<link rel="icon" href="../imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Alteração - BNG Design</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> <!-- Fonte -->
	<script src='https://kit.fontawesome.com/a076d05399.js'></script> <!-- Ícone -->
	<script src="../js/scriptjs.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
	<script src="../js/plugin-viacep.js"></script>
	<script>
		//Geral
		$('#celular').mask("(00) 00000-0000");
		$('#telefone').mask("(00) 0000-0000");
		$('#cep').mask("00000-000");

		//Pessoa jurídica
		$('#cnpj').mask("00.000.000/0000-00");
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
		<div id="conteudo-site">
			<h2 id="titulo">ALTERAÇÃO DE DADOS</h2>
		</div>
	</section>

	<!-- ------------------------------------------------------- -->
	<!--                  Menu do usuário                        -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<section id="div">
			<div id="menu-vertical"> <!-- Links para as páginas do site (Desktop) -->
				<ul id="menu-vertical-ul">
					<h2 id="texto-grande">MEUS DADOS</h2>
					<?php
						if(isset($_SESSION['codigo_cliente_fisico']))
						{
							echo "<li id='menu-vertical-li'><a href='../minha-pagina/alteracao.php' id='menu-vertical-link'>Alterar dados cadastrais</a></li>";
						}
						if(isset($_SESSION['codigo_cliente_juridico']))
						{
							echo "<li id='menu-vertical-li'><a href='../minha-pagina/alteracao-pessoa-juridica.php' id='menu-vertical-link'>Alterar dados cadastrais</a></li>";
						}
					?>
					<li id="menu-vertical-li"><a href="../minha-pagina/alteracao-dois.php" id="menu-vertical-link">Alterar senha</a></li> <br>
					<h2 id="texto-grande">MEUS PEDIDOS</h2>
					<li id="menu-vertical-li"><a href="../minha-pagina/compras.php" id="menu-vertical-link">Pedidos</a></li>
					<li id="menu-vertical-li"><a href="../minha-pagina/boleto.php" id="menu-vertical-link">Meus boletos</a></li>
				</ul>
			</div>

	<!-- ------------------------------------------------------- -->
	<!--                     Alteração                           -->
	<!-- ------------------------------------------------------- -->
			<form action="../../app/clientepost.app.php" method="post">
				<h2 id="titulo-grande">Aqui é possível fazer a alteração dos seus dados cadastrais.</h2> <br>
	<!-- 
		* A div 'dividir-para-dois-formularios' é usada para que possam haver 2 (dois) inputs na mesma linha,
		* A div 'dividir-para-dois-formularios-lado-esquerdo' comportará o label e o input que ficará no lado esquerdo
		* A div 'dividir-para-dois-formularios-lado-direito' comportará o label e o input que ficará no lado direito 
	-->
	<!-- Razão Social e Nome fantasia CADASTRO PESSOA JURÍDICA -->
			<?php
				include "../../class/clientejuridico.class.php";

				$c1 = new Clientejuridico;
	
				$c1->codigo_cliente_juridico = $_SESSION['codigo_cliente_juridico'];
				$resultado = $c1->Listar();
				foreach ($resultado as $dado)
				{
					$razaosocial = $dado['razao_social'];
					$nomefantasia = $dado['nome_fantasia'];
					$email = $dado['email'];
					$telefone = $dado['telefone'];
					$celular = $dado['celular'];
					$cnpj = $dado['cnpj'];
					$inscricaoestadual = $dado['inscricao_estadual'];
					$inscricaomunicipal = $dado['inscricao_municipal'];
					$cep = $dado['cep'];
					$endereco = $dado['endereco'];
					$numero = $dado['numero'];
					$complemento = $dado['complemento'];
					$bairro = $dado['bairro'];
					$pontodereferencia = $dado['ponto_de_referencia'];
					$cidade = $dado['cidade'];
					$estado = $dado['estado'];
				}
				echo "<input type='hidden' name='codigo_cliente_juridico' value='" . $_SESSION['codigo_cliente_juridico'] . "'>
					<div id='dividir-para-dois-formularios-pessoa-juridica'>
					<input type='hidden' name='tipodecadastro' value='pessoajuridica'>
					<div id='dividir-para-dois-formularios-lado-esquerdo'>
						<label for='razaosocial' id='form-label' >Razão Social</label> <br> <input type='text' name='razaosocial' id='razaosocial' maxlength='60' value='" . $razaosocial . "' required>
					</div>
					<div id='dividir-para-dois-formularios-lado-direito'>
						<label for='nomefantasia' id='form-label'>Nome Fantasia</label> <br> <input type='text' name='nomefantasia' id='nomefantasia' maxlength='60' value='" . $nomefantasia . "' required>
					</div>
				</div>";
	// Email -->
				echo "<label for='email' id='form-label'>E-mail</label> <br> <input type='email' name='email' id='email' maxlength='70' value='" . $email . "' required>";
	// Celular e Telefone -->
				echo "<div id='dividir-para-dois-formularios'>
					<div id='dividir-para-dois-formularios-lado-esquerdo'>
						<label for='celular' id='form-label'>Celular</label> <br> <input type='text' name='celular' id='celular' value='" . $celular . "' required>
					</div>
					<div id='dividir-para-dois-formularios-lado-direito'>
						<label for='telefone' id='form-label'>Telefone</label> <br> <input type='text' name='telefone' id='telefone' value='" . $telefone . "' required>
					</div>
				</div>";
	// CNPJ e Inscrição Municipal CADASTRO PESSOA JURÍDICA -->
				echo "<div id='dividir-para-dois-formularios-pessoa-juridica'>
					<div id='dividir-para-dois-formularios-lado-esquerdo'>
						<label for='cnpj' id='form-label'>CNPJ</label> <br> <input type='text' name='cnpj' id='cnpj' maxlength='60' value='" . $cnpj . "' required>
					</div>
					<div id='dividir-para-dois-formularios-lado-direito'>
						<label for='inscricaomunicipal' id='form-label'>Inscrição Municipal</label> <br> <input type='text' name='inscricaomunicipal' id='inscricaomunicipal' maxlength='60' value='" . $inscricaomunicipal . "' required>
					</div>
				</div>";
	// Inscrição Estadual e Isento CADASTRO PESSOA JURÍDICA -->
			if($inscricaoestadual == '')
			{
				echo "<div id='dividir-para-dois-formularios-pessoa-juridica'>
					<div id='dividir-para-dois-formularios-lado-esquerdo'>
						<label for='inscricaoestadual' id='form-label'>Inscrição Estadual</label> <br> <input type='text' name='inscricaoestadual' id='inscricaoestadual' maxlength='60' value='" . $inscricaoestadual . "' readonly>
					</div>
					<div id='dividir-para-dois-formularios-lado-direito'> <br>
						<input type='checkbox' name='isento' id='isento' value='isento' onchange='isentoCheckbox()' checked> <label for='isento' id='form-label'>Isento Inscrição Estadual</label>
					</div>
				</div>";
			}
			else
			{
				echo "<div id='dividir-para-dois-formularios-pessoa-juridica'>
					<div id='dividir-para-dois-formularios-lado-esquerdo'>
						<label for='inscricaoestadual' id='form-label'>Inscrição Estadual</label> <br> <input type='text' name='inscricaoestadual' id='inscricaoestadual' maxlength='60' value='" . $inscricaoestadual . "' required>
					</div>
					<div id='dividir-para-dois-formularios-lado-direito'> <br>
						<input type='checkbox' name='isento' id='isento' value='isento' onchange='isentoCheckbox()'> <label for='isento' id='form-label'>Isento Inscrição Estadual</label>
					</div>
				</div>";
			}
	// CEP -->
				echo "<label for='cep' id='form-label'>CEP</label> <br> <input type='text' name='cep' id='cep' value='" . $cep . "' required>";
	// Endereço -->
				echo "<label for='endereco' id='form-label'>Endereço</label> <br> <input type='text' name='endereco' id='endereco' maxlength='60' value='" . $endereco . "' required>";
	// Número e Complemento -->
				echo "<div id='dividir-para-dois-formularios'>
				<div id='dividir-para-dois-formularios-lado-esquerdo'>
					<label for='numero' id='form-label'>Número</label> <br> <input type='text' name='numero' id='numero' maxlength='70' value='" . $numero . "' required>
				</div>
				<div id='dividir-para-dois-formularios-lado-direito'>
					<label for='complemento' id='form-label'>Complemento</label> <br> <input type='text' name='complemento' id='complemento' maxlength='60' value='" . $complemento . "'>
				</div>
			</div>";
	// Bairro -->
				echo "<label for='bairro' id='form-label'>Bairro</label> <br> <input type='text' name='bairro' id='bairro'maxlength='60' value='" . $bairro . "' required>";
	// Ponto de referência -->
				echo "<label for='pontodereferencia' id='form-label'>Ponto de Referência</label> <br> <textarea name='pontodereferencia' id='pontodereferencia' rows='3' maxlength='200' required>" . $pontodereferencia ."</textarea>";
	// Cidade -->
				echo "<label for='cidade' id='form-label'>Cidade</label> <br> <input type='text' name='cidade' id='cidade' maxlength='60' value='" . $cidade . "' required>";
	// Estado -->
				echo "<label for='estado' id='form-label'>Estado</label> <br> 
				<select name='estado' id='estado' required>";
					echo "<option value='ac'"; if($estado == 'ac'){ echo 'selected'; } echo ">Acre</option>";
					echo "<option value='al'"; if($estado == 'al'){ echo 'selected'; } echo ">Alagoas</option>";
					echo "<option value='ap'"; if($estado == 'ap'){ echo 'selected'; } echo ">Amapá</option>";
					echo "<option value='am'"; if($estado == 'am'){ echo 'selected'; } echo ">Amazonas</option>";
					echo "<option value='ba'"; if($estado == 'ba'){ echo 'selected'; } echo ">Bahia</option>";
					echo "<option value='ce'"; if($estado == 'ce'){ echo 'selected'; } echo ">Ceará</option>";
					echo "<option value='df'"; if($estado == 'df'){ echo 'selected'; } echo ">Distrito Federal</option>";
					echo "<option value='es'"; if($estado == 'es'){ echo 'selected'; } echo ">Espírito Santo</option>";
					echo "<option value='go'"; if($estado == 'go'){ echo 'selected'; } echo ">Goiás</option>";
					echo "<option value='ma'"; if($estado == 'ma'){ echo 'selected'; } echo ">Maranhão</option>";
					echo "<option value='mt'"; if($estado == 'mt'){ echo 'selected'; } echo ">Mato Grosso</option>";
					echo "<option value='ms'"; if($estado == 'ms'){ echo 'selected'; } echo ">Mato Grosso do Sul</option>";
					echo "<option value='mg'"; if($estado == 'mg'){ echo 'selected'; } echo ">Minas Gerais</option>";
					echo "<option value='pa'"; if($estado == 'pa'){ echo 'selected'; } echo ">Pará</option>";
					echo "<option value='pb'"; if($estado == 'pb'){ echo 'selected'; } echo ">Paraíba</option>";
					echo "<option value='pr'"; if($estado == 'pr'){ echo 'selected'; } echo ">Paraná </option>";
					echo "<option value='pe'"; if($estado == 'pe'){ echo 'selected'; } echo ">Pernambuco</option>";
					echo "<option value='pi'"; if($estado == 'pi'){ echo 'selected'; } echo ">Piauí</option>";
					echo "<option value='rj'"; if($estado == 'rj'){ echo 'selected'; } echo ">Rio de Janeiro</option>";
					echo "<option value='rn'"; if($estado == 'rn'){ echo 'selected'; } echo ">Rio Grande do Norte</option>";
					echo "<option value='rs'"; if($estado == 'rs'){ echo 'selected'; } echo ">Rio Grande do Sul</option>";
					echo "<option value='ro'"; if($estado == 'ro'){ echo 'selected'; } echo ">Rondônia</option>";
					echo "<option value='rr'"; if($estado == 'rr'){ echo 'selected'; } echo ">Roraima</option>";
					echo "<option value='sc'"; if($estado == 'sc'){ echo 'selected'; } echo ">Santa Catarina</option>";
					echo "<option value='sp'"; if($estado == 'sp'){ echo 'selected'; } echo ">São Paulo</option>";
					echo "<option value='se'"; if($estado == 'se'){ echo 'selected'; } echo ">Sergipe</option>";
					echo "<option value='to'"; if($estado == 'to'){ echo 'selected'; } echo ">Tocantins</option>
				</select>";
			?>
				<input type="submit" name='submit' id="submit" value="Alterar">
			</form>
		</section>
	</section>

	<!-- ------------------------------------------------------- -->
	<!--                        Rodapé                           -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<footer id="rodape">
			<div id="rodape-logo">
				<img src="../imagens/logotipo/logo-roxo.png" id="rodape-logo-imagem" alt="razaosocial da empresa"> 
				<!-- ************************* razaosocial DA EMPRESA PRECISA SER MUDADO ************************* -->
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