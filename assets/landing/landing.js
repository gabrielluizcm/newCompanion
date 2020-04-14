$(document).ready(function() {
    // Máscara código partida
    $('.codigo').mask('00000')

    $('[data-toggle="tooltip"]').tooltip()

    $('#entrada').click(function () {
        idCriador = localStorage.getItem('creatorID')
        codPartida = $('#codPartida').val()
        senha = $('#senha').val()
        url = base_url + 'landing/entrar'
        $.ajax({
            url: url,
            type: 'post',
            data: {idCriador, codPartida, senha},
            complete: function(resposta) {
                retorno = resposta.responseText.split('<')[0]
                console.log(retorno)
                switch (retorno) {
                    case '1':
                        Swal.fire({
                            icon: 'success',
                            title: 'Fechou todas!',
                            text: 'Vou te redirecionar pra partida como criador!',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        })
                        setTimeout(function() {
                            window.location.href = base_url+'partida/controle/'+codPartida
                        }, 2000)
                        break
                    case '0':
                        Swal.fire({
                            icon: 'success',
                            title: 'Fechou todas!',
                            text: 'Vou te redirecionar pra partida!',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        })
                        setTimeout(function() {
                            window.location.href = base_url+'partida/jogador/'+codPartida
                        }, 2000)
                        break
                    case '-1':
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Não existe uma partida com esse código',
                        })
                    default:
                        // fix erro do servidor 000webhost
                        $('#entrada').click()
                }
            }
        })
    })
})