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
//Excluir chamado
function removerChamado(id) {
    let id_chamado = id;
    if (confirm("Tem certeza que deseja excluir o chamado: " + id_chamado + "?")) {
        location.href = '/qualitysphere/app/Controllers/ChamadoController.php?request=remover&id=' + id_chamado;
    } 
}

//Excluir usuário
function removerUser(id) {

    let id_user = id;
    
    if (confirm("Tem certeza que deseja excluir o usuário?")) {
        location.href = '/qualitysphere/app/Controllers/UserController.php?request=remover&id=' + id_user;
    } 
}

//Menu configuração 
function alterarSenha() {
    let formularioSenha = document.getElementById('form_senha');

    if (formularioSenha.style.display === 'none' || formularioSenha.style.display === '') {
        formularioSenha.style.display = 'block'; 
    } else {
        formularioSenha.style.display = 'none'; 
    }
}

// Confirma se nova senha e o confirmar nova senha são iguais
function validarSenha() {
    var senha = document.getElementsByName('nova_senha')[0].value;
    var confirmarSenha = document.getElementsByName('confirmar_nova_senha')[0].value;
    var mensagemErro = document.getElementById('mensagemErro');

    if (confirmarSenha != senha) {
        mensagemErro.textContent = "A nova senha e o confirmar nova senha devem ser iguais!";

         return false;
    } else {
        mensagemErro.textContent = ""; 
    }

    return true;
}