<?php
include "../Relatorios/conecta.php";

session_start();
error_reporting(E_ALL ^ E_NOTICE);

// +----------------------------------------------------------------------+
// | BoletoPhp - Versão Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo está disponível sob a Licença GPL disponível pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Você deve ter recebido uma cópia da GNU Public License junto com     |
// | esse pacote; se não, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colaborações de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de João Prado Maia e Pablo Martins F. Costa				        |
// | 														                                   			  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordenação Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto Itaú: Glauber Portella                        |
// +----------------------------------------------------------------------+

echo "<button onclick='window.print()' style='margin-top: 10px; marigin-left: 10px;'>Imprimir</button>";

if(isset($_SESSION['codigo_cliente_fisico']))
{
    $sql = "SELECT * FROM pagamento
            INNER JOIN pedido ON pagamento.codigo_pedido_fk = pedido.codigo_pedido
            INNER JOIN cliente_fisico ON pagamento.codigo_cliente_fisico_fk = cliente_fisico.codigo_cliente_fisico
            WHERE pagamento.forma_pagamento = 'bb' AND pagamento.codigo_cliente_fisico_fk = " . $_SESSION['codigo_cliente_fisico'] . " AND id_pedido_junto = (SELECT id_pedido_junto FROM pedido WHERE pedido.codigo_cliente_fisico_fk = " . $_SESSION['codigo_cliente_fisico'] . " ORDER BY id_pedido_junto DESC LIMIT 1)
            ORDER BY id_pedido_junto DESC";

    $tiptstuser = "cf";
}
elseif(isset($_SESSION['codigo_cliente_juridico']))
{
    $sql = "SELECT * FROM pagamento
            INNER JOIN pedido ON pagamento.codigo_pedido_fk = pedido.codigo_pedido
            INNER JOIN cliente_juridico ON pagamento.codigo_cliente_juridico_fk = cliente_juridico.codigo_cliente_juridico
            WHERE pagamento.forma_pagamento = 'bb' AND pagamento.codigo_cliente_juridico_fk = " . $_SESSION['codigo_cliente_juridico'] . " AND id_pedido_junto = (SELECT id_pedido_junto FROM pedido WHERE pedido.codigo_cliente_juridico_fk = " . $_SESSION['codigo_cliente_juridico'] . " ORDER BY id_pedido_junto DESC LIMIT 1)
            ORDER BY id_pedido_junto DESC";
    
    $tiptstuser = "cj";
}

if($_POST)
{
    $id_pedido_junto = $_POST['id_pedido_junto'];

    if(isset($_SESSION['codigo_cliente_fisico']))
    {
        $sql = "SELECT * FROM pagamento
                INNER JOIN pedido ON pagamento.codigo_pedido_fk = pedido.codigo_pedido
                INNER JOIN cliente_fisico ON pagamento.codigo_cliente_fisico_fk = cliente_fisico.codigo_cliente_fisico
                WHERE pagamento.forma_pagamento = 'bb' AND pagamento.codigo_cliente_fisico_fk = " . $_SESSION['codigo_cliente_fisico'] . " AND id_pedido_junto = $id_pedido_junto
                ORDER BY id_pedido_junto DESC";
        
        $tiptstuser = "cf";
    }
    elseif(isset($_SESSION['codigo_cliente_juridico']))
    {
        $sql = "SELECT * FROM pagamento
                INNER JOIN pedido ON pagamento.codigo_pedido_fk = pedido.codigo_pedido
                INNER JOIN cliente_juridico ON pagamento.codigo_cliente_juridico_fk = cliente_juridico.codigo_cliente_juridico
                WHERE pagamento.forma_pagamento = 'bb' AND pagamento.codigo_cliente_juridico_fk = " . $_SESSION['codigo_cliente_juridico'] . " AND id_pedido_junto = $id_pedido_junto
                ORDER BY id_pedido_junto DESC";

        $tiptstuser = "cj";
    }
}

//SELECT DO BANCO
$res = @pg_query($sql);
$dados = @pg_fetch_all($res);

foreach ($dados as $dad) {
    if($tiptstuser == "cf")
    {
        $nome 				    = $dad['nome'];
        $sobrenome   		    = $dad['sobrenome'];
    }
    elseif($tiptstuser == "cj")
    {
        $nome 				    = $dad['nome_fantasia'];
        $sobrenome   		    = $dad['razao_social'];
    }
	$cpf   				    = $dad['cpf'];
    $celular   				= $dad['celular'];
    $endereco               = $dad['endereco'];
    $numero                 = $dad['numero'];
    $complemento            = $dad['complemento'];
    $bairro                 = $dad['bairro'];
    $cidade                 = $dad['cidade'];
    $estado                 = $dad['estado'];
    $cep                    = $dad['cep'];
    $valor_total            += $dad['valor_total'];
}

// ------------------------- DADOS DINÂMICOS DO SEU CLIENTE PARA A GERAÇÃO DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formulário c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = 2.95;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = "2950,00"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = '12345678';  // Nosso numero - REGRA: Máximo de 8 caracteres!
$dadosboleto["numero_documento"] = '0123';	// Num do pedido ou nosso numero
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = number_format($valor_total,2,",",".");
//$_SESSION['valor_boleto']; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = utf8_decode($nome) . " " . utf8_decode($sobrenome);
$dadosboleto["endereco1"] = utf8_decode($endereco)  . " " . $numero  . " " . strtoupper($complemento);
$dadosboleto["endereco2"] = $cep . " - " . utf8_decode($bairro) . " - " . utf8_decode($cidade) . " " . strtoupper($estado);

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "Pagamento de Compra em BNG Design";
$dadosboleto["demonstrativo2"] = utf8_decode("Taxa bancária - R$ ").number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo3"] = "BNG Design - www.bngdesign.com.br";
$dadosboleto["instrucoes1"] = utf8_decode("- Sr. Caixa, cobrar multa de 2% após o vencimento");
$dadosboleto["instrucoes2"] = utf8_decode("- Receber até 10 dias após o vencimento");
$dadosboleto["instrucoes3"] = utf8_decode("- Em caso de dúvidas entre em contato conosco: bangubngdesign@gmail.com ");
$dadosboleto["instrucoes4"] = "&nbsp; Emito por BNG Design";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - ITAÚ
$dadosboleto["agencia"] = "1565"; // Num da agencia, sem digito
$dadosboleto["conta"] = "13877";	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "4"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - ITAÚ
$dadosboleto["carteira"] = "175";  // Código da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

// SEUS DADOS
$dadosboleto["identificacao"] = "Boleto de compra em BNG Design";
$dadosboleto["cpf_cnpj"] = "400.289.220-00";
$dadosboleto["endereco"] = "Avenida Rio Branco, 156";
$dadosboleto["cidade_uf"] = "Rio de Janeiro / Rio de Janeiro";
$dadosboleto["cedente"] = "Bangu Design";

// NÃO ALTERAR!
include("include/funcoes_itau.php"); 
include("include/layout_cef.php");


date_default_timezone_set('America/Sao_Paulo');
$diaehora = date("d-m-Y.H-m-i");
$nomedoboleto = 'teste';
//$dadosboleto->Output($nomedoboleto."boleto". $diaehora);
?>
