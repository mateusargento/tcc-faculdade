/*
								Máscara
		
	O script tem a função de capturar o que está sendo digitado, e verificar a cada dígito, quantos caracteres estão inseridos no campo e dependendo da quantidade de dígitos, inserir um caractere no campo.
	
	Para correto funcionamento da máscara é necessário que:
	- O input tenha onkeypress="mascaraCPF", sendo mascaraCPF um exemplo podendo ser usado todos os exemplos.
	- O input deve ter o id correspondente a função, por exemplo, a máscara CPF tem o id cpf.
	- O input deve ter o seu pattern inserido, como o exemplo do cpf que ficaria [0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}. É recomendado inserir um title para que o usuário sabia o erro, como por exemplo do cpf ficaria title="Exemplo de formato: 123.456.789-12".

	Nota sobre pattern:
	- [0-9] Significa que apenas números de 0 a 9.
	- {3} O número inserido é variável, é usado para obrigatoriedade de quantidade, ou seja, deve ser inserido três caracteres.
	- . É inserido para informar que deverá ter o ponto naquela posição.
*/

document.getElementById("datadenascimento").addEventListener("keypress", mascaraDatadeNascimento);

function mascaraDatadeNascimento() 
{
	var d = document.getElementById("datadenascimento");
	if(d.value.length == 2 || d.value.length == 5)
	{
		d.value += "/"; 
	}
	d.value = d.value;
}

function mascaraTelefone()
{
	var t = document.getElementById("telefone");
	if(t.value.length == 1)
	{
		t.value = "(" + t.value;
	}
	else if(t.value.length == 3)
	{
		t.value += ")";
	}
	else if(t.value.length == 8)
	{
		t.value += "-";
	}
	t.value = t.value;
}

function mascaraCelular()
{
	var c = document.getElementById("celular");
	if(c.value.length == 1)
	{
		c.value = "(" + c.value;
	}
	else if(c.value.length == 3)
	{
		c.value += ")";
	}
	else if(c.value.length == 9)
	{
		c.value += "-";
	}
}

function mascaraCPF()
{
	var cpf = document.getElementById("cpf");
	if(cpf.value.length == 3 || cpf.value.length == 7)
	{
		cpf.value += ".";
	}
	else if(cpf.value.length == 11)
	{
		cpf.value += "-";
	}
}

function mascaraRG()
{
	var r = document.getElementById("rg");
	if(r.value.length == 2 || r.value.length == 6)
	{
		r.value += ".";
	}
	else if(r.value.length == 10)
	{
		r.value += "-";
	}
}

function mascaraCEP()
{
	var cep = document.getElementById("cep");
	if(cep.value.length == 5)
	{
		cep.value += "-";
	}
}