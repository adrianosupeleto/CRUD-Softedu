<?php
    include('protect.php');
    include('conexao.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cadastrar Nível da Atividade</title>
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
                <h2>Página de Cadastro do Nível da Atividade</h2>                 
            </div>
        </header>

        <nav>
			<a href="nivel_atividade.php">VOLTAR</a>
		</nav>

		<div class="formulario">
			<form action="cadastrar_nivel_atividade.php" method="post">
				<fieldset >
					<legend><b>NOVO NÍVEL DA ATIVIDADE</b></legend>				
                    <p>
                        <label><b>Descrição:</b></label><br>
                        <input type="text" name="descricao" placeholder="Descrição" required><br>
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


<?php

    if(isset($_POST['descricao']))
    {
        if (strlen($_POST['descricao']) == 0 )
        {
            echo "<script>document.getElementById('descricaoerro').innerText='Insira a Descrição!';</script>";
    
        }
        else
        {   
            $descricao    = $mysqli->real_escape_string($_POST['descricao']);
            $sql_code = "INSERT INTO nivelatividade (descricaoNivel) VALUES ('$descricao');";
            
            if ($mysqli->query($sql_code)) 
            {
                echo '<script type="text/javascript">','cadastro("Nível da Atividade Cadastrado com Sucesso!");','</script>';
                echo '<meta http-equiv="refresh" content=0;url="nivel_atividade.php">';
            }
            else 
            {
                echo '<script type="text/javascript">','cadastro("Nível da Atividade não foi Cadastrado!");','</script>';
                die($mysqli->error);
            }
        }
    }
?>