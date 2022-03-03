<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>

    <body>

        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Página de Login</h2>                 
            </div>
        </header>

        <div class="formulario">
            <form action="login.php" method="post">
                <fieldset>
                    <legend><b>LOGIN</b></legend>             
                    <p>
                        <label><b>Usuário</b></label><br>
                        <input type="text" name="usuario" placeholder="Login" required><br>
                        <b><label id="usererro"></label></b>
                    </p>

                    <p>
                        <label><b>Senha</b></label><br>
                        <input type="password" name="senha" placeholder="Senha" required><br>
                        <b><label id="senhaerro"></label></b>
                    </p>

                </fieldset>

                <div>
                    <input type="submit" name="enviar" value="ENTRAR" class="botao"><br>
                </div>

                <div>
                    <label><b>Não possui cadastro?</b></label><br>
                    <a href="cadastro_usuario.php">Cadastre-se Aqui</a>
                </div>
            </form>
        </div>

        <footer>
            &copy; 2020 - <?php echo date('Y'); ?> - Daniel Rovetta - Adriano Supeleto<br>
        </footer> 
    </body>
</html>

<?php
    include('conexao.php');

    if(isset($_POST['usuario']) || isset($_POST['senha']))
    {
        if (strlen($_POST['usuario']) == 0 )
        {
            echo "<script>document.getElementById('usererro').innerText='Insira o Usuário!';</script>";
        }
        else if (strlen($_POST['senha']) == 0 )
        {
            echo "<script>document.getElementById('senhaerro').innerText='Insira a Senha!';</script>";
        }
        else
        {
            $usuario = $mysqli->real_escape_string($_POST['usuario']);
            $senha   = $mysqli->real_escape_string(md5($_POST['senha']));

            $sql_code = "SELECT * FROM usuario WHERE login = '$usuario' AND senha = '$senha'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execusão do codigo SQL: " . $mysqli->error);

            $quantidade = $sql_query->num_rows;

            if ($quantidade == 1)
            {
                $dados = $sql_query->fetch_assoc();

                if (!isset($_SESSION))
                {
                    session_start();
                }

                $_SESSION['id'] = $dados['idusuario'];
                $_SESSION['nome'] = $dados['nomeCompletoUsuario'];
                $_SESSION['data'] = date('Y-m-d H:i:s');
                $_SESSION['entrada'] = date('Y:m:d:H:i:s');

                header("Location: painel.php");

            }
            else
            {
                echo "<script>document.getElementById('usererro').innerText='Usuário incorreto!';</script>";
                echo "<script>document.getElementById('senhaerro').innerText='Senha incorreta!';</script>";
            }
        }
    }
?>