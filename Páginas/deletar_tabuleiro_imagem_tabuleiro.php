<?php
    include('protect.php');
    include('conexao.php');

    $id = $_SESSION['idtabuleiroimagem'];

    $sql = "SELECT idtabuleiro_imagenstabuleiro, tabuleiroID, imagenstabuleiroID,posicaoTabuleiro,
            t.descricao, tim.tipoimagem
            FROM tabuleiro_imagenstabuleiro ti
            INNER JOIN tabuleiro t ON t.idtabuleiro = ti.tabuleiroID
            INNER JOIN tipodaimagem tim ON ti.imagenstabuleiroID= tim.idimagenstabuleiro
            WHERE idtabuleiro_imagenstabuleiro = $id;";

    $dados = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Deletar Cenário</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>

    <body>

        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Apagar Cenário</h2>                 
            </div>
        </header>

        <nav>
			<a href="tabuleiro_imagem_tabuleiro.php">VOLTAR</a>
		</nav>
        <div class="formulario">
            <form action="deletar_tabuleiro_imagem_tabuleiro_script.php" method="POST">
                <fieldset>
                    <legend><b>CONFIRMAÇÃO</b></legend>    
                    <section>
                        <article>
                            <p>
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <td>Imagem</td>
                                            <td>Tabuleiro</td>
                                            <td>Tipo</td>
                                        </tr>
                                    </thead>
                                        <?php

                                     while ($linha = mysqli_fetch_assoc($dados)) {

                                        $id_tabuleiro_comimagens = $linha['idtabuleiro_imagenstabuleiro'];
                                        $tabuleiro = $linha['descricao'];
                                        $imagem = $linha['tipoimagem'];
                                        $posicao = $linha['posicaoTabuleiro'];
                                       
                                        echo "<tr><td>" . $tabuleiro . "</td>";
                                        echo "<td>". $imagem . "</td>";
                                        echo "<td>". $posicao . "</td>";
                                    }

                                ?>
                                </table>
                            </p>
                        </article> 

                        <article>
                <p>
                    <table border="1">
                        <thead>
                            <tr>
                                <td>Imagem</td>
                            </tr>
                        </thead>

                           <?php

                             $sql_code = "SELECT tipoimagem, it.urlImagem
                                          FROM tipoimagem ti 
                                          INNER JOIN imagenstabuleiro it ON it.tipoimagemid = ti.idtipoimagem
                                          WHERE tipoimagem = '$imagem';";

                             $dados = mysqli_query($conn, $sql_code);

                             $linha = mysqli_fetch_assoc($dados);

                             $foto = $linha['urlImagem'];
                                                   
                               if(!$foto == null){
                                    $mostra_foto = "<img src='img/$foto' class='lista_foto'>";
                               } else{
                                  $mostra_foto = '';
                               }
                               
                                echo "<tr><td>" . $mostra_foto . "</td>";
                                echo "</tr>";
                        ?>
                    </table>
                </p>
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