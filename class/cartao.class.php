<?php
include 'conecta.php';

class Cartao{
	public $codigo_cartao_de_credito;
	public $nomecartao;
	public $numerocartao ;
	public $datadevencimento;
	public $cvv;
	public $valor_total;
	public $parcelas;
	public $id_pedido_junto;
	public $codigo_pedido_fk;
	public $codigo_cliente_fisico_fk;
	public $codigo_cliente_juridico_fk;
	public $codigo_profissional_fk;
	public $codigo_servico_fk;
	public $codigo_consultoria_fk;
	public $codigo_pagamento_fk;
    
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

		$sql = "INSERT INTO cartao_de_credito (nomecartao, numerocartao, datadevencimento, cvv, valor_total, parcelas, id_pedido_junto, codigo_pedido_fk, $codigo_cliente_fisico_fk $codigo_cliente_juridico_fk codigo_profissional_fk, $codigo_servico_fk $codigo_consultoria_fk codigo_pagamento_fk) VALUES ('$this->nomecartao', '$this->numerocartao', '$this->datadevencimento', '$this->cvv', '$this->valor_total', '$this->parcelas', '$this->id_pedido_junto', '$this->codigo_pedido_fk', $codigo_cliente_fisico_fk2 $codigo_cliente_juridico_fk2 '$this->codigo_profissional_fk', $codigo_servico_fk2 $codigo_consultoria_fk2 $this->codigo_pagamento_fk)";
		$res = pg_query($sql);
		if(pg_affected_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return "Falha ao comprar";
		}
		else
		{	
			return pg_num_rows($res);
		}
		
    }

	public function Listar()
	{
		if($this->codigo_cartao_de_credito >= 1)
		{
			$codigo_cartao_de_credito = $this->codigo_cartao_de_credito;
			$codigo_cartao_de_credito = str_replace(",","",$codigo_cartao_de_credito);
			$codigo_cartao_de_creditoint = (int) $codigo_cartao_de_credito;

			$where = "WHERE codigo_cartao_de_credito = $codigo_cartao_de_creditoint OR car.valor_total = '$codigo_cartao_de_credito' OR parcelas = '$codigo_cartao_de_credito'";
		}
		else
		{
			$where = "";
		}

		$sql = "SELECT *, car.valor_total as valor_total_cartao FROM cartao_de_credito car
				INNER JOIN pedido ped on car.codigo_pedido_fk = ped.codigo_pedido
				$where";
		$res = pg_query($sql);
		if(pg_num_rows($res) > 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return pg_fetch_all($res);
		}
		else
		{
			return "Falha ao listar";
		}
	}
}
?>