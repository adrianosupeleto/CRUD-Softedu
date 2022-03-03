  <?php

   include('protect.php');
   include('conexao.php');

  $id = $_GET['id'];

  $sql = "SELECT plantaTabuleiro,descricao
          FROM tabuleiro
          WHERE idtabuleiro = '$id';";

  $dados = mysqli_query($conn, $sql);

  $linha = mysqli_fetch_assoc($dados);

  ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Alterar Tabuleiro</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
    <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Página de Alteração do Tabuleiro</h2>                 
            </div>
        </header>

        <nav>
			<a href="dados_tabuleiro.php">VOLTAR</a>
		</nav>

		<div class="formulario">
			<form action="alterar_tabuleiro_script.php" method="post">
				<fieldset >
					<legend><b>ALTERAR TABULEIRO</b></legend>
					<div>
			            <input type="hidden" class="form-control" name="id"
			            value="<?php echo $id;?>">
			        </div>				
                    <p>

                        <label><b>Descrição:</b></label><br>
                        <input type="text" name="descricao" placeholder="Descrição" required
                        value="<?php echo $linha['descricao']; ?>"><br>
                        <b><label id="descricaoerro"></label></b>
                    </p>
                    <p>
                        <label><b>Planta:</b></label><br>
                        <textarea name="planta" rows="10" cols="50" maxlength="1000" required><?php echo$linha['plantaTabuleiro'];?></textarea><br>
                        <b><label id="descricaoerro"></label></b>
                    </p>
				</fieldset>
				<div>
					<input type="submit" name="enviar" value="ALTERAR DADOS" class="botao"><br>
				</div>
			</form>
		</div>
		<footer>
            &copy; 2020 - <?php echo date('Y'); ?> - Daniel Rovetta - Adriano Supeleto<br>
		</footer> 
	</body>
</html>
