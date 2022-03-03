<?php
    include('protect.php');
    include('conexao.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cadastrar Avaliação</title>
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
                <h2>Página de Cadastro da Avaliação</h2>                 
            </div>
        </header>

        <nav>
			<a href="atividade_aluno.php">VOLTAR</a>
		</nav>

		<div class="formulario">
			<form  action="cadastrar_atividade_aluno.php" method="post">
				<fieldset >
					<legend><b>NOVA AVALIAÇÃO</b></legend>				
                    <div class="flex">
                        <p>
                            <label><b>Descrição:</b></label><br>
                            <input type="text" name="descricao" placeholder="Descrição" required><br>
                            <b><label id="descricaoerro"></label></b>
                        </p>

                        <p>
                            <label><b>Tabuleiro:</b></label><br>
                            <select type="text" name="tabuleiro" required>
                            <?php
                                $sql_code = "SELECT * FROM softedu.tabuleiro;";    
                                $dados = mysqli_query ($mysqli, $sql_code);
                            
                                while($linha = mysqli_fetch_assoc($dados))
                                {
                                    $id = $linha['idtabuleiro'];
                                    $descricao = $linha['descricao'];

                                    echo "<option value=" . $id . ">$descricao</option>";
                                }
                            ?>                                 
                            </select>
                            <b><label id="descricaoerro"></label></b>
                        </p>

                        <p>
                            <label><b>Atividade:</b></label><br>
                            <select type="text" name="atividade" required>
                            <?php
                                $sql_code = "SELECT * FROM softedu.atividade;";    
                                $dados = mysqli_query ($mysqli, $sql_code);
                            
                                while($linha = mysqli_fetch_assoc($dados))
                                {
                                    $id = $linha['idatividade'];
                                    $descricao = $linha['descricao'];

                                    echo "<option value=" . $id . ">$descricao</option>";
                                }
                            ?>  
                            </select>
                            <b><label id="descricaoerro"></label></b>
                        </p>

                        <p>
                            <label><b>Status:</b></label><br>
                            <input type="text" name="status" placeholder="Status" required><br>
                            <b><label id="descricaoerro"></label></b>
                        </p>
                    </div>
                    <div class="flex">
                        <p>
                            <label><b>Data de Início:</b></label><br>
                            <input type="date" name="datainicio" required><br>
                            <b><label id="descricaoerro"></label></b>
                        </p>


                        <p>
                            <label><b>Hora de Início:</b></label><br>
                            <input type="time" name="horainicio" required><br>
                            <b><label id="descricaoerro"></label></b>
                        </p>

                        <p>
                            <label><b>Data de Término:</b></label><br>
                            <input type="date" name="datafim" required><br>
                            <b><label id="descricaoerro"></label></b>
                        </p>


                        <p>
                            <label><b>Hora de Término:</b></label><br>
                            <input type="time" name="horafim" required><br>
                            <b><label id="descricaoerro"></label></b>
                        </p>

                    </div>

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

    if(isset($_POST['descricao']) || isset($_POST['status']) || isset($_POST['datainicio']) || isset($_POST['datafim']) || isset($_POST['horainicio']) || isset($_POST['horafim']))
    {
 
        $descricao  = $mysqli->real_escape_string($_POST['descricao']);
        $status     = $mysqli->real_escape_string($_POST['status']);
        $datainicio = $mysqli->real_escape_string($_POST['datainicio']);
        $datafim    = $mysqli->real_escape_string($_POST['datafim']);
        $horainicio = $mysqli->real_escape_string($_POST['horainicio']);
        $horafim    = $mysqli->real_escape_string($_POST['horafim']);
        $tabuleiro  = $mysqli->real_escape_string($_POST['tabuleiro']);
        $atividade  = $mysqli->real_escape_string($_POST['atividade']);
        $usuario    = $_SESSION['id'];

        $datahorainicio = $datainicio . " " . $horainicio . ":00";
        $datahorafim = $datafim . " " . $horafim . ":00";

        $sql_code = "INSERT INTO atividade_aluno (descricaoatividade, tabuleiroid, usuarioid, status, datainicio, atividadeid, datafim) VALUES ('$descricao', '$tabuleiro', '$usuario','$status', '$datahorainicio', '$atividade', '$datahorafim');";

        if ($mysqli->query($sql_code)) 
        {
            echo '<script type="text/javascript">','cadastro("Avaliação Cadastrada com Sucesso!");','</script>';
            echo '<meta http-equiv="refresh" content=0;url="atividade_aluno.php">';
        }
        else 
        {
            echo '<script type="text/javascript">','cadastro("Avaliação não foi Cadastrada!");','</script>';
            die($mysqli->error);
        }
    }
?>
