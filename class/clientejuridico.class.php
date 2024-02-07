<?php
include "conecta.php";

class Clientejuridico{
	
	public $razaosocial;
	public $nomefantasia;
	public $email;
	public $senha;
	public $telefone;
	public $celular;
	public $cnpj;
	public $inscricaomunicipal;
	public $inscricaoestadual;
	public $cep;
	public $endereco;
	public $numero;
	public $complemento;
	public $bairro;
	public $pontodereferencia;
	public $cidade;
	public $estado;
	public $ativo;
	public $datafiltro_juridico;

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
				$sql = "INSERT INTO cliente_juridico (razao_social, nome_fantasia, email, senha, telefone, celular, cnpj, inscricao_municipal, inscricao_estadual, cep, endereco, numero, complemento, bairro, ponto_de_referencia, cidade, estado, ativo, datafiltro_juridico) VALUES ('$this->razaosocial', '$this->nomefantasia', '$this->email', '$this->senha', '$this->telefone', '$this->celular', '$this->cnpj', '$this->inscricaomunicipal', '$this->inscricaoestadual', '$this->cep', '$this->endereco', '$this->numero', '$this->complemento', '$this->bairro', '$this->pontodereferencia', '$this->cidade', '$this->estado', '$this->ativo', '$this->datafiltro_juridico')";
				$res = pg_query($sql);
				if(pg_affected_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
				{
					return "Falha ao incluir";
				}
				else
				{
					return pg_affected_rows($res);
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

		if($result == 0)
		{
			$sql = "SELECT * FROM cliente_juridico WHERE email = '$this->email'";
			$res = pg_query($sql);
			$result = pg_num_rows($res);

			$sql = "SELECT * FROM cliente_juridico WHERE email = '$this->email' AND codigo_cliente_juridico = $this->codigo_cliente_juridico";
			$res = pg_query($sql);
			$resultsuaconta = pg_num_rows($res);
			
			if((($result == 0) || ($resultsuaconta > 0)))
			{
				$sql = "UPDATE cliente_juridico SET razao_social = '$this->razaosocial', nome_fantasia = '$this->nomefantasia', email = '$this->email', telefone = '$this->telefone', celular = '$this->celular', cnpj = '$this->cnpj', inscricao_municipal = '$this->inscricaomunicipal', inscricao_estadual = '$this->inscricaoestadual', cep = '$this->cep', endereco = '$this->endereco', numero = '$this->numero', complemento = '$this->complemento', bairro = '$this->bairro', ponto_de_referencia = '$this->pontodereferencia', cidade = '$this->cidade', estado = '$this->estado' WHERE codigo_cliente_juridico = $this->codigo_cliente_juridico";
				$res = pg_query($sql);
				if(pg_affected_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
				{
					return "Falha ao alterar";
				}
				else
				{
					return "Informação alterada";
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
		$sql = "UPDATE cliente_juridico SET ativo = '$this->ativo' WHERE codigo_cliente_juridico = $this->codigo_cliente_juridico";
		$res = pg_query($sql);
		if(pg_affected_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return "Falha ao alterar";
		}
		else
		{
			return "Informação alterada";
		}
	}

	public function Login()
	{
	/* A função vai testar se tem um usuário com o mesmo id e senha informados e caso haja, vai retornar o nome do usuário */
		$sql = "SELECT email, senha FROM cliente_juridico WHERE email = '$this->email' AND senha = '$this->senha' AND ativo = 'S'";
		$res = pg_query($sql);
		$resultado = pg_num_rows($res);
		if($resultado > 0)
		{
			$sql = "SELECT codigo_cliente_juridico, nome_fantasia FROM cliente_juridico WHERE email = '$this->email'";
			$res = pg_query($sql);
			return pg_fetch_all($res);
		}
		else
		{
			return false;
		}
	}

	public function AlterarSenha()
	{
		$sql = "SELECT * FROM cliente_juridico WHERE codigo_cliente_juridico = $this->codigo_cliente_juridico AND senha = '$this->senhaatual'";
		$res = @pg_query($sql);
		if(@pg_num_rows($res) > 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			$sql = "UPDATE cliente_juridico SET senha = '$this->senha' WHERE codigo_cliente_juridico = $this->codigo_cliente_juridico";
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
		        SELECT * FROM cliente_juridico WHERE codigo_cliente_juridico = $this->codigo_cliente_juridico";
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
		        SELECT * FROM cliente_juridico ORDER BY razao_social";
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
		if($this->razaosocial >= 1)
		{
			$where = "WHERE codigo_cliente_juridico = $this->razaosocial";
		}
		elseif($this->razaosocial)
		{
			$where = "WHERE razao_social ILIKE '%$this->razaosocial%' OR email ILIKE '%$this->razaosocial%'";
		}
		else
		{
			$where = "";
		}

		$sql = "SELECT * FROM cliente_juridico $where ORDER BY razao_social";
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
}

?>