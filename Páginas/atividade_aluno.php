<?php
    include('protect.php');
	include('conexao.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tabuleiros</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Painel das Avaliações</h2>                 
            </div>
        </header>

		<nav>
            <a href="painel.php">VOLTAR</a>
		</nav>
		<nav>
			<a href="cadastrar_atividade_aluno.php">CADASTRAR AVALIAÇÃO</a>
		</nav>
		<section>
			<article>
                <p>
			    	<table border="1">
				    	<thead>
						    <tr>
						        <td>Descrição</td>
						        <td>Usuário</td>
                                <td>Início</td>
                                <td>Status</td>
								<td>Funções</td>
						    </tr>
						</thead>
                        <?php
                            $sql_code = "SELECT * FROM atividades_alunos;";
                            $dados = mysqli_query ($mysqli, $sql_code);
                
                            while($linha = mysqli_fetch_assoc($dados))
                            {
                                $usuario = $linha['nomeusuario'];
                                $descricao = $linha['descricaoatividade'];
                                $inicio = $linha['datainicio'];
                                $status = $linha['status'];
                                $idatividade_aluno = $linha['idatividade_aluno'];


                                echo "<tr><td>" . $descricao ."</td>";
                                echo "<td>" . $usuario ."</td>";
                                echo "<td>" . $inicio ."</td>";
                                echo "<td>" . $status ."</td>";
                                echo '<td><a href="dados_atividade_aluno.php?id=' . $idatividade_aluno . '" class="botao0">Visualizar</a></td></tr>';
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