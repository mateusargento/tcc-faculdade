<?php
include 'conecta.php';

class Clientefisico{
	public $codigo_cliente_fisico;
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
	public $datafiltro_fisico;

	public function Incluir()
	{
		$sql = "SELECT * FROM cliente_fisico WHERE email = '$this->email'";
		$res = pg_query($sql);
		$result = pg_num_rows($res);

		if($result == 0)
		{
			$sql = "SELECT * FROM cliente_juridico WHERE email = '$this->email'";
			$res = pg_query($sql);
			$result = pg_num_rows($res);
			
			if($result == 0)
			{
				$sql = "INSERT INTO cliente_fisico (nome, sobrenome, email, senha, telefone, celular, sexo, cpf, rg, data_nasc, cep, endereco, numero, complemento, bairro, ponto_de_referencia, cidade, estado, ativo, datafiltro_fisico) VALUES ('$this->nome', '$this->sobrenome', '$this->email', '$this->senha', '$this->telefone', '$this->celular', '$this->sexo', '$this->cpf', '$this->rg', '$this->data_nasc', '$this->cep', '$this->endereco', $this->numero, '$this->complemento', '$this->bairro', '$this->pontodereferencia', '$this->cidade', '$this->estado', '$this->ativo', '$this->datafiltro_fisico')";
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
			else
			{
				return "E-mail já cadastrado";
			}
		}
		else
		{
			return "E-mail já cadastrado";
		}
	}
	
	public function Alterar()
	{
		$sql = "SELECT * FROM cliente_fisico WHERE email = '$this->email'";
		$res = pg_query($sql);
		$result = pg_num_rows($res);

		$sql = "SELECT * FROM cliente_fisico WHERE email = '$this->email' AND codigo_cliente_fisico = $this->codigo_cliente_fisico";
		$res = pg_query($sql);
		$resultsuaconta = pg_num_rows($res);

		if((($result == 0) || ($resultsuaconta > 0)))
		{
			$sql = "SELECT * FROM cliente_juridico WHERE email = '$this->email'";
			$res = pg_query($sql);
			$result = pg_num_rows($res);
			
			if($result == 0)
			{
				$sql = "UPDATE cliente_fisico SET nome = '$this->nome', sobrenome = '$this->sobrenome', email = '$this->email', telefone = '$this->telefone', celular = '$this->celular', sexo = '$this->sexo', cpf = '$this->cpf', rg = '$this->rg', data_nasc = '$this->data_nasc', cep = '$this->cep', endereco = '$this->endereco', numero = $this->numero, complemento = '$this->complemento', bairro = '$this->bairro', ponto_de_referencia = '$this->pontodereferencia', cidade = '$this->cidade', estado = '$this->estado' WHERE codigo_cliente_fisico = $this->codigo_cliente_fisico";
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
				return "E-mail já cadastrado";
			}
		}
		else
		{
			return "E-mail já cadastrado";
		}
	}

	public function Ativo()
	{
		$sql = "UPDATE cliente_fisico SET ativo = '$this->ativo' WHERE codigo_cliente_fisico = $this->codigo_cliente_fisico";
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
		$sql = "SELECT * FROM cliente_fisico WHERE codigo_cliente_fisico = $this->codigo_cliente_fisico AND senha = '$this->senhaatual'";
		$res = @pg_query($sql);
		if(@pg_num_rows($res) > 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			$sql = "UPDATE cliente_fisico SET senha = '$this->senha' WHERE codigo_cliente_fisico = $this->codigo_cliente_fisico";
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
		        SELECT * FROM cliente_fisico WHERE codigo_cliente_fisico = $this->codigo_cliente_fisico";
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

	public function ListarTodos()
	{
		$sql = "SET DATESTYLE TO 'SQL, DMY'; 
		        SELECT * FROM cliente_fisico ORDER BY nome";
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

	public function ListarTodosFiltro()
	{
		if($this->nome >= 1)
		{
			$where = "WHERE codigo_cliente_fisico = $this->nome";
		}
		elseif($this->nome)
		{
			$where = "WHERE nome ILIKE '%$this->nome%' OR email ILIKE '%$this->nome%'";
		}
		else
		{
			$where = "";
		}
		
		$sql = "SELECT * FROM cliente_fisico $where ORDER BY nome";
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
		$sql = "SELECT email, senha FROM cliente_fisico WHERE email = '$this->email' AND senha = '$this->senha' AND ativo = 'S'";
		$res = pg_query($sql);
		$resultado = pg_num_rows($res);
		if($resultado > 0)
		{
			$sql = "SELECT codigo_cliente_fisico, nome FROM cliente_fisico WHERE email = '$this->email'";
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