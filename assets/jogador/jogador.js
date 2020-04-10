$(document).ready(function() {
    $('#cor').val('red')
    $('#cor').change(function() {
        cor = $(this).val()
        $(this).css('color', cor)
    })
})

