$(document).ready(function () {

    // Atualiza periodicamente se não for o criador
    if (!criador)
        setInterval(function () {
            codPartida = codPartida
            url = base_url + '/partida/atualizaPlacar'
            $.ajax({
                url: url,
                dataType: 'JSON',
                data: { codPartida },
                type: 'post',
                complete: function (resultado) {
                    resultado = resultado.responseText.split('<')[0]
                    arrayValores = JSON.parse(resultado)
                    arrayValores.forEach(function (item, key) {
                        campoValor = $('[name="pontuacao"]')[key]
                        $(campoValor).empty()
                        $(campoValor).append(item)
                    })
                }
            })
        }, 15000)

    $('button[name=subtrai]').click(function () {
        codJogador = $(this).closest('.row').find('input[type="hidden"]').val()
        valor = $(this).closest('.row').find('input[type="number"]').val()
        divPontuacao = $(this).parents('.equipe').children('.pontuacao')
        url = base_url + 'jogadores/diminuirPontuacao'
        if (valor)
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'JSON',
                data: { codJogador, valor },
                complete: function (resposta) {
                    novoValor = resposta.responseText.split('<')[0]
                    $(divPontuacao).empty()
                    $(divPontuacao).append(novoValor)
                }
            })
    })
    $('button[name=add]').click(function () {
        codJogador = $(this).closest('.row').find('input[type="hidden"]').val()
        valor = $(this).closest('.row').find('input[type="number"]').val()
        divPontuacao = $(this).parents('.equipe').children('.pontuacao')
        url = base_url + 'jogadores/adicionarPontuacao'
        if (valor)
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'JSON',
                data: { codJogador, valor },
                complete: function (resposta) {
                    novoValor = resposta.responseText.split('<')[0]
                    $(divPontuacao).empty()
                    $(divPontuacao).append(novoValor)
                    if (novoValor >= 30) {
                        nome = $(divPontuacao).parent().children('.nomeEquipe').html()
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        })

                        swalWithBootstrapButtons.fire({
                            title: nome + 'venceu a partida!',
                            text: "Deseja reiniciar e jogar de novo?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Sim, com certeza!',
                            cancelButtonText: 'Não, fica pra próxima!',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.value) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Beleza!',
                                    text: 'Reiniciando contadores!',
                                    timer: 2000,
                                    timerProgressBar: true,
                                    showConfirmButton: false
                                })
                                setTimeout(function() {
                                $.ajax({
                                    url: base_url + 'jogadores/reiniciarPartida',
                                    type: 'post',
                                    dataType: 'JSON',
                                    data: {codPartida},
                                    complete: function(resposta) {
                                        valorInicial = resposta.responseText.split('<')[0]
                                        $('[name="pontuacao"]').each(function (key, item) {
                                            $(item).empty()
                                            $(item).append(valorInicial)
                                        })
                                    }
                                })},500)
                            }
                        })
                    }
                }
            })
    })
})