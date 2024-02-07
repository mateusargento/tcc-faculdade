<?php
//echo "<meta charset='UTF-8'>";

require_once ('../class/pedido.class.php');
//instanciar a classe cliente

	if($_POST){  //só vai funcionar se tiver algum dado enviado através do POST
		switch($_POST['submit']){
			case 'Finalizar Compra':

				$p1 = new Pedido();

				$resultado = $p1->UltimoPedido();
				if($resultado != 0)
				{
					$res = pg_fetch_all($resultado);
					foreach($res as $dado)
					{
						$ultimopedido = $dado['id_pedido_junto'];
					}
					$id_pedido_junto = $ultimopedido + 1;
				}
				else
				{
					$id_pedido_junto = 1;
				}
				
				session_start();
				$res = $_SESSION['carrinho'];

				$valortotal = 0;

				foreach($res as $dados)
				{
		// -------------------------- //
		// ----- CLASSE PEDIDO ------ //
		// -------------------------- //
					$p1->servico = $dados['servico'];
					$p1->nome_do_negocio = $dados['nome_do_negocio'];
					$p1->ramo_de_atuacao = $dados['ramo_de_atuacao'];
					$p1->caracteristica = $dados['caracteristica'];
					$p1->tipo = $dados['tipo'];
					$p1->prazo = $dados['prazo'];
					$p1->quantidade = $dados['quantidade'];
					$p1->descricao = $dados['descricao'];
					$p1->preco_final = $dados['preco_final'];

					$p1->status = 'Pedido realizado';

					//Data do pedido
					date_default_timezone_set('America/Sao_Paulo');
					$data_pedido = date("Y-m-d");
					$p1->data_pedido = $data_pedido;

					//Prazo
					if($dados['servico'] == "Consultoria Social Media")
					{
						$prazo = $dados['prazo'];
						$prazo = substr($prazo,0,-16);
					}
					else
					{
						$prazo = $dados['prazo'];
						$prazo = substr($prazo,0,-4);
					}

					//Data da entrega
					$data_entrega = date('Y-m-d', strtotime('+' . $prazo . ' days'));
					$p1->data_entrega = $data_entrega;
					$p1->tipo_servico = $dados['servico'];

					//ID pedido junto
					$p1->id_pedido_junto = $id_pedido_junto;

					//Código do cliente físico
					if(isset($_SESSION['codigo_cliente_fisico'])){ $p1->codigo_cliente_fisico_fk = $_SESSION['codigo_cliente_fisico']; }
					//Código do cliente jurídico
					if(isset($_SESSION['codigo_cliente_juridico'])){ $p1->codigo_cliente_juridico_fk = $_SESSION['codigo_cliente_juridico']; }
					//Código do serviço
					if(isset($dados['codigo_servico'])){ $p1->codigo_servico_fk = $dados['codigo_servico']; }
					//Código de consultoria
					if(isset($dados['codigo_consultoria'])){ $p1->codigo_consultoria_fk = $dados['codigo_consultoria']; }
					
					//Cadastra o pedido
					$resultado = $p1->Incluir();
					if($resultado != 'Falha ao comprar')
					{
						$valortotal += $dados['preco_final'];
					}
					
					$resultado = $p1->UltimoPedidoCodigoPedido();
					$res = pg_fetch_all($resultado);
					foreach($res as $dado)
					{
						$codigo_pedido = $dado['codigo_pedido'];
					}

		// -------------------------- //
		// ---- CLASSE PAGAMENTO ---- //
		// -------------------------- //
					require_once ('../class/pagamento.class.php');
					$pag = new Pagamento();
					//Tipo de pagamento
					if($_POST['tipodepagamento'] == 'cartaodecredito')
					{
						$pag->forma_pagamento = 'cc';
					}
					else
					{
						$pag->forma_pagamento = 'bb';
					}
					//Código do pedido
					$pag->codigo_pedido_fk = $codigo_pedido;
					//Código do cliente físico
					if(isset($_SESSION['codigo_cliente_fisico'])){ $pag->codigo_cliente_fisico_fk = $_SESSION['codigo_cliente_fisico']; }
					//Código do cliente jurídico
					if(isset($_SESSION['codigo_cliente_juridico'])){ $pag->codigo_cliente_juridico_fk = $_SESSION['codigo_cliente_juridico']; }
					//Código do profissional
					$pag->codigo_profissional_fk = 1;
					//Código do servico
					if(isset($dados['codigo_servico'])){ $pag->codigo_servico_fk = $dados['codigo_servico']; }
					//Código de consultoria
					if(isset($dados['codigo_consultoria'])){ $pag->codigo_consultoria_fk = $dados['codigo_consultoria']; }

					$pag->Incluir();
					$res = $pag->UltimoPagamento();
					if($res != 0)
					{
						foreach($res as $dado)
						{
							$codigo_pagamento = $dado['codigo_pagamento'];
						}
					}
				}
				$_SESSION['valor_boleto'] = $valortotal;
				if($_POST['tipodepagamento'] == 'cartaodecredito')
				{
		// ---------------------------------- //
		// ---- CLASSE CARTAO DE CREDITO ---- //
		// ---------------------------------- //
					require_once ('../class/cartao.class.php');
					$c1 = new Cartao();
					$c1->nomecartao = openssl_encrypt($_POST['nomecartao'],'aes-256-cfb8','senhaquecriamosparacriptografarosdados123@',0,'$fjkaE@sawh*86f9');
					$c1->numerocartao = openssl_encrypt($_POST['numerocartao'],'aes-256-cfb8','senhaquecriamosparacriptografarosdados123@',0,'$fjkaE@sawh*86f9');
					$c1->datadevencimento = openssl_encrypt($_POST['datadevencimento'],'aes-256-cfb8','senhaquecriamosparacriptografarosdados123@',0,'$fjkaE@sawh*86f9');
					$c1->cvv = openssl_encrypt($_POST['cvv'],'aes-256-cfb8','senhaquecriamosparacriptografarosdados123@',0,'$fjkaE@sawh*86f9');
					$c1->valor_total = $valortotal;
					$c1->parcelas = $_POST['parcelas'];
					$c1->id_pedido_junto = $id_pedido_junto;
					//Código do pedido
					$c1->codigo_pedido_fk = $codigo_pedido;
					//Código do cliente físico
					if(isset($_SESSION['codigo_cliente_fisico'])){ $c1->codigo_cliente_fisico_fk = $_SESSION['codigo_cliente_fisico']; }
					//Código do cliente jurídico
					if(isset($_SESSION['codigo_cliente_juridico'])){ $c1->codigo_cliente_juridico_fk = $_SESSION['codigo_cliente_juridico']; }
					//Código do profissional
					$c1->codigo_profissional_fk = 1;
					//Código do servico
					if(isset($dados['codigo_servico'])){ $c1->codigo_servico_fk = $dados['codigo_servico']; }
					//Código de consultoria
					if(isset($dados['codigo_consultoria'])){ $c1->codigo_consultoria_fk = $dados['codigo_consultoria']; }
					//Codigo do pagamento
					$c1->codigo_pagamento_fk = $codigo_pagamento;
					$c1->Incluir();
					$res = $pag->UltimoPagamento();
					echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.location.href='../view/aviso.php?mensagem=Compra+efetuada+com+sucesso!&p=minha-pagina/compras.php';
					   </SCRIPT>");
				}
				unset($_SESSION['carrinho']);
				echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.location.href='../view/compra-finalizada.php?mensagem=Compra+efetuada+com+sucesso!+Você+pode+gerar+o+seu+boleto+abaixo.&p=minha-pagina/compras.php';
					   </SCRIPT>");
			break;
			case 'Alterar':
				$p1 = new Pedido();

				$p1->id_pedido_junto = $_POST['id_pedido_junto'];
				$p1->status = $_POST['status'];
				$res = $p1->Alterar();
				
				if($res != "Falha ao alterar")
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Status+alterado+com+sucesso!&p=pcontrole/meus-trabalhos.php';
					   	   </SCRIPT>");
				}
				else
				{
					echo ("<SCRIPT LANGUAGE='JavaScript'>
								window.location.href='../view/aviso.php?mensagem=Erro+ao+alterar+status!+Tente+novamente.&p=pcontrole/meus-trabalhos.php';
					   	   </SCRIPT>");
				}
			break;
		}
		
	}
?>