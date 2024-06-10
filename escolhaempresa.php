<?php
include_once ('models/metodos.php');
verificarAutenticacao();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>DW Sistemas</title>
</head>
<style>
    body,
    html {
        height: 100%;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    .bg {
        background: linear-gradient(to bottom, #00008B, #87CEEB);
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-box {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .input-group-text {
        padding: 0.375rem 0.75rem;
    }

    .input-group-text img {
        width: 16px;
        height: 16px;
    }

    .logo-img {
        display: block;
        margin: 0 auto 20px auto;
        height: 80px;
        width: 80px;
    }
</style>

<body>
    <div class="bg">
        <div class="card login-box">
            <div class="card-body">
                <img class="logo-img" src="src/Sistema de Vendas (2).png" alt="imagem do sistema">
                <form action="models/processa_selecao.php" method="POST">
                    <div class="mb-3">
                        <label for="cbempresa" class="form-label">Selecione uma Empresa</label>
                        <div class="input-group">
                            <select class="form-control form-control-sm" id="cbempresa" name="cbempresa">
                                <option value="" disabled selected>Selecione a Empresa</option>
                                <?php
                                include 'models/buscar_empresa.php';

                                foreach ($nomesEmpresas as $nome) {
                                    echo "<option value='" . htmlspecialchars($nome) . "'>" . htmlspecialchars($nome) . "</option>";
                                }
                                ?>
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <img src="src/company_22169.png" alt="user-icon">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-block mb-3" name="submit">Selecionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>