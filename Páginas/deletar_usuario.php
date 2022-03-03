<?php
    include('protect.php');
	include('conexao.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Deletar Usuário</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <script>
            function cadastro(txt)
            {
              alert(txt);
            }
        </script>
    </head>

    <body>

        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Apagar Dados do Usuário</h2>                 
            </div>
        </header>

        <nav>
			<a href="dados_usuario.php">VOLTAR</a>
		</nav>

        <div class="formulario">
            <form action="deletar_usuario.php" method="post">
                <fieldset>
                    <legend><b>CONFIRMAÇÃO</b></legend>             
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
                    <input type="submit" name="enviar" value="EXCLUIR DADOS" class="botao"><br>
                </div>

            </form>
        </div>

        <footer>
            &copy; 2020 - <?php echo date('Y'); ?> - Daniel Rovetta - Adriano Supeleto<br>
        </footer> 
    </body>
</html>

<?php
    

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
            $id = $_SESSION['id'];

            $sql_code = "SELECT * FROM usuario WHERE login = '$usuario' AND senha = '$senha' AND idusuario = '$id'; ";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execusão do codigo SQL: " . $mysqli->error);

            $quantidade = $sql_query->num_rows;

            if ($quantidade == 1)
            {
                $sql_code1 = "DELETE FROM usuario WHERE idusuario = '$id';";
                $sql_code2 = "DELETE FROM atividade_aluno WHERE usuarioid = '$id';";
                $sql_code3 = "DELETE FROM historicoacessos  WHERE idusuarioid = '$id';";
                $sql_code4 = "DELETE FROM tabuleiro   WHERE usuarioid = '$id';";
                

                $sql_code6 =  "SELECT * FROM tabuleiro WHERE usuarioid = '$id';";
                $dados = mysqli_query ($mysqli, $sql_code6);
                while($linha = mysqli_fetch_assoc($dados))
                {
                    $idtabuleiro = $linha['idtabuleiro'];
                }

                $sql_code5 = "DELETE FROM tabuleiro_imagenstabuleiro WHERE tabuleiroID = '$idtabuleiro';";

                if ($mysqli->query($sql_code2)) 
                {
                    if ($mysqli->query($sql_code5)) 
                    {
                        if ($mysqli->query($sql_code4)) 
                        {
                            if ($mysqli->query($sql_code3)) 
                            {
                                if ($mysqli->query($sql_code1)) 
                                {
                                echo '<script type="text/javascript">','cadastro("Dados Apagados com Sucesso");','</script>';
                                echo '<meta http-equiv="refresh" content=0;url="logout.php">';
                                }
                                 else 
                                {
                                echo '<script type="text/javascript">','cadastro("Não foi Possivel Apagar os Dados");','</script>';
                                die($mysqli->error);
                                }
                            }
                            else 
                            {
                                echo '<script type="text/javascript">','cadastro("Não foi Possivel Apagar os Dados");','</script>';
                                die($mysqli->error);
                            }
                        }
                        else 
                        {
                            echo '<script type="text/javascript">','cadastro("Não foi Possivel Apagar os Dados");','</script>';
                            die($mysqli->error);
                        }
                    }
                    else 
                    {
                        echo '<script type="text/javascript">','cadastro("Não foi Possivel Apagar os Dados");','</script>';
                        die($mysqli->error);
                    }
                }
                else
                {
                    echo '<script type="text/javascript">','cadastro("Não foi Possivel Apagar os Dados");','</script>';
                        die($mysqli->error);                }
            }
            else
            {
                    echo "<script>document.getElementById('usererro').innerText='Usuário incorreto!';</script>";
                    echo "<script>document.getElementById('senhaerro').innerText='Senha incorreta!';</script>";
            }
        }
    }
?>