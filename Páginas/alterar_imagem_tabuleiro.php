<?php
    include('protect.php');
    include('conexao.php');


  $id = $_GET['id'] ?? '';

  $sql = "SELECT * FROM imagenstabuleiro WHERE idimagenstabuleiro = $id";

  $dados = mysqli_query($conn, $sql);

  $linha = mysqli_fetch_assoc($dados);
  
  $tipoid = $linha['tipoimagemid'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Alterar Imagem</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		
	</head>
	<body>
    <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Página de Alteração da Imagem</h2>                 
            </div>
        </header>

        <nav>
			<a href="imagem_tabuleiro.php">VOLTAR</a>
		</nav>

		<div class="formulario">
			<form action="alterar_imagem_tabuleiro_script.php" method="POST" enctype="multipart/form-data">
				<fieldset >
					<legend><b>ALTERAR IMAGEM</b></legend>		

					<div class="form-group">
		             <input type="hidden" class="form-control" name="id"
		             value="<?php echo $id;?>">
		          </div>

		          <section>
			<article>
                <p>
			    	<table border="1">
				    	<thead>
						    <tr>
						        <td>Imagem Atual</td>
						    </tr>
						</thead>

						 <?php

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
			</article>
		</section>

			         

                    <p>
                        <label><b>Arquivo de Imagem:</b></label><br>
                        <input type="file" name="imagem" placeholder="Arquivo de Imagem"  accept="image/*"required><br>
                        <b><label id="descricaoerro"></label></b>
                    </p><br>


                    <p>
                        <label><b>Tipo Imagem:</b></label><br>
                        <select type="text" name="tipo" required>
                         
                    <?php

		                $sql = "SELECT idtipoimagem, tipoimagem FROM tipoimagem;";
		                $dados = mysqli_query($conn, $sql);

		                while ($linha = mysqli_fetch_assoc($dados)) {
		                $id = $linha['idtipoimagem'];
		                $tipo = $linha['tipoimagem'];

		                  if($id == $tipoid){
                                echo "<option selected='selected' value=" . $id . ">$tipo</option>";
                          }
                          else{
                            echo "<option value=" . $id . ">$tipo</option>";
                          }
                       }
		            ?>

						</select>
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
