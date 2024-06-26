function alerta(id){

    let id_chamado = id
    // let form = document.createElement('form')
    // form.action = "#"
    // form.method = "POST"

    // let inputChamado = document.createElement('input')
    // inputChamado.type = "text"
    // inputChamado.name = "chamado"
    // inputChamado.classList = "form-control"


    // let button = document.createElement('button')
    // button.type = "submit"
    // button.className = "btn btn-info"
    // button.innerHTML = "Salvar"


    // form.appendChild(inputChamado)
    // form.appendChild(button)


    // let chamado = document.getElementById('Chamado_'+chamado);
    alert('conectado. ID: ' + id_chamado);
}

function removerChamado(id) {
    let id_chamado = id;
    if (confirm("Tem certeza que deseja excluir o chamado: " + id_chamado + "?")) {
        location.href = '/qualitysphere/app/Controllers/ChamadoController.php?request=remover&id=' + id_chamado;
    } 
}
function alterarSenha() {
    let formularioSenha = document.getElementById('form_senha');

    // Verifica se o formulário está visível
    if (formularioSenha.style.display === 'none' || formularioSenha.style.display === '') {
        formularioSenha.style.display = 'block'; // Mostra o formulário
    } else {
        formularioSenha.style.display = 'none'; // Oculta o formulário
    }
}