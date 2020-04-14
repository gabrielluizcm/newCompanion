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
                            url = base_url + 'partida/index/'+codPartida;
                            form = $('<form action="' + url + '" method="post">' +
                                        '<input type="hidden" name="isCriador" value="1" />' +
                                    '</form>');
                            $('body').append(form)
                            form.submit();
                            $(form).remove();
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
                            window.location.href = base_url+'partida/index/'+codPartida
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

    $('#criarPartida').click(function () {
        if ((senha = $('#senhaCriacao').val()) && (codJogo = $('#codJogo').val())) {
            url = base_url + 'landing/criar'
            Swal.fire({
                icon: 'success',
                title: 'Partida criada!',
                text: 'Agora vamos cadastrar os jogadores!',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false
            })
            setTimeout(function() {
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {senha, codJogo, idCriador},
                    complete: function(resposta) {
                        codPartida = resposta.responseText.split('<')[0]
                        window.location.href = base_url + 'jogadores/index/' + codPartida
                    }
                })
            },2000)
        }
        else {
            Swal.fire({
                icon: 'error',
                title: 'Ops! Campos em branco!',
                text: 'Você deve escolher um jogo e informar uma senha!',
            })
        }
    })
})