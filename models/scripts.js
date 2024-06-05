// Converte o campo de entrada para formato de moeda
var inputs = document.getElementsByClassName('moeda');
for (var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('keyup', function (e) {
        var valor = this.value.replace(/\D/g, '');
        valor = (valor / 100).toLocaleString('pt-BR', { minimumFractionDigits: 2 });
        this.value = valor;
    });
}

function logout() {
    // Envia uma solicitação para o servidor para destruir a sessão
    fetch('models/metodos.php?action=logout')
        .then(response => {
            if (response.ok) {
                // Redireciona para a página de login
                window.location.href = 'login.php';
            } else {
                console.error('Erro ao fazer logout');
            }
        })
        .catch(error => console.error('Erro de rede:', error));
}


