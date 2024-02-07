/* --------------------------------------------------- */
/* ---                    Menu                     --- */
/* --------------------------------------------------- */
function abrirMenuMobile()
{
	document.getElementById("conteudo-menu-mobile").style.display = "block";
}

function fecharMenuMobile()
{
	document.getElementById("conteudo-menu-mobile").style.display = "none";
}

/* --------------------------------------------------- */
/* ---                 Fim menu                    --- */
/* --------------------------------------------------- */

/* --------------------------------------------------- */
/* ---                Fale conosco                 --- */
/* --------------------------------------------------- */

function exibirResposta(numeroQuestao)
{
	var valor = window.getComputedStyle(document.getElementById(numeroQuestao)).display
	if(valor == "none") // Abre a resposta
	{
		document.getElementById(`${numeroQuestao}`).style.display = "block"
		document.getElementById(`${numeroQuestao}1`).innerHTML = "-"
	}
	else // Fecha a resposta
	{
		document.getElementById(`${numeroQuestao}`).style.display = "none"
		document.getElementById(`${numeroQuestao}1`).innerHTML = "+"
	}
}

function exibirQuestao(numeroQuestao)
{
	var valor = window.getComputedStyle(document.getElementById(numeroQuestao)).display
	if(valor == "none") // Abre a resposta
	{
		document.getElementById(`${numeroQuestao}`).style.display = ""
		document.getElementById(`${numeroQuestao}1`).innerHTML = "Exibir -"
	}
	else // Fecha a resposta
	{
		document.getElementById(`${numeroQuestao}`).style.display = "none"
		document.getElementById(`${numeroQuestao}1`).innerHTML = "Exibir +"
	}
}

/* --------------------------------------------------- */
/* ---              Fim fale conosco               --- */
/* --------------------------------------------------- */

/* --------------------------------------------------- */
/* ---                  Cadastro                   --- */
/* --------------------------------------------------- */

function pessoaFisica()
{
	// Coloca os campos necessários para o cadastro de pessoa física
	document.getElementsByTagName('div')[5].style.display = 'block' // Nome e sobrenome
	document.getElementsByTagName('div')[14].style.display = 'block' // CPF e RG
	document.getElementById('datadenascimento').style.display = 'initial' // Data de nascimento
	document.getElementById('form-label-datadenascimento').style.display = 'initial' // Label de Data de nascimento
	document.getElementById('sexo').style.display = 'initial' // Sexo
	document.getElementById('form-label-sexo').style.display = 'initial' // Label de Sexo

	// Oculta os campos referentes ao cadastro de pessoa jurídica
	document.getElementsByTagName('div')[8].style.display = 'none' // Razão Social e Nome Fantasia
	document.getElementsByTagName('div')[17].style.display = 'none' // CNPJ e Inscrição Municipal
	document.getElementsByTagName('div')[20].style.display = 'none' // Inscrição Estadual e Isento

	/* Coloca o required dos inputs de pessoa jurídica como falsos, para não serem necessários */
	document.getElementById('razaosocial').required = false
	document.getElementById('nomefantasia').required = false
	document.getElementById('cnpj').required = false
	document.getElementById('inscricaomunicipal').required = false
	document.getElementById('inscricaoestadual').required = false
	
	/* Coloca o required dos inputs de pessoa física como verdadeiros, para serem necessários */
	document.getElementById('nome').required = true
	document.getElementById('sobrenome').required = true
	document.getElementById('cpf').required = true
	document.getElementById('rg').required = true
	document.getElementById('datadenascimento').required = true
	document.getElementById('sexo').required = true
}

