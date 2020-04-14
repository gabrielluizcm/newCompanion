$(document).ready(function() {
    $('#cor').val('red')
    $('#cor').change(function() {
        cor = $(this).val()
        $(this).css('color', cor)
    })
    $('i').click(function() {
        codJogador = $(this).siblings('input').val()
        div = $(this).parents('div[name="jogadorIncluso"]')
        url = base_url + '/jogadores/remover'
        $.ajax({
            url: url,
            dataType: 'JSON',
            data: {codJogador, codPartida},
            type: 'post',
            complete: function(resposta) {
                resposta = resposta.responseText.split('<')[0]
                div.remove()
                if (resposta < 2)
                    $('#botaoIniciar').attr('disabled', true) 
                else
                    $('#botaoIniciar').attr('disabled', false)
            }
        })
    })
    $('#botaoIniciar').click(function() {
        window.location.href = base_url+'partida/controle/'+codPartida
    })
})
