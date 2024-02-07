<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link rel="stylesheet" href="css/estilocadastro.css">
	<link rel="stylesheet" href="css/estilomenu.css">
	<link rel="icon" href="imagens/logotipo/logo-icone.png">
	<meta charset="UTF-8">
	<title>Cadastro - BNG Design</title>
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
		$('#celular').mask("(00) 00000-0000");
		$('#telefone').mask("(00) 0000-0000");
		$('#cpf').mask("000.000.000-00");
		$('#rg').mask("00.000.000-0");
		$('#datadenascimento').mask("00/00/0000");
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
	<!--                       Título                            -->
	<!-- ------------------------------------------------------- -->
	<section id="div">
		<section id="conteudo-site">
			<h1 id="titulo">CADASTRE - SE</h1>
		</section>
	</section>

	<!-- ------------------------------------------------------- -->
	<!--                      Cadastro                           -->
	<!-- ------------------------------------------------------- -->
	<section id="conteudo-site">
		<form action="../app/clientepost.app.php" method="post">
            <h2 id="titulo-grande">Faça seu cadastro abaixo, é rápido e fácil.</h2>
    <!-- 
        * A div 'dividir-para-dois-formularios' é usada para que possam haver 2 (dois) inputs na mesma linha,
        * A div 'dividir-para-dois-formularios-lado-esquerdo' comportará o label e o input que ficará no lado esquerdo
        * A div 'dividir-para-dois-formularios-lado-direito' comportará o label e o input que ficará no lado direito 
	-->
	<!-- Pessoa física e Pessoa jurídica -->
			<div id="dividir-para-dois-formularios">
				<div id="dividir-para-dois-formularios-lado-esquerdo">
					<input type="radio" name="tipodecadastro" id="pessoafisica" value="pessoafisica" onchange="pessoaFisica()" checked><label for="pessoafisica" id="form-label-pessoa-fisica">Pessoa Física</label>
				</div>
				<div id="dividir-para-dois-formularios-lado-direito">
					<input type="radio" name="tipodecadastro" id="pessoajuridica" value="pessoajuridica" onchange="pessoaJuridica()"><label for="pessoajuridica" id="form-label-pessoa-fisica">Pessoa Jurídica</label>
				</div>
			</div>
			<label for="tipodecadastro-mobile" id="form-label-tipodecadastro">Tipo de Cadastro</label> 
			<select id="tipodecadastro-mobile" name="tipodecadastro-mobile" onchange="cadastroMobile()">
				<option value="pessoafisica">Pessoa Física</option>
				<option value="pessoajuridica">Pessoa Jurídica</option>
			</select>
    <!-- Nome e Sobrenome -->
            <div id="dividir-para-dois-formularios">
                <div id="dividir-para-dois-formularios-lado-esquerdo">
                    <label for="nome" id="form-label">Nome</label> <br> <input type="text" name="nome" id="nome" maxlength="60" required>
                </div>
                <div id="dividir-para-dois-formularios-lado-direito">
                    <label for="sobrenome" id="form-label">Sobrenome</label> <br> <input type="text" name="sobrenome" id="sobrenome" maxlength="60" required>
                </div>
			</div>
	<!-- Razão Social e Nome fantasia CADASTRO PESSOA JURÍDICA -->
			<div id="dividir-para-dois-formularios-pessoa-juridica">
				<div id="dividir-para-dois-formularios-lado-esquerdo">
					<label for="razaosocial" id="form-label" >Razão Social</label> <br> <input type="text" name="razaosocial" id="razaosocial" maxlength="60">
				</div>
				<div id="dividir-para-dois-formularios-lado-direito">
                    <label for="nomefantasia" id="form-label">Nome Fantasia</label> <br> <input type="text" name="nomefantasia" id="nomefantasia" maxlength="60">
                </div>
			</div>
    <!-- Email -->
			<label for="email" id="form-label">E-mail</label> <br> <input type="email" name="email" id="email" maxlength="70" required>
	<!-- Senha -->
			<label for="senha" id="form-label">Senha</label> <br> <input type="password" name="senha" id="senha" maxlength="256" required>
	<!-- Confirmar Senha -->
			<label for="confirmarsenha" id="form-label">Confirmar Senha</label> <br> <input type="password" name="confirmarsenha" id="confirmarsenha" maxlength="256" onblur="confereSenha()" required>
	<!-- Celular e Telefone -->
			<div id="dividir-para-dois-formularios">
				<div id="dividir-para-dois-formularios-lado-esquerdo">
					<label for="celular" id="form-label">Celular</label> <br> <input type="text" name="celular" id="celular" required>
				</div>
				<div id="dividir-para-dois-formularios-lado-direito">
					<label for="telefone" id="form-label">Telefone</label> <br> <input type="text" name="telefone" id="telefone" required>
				</div>
			</div>
	<!-- Sexo -->
			<label for="sexo" id="form-label-sexo">Sexo</label> <br>
			<select id="sexo" name="sexo" required>
				<option value="m">Masculino</option>
				<option value="f">Feminino</option>
			</select>
    <!-- CPF e RG -->
            <div id="dividir-para-dois-formularios">
                <div id="dividir-para-dois-formularios-lado-esquerdo">
                    <label for="cpf" id="form-label">CPF</label> <br> <input type="text" name="cpf" id="cpf" data-mask="00/00/0000" required>
                </div>
                <div id="dividir-para-dois-formularios-lado-direito">
                    <label for="rg" id="form-label">RG</label> <br> <input type="text" name="rg" id="rg" required>
                </div>
			</div>
	<!-- CNPJ e Inscrição Municipal CADASTRO PESSOA JURÍDICA -->
			<div id="dividir-para-dois-formularios-pessoa-juridica">
				<div id="dividir-para-dois-formularios-lado-esquerdo">
					<label for="cnpj" id="form-label">CNPJ</label> <br> <input type="text" name="cnpj" id="cnpj">
				</div>
				<div id="dividir-para-dois-formularios-lado-direito">
					<label for="inscricaomunicipal" id="form-label">Inscrição Municipal</label> <br> <input type="text" name="inscricaomunicipal" id="inscricaomunicipal" maxlength="60">
				</div>
			</div>
	<!-- Inscrição Estadual e Isento CADASTRO PESSOA JURÍDICA -->
			<div id="dividir-para-dois-formularios-pessoa-juridica">
				<div id="dividir-para-dois-formularios-lado-esquerdo">
					<label for="inscricaoestadual" id="form-label">Inscrição Estadual</label> <br> <input type="text" name="inscricaoestadual" id="inscricaoestadual" maxlength="60">
				</div>
				<div id="dividir-para-dois-formularios-lado-direito">
					<br>
					<input type="checkbox" name="isento" id="isento" value="isento" onchange="isentoCheckbox()"> <label for="isento" id="form-label">Isento Inscrição Estadual</label>
				</div>
			</div>
    <!-- Data de Nascimento -->
            <label for="datadenascimento" id="form-label-datadenascimento">Data de nascimento</label><input type="text" name="datadenascimento" id="datadenascimento" required>
    <!-- CEP -->
            <label for="cep" id="form-label">CEP</label> <br> <input type="text" name="cep" id="cep" onblur="pesquisacep(this.value)" required>
    <!-- Endereço -->
            <label for="endereco" id="form-label">Endereço</label> <br> <input type="text" name="endereco" id="endereco" maxlength="60" required>
    <!-- Número e Complemento -->
            <div id="dividir-para-dois-formularios">
                <div id="dividir-para-dois-formularios-lado-esquerdo">
                    <label for="numero" id="form-label">Número</label> <br> <input type="text" name="numero" id="numero" maxlength="70" required>
                </div>
                <div id="dividir-para-dois-formularios-lado-direito">
                    <label for="complemento" id="form-label">Complemento</label> <br> <input type="text" name="complemento" id="complemento" maxlength="60">
                </div>
			</div>
	<!-- Bairro -->
			<label for="bairro" id="form-label">Bairro</label> <br> <input type="text" name="bairro" id="bairro" maxlength="60" required>
	<!-- Ponto de referência -->
			<label for="pontodereferencia" id="form-label">Ponto de Referência</label> <br> <textarea name="pontodereferencia" id="pontodereferencia" maxlength="200" rows="3" required></textarea>
    <!-- Cidade -->
            <label for="cidade" id="form-label">Cidade</label> <br> <input type="text" name="cidade" id="cidade" maxlength="70" required>
    <!-- Estado -->
			<label for="estado" id="form-label">Estado</label> <br>
			<select name="estado" id="estado" required>
				<option value="ac">Acre</option>
				<option value="al">Alagoas</option>
				<option value="ap">Amapá</option>
				<option value="am">Amazonas</option>
				<option value="ba">Bahia</option>
				<option value="ce">Ceará</option>
				<option value="df">Distrito Federal</option>
				<option value="es">Espírito Santo</option>
				<option value="go">Goiás</option>
				<option value="ma">Maranhão</option>
				<option value="mt">Mato Grosso</option>
				<option value="ms">Mato Grosso do Sul</option>
				<option value="mg">Minas Gerais</option>
				<option value="pa">Pará</option>
				<option value="pb">Paraíba</option>
				<option value="pr">Paraná </option>
				<option value="pe">Pernambuco</option>
				<option value="pi">Piauí</option>
				<option value="rj">Rio de Janeiro</option>
				<option value="rn">Rio Grande do Norte</option>
				<option value="rs">Rio Grande do Sul</option>
				<option value="ro">Rondônia</option>
				<option value="rr">Roraima</option>
				<option value="sc">Santa Catarina</option>
				<option value="sp">São Paulo</option>
				<option value="se">Sergipe</option>
				<option value="to">Tocantins</option>
			</select>
			<input type="submit" name="submit" id="submit" value="Cadastrar">
		</form>
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