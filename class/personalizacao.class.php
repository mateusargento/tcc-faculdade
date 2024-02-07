<?php
include 'conecta.php';

class Personalizacao{
    public $codigo_servico;
    public $categoria;
	public $tipo;
	public $valor_inicial ;
	public $disponibilidade;
    
    public function Incluir()
	{
		$sql = "INSERT INTO servico (codigo_servico, tipo, valor_inicial, disponibilidade ) VALUES ('$this->codigo_servico', '$this->tipo', '$this->valor_inicial', '$this->disponibilidade')";
		$res = pg_query($sql);
		if(pg_affected_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
				return "Falha ao incluir";
		}
		else
		{	
			echo "Cadastro efetuado com sucesso!! <a href='../view/login.html'>Clique aqui para Logar</a>";
		}
		
    }
    
    public function Alterar()
	{
		$sql = "UPDATE servico SET codigo_servico = '$this->codigo_servico', tipo = '$this->tipo', valor_inicial = '$this->valor_inicial', disponibilidade = '$this->disponibilidade' WHERE codigo_servico = '$this->codigo_servico'";
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
    
    public function ListarLogotipo()
	{
		$sql = "SELECT * FROM personalizacao WHERE codigo_servico_fk = 1 AND disponibilidade = 'S' AND categoria = '$this->categoria'";
		$res = @pg_query($sql);
		if(@pg_num_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return "Falha ao alterar";
		}
		else
		{
			return @pg_fetch_all($res);
		}
    }

    public function ListarAnimacaoTD()
	{
		$sql = "SELECT * FROM personalizacao WHERE codigo_servico_fk = 2 AND disponibilidade = 'S' AND categoria = '$this->categoria'";
		$res = @pg_query($sql);
		if(@pg_num_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return "Falha ao alterar";
		}
		else
		{
			return @pg_fetch_all($res);
		}
    }

    public function ListarIdentidadeVisual()
	{
		$sql = "SELECT * FROM personalizacao WHERE codigo_servico_fk = 3 AND disponibilidade = 'S' AND categoria = '$this->categoria'";
		$res = @pg_query($sql);
		if(@pg_num_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return "Falha ao alterar";
		}
		else
		{
			return @pg_fetch_all($res);
		}
	}

	public function ListarConsultoriaSocialMedia()
	{
		$sql = "SELECT * FROM personalizacao WHERE codigo_consultoria_fk = 1 AND disponibilidade = 'S' AND categoria = '$this->categoria'";
		$res = @pg_query($sql);
		if(@pg_num_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return "Falha ao alterar";
		}
		else
		{
			return @pg_fetch_all($res);
		}
	}
}
?>