function pessoaJuridica()
{
	// Coloca os campos necessários para o cadastro de pessoa jurídica
	document.getElementsByTagName('div')[5].style.display = 'none' // Nome e sobrenome
	document.getElementsByTagName('div')[14].style.display = 'none' // CPF e RG
	document.getElementById('datadenascimento').style.display = 'none' // Data de nascimento
	document.getElementById('form-label-datadenascimento').style.display = 'none' // Label de Data de nascimento
	document.getElementById('sexo').style.display = 'none' // Sexo
	document.getElementById('form-label-sexo').style.display = 'none' // Label de Sexo

	// Oculta os campos referentes ao cadastro de pessoa física
	document.getElementsByTagName('div')[8].style.display = 'block' // Razão Social e Nome Fantasia
	document.getElementsByTagName('div')[17].style.display = 'block' // CNPJ e Inscrição Municipal
	document.getElementsByTagName('div')[20].style.display = 'block' // Inscrição Estadual e Isento

	/* Coloca o required dos inputs de pessoa jurídica como falsos, para não serem necessários */
	document.getElementById('razaosocial').required = true
	document.getElementById('nomefantasia').required = true
	document.getElementById('cnpj').required = true
	document.getElementById('inscricaomunicipal').required = true
	document.getElementById('inscricaoestadual').required = true
	
	/* Coloca o required dos inputs de pessoa física como verdadeiros, para serem necessários */
	document.getElementById('nome').required = false
	document.getElementById('sobrenome').required = false
	document.getElementById('cpf').required = false
	document.getElementById('rg').required = false
	document.getElementById('datadenascimento').required = false
	document.getElementById('sexo').required = false
}

function isentoCheckbox()
{
	// Caso o botão checkbox isento for clicado, o campo inscrição estadual receberá o valor de nulo e não poderá ser inserido dados nele
	var checkbox = document.getElementById('isento').checked
	var inscricaoestadual = document.getElementById('inscricaoestadual')
	inscricaoestadual.value = null
	inscricaoestadual.readOnly = checkbox
}

function cadastroMobile()
{
	var valor = document.getElementById('tipodecadastro-mobile').value
	if(valor == 'pessoafisica')
	{
		// Coloca os campos necessários para o cadastro de pessoa física
		document.getElementsByTagName('div')[5].style.display = 'block' // Nome e sobrenome
		document.getElementsByTagName('div')[14].style.display = 'block' // CPF e RG
		document.getElementById('datadenascimento').style.display = 'block' // Data de nascimento
		document.getElementById('form-label-datadenascimento').style.display = 'block' // Label de Data de nascimento

		// Oculta os campos referentes ao cadastro de pessoa jurídica
		document.getElementsByTagName('div')[8].style.display = 'none' // Razão Social e Nome Fantasia
		document.getElementsByTagName('div')[17].style.display = 'none' // CNPJ e Inscrição Municipal
		document.getElementsByTagName('div')[20].style.display = 'none' // Inscrição Estadual e Isento

		/* Coloca o required dos inputs de pessoa jurídica como falsos, para não serem necessários */
		document.getElementById('razaosocial').required = false
		document.getElementById('nomefantasia').required = false
		document.getElementById('cnpj').required = false
		document.getElementById('inscricaomunicipal').required = false
		document.getElementById('inscricaoestadual').required = false
		
		/* Coloca o required dos inputs de pessoa física como verdadeiros, para serem necessários */
		document.getElementById('nome').required = true
		document.getElementById('sobrenome').required = true
		document.getElementById('cpf').required = true
		document.getElementById('rg').required = true
		document.getElementById('datadenascimento').required = true
	}
	else if('pessoajuridica') 
	{
		// Coloca os campos necessários para o cadastro de pessoa jurídica
		document.getElementsByTagName('div')[5].style.display = 'none' // Nome e sobrenome
		document.getElementsByTagName('div')[14].style.display = 'none' // CPF e RG
		document.getElementById('datadenascimento').style.display = 'none' // Data de nascimento
		document.getElementById('form-label-datadenascimento').style.display = 'none' // Label de Data de nascimento

		// Oculta os campos referentes ao cadastro de pessoa física
		document.getElementsByTagName('div')[8].style.display = 'block' // Razão Social e Nome Fantasia
		document.getElementsByTagName('div')[17].style.display = 'block' // CNPJ e Inscrição Municipal
		document.getElementsByTagName('div')[20].style.display = 'block' // Inscrição Estadual e Isento

		/* Coloca o required dos inputs de pessoa jurídica como falsos, para não serem necessários */
		document.getElementById('razaosocial').required = true
		document.getElementById('nomefantasia').required = true
		document.getElementById('cnpj').required = true
		document.getElementById('inscricaomunicipal').required = true
		document.getElementById('inscricaoestadual').required = true
		
		/* Coloca o required dos inputs de pessoa física como verdadeiros, para serem necessários */
		document.getElementById('nome').required = false
		document.getElementById('sobrenome').required = false
		document.getElementById('cpf').required = false
		document.getElementById('rg').required = false
		document.getElementById('datadenascimento').required = false
	}
	else
	{
		
	}
}

