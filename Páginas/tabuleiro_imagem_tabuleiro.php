<?php
    include('protect.php');
	include('conexao.php');

	  $sql = "SELECT idtabuleiro_imagenstabuleiro, tabuleiroID, imagenstabuleiroID,posicaoTabuleiro,
     		t.descricao, tim.tipoimagem
			FROM tabuleiro_imagenstabuleiro ti
			INNER JOIN tabuleiro t ON t.idtabuleiro = ti.tabuleiroID
			INNER JOIN tipodaimagem tim ON ti.imagenstabuleiroID= tim.idimagenstabuleiro;";

    $dados = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cenários</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Painel dos Cenários</h2>                 
            </div>
        </header>

		<nav>
            <a href="painel.php">VOLTAR</a>
		</nav>
		<nav>
			<a href="cadastrar_tabuleiro_imagem_tabuleiro.php">CADASTRAR CENÁRIO</a>
		</nav>
		<section>
			<article>
                <p>
			    	<table border="1">
				    	<thead>
						    <tr>
						        <td>Tabuleiro</td>
						        <td>Tipo</td>
                                <td>Função</td>
						    </tr>
						</thead>

								 <?php

		                             while ($linha = mysqli_fetch_assoc($dados)) {

		                                $id_tabuleiro_imagem = $linha['idtabuleiro_imagenstabuleiro'];
		                                $tabuleiro = $linha['descricao'];
		                                $imagem = $linha['tipoimagem'];
		                                $posicao = $linha['posicaoTabuleiro'];
		                               
		                                echo "<tr><td>" . $tabuleiro . "</td>";
		                                echo "<td>". $imagem . "</td>";
		                                echo '<td><a href="dados_tabuleiro_imagem_tabuleiro.php?id='. $id_tabuleiro_imagem .'"class="botao0">Visualizar</a></td>
		                               <tr>';		                                
		                            }

		                        ?>
                  
					</table>
				</p>
			</article>

            <section>            
		</section>

            
		</section>
        <footer>
            &copy; 2020 - <?php echo date('Y'); ?> - Daniel Rovetta - Adriano Supeleto<br>
		</footer> 
	</body>
</html>