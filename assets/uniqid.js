// Gera uma hash de criador se não existir
if (!localStorage.getItem('creatorID'))
    localStorage.setItem('creatorID', Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15))
$('head').append('<script>idCriador = "'+localStorage.getItem('creatorID')+'"</script>')