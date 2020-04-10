$(document).ready(function() {
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
                        Swal.fire(
                            'Fechou todas!',
                            'Vou te redirecionar para o controle da partida!',
                            'success'
                          )
                        break
                    case '0':
                        Swal.fire(
                            'Fechou todas!',
                            'Vou te redirecionar pra partida!',
                            'success'
                          )
                        break
                    case '-1':
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Não existe uma partida com esse código',
                          })
                }
            }
        })
    })
})