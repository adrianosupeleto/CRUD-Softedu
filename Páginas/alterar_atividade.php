<?php
    include('protect.php');
    include('conexao.php');

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $_SESSION['idaux'] = $id;
        $sql_code = "SELECT * FROM atividades WHERE idatividade = $id;";
        $dados = mysqli_query ($mysqli, $sql_code);

        while($linha = mysqli_fetch_assoc($dados))
        {
            $idatividade = $linha['idatividade'];
            $descricaoatividade = $linha['descricao'];
            $categoria = $linha['descricaoCategoria'];
            $nivel = $linha['descricaoNivel'];
        }
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Alterar Atividade</title>
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
                <h2>Página de Alteração da Atividade</h2>                 
            </div>
        </header>

        <nav>
			<a href="atividade.php">VOLTAR</a>
		</nav>

		<div class="formulario">
			<form action="alterar_atividade.php" method="post">
				<fieldset class="flex">
					<legend><b>ALTERAR ATIVIDAE</b></legend>				
                    <p>
                        <label><b>Descrição:</b></label><br>
                        <input type="text" name="descricao"  value="<?php echo $descricaoatividade ?>"placeholder="Descrição" required><br>
                        <b><label id="descricaoerro"></label></b>
                    </p>

                    <p>
						<label><b>Categoria da Atividade:</b></label><br>
						<select type="text" name="categoria" required>
                            <?php
                                $sql_code = "SELECT * FROM softedu.categoriaatividade;";    
                                $dados = mysqli_query ($mysqli, $sql_code);
                    
                                while($linha = mysqli_fetch_assoc($dados))
                                {
                                    $id = $linha['idcategoriaAtividade'];
                                    $descricao = $linha['descricao'];

                                    if($descricao == $categoria){
                                        echo "<option selected='selected' value=" . $id . ">$descricao</option>";
                                    }
                                    else{
                                        echo "<option value=" . $id . ">$descricao</option>";

                                    }

                                }
                            ?> 
						</select>
					</p>

                    <p>
						<label><b>Nível da Atividade:</b></label><br>
						<select type="text" name="nivel" required>
                            <?php
                                $sql_code = "SELECT * FROM softedu.nivelatividade;";    
                                $dados = mysqli_query ($mysqli, $sql_code);
                    
                                while($linha = mysqli_fetch_assoc($dados))
                                {
                                    $id = $linha['idnivelAtividade'];
                                    $descricao = $linha['descricaoNivel'];

                                    if($descricao == $nivel){
                                        echo "<option selected='selected' value=" . $id . ">$descricao</option>";
                                    }
                                    else{
                                        echo "<option value=" . $id . ">$descricao</option>";

                                    }

                                }
                            ?> 
						</select>
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
            $categoria = $mysqli->real_escape_string($_POST['categoria']);
            $nivel   = $mysqli->real_escape_string($_POST['nivel']);
            $idatividade = $_SESSION['idaux'];

            $sql_code1 = "UPDATE softedu.atividade SET descricao = '$descricao' WHERE idatividade = '$idatividade';";
            $sql_code2 = "UPDATE softedu.atividade SET categoriaatividadeid = '$categoria' WHERE idatividade = '$idatividade';";
            $sql_code3 = "UPDATE softedu.atividade SET nivelatividadeid = '$nivel ' WHERE idatividade = '$idatividade';";
            
            if ($mysqli->query($sql_code1)) 
            {
                if ($mysqli->query($sql_code2)) 
                {
                    if ($mysqli->query($sql_code3)) 
                    {
                        echo '<script type="text/javascript">','cadastro("Atividade Alterada com Sucesso");','</script>';
                        //header("Location: dados_usuario.php");
                        echo '<meta http-equiv="refresh" content=0;url="atividade.php">';
                    }
                    else 
                    {
                        echo '<script type="text/javascript">','cadastro("Não foi Possivel Alterar a Atividade");','</script>';
                        die($mysqli->error);
                    }
                }
                else 
                {
                    echo '<script type="text/javascript">','cadastro("Não foi Possivel Alterar os Dados");','</script>';
                    die($mysqli->error);
                }
            }
             else 
            {
                echo '<script type="text/javascript">','cadastro("Não foi Possivel Alterar os Dados");','</script>';
                die($mysqli->error);
            }
        }
    }
?>