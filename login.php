<?php
// Inicia a sessão
session_start();

// Inclui o arquivo que contém a função de conexão
include_once ('models/conexao.php');

if (isset($_POST['submit'])) {
    // Verifica se os campos estão vazios
    if (empty($_POST["usuario"])) {
        $error = "Digite um Usuário Válido!";
    } elseif (empty($_POST["senha"])) {
        $error = "Digite uma Senha Válida!";
    } else {
        try {
            // Estabelece a conexão com o banco de dados
            $con = conectarBanco();

            // Obtém os valores do formulário
            $usuario = $_POST["usuario"];
            $senha = $_POST["senha"];

            // Desembaralha a senha
            $respassword = "";
            for ($i = 0; $i < strlen($senha); $i++) {
                $passwordoriginal = ord($senha[$i]);
                $passwordcodificado = $passwordoriginal + 15;
                $respassword .= chr($passwordcodificado);
            }

            // Consulta ao banco de dados para verificar se o usuário e senha existem
            if ($con) {
                $query = "SELECT * FROM cad_usuarios WHERE nome_usuarios = '$usuario' AND senha_Usuarios = '$respassword'";
                $result = mysqli_query($con, $query);

                // Verifica se a consulta retornou algum resultado
                if ($result && mysqli_num_rows($result) > 0) {
                    // Inicia a sessão e armazena informações relevantes
                    $_SESSION['usuario'] = $usuario;
                    // Fecha a conexão com o banco de dados
                    mysqli_close($con);



                    // if (isset($_POST['conectado'])) {
                    //     // Cria um cookie que expira em 30 dias
                    //     setcookie('conectado', $usuario, time() + (86400 * 30), "/");
                    // }                   


                    // Redireciona para a página index.php
                    header("Location: index.php");
                    exit;
                } else {
                    // Mensagem de erro
                    $error = "Usuário ou senha incorretos!";
                }
            } else {
                $error = "Erro na conexão com o banco de dados!";
            }
        } catch (Exception $ex) {
            $error = "Erro na consulta! $ex";
        }
    }

    // Exibe a mensagem de erro
    echo "<script>alert('$error');</script>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>DW Sistemas</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .bg {
            background: linear-gradient(to bottom, #00008B, #87CEEB);
            /* Gradiente do azul escuro para o azul claro */
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
            /* Fundo branco semi-transparente */
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
</head>

<body>
    <div class="bg">
        <div class="card login-box">
            <div class="card-body">
                <img class="logo-img" src="src/Sistema de Vendas (2).png" alt="imagem do sistema">
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuário</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" id="usuario" name="usuario"
                                aria-describedby="emailHelp" placeholder="Digite o Usuário">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <img src="src/User-80_icon-icons.com_57249.png" alt="user-icon">
                                </span>
                            </div>
                        </div>
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <div class="input-group">
                            <input type="password" class="form-control form-control-sm" id="senha" name="senha"
                                placeholder="Digite a Senha">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <img src="src/security-protection-protect-key-password-login_108554.png"
                                        alt="lock-icon">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="conectado" id="conectado">
                        <label class="form-check-label" for="conectado">Permanecer Conectado?</label>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-block mb-3" name="submit">Entrar</button>
                        <button type="button" class="btn btn-warning btn-block">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>