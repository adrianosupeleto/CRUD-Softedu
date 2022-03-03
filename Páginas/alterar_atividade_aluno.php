<?php
    include('protect.php');
    include('conexao.php');

    if(isset($_GET['id']))
    {  
        $id = $_GET['id'];
        $_SESSION['idaux1'] = $id;

        $sql_code = "SELECT * FROM atividades_alunos WHERE idatividade_aluno = '$id';";
        $dados = mysqli_query($mysqli, $sql_code);

        while($linha = mysqli_fetch_assoc($dados))
        {
            $usuario = $linha['nomeusuario'];
            $descricao = $linha['descricaoatividade'];
            $status = $linha['status'];
            $inicio = $linha['datainicio'];
            $tabuleiro = $linha['descricaotabuleiro'];
            $atividade = $linha['descricao'];
            $fim = $linha['datafim'];
        }
    }

    $datahorainicio = explode(" ", $inicio);
    $datahorafim = explode(" ", $fim);

    $horainicio = $datahorainicio[1];
    $datainicio = $datahorainicio[0];

    $horafim    = $datahorafim[1];
    $datafim    = $datahorafim[0];  
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Alterar Avaliação</title>
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
                <h2>Página de Alterar da Avaliação</h2>                 
            </div>
        </header>

        <nav>
            <?php
             echo '<td><a href="dados_atividade_aluno.php?id=' . $id  . '" >VOLTAR</a></td>';
            ?>
		</nav>

		<div class="formulario">
			<form  action="" method="post">
				<fieldset >
					<legend><b>ALTERAR AVALIAÇÃO</b></legend>				
                    <div class="flex">
                        <p>
                            <label><b>Descrição:</b></label><br>
                            <input type="text" name="descricao"  value="<?php echo $descricao ?>" placeholder="Descrição" required><br>
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

                                    if($descricao == $tabuleiro){
                                        echo "<option selected='selected' value=" . $id . ">$descricao</option>";
                                    }
                                    else{
                                        echo "<option value=" . $id . ">$descricao</option>";

                                    }
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

                                     if($descricao == $descricao){
                                        echo "<option selected='selected' value=" . $id . ">$descricao</option>";
                                    }
                                    else{
                                        echo "<option value=" . $id . ">$descricao</option>";

                                    }
                                }
                            ?>  
                            </select>
                            <b><label id="descricaoerro"></label></b>
                        </p>

                        <p>
                            <label><b>Status:</b></label><br>
                            <input type="text" name="status" value="<?php echo $status ?>" placeholder="Status" required><br>
                            <b><label id="descricaoerro"></label></b>
                        </p>
                    </div>
                    <div class="flex">
                        <p>
                            <label><b>Data de Início:</b></label><br>
                            <input type="date" name="datainicio" value="<?php echo $datainicio; ?>" required><br>
                            <b><label id="descricaoerro"></label></b>
                        </p>


                        <p>
                            <label><b>Hora de Início:</b></label><br>
                            <input type="time" name="horainicio" value="<?php echo $horainicio; ?>" required><br>
                            <b><label id="descricaoerro"></label></b>
                        </p>

                        <p>
                            <label><b>Data de Término:</b></label><br>
                            <input type="date" name="datafim" value="<?php echo $datafim; ?>" required><br>
                            <b><label id="descricaoerro"></label></b>
                        </p>


                        <p>
                            <label><b>Hora de Término:</b></label><br>
                            <input type="time" name="horafim" value="<?php echo $horafim; ?>" required><br>
                            <b><label id="descricaoerro"></label></b>
                        </p>

                    </div>

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
        $idatividade_aluno = $_SESSION['idaux1'];

        $datahorainicio = $datainicio . " " . $horainicio ;
        $datahorafim = $datafim . " " . $horafim;

        $sql_code = "UPDATE softedu.atividade_aluno SET descricaoatividade ='$descricao', status = '$status', datainicio = '$datahorainicio', datafim = '$datahorafim', atividadeid = '$atividade', tabuleiroid = '$tabuleiro' 
            WHERE idatividade_aluno = $idatividade_aluno;";


        if ($mysqli->query($sql_code)) 
        {
            echo '<script type="text/javascript">','cadastro("Avaliação Alterada com Sucesso!");','</script>';
            echo '<meta http-equiv="refresh" content=0;url="atividade_aluno.php">';
        }
        else 
        {
            echo '<script type="text/javascript">','cadastro("Avaliação não foi Alterada!");','</script>';
            die($mysqli->error);
        }
    }
?>