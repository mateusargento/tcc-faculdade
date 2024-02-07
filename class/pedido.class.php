<?php
include 'conecta.php';

class Pedido{
	public $codigo_pedido;
	public $status;
	public $nome_do_negocio;
	public $ramo_de_atuacao;
	public $caracteristica;
	public $tipo;
	public $tipo_servico;
	public $prazo;
	public $quantidade;
	public $descricao;
	public $preco_final;
	public $data_pedido;
	public $data_entrega;
	public $id_pedido_junto;
	public $codigo_cliente_fisico_fk;
    public $codigo_cliente_juridico_fk;
    public $codigo_profissional_fk;
    public $codigo_servico_fk;
    public $codigo_consultoria_fk;

	public function UltimoPedido()
	{
		$sql = "SELECT codigo_pedido, id_pedido_junto FROM pedido ORDER BY id_pedido_junto DESC LIMIT 1";
		$res = pg_query($sql);
		if(pg_num_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return 0;
		}
		else
		{	
			return $res;
		}
	}
	
	public function UltimoPedidoCodigoPedido()
	{
		$sql = "SELECT codigo_pedido FROM pedido ORDER BY codigo_pedido DESC LIMIT 1";
		$res = pg_query($sql);
		if(pg_num_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return 0;
		}
		else
		{	
			return $res;
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

		$sql = "INSERT INTO pedido (status, tipo, nome_do_negocio, ramo_de_atuacao, p1_tipo, p2_tipo, p3_tipo, quantidade, descricao, valor_total, data_pedido, data_entrega, id_pedido_junto, $codigo_cliente_fisico_fk $codigo_cliente_juridico_fk $codigo_servico_fk $codigo_consultoria_fk codigo_profissional_fk) VALUES ('$this->status', '$this->tipo_servico', '$this->nome_do_negocio', '$this->ramo_de_atuacao', '$this->caracteristica', '$this->tipo', '$this->prazo', '$this->quantidade', '$this->descricao', '$this->preco_final', '$this->data_pedido', '$this->data_entrega', $this->id_pedido_junto, $codigo_cliente_fisico_fk2 $codigo_cliente_juridico_fk2 $codigo_servico_fk2 $codigo_consultoria_fk2 1)";
		$res = pg_query($sql);
		if(pg_affected_rows($res) == 0) // Affected_rows verifica quantas linhas foram afetadas, se houve alteração no banco de dados
		{
			return "Falha ao comprar";
		}
		else
		{	
			$sql = "SELECT codigo_pedido FROM pedido ORDER BY codigo_pedido DESC LIMIT 1";
			$res = pg_query($sql);
			return pg_fetch_all($res);
		}
		
    }
    
    public function Alterar()
	{
		$sql = "UPDATE pedido SET status = '$this->status' WHERE id_pedido_junto = '$this->id_pedido_junto'";
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

	public function Listar()
	{
		/*$sql = "SET DATESTYLE TO 'SQL, DMY';
				SELECT ped.codigo_pedido, ped.status, ped.tipo, ped.nome_do_negocio, ped.ramo_de_atuacao, ped.p1_tipo, ped.p2_tipo, ped.p3_tipo, ped.quantidade, ped.descricao, ped.valor_total, ped.data_pedido, ped.data_entrega, ped.id_pedido_junto, ped.codigo_cliente_fisico_fk, ped.codigo_cliente_juridico_fk, ped.codigo_profissional_fk, ped.codigo_servico_fk, ped.codigo_consultoria_fk, pag.codigo_pagamento, pag.forma_pagamento, pag.codigo_pedido_fk, pag.codigo_cliente_fisico_fk, pag.codigo_cliente_juridico_fk, pag.codigo_profissional_fk, pag.codigo_servico_fk, pag.codigo_consultoria_fk, car.codigo_cartao_de_credito, car.parcelas, car.codigo_pedido_fk, car.codigo_cliente_fisico_fk, car.codigo_cliente_juridico_fk, car.codigo_profissional_fk, car.codigo_servico_fk, car.codigo_consultoria_fk, car.codigo_pagamento_fk
				FROM pedido ped 
				INNER JOIN pagamento pag ON ped.codigo_pedido = pag.codigo_pedido_fk
				INNER JOIN cartao_de_credito car ON ped.id_pedido_junto = car.id_pedido_junto
				ORDER BY ped.codigo_pedido";*/
		if($this->codigo_cliente_fisico_fk != '')
		{
			$where = "WHERE ped.codigo_cliente_fisico_fk = $this->codigo_cliente_fisico_fk";
		}
		else if($this->codigo_cliente_juridico_fk != '')
		{
			$where = "WHERE ped.codigo_cliente_juridico_fk = $this->codigo_cliente_juridico_fk";
		}

		$sql = "SET DATESTYLE TO 'SQL, DMY';
				SELECT ped.codigo_pedido, ped.status, ped.tipo, ped.nome_do_negocio, ped.ramo_de_atuacao, ped.p1_tipo, ped.p2_tipo, ped.p3_tipo, ped.quantidade, ped.descricao, ped.valor_total, ped.data_pedido, ped.data_entrega, ped.id_pedido_junto, ped.codigo_cliente_fisico_fk, ped.codigo_cliente_juridico_fk, ped.codigo_profissional_fk, ped.codigo_servico_fk, ped.codigo_consultoria_fk, pag.codigo_pagamento, pag.forma_pagamento, pag.codigo_pedido_fk, pag.codigo_cliente_fisico_fk, pag.codigo_cliente_juridico_fk, pag.codigo_profissional_fk, pag.codigo_servico_fk, pag.codigo_consultoria_fk
				FROM pedido ped 
				INNER JOIN pagamento pag ON ped.codigo_pedido = pag.codigo_pedido_fk
				$where
				ORDER BY ped.codigo_pedido DESC";
		$res = pg_query($sql);
		if(pg_num_rows($res) > 0)
		{
			return pg_fetch_all($res);
		}
		else
		{
			return "Sem pedidos cadastrados";
		}
	}

	public function ListarTodosClienteFisico()
	{
		if($this->codigo_pedido >= 1)
		{
			$where = "WHERE codigo_pedido = $this->codigo_pedido";
		}
		elseif($this->codigo_pedido)
		{
			$where = "WHERE tipo ILIKE '%$this->codigo_pedido%' OR email ILIKE '%$this->codigo_pedido%'";
		}
		else
		{
			$where = "";
		}

		$sql = "SET DATESTYLE TO 'SQL, DMY';
				SELECT ped.codigo_pedido, ped.status, ped.tipo, ped.nome_do_negocio, ped.ramo_de_atuacao, ped.p1_tipo, ped.p2_tipo, ped.p3_tipo, ped.quantidade, ped.descricao, ped.valor_total, ped.data_pedido, ped.data_entrega, ped.id_pedido_junto, ped.codigo_cliente_fisico_fk, ped.codigo_cliente_juridico_fk, ped.codigo_profissional_fk, ped.codigo_servico_fk, ped.codigo_consultoria_fk, pag.codigo_pagamento, pag.forma_pagamento, pag.codigo_pedido_fk, pag.codigo_cliente_fisico_fk, pag.codigo_cliente_juridico_fk, pag.codigo_profissional_fk, pag.codigo_servico_fk, pag.codigo_consultoria_fk, clf.nome, clf.sobrenome, clf.email
				FROM pedido ped 
				INNER JOIN pagamento pag ON ped.codigo_pedido = pag.codigo_pedido_fk
				INNER JOIN cliente_fisico clf ON ped.codigo_cliente_fisico_fk = clf.codigo_cliente_fisico
				$where
				ORDER BY ped.codigo_pedido DESC";
		$res = pg_query($sql);
		if(pg_num_rows($res) > 0)
		{
			return pg_fetch_all($res);
		}
		else
		{
			return "Sem pedidos cadastrados";
		}
	}

	public function ListarTodosClienteJuridico()
	{
		if(is_int($this->codigo_pedido))
		{
			$where = "WHERE codigo_pedido = $this->codigo_pedido";
		}
		elseif($this->codigo_pedido)
		{
			$where = "WHERE tipo ILIKE '$this->codigo_pedido' OR email ILIKE '$this->codigo_pedido'";
		}
		else
		{
			$where = "";
		}

		$sql = "SET DATESTYLE TO 'SQL, DMY';
				SELECT ped.codigo_pedido, ped.status, ped.tipo, ped.nome_do_negocio, ped.ramo_de_atuacao, ped.p1_tipo, ped.p2_tipo, ped.p3_tipo, ped.quantidade, ped.descricao, ped.valor_total, ped.data_pedido, ped.data_entrega, ped.id_pedido_junto, ped.codigo_cliente_fisico_fk, ped.codigo_cliente_juridico_fk, ped.codigo_profissional_fk, ped.codigo_servico_fk, ped.codigo_consultoria_fk, pag.codigo_pagamento, pag.forma_pagamento, pag.codigo_pedido_fk, pag.codigo_cliente_fisico_fk, pag.codigo_cliente_juridico_fk, pag.codigo_profissional_fk, pag.codigo_servico_fk, pag.codigo_consultoria_fk, clj.razao_social, clj.nome_fantasia, clj.email
				FROM pedido ped 
				INNER JOIN pagamento pag ON ped.codigo_pedido = pag.codigo_pedido_fk
				INNER JOIN cliente_juridico clj ON ped.codigo_cliente_juridico_fk = clj.codigo_cliente_juridico
				$where
				ORDER BY ped.codigo_pedido DESC";
		$res = pg_query($sql);
		if(pg_num_rows($res) > 0)
		{
			return pg_fetch_all($res);
		}
		else
		{
			return "Sem pedidos cadastrados";
		}
	}
}
?>