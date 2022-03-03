<?php
    include('protect.php');
	include('conexao.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Painel</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
        <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Painel</h2>                 
            </div>
        </header>

		<nav>
			<a href="atividade.php">ATIVIDADES</a>
			<a href="tabuleiro.php">TABULEIROS</a>
			<a href="imagem_tabuleiro.php">IMAGENS</a>
			<a href="tabuleiro_imagem_tabuleiro.php">CENÁRIOS</a>
            <a href="atividade_aluno.php">AVALIAÇÃO</a>
            <a href="logout.php">SAIR</a>
		</nav>
		<nav>
			<a href="dados_usuario.php">DADOS DO USUÁRIO</a>
            <a href="historico_acesso.php">HISTÓRICO DE ACESSOS</a>
		</nav>
		<section>
			<article>
			    <label>Bem vindo ao Painel, <?php echo $_SESSION['nome'];?>.</label>
			</article>
		</section>
        <footer>
            &copy; 2020 - <?php echo date('Y'); ?> - Daniel Rovetta - Adriano Supeleto<br>
		</footer> 
	</body>
</html>