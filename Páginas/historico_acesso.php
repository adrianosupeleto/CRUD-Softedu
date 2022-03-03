<?php
    include('protect.php');
	include('conexao.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Histórico</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Histórico de Acessos</h2>                 
            </div>
        </header>

		<nav>
			<a href="painel.php">VOLTAR</a>
		</nav>
		<section>
			<article>
                <p>
			    	<table border="1">
				    	<thead>
						    <tr>
						        <td>Data e Hora</td>
						        <td>Tempo de Acesso</td>
						    </tr>
						</thead>
				    	<?php
                            $id = $_SESSION['id'];
                            $sql_code = "SELECT * FROM softedu.historicoacessos WHERE idusuarioid =  '$id';";    
                            $dados = mysqli_query ($mysqli, $sql_code);
                
                            while($linha = mysqli_fetch_assoc($dados))
                            {
                                $data = $linha['hora_data'];
                                $tempo = $linha['tempoacesso'];

                                echo "<tr><td>" . $data ."</td>";
								echo "<td>" . $tempo ."</td></tr>";
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