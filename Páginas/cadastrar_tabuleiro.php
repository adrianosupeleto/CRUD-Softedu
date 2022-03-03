<?php
    include('protect.php');
	include('conexao.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cadastrar Tabuleiro</title>
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
                <h2>Página de Cadastro do Tabuleiro</h2>                 
            </div>
        </header>

        <nav>
			<a href="tabuleiro.php">VOLTAR</a>
		</nav>

		<div class="formulario">
			<form action="cadastrar_tabuleiro_script.php" method="POST">
				<fieldset >
					<legend><b>NOVO TABULEIRO</b></legend>				
                    <p>
                        <label><b>Descrição:</b></label><br>
                        <input type="text" name="descricao" placeholder="Descrição" required><br>
                        <b><label id="descricaoerro"></label></b>
                    </p>
                    <p>
                        <label><b>Planta:</b></label><br>
                        <textarea name="planta" placeholder="Planta"  rows="10" cols="50" maxlength="1000" required></textarea><br>
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
