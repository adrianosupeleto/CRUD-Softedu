<?php
    include('protect.php');
	include('conexao.php');

	$id = $_GET['id'] ?? '';

	$_SESSION['idtabuleiroimagem'] = $id;

	$sql = "SELECT idtabuleiro_imagenstabuleiro, tabuleiroID, imagenstabuleiroID,posicaoTabuleiro,
     		t.descricao, tim.tipoimagem
			FROM tabuleiro_imagenstabuleiro ti
			INNER JOIN tabuleiro t ON t.idtabuleiro = ti.tabuleiroID
			INNER JOIN tipodaimagem tim ON ti.imagenstabuleiroID= tim.idimagenstabuleiro
			WHERE idtabuleiro_imagenstabuleiro = $id;";

    $dados = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Dados do Cenário</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Painel do Cenário</h2>                 
            </div>
        </header>

		<nav>
            <a href="tabuleiro_imagem_tabuleiro.php">VOLTAR</a>
		</nav>
		<nav>
            <tr>
                <td><a href="alterar_tabuleiro_imagem_tabuleiro.php">ALTERAR CENÁRIO</a></td>
			    <td><a href="deletar_tabuleiro_imagem_tabuleiro.php">DELETAR CENÁRIO</a></td>
            </tr>
		</nav>
		<section>
			<article>
                <p>
			    	<table border="1">
				    	<thead>
						    <tr>
						        <td>Tabuleiro</td>
                                <td>Tipo da Imagem</td>
                                <td>Posição</td>
						    </tr>
						</thead>
	
                       		 <?php

		                             while ($linha = mysqli_fetch_assoc($dados)) {

		                                $id_tabuleiro_comimagens = $linha['idtabuleiro_imagenstabuleiro'];
		                                $tabuleiro = $linha['descricao'];
		                                $imagem = $linha['tipoimagem'];
		                                $posicao = $linha['posicaoTabuleiro'];
		                               
		                                echo "<tr><td>" . $tabuleiro . "</td>";
		                                echo "<td>". $imagem . "</td>";
		                                echo "<td>". $posicao . "</td>";
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
						        <td>Imagem</td>
						    </tr>
						</thead>

                           <?php

                           	 $sql_code = "SELECT tipoimagem, it.urlImagem
						            	  FROM tipoimagem ti 
						            	  INNER JOIN imagenstabuleiro it ON it.tipoimagemid = ti.idtipoimagem
						            	  WHERE tipoimagem = '$imagem';";

						     $dados = mysqli_query($conn, $sql_code);

						     $linha = mysqli_fetch_assoc($dados);

					         $foto = $linha['urlImagem'];
					                               
					           if(!$foto == null){
					                $mostra_foto = "<img src='img/$foto' style='width: 250px;border-radius: 10px'>";
					           } else{
					              $mostra_foto = '';
					           }
                               
                                echo "<tr><td>" . $mostra_foto . "</td>";
                                echo "</tr>";
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