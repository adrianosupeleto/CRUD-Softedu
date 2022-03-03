<?php
 include('protect.php');
 include('conexao.php');

 $id = $_GET['id'] ?? '';

 $sql = "SELECT * FROM tipoimagem WHERE idtipoimagem = $id;";

 $dados = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Deletar Tipo da Imagem</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>

    <body>

        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Deletar Tipo da Imagem</h2>                 
            </div>
        </header>

        <nav>
			<a href="tipo_imagem.php">VOLTAR</a>
		</nav>
        <div class="formulario">
            <form action="deletar_tipo_imagem_script.php" method="POST">
                <fieldset>
                    <legend><b>CONFIRMAÇÃO</b></legend>    
                    <section>
                        <article>
                            <p>
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <td>Tipo</td>
                                            <td>Descrição</td>
                                        </tr>
                                    </thead>

                                    <?php

                                        while ($linha = mysqli_fetch_assoc($dados)) {
                                            $id_tipo_imagem = $linha['idtipoimagem'];
                                            $tipoimagem = $linha['tipoimagem'];
                                            $descricao = $linha['descricao'];

                                            echo "<tr><td>" . $tipoimagem . "</td>";
                                            echo "<td>". $descricao. "</td>";
                                        }

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
                    <input type="submit" name="enviar" value="EXCLUIR ATIVIDADE" class="botao"><br>
                </div>

            </form>
        </div>

        <footer>
            &copy; 2020 - <?php echo date('Y'); ?> - Daniel Rovetta - Adriano Supeleto<br>
        </footer> 
    </body>
</html>
