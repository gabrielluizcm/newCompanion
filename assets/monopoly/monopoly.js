$(document).ready(function () {
    $("a").mouseenter(function(){
        $(this).css('color', 'white')
        $(this).css('background-color', $(this).closest('tr').css('color'))
    }).mouseleave(function(){
        $(this).css('color', $(this).closest('tr').css('color'))
        $(this).css('background', 'transparent')
    });

    // Adicionar valor
    $('button[name="deposito"]').click(function () {
        codJogador = $(this).parent().parent().find('input[type="hidden"]').val()
        valor = $(this).parent().parent().find('input[type="text"]').val()
        url = base_url + '/jogadores/adicionarPontuacao'
        campoValor = '#valorJogador' + codJogador
        $.ajax({
            url: url,
            dataType: 'JSON',
            data: {valor, codJogador},
            type: 'post',
            complete: function(resultado) {
                novoValor = resultado.responseText.split('<')
                $(campoValor).empty()
                $(campoValor).append('R$ <span class="money">'+parseFloat(novoValor[0])+',00</span>')
                $('.money').mask('000.000.000.000.000,00', {reverse: true})
            }
        })
    })

    // Subtrair valor
    $('button[name="saque"]').click(function () {
        codJogador = $(this).parent().parent().find('input[type="hidden"]').val()
        valor = $(this).parent().parent().find('input[type="text"]').val()
        url = base_url + '/jogadores/diminuirPontuacao'
        campoValor = '#valorJogador' + codJogador
        $.ajax({
            url: url,
            dataType: 'JSON',
            data: {valor, codJogador},
            type: 'post',
            complete: function(resultado) {
                novoValor = resultado.responseText.split('<')
                $(campoValor).empty()
                $(campoValor).append('R$ <span class="money">'+parseFloat(novoValor[0])+',00</span>')
                $('.money').mask('000.000.000.000.000,00', {reverse: true})
            }
        })
    })

    // Transferir valor
    $('button[name="transfere"]').click(function () {
        codJogador = $(this).parent().parent().find('input[type="hidden"]').val()
        jogadorTransf = $(this).parent().parent().find('select').val()
        valor = $(this).parent().parent().find('input[type="text"]').val()
        url = base_url + '/jogadores/transferirPontuacao'
        campoValorOrigem = '#valorJogador' + codJogador
        campoValorDestino = '#valorJogador' + jogadorTransf
        $.ajax({
            url: url,
            dataType: 'JSON',
            data: {valor, codJogador, jogadorTransf},
            type: 'post',
            complete: function(resultado) {
                novosValores = resultado.responseText.split('<')
                $(campoValorOrigem).empty()
                $(campoValorOrigem).append('R$ <span class="money">'+parseFloat(novosValores[0].split(' ')[0].replace('"', ''))+',00</span>')
                $(campoValorDestino).empty()
                $(campoValorDestino).append('R$ <span class="money">'+parseFloat(novosValores[0].split(' ')[1])+',00</span>')
                $('.money').mask('000.000.000.000.000,00', {reverse: true})
            }
        })
    })

    // Máscara dinheiro
    $('.money').mask('000.000.000.000.000,00', {reverse: true})
})