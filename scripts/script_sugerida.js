var search = document.getElementById('pesquisar');
function searchData()
{
    window.location = 'listar_pergunta_sugerida.php?search='+search.value;
}