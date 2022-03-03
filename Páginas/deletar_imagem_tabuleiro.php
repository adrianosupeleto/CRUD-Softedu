<?php
 include('protect.php');
 include('conexao.php');

  $id = $_GET['id'] ?? '';

  $sql = "SELECT * FROM imagenstabuleiro WHERE idimagenstabuleiro = $id";

  $dados = mysqli_query($conn, $sql);

  $linha = mysqli_fetch_assoc($dados);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Deletar Imagem</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>

    <body>

        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Apagar Imagem</h2>                 
            </div>
        </header>

        <nav>
			<a href="imagem_tabuleiro.php">VOLTAR</a>
		</nav>
        <div class="formulario">
            <form action="deletar_imagem_tabuleiro_script.php" method="POST">
                <fieldset>
                    <legend><b>CONFIRMAÇÃO</b></legend>    
                    <section>
                        <article>
                            <p>
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <td>Imagem</td>
                                             <td style="width: 250px" >Tipo</td>
                                        </tr>
                                    </thead>
                                    <?php
                                        
                                        $foto = $linha['urlImagem'];
                                       
                                        if(!$foto == null){
                                            $mostra_foto = "<img src='img/$foto' class='lista_foto'>";
                                        } else{
                                            $mostra_foto = '';
                                        }

                                        $sql = "SELECT idimagenstabuleiro,urlImagem,tipoimagemid, t.tipoimagem
                                                FROM imagenstabuleiro i
                                                INNER JOIN tipoimagem t ON t.idtipoimagem = i.tipoimagemid
                                                WHERE idimagenstabuleiro = '$id';";


                                        $dados = mysqli_query($conn, $sql);
                                        $linha = mysqli_fetch_assoc($dados);
                                        $tipoimagem = $linha['tipoimagem'];
                                       
                                        echo "<tr><td>" . $mostra_foto . "</td>";
                                        echo "<td>". $tipoimagem . "</td>";
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