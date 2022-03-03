<?php
    include('protect.php');
    include('conexao.php');

    if(isset($_GET['id']))
    {  
        $id = $_GET['id'];
        $_SESSION['idaux1'] = $id;
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Dados da Avaliação</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Painel da Avaliação</h2>                 
            </div>
        </header>

		<nav>
            <a href="atividade_aluno.php">VOLTAR</a>
		</nav>
		<nav>
            <?php
                $idtabuleiro = $_SESSION['idaux1'];
                echo '<td><a href="alterar_atividade_aluno.php?id=' . $idtabuleiro  . '" >ALTERAR AVALIAÇÃO</a></td>';
                echo '<td><a href="deletar_atividade_aluno.php?id=' . $idtabuleiro . '" >DELETAR AVALIAÇÃO</a></td></tr>';
            ?>
		</nav>
		<section>
			<article>
                <p>
                    <table border="1">
				    	<thead>
						    <tr>
						        <td>Descrição</td>
						        <td>Usuário</td>
                                <td>Status</td>
						    </tr>
						</thead>
                            <?php
                                $id = $_SESSION['idaux1'];
                                $sql_code = "SELECT * FROM atividades_alunos WHERE idatividade_aluno = '$id';";
                                $dados = mysqli_query ($mysqli, $sql_code);
                    
                                while($linha = mysqli_fetch_assoc($dados))
                                {
                                    $usuario = $linha['nomeusuario'];
                                    $descricao = $linha['descricaoatividade'];
                                    $status = $linha['status'];

                                    echo "<tr><td>" . $descricao ."</td>";
                                    echo "<td>" . $usuario ."</td>";
                                    echo "<td>" . $status ."</td>";                                    
                                }
                            ?>
					</table>
				</p>
			</article>
            
            <article>
                <p>
                    <table border="1">
                        <thead>
                            <tr>
                                <td>Tabuleiro</td>
                                <td>Atividade</td>
                                <td>Início</td>
                                <td>Fim</td>
                            </tr>
                        </thead>
                        <?php
                                $id = $_SESSION['idaux1'];
                                $sql_code = "SELECT * FROM atividades_alunos WHERE idatividade_aluno = '$id';";
                                $dados = mysqli_query ($mysqli, $sql_code);
                    
                                while($linha = mysqli_fetch_assoc($dados))
                                {
                                    $inicio = $linha['datainicio'];
                                    $tabuleiro = $linha['descricaotabuleiro'];
                                    $atividade = $linha['descricao'];
                                    $fim = $linha['datafim'];
                                    $_SESSION['idaux2'] = $linha['tabuleiroid'];

                                    echo "<tr><td>" . $tabuleiro ."</td>";
                                    echo "<td>" . $atividade ."</td>";
                                    echo "<td>" . $inicio ."</td>";
                                    echo "<td>" . $fim ."</td>";                                    
                                }
                            ?>
                    </table>
                </p>
            </article>

            <article>
                <p>
                    <table border="1">
                        <thead>
                            <tr>
                                <td colspan="3">Planta</td>
                            </tr>
                            </thead>  
                            <?php
                                $id = $_SESSION['idaux1'];
                                $sql_code = "SELECT * FROM atividades_alunos WHERE idatividade_aluno = '$id';";
                                $dados = mysqli_query ($mysqli, $sql_code);
                    
                                while($linha = mysqli_fetch_assoc($dados))
                                {
                                    $idtabuleiro = $linha['tabuleiroid'];
                                    $sql_code = "SELECT * FROM tabuleiro WHERE idtabuleiro = '$idtabuleiro';";
                                    $dados = mysqli_query ($mysqli, $sql_code);
                    
                                    while($linha = mysqli_fetch_assoc($dados))
                                    {
                                        $planta = $linha['plantaTabuleiro'];

                                        echo '<td colspan="' . 3 . '">' . $planta . '</td>';
                                    }
                                }
                            ?>  
                    </table>
                </p>
            </article>

            <article>
                <p>
			    	<table border="1">
				    	<thead>
						    <tr>
						        <td colspan="4">Cenários</td>
						    </tr>
                            <tr>
                                <td style="width: 600px">Imagem</td>
                                <td>Tipo</td>
                                <td>Descriçao</td>
                                <td>Posição</td>
                            </tr>
						</thead>
                        <?php
                            $id = $_SESSION['idaux2'];

                            $sql_code = "SELECT * FROM imagens_cenario WHERE tabuleiroid = '$id';";
                            $dados = mysqli_query ($mysqli, $sql_code);
                
                            while($linha = mysqli_fetch_assoc($dados))
                            {
                                $tipo = $linha['tipoimagem'];
                                        $descricao = $linha['descricao'];
                                        $url = $linha['urlImagem'];
                                        $posicao =$linha['posicaoTabuleiro'];

                                        echo '<tr><td><img src="' .'img/' . $url .'"' . 'style="' . 'width: 250px;border-radius: 10px"' .'></td>';
                                        echo "<td>" . $tipo ."</td>";
                                        echo "<td>" . $descricao ."</td>";
                                        echo "<td>" . $posicao ."</td></tr>";      
                            }  
                                 
                    ?>
                    </table>
				</p>
			</article>
		</section>
        <footer>
            &copy; 2020 - <?php echo date('Y'); ?> - Daniel Rovetta - Adriano Supeleto<br>
		</footer> 
	</body>
</html>