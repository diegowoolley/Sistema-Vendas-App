// Converte o campo de entrada para formato de moeda
var inputs = document.getElementsByClassName('moeda');
for (var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('keyup', function (e) {
        var valor = this.value.replace(/\D/g, '');
        valor = (valor / 100).toLocaleString('pt-BR', { minimumFractionDigits: 2 });
        this.value = valor;
    });
}




