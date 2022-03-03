<?php
    include('protect.php');
    include('conexao.php');

    $id = $_SESSION['idaux'];

    $sql = "SELECT descricao,dataCriacao,usuarioid,u.nomeCompletoUsuario
            FROM tabuleiro t
            INNER JOIN usuario u ON u.idusuario = t.usuarioid
            WHERE idtabuleiro = '$id';";

    $dados = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Deletar Tabuleiro</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>

    <body>

        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Deletar Tabuleiro</h2>                 
            </div>
        </header>

        <nav>
			<a href="tabuleiro.php">VOLTAR</a>
		</nav>
        <div class="formulario">
            <form action="deletar_tabuleiro_script.php" method="post">
                <fieldset>
                    <legend><b>CONFIRMAÇÃO</b></legend>    
                    <section>
                        <article>
                            <p>
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <td>Descrição</td>
						                    <td>Usuário Criador</td>
                                            <td>Data Criação</td>
                                        </tr>
                                    </thead>

                                     <?php

                            while ($linha = mysqli_fetch_assoc($dados)) {
                                $descricao = $linha['descricao'];
                                $idusuariocriador = $linha['usuarioid'];
                                $data = $linha['dataCriacao'];
                                $data = exibirdata($data);
                                $usuario = $linha['nomeCompletoUsuario'];        

                                echo 
                                    "<tr>
                                        <td>$descricao</td>
                                        <td>$usuario</td>
                                        <td>$data</td>
                                    </tr>";
                                        }

                                    ?>
                                </table>
                            </p>
                        </article> 
                    </section>

                    <div>
                        <input type="hidden" class="form-control" name="idtabuleiro"
                        value="<?php echo $id;?>">
                    </div>  


                    <div>
                        <input type="hidden" class="form-control" name="idusuariocriador"
                        value="<?php echo $idusuariocriador;?>">
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
                    <input type="submit" name="enviar" value="EXCLUIR ATIVIDADE" class="botao"><br>
                </div>

            </form>
        </div>

        <footer>
            &copy; 2020 - <?php echo date('Y'); ?> - Daniel Rovetta - Adriano Supeleto<br>
        </footer> 
    </body>
</html>
