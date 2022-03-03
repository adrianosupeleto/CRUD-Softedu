<?php
    include('protect.php');
	include('conexao.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Atividades</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Painel de Atividades</h2>                 
            </div>
        </header>

		<nav>
            <a href="painel.php">VOLTAR</a>
		</nav>
		<nav>
			<a href="nivel_atividade.php">NÍVEL ATIVIDADE</a>
			<a href="categoria_atividade.php">CATEGORIA ATIVIDADE</a>
		</nav>
		<nav>
			<a href="cadastrar_atividade.php">CADASTRAR ATIVIDADE</a>
		</nav>
		<section>
			<article>
                <p>
			    	<table border="1">
				    	<thead>
						    <tr>
						        <td>Descrição</td>
						        <td>Categoria</td>
                                <td>Nível</td>
								<td colspan="2">Funções</td>
						    </tr>
						</thead>
				    	<?php
                            $sql_code = "SELECT * FROM atividades;";
                            $dados = mysqli_query ($mysqli, $sql_code);
                
                            while($linha = mysqli_fetch_assoc($dados))
                            {
                                $idatividade = $linha['idatividade'];
                                $descricao = $linha['descricao'];
                                $categoria = $linha['descricaoCategoria'];
                                $nivel = $linha['descricaoNivel'];

                                echo "<tr><td>" . $descricao ."</td>";
                                echo "<td>" . $categoria ."</td>";
                                echo "<td>" . $nivel ."</td>";
								echo '<td><a href="alterar_atividade.php?id=' . $idatividade . '" class="botao1">Alterar</a></td>';
								echo '<td><a href="deletar_atividade.php?id=' . $idatividade . '" class="botao2">Deletar</a></td></tr>';
								//echo '<td><a href=""><img src="img/alter.png" style="width: 30px" alt="Alterar"></a></td>';
								//echo '<td><a href=""><img src="img/excluir.png" style="width: 50px" alt="Alterar"></a></td></tr>';
								//<img src="img/alter.png" style="width: 15px" alt="Alterar">
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