<?php
    include('protect.php');
    include('conexao.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cadastrar Cenário</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
    
	</head>
	<body>
    <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Página de Cadastro do Cenário</h2>                 
            </div>
        </header>

        <nav>
			<a href="tabuleiro_imagem_tabuleiro.php">VOLTAR</a>
		</nav>

		<div class="formulario">
			<form action="cadastrar_tabuleiro_imagem_tabuleiro_script.php" method="POST">
				<fieldset >
					<legend><b>NOVO CENÁRIO</b></legend>				
                    <p>
                        <label><b>Tabuleiro:</b></label><br>
                        <select type="text" name="idtabuleiro" required>
                            
                            <?php              

                                $sql = "SELECT idtabuleiro, descricao FROM tabuleiro;";

                                $dados = mysqli_query($conn, $sql);

                                while ($linha = mysqli_fetch_assoc($dados)) {
                                $id = $linha['idtabuleiro'];
                                $descricao = $linha['descricao'];
                      
                                echo   
                                "<option value='$id'>$descricao</option>";
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

                                while ($linha = mysqli_fetch_assoc($dados)) {
                                $id = $linha['idimagenstabuleiro'];
                                $url = $linha['tipoimagem'];
                      
                                echo   
                                "<option value='$id'>$url</option>";
                                  }

                            ?>

						</select>
                        <b><label id="descricaoerro"></label></b>
                    </p>

                    <p>
                        <label><b>Posição:</b></label><br>
                        <input type="number" name="posicao" placeholder="Descrição" required><br>
                        <b><label id="descricaoerro"></label></b>
                    </p>
				</fieldset>
				<div>
					<input type="submit" name="enviar" value="CADASTRAR" class="botao"><br>
				</div>
			</form>
		</div>
		<footer>
            &copy; 2020 - <?php echo date('Y'); ?> - Daniel Rovetta - Adriano Supeleto<br>
		</footer> 
	</body>
</html>
