<?php
    include('protect.php');
    include('conexao.php');

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $_SESSION['idaux'] = $id;
        $sql_code = "SELECT * FROM nivelatividade WHERE idnivelAtividade = $id;";
        $dados = mysqli_query ($mysqli, $sql_code);

        while($linha = mysqli_fetch_assoc($dados))
        {
            $descricaonivel = $linha['descricaoNivel'];
        }
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Alterar Nível da Atividade</title>
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
                <h2>Página de Alteração do Nível da Atividade</h2>                 
            </div>
        </header>

        <nav>
			<a href="nivel_atividade.php">VOLTAR</a>
		</nav>

		<div class="formulario">
			<form action="alterar_nivel_atividade.php" method="post">
				<fieldset class="flex">
					<legend><b>ALTERAR NÍVEL ATIVIDAE</b></legend>				
                    <p>
                        <label><b>Descrição:</b></label><br>
                        <input type="text" name="descricao"  value="<?php echo $descricaonivel ?>"placeholder="Descrição" required><br>
                        <b><label id="descricaoerro"></label></b>
                    </p>

				</fieldset>
				<div>
					<input type="submit" name="enviar" value="CONFIRMAR ALTERAÇÃO" class="botao"><br>
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
            $idnivel = $_SESSION['idaux'];

            $sql_code = "UPDATE softedu.nivelatividade SET descricaoNivel = '$descricao' WHERE idnivelAtividade = $idnivel;";
            
            if ($mysqli->query($sql_code)) 
            {
                echo '<script type="text/javascript">','cadastro("Dados Alterados com Sucesso");','</script>';
                echo '<meta http-equiv="refresh" content=0;url="nivel_atividade.php">';
            }
            else 
            {
                echo '<script type="text/javascript">','cadastro("Não foi Possivel Alterar os Dados");','</script>';
                die($mysqli->error);
            }
        }
    }
?>