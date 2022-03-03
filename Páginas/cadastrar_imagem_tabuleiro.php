  <?php

   include('protect.php');
   include('conexao.php');
   ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Cadastrar Imagem</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<script src="js/script.js"></script>
    
	</head>
	<body>
    <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Página de Cadastro da Imagem</h2>                 
            </div>
        </header>

        <nav>
			<a href="imagem_tabuleiro.php">VOLTAR</a>
		</nav>

		<div class="formulario">
			<form action="cadastrar_imagem_tabuleiro_script.php" method="POST" enctype="multipart/form-data">
				<fieldset >
					<legend><b>NOVA IMAGEM</b></legend>				
                    <p>
                        <label><b>Arquivo de Imagem:</b></label><br>
                        <input type="file" name="imagem" onchange="previewImagem()" accept="image/*" required><br>
                        <b><label id="descricaoerro"></label></b>
                    </p>

                    <p>
                        <label><b>Tipo Imagem:</b></label><br>
                        <select type="text" name="id" required>
                           
                        	<?php

				                $sql = "SELECT idtipoimagem, tipoimagem FROM tipoimagem;";
				                $dados = mysqli_query($conn, $sql);
				              
				                while ($linha = mysqli_fetch_assoc($dados)) {
				                $id = $linha['idtipoimagem'];
				                $tipo = $linha['tipoimagem'];
				      
				                echo   
				                "<option value='$id'>$tipo</option>";
				                  }

              				?>

						</select>
                        <b><label id="descricaoerro"></label></b>
                    </p>

                    <section>
                        <article>
                            <p>
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <td>Imagem Selecionada</td>
                                        </tr>
                                    </thead>
                                        <tr>
                                            <td><img src="" style="width: 250px;border-radius: 10px" id="preview-image"></td>
                                        </tr>
                                </table>
                            </p>
                        </article>
                    </section>
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
