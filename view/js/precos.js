function precosPersonaliza()
{
    // Este é o valor inicial do serviço
    var precoInicial = document.getElementById("preco_produto")
    // Estes são os valores definidos, que estão nos IDs, das personalizações.
    var adicionalP1 = document.querySelector("input[name='p1']:checked")
    var adicionalP2 = document.querySelector("input[name='p2']:checked")
    var adicionalP3 = document.querySelector("input[name='p3']:checked")
    //Esta é a quantidade de serviços iguais
    var quantidade = document.getElementById("p4")
    
    // É somado todos o valor inicial com os valores das personalizações e multiplicado pela quantidade
    var precoNovo = (parseFloat(precoInicial.value) + parseFloat(adicionalP1.id) + parseFloat(adicionalP2.id) + parseFloat(adicionalP3.id)) * parseFloat(quantidade.value)
    // A parcela dividida por 10
    var parcelaNova = precoNovo / 10
    
    //Formata o valor do preço para que fique no formato padrão. Ex.: R$1.000,00
    var n = new Number(`${precoNovo.toFixed(2)}`);
    var formatadorNumeros = {
    style: "currency",
    currency: "BRL"
    }
    document.getElementById("preco").innerHTML =  n.toLocaleString("pt-BR", formatadorNumeros)

    //Formata o valor da parcela para que fique no formato padrão. Ex.: R$1.000,00
    var m = new Number(`${parcelaNova.toFixed(2)}`);
    var formatadorNumeros = {
    style: "currency",
    currency: "BRL"
    }
    document.getElementById("parcela").innerHTML = m.toLocaleString("pt-BR", formatadorNumeros)

    //Envia o valor do preço final para input para que possa ser calculado o valor final
    document.getElementById("preco_final").value =  `${precoNovo.toFixed(2)}`
}