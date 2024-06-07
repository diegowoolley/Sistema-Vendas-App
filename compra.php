<?php
// Inclui o arquivo que contém as funções de autenticação
include_once ('models/metodos.php');

// Chamada da função para verificar autenticação
verificarAutenticacao();


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DW Sistemas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="models/scripts.js"></script>



  <style>
    html,
    body {
      height: 100%;
      margin: 0;
    }

    body {
      background: linear-gradient(to bottom, #00008B, #87CEEB);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    .navbar {
      width: 100%;
      position: fixed;
      top: 0;
      z-index: 1000;
    }

    .card {
      width: 90%;
      max-width: 1200px;
      margin: 60px auto;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      overflow-y: auto;
      overflow-x: auto;
      background: rgba(255, 255, 255, 0.8);

    }

    .table {

      background: rgba(0, 0, 0, 0.5);
      border-radius: 15px;
      overflow: hidden;
      color: white;
      font-size: 0.9em;

    }

    .table-container {
      overflow-y: auto;
      max-height: 150px;
      position: relative;
    }

    .table-container table {
      width: 100%;
      margin: 0;
    }

    @media (max-width: 768px) {
      .table-wrapper {
        margin-left: -30px;
      }

      .table-container thead tr {
        font-size: 12px;
      }

      .table-container tbody tr {
        font-size: 12px;
      }
    }
  </style>
</head>

<body>
  <?php
  include 'models/navbar.php'; // Inclua a classe NavBar
  
  $navBar = new NavBar(); // Instancie a classe NavBar
  
  // Renderize a barra de navegação
  $navBar->render();

  ?>

  <div class="card p-4">
    <div class="container border p-2">
      <div class="row">
        <div class="col-12 col-md-4 mb-2 mb-md-0">
          <label class="form-label text-danger fw-bold" id="lblnumerovenda">Número da Compra:</label>
        </div>
        <div class="col-12 col-md-4 mb-3 mb-md-0">
          <label class="form-label text-danger fw-bold" id="lbltotalitens">Total de Itens:</label>
        </div>
        <div class="col-12 col-md-4">
          <label class="form-label text-danger fw-bold" id="lblvalortotal">Valor Total:</label>
        </div>
      </div>
    </div>
    <div class="container border p-2 mt-2">
      <div class="row">
        <div class="col-12 col-md-4 mt-2">
          <div class="mb-3">
            <label class="form-label">Fornecedor:</label>
            <input type="text" class="form-control" maxlength="80" id="txtcliente"
              placeholder="Digite para Buscar um Fornecedor">
          </div>
        </div>
        <div class="col-12 col-md-4 mt-2">
          <div class="mb-3">
            <label class="form-label">Produto:</label>
            <input type="text" class="form-control" maxlength="80" id="txtproduto"
              placeholder="Digite para Buscar um Produto">
          </div>
        </div>
        <div class="col-12 col-md-4 mt-2">
          <div class="mb-3">
            <label class="form-label">Quantidade:</label>
            <input type="number" class="form-control" maxlength="10" style="width: 4rem;" id="txtquantidade">
          </div>
        </div>
        <div class="col-12 col-md-4 mt-3">
          <div class="mb-3">
            <label class="form-label">Vendedor:</label>
            <input type="text" class="form-control" maxlength="80" id="txtvendedor"
              placeholder="Digite para Buscar um Vendedor">
          </div>
        </div>
        <div class="col-12 mt-2 text-center">
          <button class="btn btn-sm btn-success me-2" id="btnadicionar">Adicionar</button>
          <button class="btn btn-sm btn-danger me-2" id="btnexcluir">Excluir</button>
          <button class="btn btn-sm btn-warning" id="btnfecharvenda">Fechar Venda</button>
        </div>
      </div>
    </div>

    <div class="table-container border p-5 mt-6 mb-2">
      <table class="table table-primary table-striped table-hover table-bordered table-sm" id="tb_itens">
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
          <!-- Adicione mais linhas conforme necessário -->
        </tbody>
      </table>
    </div>

    <div class="container border p-2 mt-2">
      <div class="row justify-content-center">
        <div class="col-12 col-md-4 mb-3 text-center">
          <label class="form-label">Forma de Pagamento:</label>
          <select class="form-select mx-auto" aria-label="Forma de Pagamento" style="width: 12rem;"
            id="cbforma_pagamento" disabled>
            <option selected>Selecione...</option>
            <option value="1">Dinheiro</option>
            <option value="2">Cartão de Crédito</option>
            <option value="3">Cartão de Débito</option>
            <option value="4">Pix</option>
            <option value="5">Crédito Cliente</option>
            <option value="6">Fracionado</option>
          </select>
        </div>
        <div class="col-12 col-md-4 mb-3 text-center">
          <label class="form-label">Valor Pago:</label>
          <div class="input-group mx-auto" style="width: 10rem;">
            <input type="text" class="form-control" aria-label="Valor Pago" id="txtvalorpago" disabled>
          </div>
        </div>
        <div class="col-12 col-md-4 mb-4 text-center">
          <label class="form-label">Vencimento:</label>
          <div class="input-group mx-auto" style="width: 10rem;">
            <input type="date" class="form-control" aria-label="troco" id="txttroco" disabled>
          </div>
        </div>
      </div>
    </div>


    <div class="row justify-content-center">
      <div class="col-md-2">
        <label class="form-label">Dinheiro:</label>
        <input type="text" class="form-control moeda" style="width: 10rem;" id="txtdinheiro" placeholder="0.00"
          disabled>
      </div>
      <div class="col-md-2">
        <label class="form-label">Pix:</label>
        <input type="text" class="form-control moeda" style="width: 10rem;" id="txtpix" placeholder="0.00" disabled>
      </div>
      <div class="col-md-2">
        <label class="form-label">Cartão:</label>
        <input type="text" class="form-control moeda" style="width: 10rem;" id="txtcartao" placeholder="0.00"
          disabled="true">
      </div>
      <div class="col-md-2">
        <label class="form-label">Desconto:</label>
        <input type="text" class="form-control" style="width: 10rem;" id="txtdesconto" placeholder="0%" disabled="true">
      </div>
      <div class="col-md-2">
        <label class="form-label">Taxa:</label>
        <input type="text" class="form-control" style="width: 10rem;" id="txttaxa" placeholder="0%" disabled="true">
      </div>
    </div>

    <div class="row mt-3 text-center">
      <div class="col-6">
        <button class="btn btn-success" style="width: 10rem;" id="btnconcluir" disabled>Concluir</button>
      </div>
      <div class="col-6">
        <button class="btn btn-warning" style="width: 10rem;" id="btncancelar">Cancelar</button>
      </div>
    </div>
  </div>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>


  <script>
    // Converte o campo de entrada para formato de moeda
    var inputs = document.getElementsByClassName('moeda');
    for (var i = 0; i < inputs.length; i++) {
      inputs[i].addEventListener('keyup', function (e) {
        var valor = this.value.replace(/\D/g, '');
        valor = (valor / 100).toLocaleString('pt-BR', { minimumFractionDigits: 2 });
        this.value = valor;
      });
    }
  </script>


  <script>


    $(document).ready(function () {
      // Função para cancelar a venda
      $('#btncancelar').click(function () {
        // Atualiza a página
        location.reload();
      });
    });

    $(document).ready(function () {
      contarVendas();
    });

    $(document).ready(function () {
      // Torna as linhas da tabela selecionáveis
      $('#tb_itens tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
      });


      // Função para excluir a linha selecionada
      $('#btnexcluir').click(function () {
        var selectedRow = $('#tb_itens tbody tr.selected');
        if (selectedRow.length === 0) {
          alert('Por favor, selecione uma linha para excluir.');
          return;
        }
        var confirmDelete = confirm('Tem certeza de que deseja excluir a linha selecionada?');
        if (confirmDelete) {
          selectedRow.remove();
          atualizarTotais();
        }
      });

      $('#btnfecharvenda').click(function () {
        if ($('#tb_itens tbody tr').length <= 0) {
          alert("Insira produtos antes de finalizar a venda!");
          $('#txtproduto').focus();
        } else {
          $('#cbforma_pagamento').prop('disabled', false);
          $('#txtdesconto').prop('disabled', false);
          $('#txttaxa').prop('disabled', false);
          $('#btnconcluir').prop('disabled', false);
          $('#txttroco').prop('disabled', false);
          $('#txtproduto').prop('disabled', true);
          $('#txtquantidade').prop('disabled', true);
          $('#btnadicionar').prop('disabled', true);
          $('#btnexcluir').prop('disabled', true);
          $('#btnfecharvenda').prop('disabled', true);
        }
      });
    });

    $(function () {
      // Inicializa o plugin de autocompletar para o campo de entrada do cliente
      $("#txtcliente").autocomplete({
        source: function (request, response) {
          $.ajax({
            url: "models/buscarfornecedor.php",
            dataType: "json",
            data: {
              term: request.term
            },
            success: function (data) {
              response(data);
            }
          });
        },
        minLength: 2
      });

      var ultimoValorCliente = ""; // Variável para armazenar o último valor do campo de entrada

      // Adiciona um evento de perda de foco ao campo de entrada do cliente
      $("#txtcliente").on("blur", function () {
        var valorAtualCliente = $(this).val().trim(); // Obter o valor atual do campo de entrada

        // Verificar se o campo de pesquisa está vazio ou se o valor não mudou significativamente
        if (valorAtualCliente !== "" && valorAtualCliente !== ultimoValorCliente) {
          buscarClientes(); // Chama a função buscarClientes apenas se o campo não estiver vazio e houver uma mudança no valor
          ultimoValorCliente = valorAtualCliente; // Atualiza o último valor do campo de entrada
        }
      });

      // Inicializa o plugin de autocompletar para o campo de entrada do produto
      $("#txtproduto").autocomplete({
        source: function (request, response) {
          $.ajax({
            url: "models/buscarprodutos.php",
            dataType: "json",
            data: {
              term: request.term
            },
            success: function (data) {
              response(data);
            }
          });
        },
        minLength: 2
      });

      var ultimoValorProduto = ""; // Variável para armazenar o último valor do campo de entrada

      // Adiciona um evento de perda de foco ao campo de entrada do produto
      $("#txtproduto").on("blur", function () {
        var valorAtualProduto = $(this).val().trim(); // Obter o valor atual do campo de entrada

        // Verificar se o campo de pesquisa está vazio ou se o valor não mudou significativamente
        if (valorAtualProduto !== "" && valorAtualProduto !== ultimoValorProduto) {
          buscarProdutos(); // Chama a função buscarProdutos apenas se o campo não estiver vazio e houver uma mudança no valor
          ultimoValorProduto = valorAtualProduto; // Atualiza o último valor do campo de entrada
        }
      });

      // Inicializa o plugin de autocompletar para o campo de entrada do vendedor
      $("#txtvendedor").autocomplete({
        source: function (request, response) {
          $.ajax({
            url: "models/buscarfuncionario.php",
            dataType: "json",
            data: {
              term: request.term
            },
            success: function (data) {
              response(data);
            }
          });
        },
        minLength: 2
      });

      var ultimoValorVendedor = ""; // Variável para armazenar o último valor do campo de entrada

      // Adiciona um evento de perda de foco ao campo de entrada do vendedor
      $("#txtvendedor").on("blur", function () {
        var valorAtualVendedor = $(this).val().trim(); // Obter o valor atual do campo de entrada

        // Verificar se o campo de pesquisa está vazio ou se o valor não mudou significativamente
        if (valorAtualVendedor !== "" && valorAtualVendedor !== ultimoValorVendedor) {
          buscarVendedores(); // Chama a função buscarVendedores apenas se o campo não estiver vazio e houver uma mudança no valor
          ultimoValorVendedor = valorAtualVendedor; // Atualiza o último valor do campo de entrada
        }
      });
    });

    function buscarClientes() {
      var pesquisa = $("#txtcliente").val().trim(); // Obter o valor do input de pesquisa e remover espaços em branco

      // Fazer a requisição AJAX para buscar os clientes
      $.ajax({
        url: "models/buscarfornecedor.php",
        dataType: "json",
        data: {
          term: pesquisa
        },
        success: function (data) {
          if (data.length > 0) {
            $("#txtcliente").val(data[0]); // Preencher o campo com o nome do primeiro cliente retornado
            $("#txtproduto").focus(); // Transferir o foco para o próximo campo
          } else {
            // Se não houver resultados, exibir uma mensagem informando que o cliente não foi encontrado
            alert("Fornecedor não encontrado.");
            $("#txtcliente").val(""); // Limpar o campo de entrada
            $("#txtcliente").focus(); // Manter o foco no campo de entrada para nova pesquisa
          }
        },
        error: function () {
          // Em caso de erro na requisição AJAX, exibir uma mensagem de erro
          alert("Erro ao buscar fornecedores.");
        }
      });
    }

    function buscarProdutos() {
      var pesquisa = $("#txtproduto").val().trim(); // Obter o valor do input de pesquisa e remover espaços em branco

      // Fazer a requisição AJAX para buscar os produtos
      $.ajax({
        url: "models/buscarprodutos.php",
        dataType: "json",
        data: {
          term: pesquisa
        },
        success: function (data) {
          if (data.length > 0) {
            $("#txtproduto").val(data[0]); // Preencher o campo com o nome do primeiro produto retornado
            $("#txtquantidade").focus(); // Transferir o foco para o próximo campo
          } else {
            // Se não houver resultados, exibir uma mensagem informando que o produto não foi encontrado
            alert("Produto não encontrado.");
            $("#txtproduto").val(""); // Limpar o campo de entrada
            $("#txtproduto").focus(); // Manter o foco no campo de entrada para nova pesquisa
          }
        },
        error: function () {
          // Em caso de erro na requisição AJAX, exibir uma mensagem de erro
          alert("Erro ao buscar produtos.");
        }
      });
    }

    function buscarVendedores() {

      var pesquisa = $("#txtvendedor").val().trim(); // Obter o valor do input de pesquisa e remover espaços em branco

      // Fazer a requisição AJAX para buscar os vendedores
      $.ajax({
        url: "models/buscarfuncionario.php",
        dataType: "json",
        data: {
          term: pesquisa
        },
        success: function (data) {
          if (data.length > 0) {
            $("#txtvendedor").val(data[0]); // Preencher o campo com o nome do primeiro vendedor retornado

          } else {
            // Se não houver resultados, exibir uma mensagem informando que o vendedor não foi encontrado
            alert("Vendedor não encontrado.");
            $("#txtvendedor").val(""); // Limpar o campo de entrada
            $("#txtvendedor").focus(); // Manter o foco no campo de entrada para nova pesquisa
          }
        },
        error: function () {
          // Em caso de erro na requisição AJAX, exibir uma mensagem de erro
          alert("Erro ao buscar vendedores.");
        }
      });
    }


    $("#btnadicionar").click(function () {
      var contador = 1;

      // Verifica se um cliente foi selecionado
      if ($("#txtcliente").val() == "") {
        alert("Selecione um Fornecedor!");
        $("#txtcliente").focus();
        return;
      }

      // Verifica se um produto foi selecionado
      if ($("#txtproduto").val() == "") {
        alert("Selecione um produto!");
        $("#txtproduto").focus();
        return;
      }

      // Verifica se a quantidade é válida
      var quantidade = $("#txtquantidade").val();
      if ($.trim(quantidade) === "" || isNaN(quantidade) || parseFloat(quantidade) <= 0) {
        alert("Escolha uma quantidade válida para o produto");
        $("#txtquantidade").focus();
        return;
      }

      // Verifica se um vendedor foi selecionado
      if ($("#txtvendedor").val() == "") {
        alert("Selecione um vendedor");
        $("#txtvendedor").focus();
        return;
      }

      $.ajax({
        url: "models/inserirprodutos.php",
        dataType: "json",
        data: {
          term: $("#txtproduto").val()
        },
        success: function (data) {
          if (data.error) {
            alert(data.error);
          } else {
            var produto = data[0]; // Extrai o primeiro produto do array retornado

            // Verificar se o produto já está na tabela
            var produtoExistente = false;
            $("#tb_itens tbody tr").each(function () {
              if ($(this).find("td:eq(3)").text() === produto.nome_produto) {
                // Produto já está na tabela, atualizar quantidade e valor total
                var novaQuantidade = parseFloat($(this).find("td:eq(4)").text()) + parseFloat(quantidade);
                $(this).find("td:eq(4)").text(novaQuantidade);
                var valorUnitario = parseFloat(produto.valor_venda.replace("R$ ", ""));
                var valorTotal = novaQuantidade * valorUnitario;
                $(this).find("td:eq(8)").text("R$ " + valorTotal.toFixed(2));
                produtoExistente = true;
                return false; // Sair do loop
              }
            });

            if (!produtoExistente) {
              // Adiciona a linha à tabela
              $("#tb_itens tbody").append(
                "<tr class='text-center'>" +
                "<td>" + contador++ + "</td>" + // ID
                "<td>" + produto.cod_produto + "</td>" + // Código do Produto
                "<td>" + $("#txtcliente").val() + "</td>" + // Cliente
                "<td>" + produto.nome_produto + "</td>" + // Produto
                "<td>" + quantidade + "</td>" + // Quantidade
                "<td>" + produto.categoria_produto + "</td>" + // Categoria
                "<td>" + produto.valor_venda + "</td>" + // Preço Unitário
                "<td>" + $("#txtvendedor").val() + "</td>" + // Vendedor
                "<td>R$ " + (parseFloat(produto.valor_venda.replace("R$ ", "")) * parseFloat(quantidade)).toFixed(2) + "</td>" + // Valor Total
                "</tr>"
              );
            }

            // Limpa os campos do formulário após adicionar a linha
            $("#txtcliente").prop("disabled", true);
            $("#txtproduto").val("").focus();
            $("#txtquantidade").val("");
            $("#txtvendedor").prop("disabled", true);
            contarVendas();
            atualizarTotais();
          }
        },
        error: function () {
          alert("Erro ao buscar dados do produto");
        }
      });
    });



    function contarVendas() {

      $.ajax({
        url: 'models/buscarMaxVenda.php', // Arquivo PHP para buscar o número máximo de venda
        method: 'GET',
        success: function (response) {
          var maxVenda = parseInt(response); // Converte a resposta para um número inteiro
          if (isNaN(maxVenda)) { // Se a resposta não for um número, define o código de venda como 1
            cod_venda = 1;
            $("#lblnumerovenda").text("Número da Compra: " + cod_venda);
            //funcoes.cod_venda = cod_venda;
          } else { // Caso contrário, incrementa o número máximo de venda em 1
            cod_venda = maxVenda + 1;
            $("#lblnumerovenda").text("Número da Compra: " + cod_venda);
            //funcoes.cod_venda = cod_venda;
          }
        },
        error: function (xhr, status, error) {
          console.error("Erro na conexão: " + error); // Exibe um erro caso haja algum problema na requisição AJAX
        }
      });
    }


    function atualizarTotais() {
      var precoTotal = 0;
      var totalItens = 0;

      $('#tb_itens tbody tr').each(function () {
        var quantidade = parseInt($(this).find('td:eq(4)').text());
        var precoUnitario = parseFloat($(this).find('td:eq(6)').text().replace('R$', '').replace(',', '.'));

        if (!isNaN(quantidade) && !isNaN(precoUnitario)) {
          totalItens += quantidade;
          precoTotal += quantidade * precoUnitario;
        }
      });

      $('#lbltotalitens').text("Total de Itens: " + totalItens);
      $('#lblvalortotal').text("Valor Total: " + precoTotal.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }));
    }


    $(document).ready(function () {
      $('#cbforma_pagamento').change(function () {
        var cbformapagamentoIndex = parseInt($(this).val()); // Convertendo para número inteiro
        console.log("Índice da forma de pagamento selecionada:", cbformapagamentoIndex);

        var valor_total_texto = $("#lblvalortotal").text();
        console.log("Texto do valor total:", valor_total_texto);

        var valor_total_sem_texto = valor_total_texto.trim().replace("Valor Total: R$", "");
        console.log("Valor total sem texto:", valor_total_sem_texto);

        var valor_total = parseFloat(valor_total_sem_texto.trim());
        console.log("Valor total convertido para número:", valor_total);

        function formatarMoeda(valor) {
          return valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        }

        if (cbformapagamentoIndex === 5 || cbformapagamentoIndex === 6) {
          $('#txtvalorpago').val("");
          $('#txtdesconto').val("");
          $('#txttaxa').val("");
          $('#txtdinheiro').prop('disabled', false).val("").focus();
          $('#txtpix').prop('disabled', false).val("");
          $('#txtcartao').prop('disabled', false).val("");
          $('#txttroco').val('');
        } else if (cbformapagamentoIndex === 1) {
          $('#txtvalorpago').val(formatarMoeda(valor_total));
          $('#txtdinheiro').prop('disabled', true).val(formatarMoeda(valor_total));
          $('#txtpix').prop('disabled', true).val("");
          $('#txtcartao').prop('disabled', true).val("");
          $('#txttaxa').val("");
          $('#txtdesconto').val("");
          $('#txttroco').val('');
          $('#txtdesconto').focus();
        } else if (cbformapagamentoIndex === 4) {
          $('#txtvalorpago').val(formatarMoeda(valor_total));
          $('#txtdinheiro').prop('disabled', true).val("");
          $('#txtpix').prop('disabled', true).val(formatarMoeda(valor_total));
          $('#txtcartao').prop('disabled', true).val("");
          $('#txttaxa').val("");
          $('#txtdesconto').val("");
          $('#txttroco').val('');
          $('#txtdesconto').focus();
        } else if (cbformapagamentoIndex === 2 || cbformapagamentoIndex === 3) {
          $('#txtvalorpago').val(formatarMoeda(valor_total));
          $('#txtdinheiro').prop('disabled', true).val("");
          $('#txtpix').prop('disabled', true).val("");
          $('#txtcartao').prop('disabled', true).val(formatarMoeda(valor_total));
          $('#txttaxa').val("");
          $('#txtdesconto').val("");
          $('#txttroco').val('');
          $('#txtdesconto').focus();
        }
      });
    });



    $(document).ready(function () {
      // Função para calcular o valor da venda fracionada
      function calcularValorVendaFracionada() {
        // Verificar se o elemento #lblvalortotal existe
        var valorTotalTexto = $("#lblvalortotal").text().trim();
        if (valorTotalTexto !== "") {
          // Remover "Valor Total: R$" do texto e converter para número
          var valorTotalNumerico = parseFloat(valorTotalTexto.replace("Valor Total: R$", "").trim());
          console.log(valorTotalNumerico);
          // Verificar se o valor é um número válido
          if (!isNaN(valorTotalNumerico)) {
            // Pegar os valores dos campos
            var dinheiro = parseFloat($('#txtdinheiro').val().trim()) || 0;
            var pix = parseFloat($('#txtpix').val().trim()) || 0;
            var cartao = parseFloat($('#txtcartao').val().trim()) || 0;
            var descontos = parseFloat($('#txtdesconto').val().replace("%", "")) || 0;
            var taxa = parseFloat($('#txttaxa').val().replace("%", "")) || 0;

            // Calcular soma fracionada
            var somaFracionado = dinheiro + pix + cartao;

            // Calcular descontos
            var valorDescontos = valorTotalNumerico * (descontos / 100);

            // Calcular valor com descontos
            var valorComDescontos = valorTotalNumerico - valorDescontos;

            // Calcular taxa sobre o valor com descontos
            var resultadoFracionado = valorComDescontos * (1 + (taxa / 100));

            // Calcular troco com descontos e taxas
            var troco = somaFracionado - resultadoFracionado;

            // Atualizar campos
            if (resultadoFracionado > valorTotalNumerico) {
              $('#txttroco').val("R$ 0,00");
            } else {
              $('#txttroco').val(troco.toFixed(2));
            }
            $('#txtvalorpago').val(resultadoFracionado.toFixed(2));
          }
        }
      }

      // Chamar a função calcularValorVendaFracionada() nos eventos de saída (blur) dos campos
      $('#txtdinheiro, #txtpix, #txtcartao, #txtdesconto, #txttaxa').on('blur', function () {
        calcularValorVendaFracionada();
      });
    });





  </script>




</body>

</html>