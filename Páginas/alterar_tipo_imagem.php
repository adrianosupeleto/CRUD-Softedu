<?php
    include('protect.php');
	include('conexao.php');

	$id = $_GET['id'] ?? '';

  	$sql = "SELECT * FROM tipoimagem WHERE idtipoimagem = $id;";

  	$_SESSION['tipo_imagem'] = $id;

  	$dados = mysqli_query($conn, $sql);

  	$linha = mysqli_fetch_assoc($dados);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>ALterar Tipo da Imagem</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
    <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Página de Alteração do Tipo da Imagem</h2>                 
            </div>
        </header>

        <nav>
			<a href="tipo_imagem.php">VOLTAR</a>
		</nav>

		<div class="formulario">
			<form action="alterar_tipo_imagem_script.php" method="POST">
				<fieldset >
					<legend><b>ALTERAR TIPO DA IMAGEM</b></legend>	
                    <p>
                        <label><b>Tipo:</b></label><br>
                        <input type="text" name="tipo" placeholder="Tipo" required
                        value="<?php echo $linha['tipoimagem']; ?>"><br>
                        <b><label id="descricaoerro"></label></b>
                    </p>
                    
                    <p>
                        <label><b>Descrição:</b></label><br>
                        <input type="text" name="descricao" placeholder="Descrição" required
                        value="<?php echo $linha['descricao']; ?>"><br>
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