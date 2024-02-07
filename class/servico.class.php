<?php
include 'conecta.php';

class Servico{
	public $codigo_servico;
	public $tipo;
	public $valor_inicial ;
	public $disponibilidade;
    
    public function Alterar()
	{
		$sql = "UPDATE servico SET valor_inicial = '$this->valor_inicial', disponibilidade = '$this->disponibilidade' WHERE codigo_servico = $this->codigo_servico";
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
		$sql = "SELECT * FROM servico WHERE codigo_servico = '$this->codigo_servico' ORDER BY codigo_servico";
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
		$sql = "SELECT * FROM servico ORDER BY codigo_servico";
		$res = pg_query($sql);
		if(pg_num_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
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