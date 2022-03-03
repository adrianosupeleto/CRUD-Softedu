<?php
    include('protect.php');
    include('conexao.php');


    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $_SESSION['idaux'] = $id;
        $sql_code = "SELECT * FROM categoriaatividade  WHERE idcategoriaAtividade = $id;";
        $dados = mysqli_query ($mysqli, $sql_code);

        while($linha = mysqli_fetch_assoc($dados))
        {
            $descricaoatividade = $linha['descricao'];
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Deletar Categoira Atividade</title>
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
                <h2>Apagar Categoria da Atividade </h2>                 
            </div>
        </header>

        <nav>
			<a href="categoria_atividade.php">VOLTAR</a>
		</nav>
        <div class="formulario">
            <form action="deletar_categoria_atividade.php" method="post">
                <fieldset>
                    <legend><b>CONFIRMAÇÃO</b></legend>    
                    <section>
                        <article>
                            <p>
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <td>Descrição</td>
                                        </tr>
                                    </thead>
                                    <?php
                                        $idnivel = $_SESSION['idaux'];
                                        $sql_code = "SELECT * FROM categoriaatividade  WHERE idcategoriaAtividade = $idnivel;";
                                        $dados = mysqli_query ($mysqli, $sql_code);
                                
                                        while($linha = mysqli_fetch_assoc($dados))
                                        {
                                            $descricaocategoira = $linha['descricao'];
                                        }

                                        echo "<tr><td>" . $descricaocategoira ."</td></tr>";

                                    ?> 
                                </table>
                            </p>
                        </article> 
                    </section>
        
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
                    <input type="submit" name="enviar" value="EXCLUIR CATEGORIA ATIVIDADE" class="botao"><br>
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
            $idusuario = $_SESSION['id'];

            $sql_code = "SELECT * FROM usuario WHERE login = '$usuario' AND senha = '$senha' AND idusuario = '$idusuario'; ";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execusão do codigo SQL: " . $mysqli->error);

            $quantidade = $sql_query->num_rows;

            if ($quantidade == 1)
            {   
                $idnivel= $_SESSION['idaux'];
                $sql_code = "DELETE FROM categoriaatividade  WHERE idcategoriaAtividade = '$idnivel';";

                if ($mysqli->query($sql_code)) 
                {
                    echo '<script type="text/javascript">','cadastro("Categoria da Atividade Apagada com Sucesso");','</script>';
                    //header("Location: dados_usuario.php");
                    echo '<meta http-equiv="refresh" content=0;url="categoria_atividade.php">';
                }
                else 
                {
                    echo '<script type="text/javascript">','cadastro("Não foi possível deletar a Categoria! Verifique se há atividades com essa categoria cadastrada");','</script>';
                    echo '<meta http-equiv="refresh" content=0;url="categoria_atividade.php">';
                }
            }
            else
            {
                    echo "<script>document.getElementById('usererro').innerText='Usuário incorreto!';</script>";
                    echo "<script>document.getElementById('senhaerro').innerText='Senha incorreta!';</script>";
            }
        }
    }
?>