<?php
 include('protect.php');
 include('conexao.php');

 $sql = "SELECT * FROM tipoimagem;";

 $dados = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tipo da Imagem</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Painel dos Tipos da Imagem</h2>                 
            </div>
        </header>

		<nav>
            <a href="imagem_tabuleiro.php">VOLTAR</a>
		</nav>
		<nav>
			<a href="cadastrar_tipo_imagem.php">CADASTRAR TIPO DA IMAGEM</a>
		</nav>
		<section>
			<article>
                <p>
			    	<table border="1">
				    	<thead>
						    <tr>
						        <td>Tipo</td>
                    <td>Descrição</td>
                    <td colspan="2">Funções</td>
						    </tr>
						</thead>

            <?php

                            while ($linha = mysqli_fetch_assoc($dados)) {
                                $id_tipo_imagem = $linha['idtipoimagem'];
                                $tipoimagem = $linha['tipoimagem'];
                                $descricao = $linha['descricao'];

                                echo "<tr><td>" . $tipoimagem . "</td>";
                                echo "<td>". $descricao. "</td>";
                                echo '<td><a href="alterar_tipo_imagem.php?id=' . $id_tipo_imagem .
                                '"class="botao1">Alterar</a></td>
                                      <td><a href="deletar_tipo_imagem.php?id=' . $id_tipo_imagem .
                                '"class="botao2">Deletar</a></td>
                                </tr>';

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