function confereSenha()
{
	var senha = document.getElementById('senha').value
	var confirmarsenha = document.getElementById('confirmarsenha').value
	if(senha != confirmarsenha)
	{
		alert('Senha diferentes digitadas nos campos de SENHA e CONFIRMAR SENHA')
		document.getElementById('confirmarsenha').value = ""
		return false;
	}
}

function Voltar()
{
	window.history.go(-1);
}

/* --------------------------------------------------- */
/* ---                Fim cadastro                 --- */
/* --------------------------------------------------- */

/* --------------------------------------------------- */
/* ---               Finalizar Compra              --- */
/* --------------------------------------------------- */

function cartaoDeCredito()
{
	// Coloca os campos necessários para o cadastro de pessoa física
	document.getElementsByTagName('div')[5].style.display = 'block' // Nome e sobrenome
	document.getElementsByTagName('div')[8].style.display = 'block' // CPF e RG
	document.getElementById('form-label-parcelas').style.display = 'initial' // Label de Data de nascimento
	document.getElementById('parcelas').style.display = 'initial' // Sexo

	document.getElementById('nomecartao').required = true
	document.getElementById('numerocartao').required = true
	document.getElementById('datadevencimento').required = true
	document.getElementById('cvv').required = true
}

function boletoBancario()
{
	// Coloca os campos necessários para o cadastro de pessoa física
	document.getElementsByTagName('div')[5].style.display = 'none' // Nome e sobrenome
	document.getElementsByTagName('div')[8].style.display = 'none' // CPF e RG
	document.getElementById('form-label-parcelas').style.display = 'none' // Label de Data de nascimento
	document.getElementById('parcelas').style.display = 'none' // Sexo

	document.getElementById('nomecartao').required = false
	document.getElementById('numerocartao').required = false
	document.getElementById('datadevencimento').required = false
	document.getElementById('cvv').required = false
}

/* --------------------------------------------------- */
/* ---            Fim Finalizar Compra             --- */
/* --------------------------------------------------- */

/*
	Slide
	Variáveis: 
	quantImagens - Adquire a quantidade de imagens no slide.
	slideMostrando - Contador usado para representar o slide a ser exibido no momento.
			
	O funcionamente é iniciado obtendo a quantidade de imagens no slide (como mesmo nome de classe). Após, todas as imagens recebem no css display: none, para que não façam parte do código.
	Depois, a imagem do momento recebe no css display: block, para que fique como a única a ser mostrada. O contador de vez da imagem recebe mais um, para que a próxima foto possa ser exibida em seguida.
	Existe uma condicional no script para verificar se o número do momento não é maior que a quantidade de imagens, e se for, resetará o número do slide do momento.
	Ao final, um timer é usado para que cada foto fique 10 segundos na tela e o script se repita.
*/
/*var slideMostrando = 0
function slide()
{
	var quantImagens = document.getElementsByClassName("banner-slide-imagem");
	for (i = 0; i < quantImagens.length; i++)
	{
		quantImagens[i].style.display = "none";
	}
	quantImagens[slideMostrando].style.display = "block";
	
	slideMostrando++;
	if(slideMostrando == quantImagens.length) { slideMostrando = 0; }
	
	setTimeout(slide, 1000);
}

var slideMostrandos = 0
function slides()
{
	var quantImagens = document.getElementsByClassName("banner-slide-imagemm");
	for (i = 0; i < quantImagens.length; i++)
	{
		quantImagens[i].style.display = "none";
	}
	quantImagens[slideMostrandos].style.display = "block";
	
	slideMostrandos++;
	if(slideMostrandos == quantImagens.length) { slideMostrandos = 0; }
	
	setTimeout(slides, 1000);
}*/
