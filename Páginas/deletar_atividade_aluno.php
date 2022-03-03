<?php
    include('protect.php');
    include('conexao.php');

    if(isset($_GET['id']))
    {  
        $id = $_GET['id'];
        $_SESSION['idaux1'] = $id;

        $sql_code = "SELECT * FROM atividades_alunos WHERE idatividade_aluno = '$id';";
        $dados = mysqli_query($mysqli, $sql_code);

        while($linha = mysqli_fetch_assoc($dados))
        {
            $usuario = $linha['nomeusuario'];
            $descricao = $linha['descricaoatividade'];
            $status = $linha['status'];
            $inicio = $linha['datainicio'];
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Deletar Avaliação</title>
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
                <h2>Apagar Avaliação</h2>                 
            </div>
        </header>

        <nav>
			<a href="atividade_aluno.php">VOLTAR</a>
		</nav>
        <div class="formulario">
            <form action="deletar_atividade_aluno_script.php" method="POST">
                <fieldset>
                    <legend><b>CONFIRMAÇÃO</b></legend>    
                    <section>
                        <article>
                            <p>
                                <table border="1">
                                <thead>
                                    <tr>
                                        <td style="width: 500px">Descrição</td>
                                        <td style="width: 1000px">Usuário</td>
                                        <td style="width: 2000px">Data e Hora de Início</td>
                                        <td style="width: 1000px">Status</td>
                                    </tr>
                                </thead>
                                     <?php
                                        echo "<tr><td>" . $descricao ."</td>";
                                        echo "<td>" . $usuario ."</td>";
                                        echo "<td>" . $inicio ."</td>";
                                        echo "<td>" . $status ."</td></tr>";     
                                    ?>
					            </table>
                            </p>
                        </article> 
                    </section>

                     <div>
                        <input type="hidden" class="form-control" name="id"
                        value="<?php echo $id;?>">
                    </div>  
        
                    <p>
                        <label><b>Usuário</b></label><br>
                        <input type="text" name="login" placeholder="Login" required><br>
                        <b><label id="usererro"></label></b>
                    </p>

                    <p>
                        <label><b>Senha</b></label><br>
                        <input type="password" name="senha" placeholder="Senha" required><br>
                        <b><label id="senhaerro"></label></b>
                    </p>
                </fieldset>

                <div>
                    <input type="submit" name="enviar" value="EXCLUIR" class="botao"><br>
                </div>

            </form>
        </div>

        <footer>
            &copy; 2020 - <?php echo date('Y'); ?> - Daniel Rovetta - Adriano Supeleto<br>
        </footer> 
    </body>
</html>