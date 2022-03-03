<?php
    include('protect.php');
	include('conexao.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Dados do Usuário</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Dados do Usuário</h2>                 
            </div>
        </header>

		<nav>
			<a href="painel.php">VOLTAR</a>
		</nav>

        <nav>
			<a href="alterar_usuario.php">ALTERAR DADOS</a>
            <a href="deletar_usuario.php">DELETAR DADOS</a>
		</nav>
		<section>
			<article>
                <p>
			    	<table border="1">
				    	<thead>
						    <tr>
                                <td>ID</td>
						        <td>Nome Completo</td>
						        <td>Data de Cadastro</td>
                                <td>Perfil</td>
                                <td>Login</td>
						    </tr>
						</thead>
				    	<?php
                            $id = $_SESSION['id'];
                            $sql_code = "CALL dados_usuario('$id');";
                            $dados = mysqli_query ($mysqli, $sql_code);
                
                            while($linha = mysqli_fetch_assoc($dados))
                            {
                                $idusuario = $linha['idusuario'];
                                $nome = $linha['nomeCompletoUsuario'];
                                $data = $linha['dataCadastro'];
                                $perfil = $linha['descricao'];
                                $login = $linha['login'];

                                echo "<tr><td>" . $idusuario ."</td>";
                                echo "<td>" . $nome ."</td>";
                                echo "<td>" . $data ."</td>";
                                echo "<td>" . $perfil ."</td>";
								echo "<td>" . $login ."</td></tr>";
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