<?php
include 'conecta.php';

class FaleConosco{
	public $ticket;
	public $nome;
	public $email;
	public $celular;
	public $assunto;
	public $duvida;
	public $respondido;
	public $datafiltro_fale_conosco;

	public function Incluir()
	{
		$sql = "INSERT INTO fale_conosco (nome, email, celular, assunto, duvida, respondido, codigo_profissional_fk, datafiltro_fale_conosco) VALUES ('$this->nome', '$this->email', '$this->celular', '$this->assunto', '$this->duvida', '$this->respondido',1,'$this->datafiltro_fale_conosco')";
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
	public function Listar()
	{
		if($this->ticket >= 1)
		{
			$where = "WHERE ticket = $this->ticket";
		}
		elseif($this->ticket)
		{
			$where = "WHERE nome ILIKE '%$this->ticket%' OR email ILIKE '%$this->ticket%'";
		}
		else
		{
			$where = "";
		}
		$sql = "SELECT * FROM fale_conosco $where ORDER BY respondido, ticket";
		$res = pg_query($sql);
		if(pg_num_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return "Falha ao listar";
		}
		else
		{	
			return pg_fetch_all($res);
		}
	}
	public function Alterar()
	{
		$sql = "UPDATE fale_conosco SET respondido = '$this->respondido' WHERE ticket = $this->ticket";
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
}
?>