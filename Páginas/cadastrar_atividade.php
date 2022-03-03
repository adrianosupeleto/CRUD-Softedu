<?php
 include('protect.php');
 include('conexao.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Cadastrar Atividade</title>
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
                <h2>Página de Cadastro de Atividade</h2>                 
            </div>
        </header>

        <nav>
			<a href="atividade.php">VOLTAR</a>
		</nav>

		<div class="formulario">
			<form action="cadastrar_atividade.php" method="post">
				<fieldset >
					<legend><b>NOVA ATIVIDADE</b></legend>				
                    <p>
                        <label><b>Descrição:</b></label><br>
                        <input type="text" name="descricao" placeholder="Descrição" required><br>
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

                                    echo "<option value=" . $id . ">$descricao</option>";
                                }
                            ?> 
						</select>
                        <?php
                                $sql_code = "SELECT * FROM categoriaatividade;";    
                                $dados = mysqli_query ($mysqli, $sql_code);

                                $sql_query = $mysqli->query($sql_code);
                                $quantidade = $sql_query->num_rows;

                                if ($quantidade == 0)
                                {   
                                    echo '</br><b><label>SEM CATEGORIAS CADASTRADAS</label></b>';
                                }
                        ?> 
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

                                    echo "<option value=" . $id . ">$descricao</option>";
                                }
                            ?> 
						</select>
                        <?php
                                $sql_code = "SELECT * FROM softedu.nivelatividade;";    
                                $dados = mysqli_query ($mysqli, $sql_code);

                                $sql_query = $mysqli->query($sql_code);
                                $quantidade = $sql_query->num_rows;

                                if ($quantidade == 0)
                                {   
                                    echo '</br><b><label>SEM NÍVEIS CADASTRADOS</label></b>';
                                }
                        ?> 
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
            $categoria = $mysqli->real_escape_string($_POST['categoria']);
            $nivel   = $mysqli->real_escape_string($_POST['nivel']);

            $sql_code = "INSERT INTO atividade (descricao, categoriaatividadeid, nivelatividadeid) VALUES ('$descricao', '$categoria', '$nivel');";
            
            if ($mysqli->query($sql_code)) 
            {
                echo '<script type="text/javascript">','cadastro("Atividade Cadastrada com Sucesso!");','</script>';
                echo '<meta http-equiv="refresh" content=0;url="atividade.php">';
            }
            else 
            {
                echo '<script type="text/javascript">','cadastro("Atividade não foi Cadastrada!");','</script>';
                die($mysqli->error);
            }
        }
    }
?>