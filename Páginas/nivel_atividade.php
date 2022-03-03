<?php
    include('protect.php');
	include('conexao.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Nível da Atividade</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Painel dos Níveis das Atividades</h2>                 
            </div>
        </header>

		<nav>
            <a href="atividade.php">VOLTAR</a>
		</nav>
		<nav>
			<a href="cadastrar_nivel_atividade.php">CADASTRAR NÍVEL DA ATIVIDADE</a>
		</nav>
		<section>
			<article>
                <p>
			    	<table border="1">
				    	<thead>
						    <tr>
						        <td>Descrição</td>
                                <td colspan="2">Funções</td>
						    </tr>
						</thead>
				    	<?php
                            $sql_code = "SELECT * FROM nivelatividade ;";
                            $dados = mysqli_query ($mysqli, $sql_code);
                
                            while($linha = mysqli_fetch_assoc($dados))
                            {
                                $idnivel = $linha['idnivelAtividade'];
                                $descricao = $linha['descricaoNivel'];

                                echo "<tr><td>" . $descricao ."</td>";
								echo '<td><a href="alterar_nivel_atividade.php?id=' . $idnivel . '" class="botao1">Alterar</a></td>';
								echo '<td><a href="deletar_nivel_atividade.php?id=' . $idnivel . '" class="botao2">Deletar</a></td></tr>';
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