<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DW Sistemas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php
include 'models/navbar.php'; // Inclua a classe NavBar

$navBar = new NavBar(); // Instancie a classe NavBar

// Renderize a barra de navegação
$navBar->render();

// Defina os valores das variáveis
$numeroVenda = "Número da Compra:";
$totalItens = "Total de Itens:";
$valorTotal = "Valor Total:";
?>


<form action="">
<div class="container border p-4 mt-5">
  <div class="row">
    <div class="col-12 col-md-4 mb-3 mb-md-0">
      <label class="form-label text-danger fw-bold"><?php echo $numeroVenda; ?></label>
    </div>
    <div class="col-12 col-md-4 mb-3 mb-md-0">
      <label class="form-label text-danger fw-bold"><?php echo $totalItens; ?></label>
    </div>
    <div class="col-12 col-md-4">
      <label class="form-label text-danger fw-bold"><?php echo $valorTotal; ?></label>
    </div> 
  </div>   
</div>

<div class="container border p-4 mt-2">
  <div class="row">
    <div class="col-12 col-md-4 mt-2">
      <div class="mb-3">
        <label class="form-label">Fornecedor:</label>
        <input type="text" class="form-control" maxlength="80">
      </div>
    </div>
    <div class="col-12 col-md-4 mt-2">
      <div class="mb-3">
        <label class="form-label">Produto:</label>
        <input type="text" class="form-control" maxlength="80">
      </div>
    </div>
    <div class="col-12 col-md-4 mt-2">
      <div class="mb-3">
        <label class="form-label">Quantidade:</label>
        <input type="number" class="form-control" maxlength="10" style="width: 4rem;">
      </div>
    </div>
    <div class="col-12 col-md-4 mt-3">
      <div class="mb-3">
        <label class="form-label">Vendedor:</label>
        <input type="text" class="form-control" maxlength="80">
      </div>
    </div>
    <div class="col-12 mt-2 text-center">
      <button class="btn btn-success me-2">Adicionar</button>
      <button class="btn btn-danger me-2">Excluir</button>
      <button class="btn btn-warning">Fechar Venda</button>
    </div>
  </div>
</div>



<div class="container border p-4 mt-2">
  <div style="overflow-x: auto;">
    <table class="table">
      <thead>
        <tr class="text-center">
          <th scope="col">ID</th>
          <th scope="col">Código do Produto</th>
          <th scope="col">Cliente</th>
          <th scope="col">Produto</th>
          <th scope="col">Quantidade</th>
          <th scope="col">Categoria</th>
          <th scope="col">Preço Unitário</th>
          <th scope="col">Vendedor</th>
          <th scope="col">Valor Total</th>
        </tr>
      </thead>
      <tbody>
        <!-- Aqui você pode adicionar mais linhas conforme necessário -->
        <tr class="text-center">
          <td>1</td>
          <td>123</td>
          <td>Cliente A</td>
          <td>Produto X</td>
          <td>5</td>
          <td>Categoria A</td>
          <td>R$ 10.00</td>
          <td>Vendedor 1</td>
          <td>R$ 50.00</td>
        </tr>
        <tr class="text-center">
          <td>2</td>
          <td>456</td>
          <td>Cliente B</td>
          <td>Produto Y</td>
          <td>3</td>
          <td>Categoria B</td>
          <td>R$ 15.00</td>
          <td>Vendedor 2</td>
          <td>R$ 45.00</td>
        </tr>
        <!-- Adicione mais linhas conforme necessário -->
      </tbody>
    </table>
  </div>
</div>




<div class="container border p-4 mt-2">
  <div class="row justify-content-center">
    <div class="col-12 col-md-6 text-center">
      <label class="form-label">Forma de Pagamento:</label>
      <select class="form-select mx-auto" aria-label="Forma de Pagamento" style="width: 12rem;">
        <option selected>Selecione...</option>
        <option value="1">Dinheiro</option>
        <option value="2">Cartão de Crédito</option>
        <option value="3">Cartão de Débito</option>
        <option value="4">Pix</option>
        <option value="5">Crédito Cliente</option>
      </select>
    </div>
    <div class="col-12 col-md-6 text-center">
      <label class="form-label">Valor Pago:</label>
      <div class="input-group mx-auto" style="width: 10rem;">
        <input type="text" class="form-control moeda" aria-label="Valor Pago">
      </div>
    </div>
  </div>
</div>



<div class="container border p-4 mt-2">
  <div class="row justify-content-center">
    <div class="col-md-2">
      <label class="form-label">Dinheiro:</label>
      <input type="text" class="form-control moeda" style="width: 10rem;">
    </div>
    <div class="col-md-2">
      <label class="form-label">Pix:</label>
      <input type="text" class="form-control moeda" style="width: 10rem;">
    </div>
    <div class="col-md-2">
      <label class="form-label">Cartão:</label>
      <input type="text" class="form-control moeda" style="width: 10rem;">
    </div>
    <div class="col-md-2">
      <label class="form-label">Desconto:</label>
      <input type="text" class="form-control" style="width: 10rem;">
    </div>
    <div class="col-md-2">
      <label class="form-label">Taxa:</label>
      <input type="text" class="form-control" style="width: 10rem;">
    </div>
  </div>
</div>

<div class="row mt-3 text-center">
    <div class="col-6">
        <button class="btn btn-success" style="width: 10rem;">Concluir</button>
    </div>
    <div class="col-6 mt-2">
        <button class="btn btn-warning" style="width: 10rem;">Cancelar</button>
    </div>
</div>

</form>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
// Converte o campo de entrada para formato de moeda
var inputs = document.getElementsByClassName('moeda');
for (var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('keyup', function(e) {
        var valor = this.value.replace(/\D/g, '');
        valor = (valor / 100).toLocaleString('pt-BR', { minimumFractionDigits: 2 });
        this.value = valor;
    });
}
</script>

</body>
</html>
