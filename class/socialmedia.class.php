<?php
include 'conecta.php';

class Socialmedia{
	public $codigo_consultoria;
	public $tipo;
	public $valor_inicial;
	public $disponibilidade;
    public $ativo;
    
    public function Incluir()
	{
		$sql = "INSERT INTO consultoria_social_media (codigo_consultoria, tipo , valor_inicial, disponibilidade ) VALUES ('$this->codigo_consultoria', '$this->tipo ', '$this->valor_inicial', '$this->disponibilidade')";
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
		$sql = "UPDATE consultoria_social_media SET valor_inicial = '$this->valor_inicial', disponibilidade = '$this->disponibilidade' WHERE codigo_consultoria = $this->codigo_consultoria";
		$res = pg_query($sql);
		if(pg_affected_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return "Falha ao alterar";
		}
		else
		{
			return pg_affected_rows($res);
		}
	}

	public function Listar() //Usado para listar e mostrar na tela de contratar serviços, tela inicial com todos os serviços disponíveis
	{
		$sql = "SELECT * FROM consultoria_social_media WHERE codigo_consultoria = $this->codigo_consultoria ORDER BY codigo_consultoria";
		$res = pg_query($sql);
		if(pg_num_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return "Falha ao listar";
		}
		else
		{
			return @pg_fetch_all($res);
		}
	}

	public function ListarTodos()
	{
		$sql = "SELECT * FROM consultoria_social_media ORDER BY codigo_consultoria";
		$res = pg_query($sql);
		if(pg_num_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return "Falha ao listar";
		}
		else
		{
			return @pg_fetch_all($res);
		}
	}
}
?>