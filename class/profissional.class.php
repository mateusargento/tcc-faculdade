<?php
include 'conecta.php';

class Profissional{
	public $codigo_profissional;
	public $nome;
	public $sobrenome;
	public $email;
	public $senhaatual;
	public $senha;
	public $telefone;
	public $celular;
	public $sexo;
	public $cpf;
	public $rg;
	public $data_nasc;
	public $cep;
	public $endereco;
	public $numero;
	public $complemento;
	public $bairro;
	public $pontoreferencia;
	public $cidade;
	public $estado;
	public $ativo;
	
    public function Incluir()
	{
		$sql = "INSERT INTO profissional (nome, sobrenome, email, senha, telefone, celular, sexo, cpf, rg, data_nasc, cep, endereco, numero, complemento, bairro, ponto_de_referencia, cidade, estado, ativo) VALUES ('$this->nome', '$this->sobrenome', '$this->email', '$this->senha', '$this->telefone', '$this->celular', '$this->sexo', '$this->cpf', '$this->rg', '$this->data_nasc', '$this->cep', '$this->endereco', $this->numero, '$this->complemento', '$this->bairro', '$this->pontodereferencia', '$this->cidade', '$this->estado', '$this->ativo')";
		$res = @pg_query($sql);
		if(@pg_affected_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return "Falha ao incluir";
		}
		else
		{	
			return @pg_affected_rows($res);
		}
		
	}
	
	public function Alterar()
	{
		$sql = "UPDATE profissional SET nome = '$this->nome', sobrenome = '$this->sobrenome', email = '$this->email', telefone = '$this->telefone', celular = '$this->celular', sexo = '$this->sexo', cpf = '$this->cpf', rg = '$this->rg', data_nasc = '$this->data_nasc', cep = '$this->cep', endereco = '$this->endereco', numero = $this->numero, complemento = '$this->complemento', bairro = '$this->bairro', ponto_de_referencia = '$this->pontodereferencia', cidade = '$this->cidade', estado = '$this->estado' WHERE codigo_profissional = $this->codigo_profissional";
		$res = @pg_query($sql);
		if(@pg_affected_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
				return "Falha ao alterar";
		}
		else
		{
				return @pg_affected_rows($res);
		}
	}

	public function AlterarSenha()
	{
		$sql = "SELECT * FROM profissional WHERE codigo_profissional = $this->codigo_profissional AND senha = '$this->senhaatual'";
		$res = @pg_query($sql);
		if(@pg_num_rows($res) > 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			$sql = "UPDATE profissional SET senha = '$this->senha' WHERE codigo_profissional = $this->codigo_profissional";
			$res = @pg_query($sql);
			if(@pg_affected_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
			{
				return "Falha ao alterar";
			}
			else
			{
				return @pg_affected_rows($res);
			}
		}
		else
		{
			return "Falha ao alterar";
		}
	}

	public function Listar()
	{
		$sql = "SET DATESTYLE TO 'SQL, DMY'; 
		        SELECT * FROM profissional WHERE codigo_profissional = $this->codigo_profissional";
		$res = @pg_query($sql);
		if(@pg_num_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
				return "Nenhum resultado encontrado";
		}
		else
		{
				return @pg_fetch_all($res);
		}
	}

	public function Login()
	{
	/* A função vai testar se tem um usuário com o mesmo id e senha informados e caso haja, vai retornar o nome do usuário */
		$sql = "SELECT email, senha FROM profissional WHERE email = '$this->email' AND senha = '$this->senha'";
		$res = pg_query($sql);
		$resultado = pg_num_rows($res);
		if($resultado > 0)
		{
			$sql = "SELECT codigo_profissional, nome FROM profissional WHERE email = '$this->email'";
			$res = pg_query($sql);
			return pg_fetch_all($res);
		}
		else
		{
			return false;
		}
	}
}
?>