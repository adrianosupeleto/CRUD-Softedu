<?php
 include('protect.php');
 include('conexao.php');


    $sql = "SELECT idimagenstabuleiro,urlImagem,tipoimagemid, t.tipoimagem
            FROM imagenstabuleiro i
            INNER JOIN tipoimagem t ON t.idtipoimagem = i.tipoimagemid;";


    $dados = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Imagens</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Painel das Imagens</h2>                 
            </div>
        </header>

		<nav>
            <a href="painel.php">VOLTAR</a>
		</nav>
        <nav>
			<a href="tipo_imagem.php">TIPO DA IMAGEM</a>
		</nav>
		<nav>
			<a href="cadastrar_imagem_tabuleiro.php">CADASTRAR IMAGEM</a>
		</nav>
		<section>
			<article>
                <p>
			    	<table border="1">
				    	<thead>
						    <tr>
						        <td>Imagem</td>
						        <td style="width: 250px" >Tipo</td>
                                <td colspan="2">Funções</td>
						    </tr>
						</thead>

						 <?php

                            while ($linha = mysqli_fetch_assoc($dados)) {
                                $id_imagens_tabuleiro = $linha['idimagenstabuleiro'];
                                $tipoimagem = $linha['tipoimagem'];
                                
                                $foto = $linha['urlImagem'];
                               
                                if(!$foto == null){
                                    $mostra_foto = "<img src='img/$foto' class='lista_foto'>";
                                } else{
                                    $mostra_foto = '';
                                }
                               
                                echo "<tr><td>" . $mostra_foto . "</td>";
                                echo "<td>". $tipoimagem . "</td>";
                                echo '<td><a href="alterar_imagem_tabuleiro.php?id=' . $id_imagens_tabuleiro .
                                '"class="botao1">Alterar</a></td>
                                      <td><a href="deletar_imagem_tabuleiro.php?id=' . $id_imagens_tabuleiro .
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