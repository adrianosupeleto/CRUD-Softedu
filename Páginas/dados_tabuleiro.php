<?php
    include('protect.php');
    include('conexao.php');

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $_SESSION['idaux'] = $id;
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Dados do Tabuleiro</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Painel dos Tabuleiros</h2>                 
            </div>
        </header>

		<nav>
            <a href="tabuleiro.php">VOLTAR</a>
		</nav>
		<nav>
            <?php
                $idtabuleiro = $_SESSION['idaux'];
                echo '<td><a href="alterar_tabuleiro.php?id=' . $idtabuleiro  . '" >ALTERAR TABULEIRO</a></td>';
			    echo '<td><a href="deletar_tabuleiro.php?id=' . $idtabuleiro . '" >DELETAR TABULEIRO</a></td></tr>';
            ?>
		</nav>
		<section>
			<article>
                <p>
			    	<table border="1">
				    	<thead>
						    <tr>
						        <td>Descrição</td>
						        <td>Usuário Criador</td>
                                <td>Data Criação</td>
						    </tr>
						</thead>
				    	<?php
                            $idtabuleiro = $_SESSION['idaux'];
                            $sql_code = "SELECT * FROM tabuleiros WHERE idtabuleiro = '$idtabuleiro' ";
                            $dados = mysqli_query ($mysqli, $sql_code);
                
                            while($linha = mysqli_fetch_assoc($dados))
                            {
                                $planta = $linha['plantaTabuleiro'];
                                $data = $linha['dataCriacao'];
                                $usuario = $linha['nome'];
                                $descricao = $linha['descricao'];
                                $idtbulerio = $linha['idtabuleiro'];


                                echo "<tr><td>" . $descricao ."</td>";
                                echo "<td>" . $usuario ."</td>";
                                echo "<td>" . $data ."</td></tr>";
                                
                                echo "<tr><td colspan=". 3 . "><b>" . "Planta" . "</b></td></tr>";
                                echo "<tr><td colspan=". 3 . ">" . $planta . "</td></tr>";

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
                            $id = $_SESSION['idaux'];

                            $sql_code = "SELECT * FROM imagens_cenario WHERE tabuleiroid = '$id';";
                            $dados = mysqli_query ($mysqli, $sql_code);
                
                            while($linha = mysqli_fetch_assoc($dados))
                            {
                                $tipo = $linha['tipoimagem'];
                                        $descricao = $linha['descricao'];
                                        $url = $linha['urlImagem'];
                                        $posicao =$linha['posicaoTabuleiro'];

                                        echo '<tr><td><img src="' .'img/' . $url .'"' . 'style="' . 'width: 250px; border-radius: 10px"' .'></td>';
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