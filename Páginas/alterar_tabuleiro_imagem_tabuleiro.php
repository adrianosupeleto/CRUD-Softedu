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

  $linha = mysqli_fetch_assoc($dados);

  $desctabuleiro = $linha['descricao'];

  $tipoimagemtabuleiro = $linha['tipoimagem'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Alterar Cenário</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
        
	</head>
	<body>
    <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Página de Alteração do Cenário</h2>                 
            </div>
        </header>

        <nav>
			<a href="tabuleiro_imagem_tabuleiro.php">VOLTAR</a>
		</nav>

		<div class="formulario">
			<form action="alterar_tabuleiro_imagem_tabuleiro_script.php" method="POST">
				<fieldset >
					<legend><b>ALTERAR CENÁRIO</b></legend>	

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id"
                        value="<?php echo $id;?>">
                    </div>	

                    <p>
                        <label><b>Tabuleiro:</b></label><br>
                        <select type="text" name="idtabuleiro" required>
                           
                        <?php                  

                            $sql = "SELECT idtabuleiro, descricao FROM tabuleiro;";

                            $dados = mysqli_query($conn, $sql);


                            while ($verifica = mysqli_fetch_assoc($dados)) {
                            $id = $verifica['idtabuleiro'];
                            $descricao = $verifica['descricao'];
                  
                             if($descricao == $desctabuleiro){
                                echo "<option selected='selected' value=" . $id . ">$descricao</option>";
                             }
                            else{
                                echo "<option value=" . $id . ">$descricao</option>";
                            }
                        }

                        ?>

						</select>
                        <b><label id="descricaoerro"></label></b>
                    </p>
                    <p>
                        <label><b>Imagem:</b></label><br>
                        <select type="text" name="idimagem" required>

                        <?php                  

                                $sql = "SELECT idimagenstabuleiro, t.tipoimagem
                                        FROM imagenstabuleiro i
                                        INNER JOIN tipoimagem t ON t.idtipoimagem = i.tipoimagemid;";

                                $dados = mysqli_query($conn, $sql);

                                while ($verifica = mysqli_fetch_assoc($dados)) {
                                $id = $verifica['idimagenstabuleiro'];
                                $url = $verifica['tipoimagem'];
                      
                                if($url == $tipoimagemtabuleiro){
                                echo "<option selected='selected' value=" . $id . ">$url</option>";
                                 }
                                else{
                                    echo "<option value=" . $id . ">$url</option>";
                                }
                            }
                        ?>
                
						</select>
                        <b><label id="descricaoerro"></label></b>
                    </p>

                    <p>
                        <label><b>Posição:</b></label><br>
                        <input type="number" name="posicao" value="<?php echo $linha['posicaoTabuleiro'];?>"required><br>
                        <b><label id="descricaoerro"></label></b>
                    </p>
				</fieldset>
				<div>
					<input type="submit" name="enviar" value="ALTERAR" class="botao"><br>
				</div>
			</form>
		</div>
		<footer>
            &copy; 2020 - <?php echo date('Y'); ?> - Daniel Rovetta - Adriano Supeleto<br>
		</footer> 
	</body>
</html>
