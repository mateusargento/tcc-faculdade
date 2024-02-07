<?php
include 'conecta.php';

class Pagamento{
	public $codigo_pagamento;
	public $forma_pagamento;
	public $codigo_pedido_fk;
	public $codigo_cliente_fisico_fk;
	public $codigo_cliente_juridico_fk;
	public $codigo_profissional_fk;
	public $codigo_servico_fk;
	public $codigo_consultoria_fk;

	public function UltimoPagamento()
	{
		$sql = "SELECT codigo_pagamento FROM pagamento ORDER BY codigo_pagamento DESC LIMIT 1";
		$res = pg_query($sql);
		if(pg_num_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return 0;
		}
		else
		{	
			return pg_fetch_all($res);
		}
    }
    
    public function Incluir()
	{
		$codigo_cliente_fisico_fk = '';
		$codigo_cliente_fisico_fk2 = '';
		$codigo_cliente_juridico_fk = '';
		$codigo_cliente_juridico_fk2 = '';
		$codigo_servico_fk = '';
		$codigo_servico_fk2 = '';
		$codigo_consultoria_fk = '';
		$codigo_consultoria_fk2 = '';
		if(isset($this->codigo_cliente_fisico_fk))
		{
			$codigo_cliente_fisico_fk = 'codigo_cliente_fisico_fk, ';
			$codigo_cliente_fisico_fk2 = $this->codigo_cliente_fisico_fk . ', ';
		}
		if(isset($this->codigo_cliente_juridico_fk))
		{
			$codigo_cliente_juridico_fk = 'codigo_cliente_juridico_fk, ';
			$codigo_cliente_juridico_fk2 = $this->codigo_cliente_juridico_fk . ', ';
		}
		if(isset($this->codigo_servico_fk))
		{
			$codigo_servico_fk = 'codigo_servico_fk, ';
			$codigo_servico_fk2 = $this->codigo_servico_fk . ', ';
		}
		if(isset($this->codigo_consultoria_fk))
		{
			$codigo_consultoria_fk = 'codigo_consultoria_fk, ';
			$codigo_consultoria_fk2 = $this->codigo_consultoria_fk . ', ';
		}
		
		$sql = "INSERT INTO pagamento (forma_pagamento, codigo_pedido_fk, $codigo_cliente_fisico_fk $codigo_cliente_juridico_fk $codigo_servico_fk $codigo_consultoria_fk codigo_profissional_fk) VALUES ('$this->forma_pagamento', '$this->codigo_pedido_fk', $codigo_cliente_fisico_fk2 $codigo_cliente_juridico_fk2 $codigo_servico_fk2 $codigo_consultoria_fk2 1)";
		$res = pg_query($sql);
		if(pg_affected_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return "Falha ao comprar";
		}
		else
		{	
			$sql = "SELECT codigo_pagamento FROM pagamento ORDER BY codigo_pagamento DESC LIMIT 1";
			$res = pg_query($sql);
			return pg_fetch_all($res);
		}
		
    }
    
    public function Alterar()
	{
		$sql = "UPDATE pagamento SET codigo_pedido = '$this->codigo_pedido', status = '$this->status', data_pedido = '$this->data_pedido', data_entrega = '$this->data_entrega' WHERE codigo_pedido = '$this->codigo_pedido'";
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
}
?>