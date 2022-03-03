<?php
 include('conexao.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Cadastro Usuário</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
        <script>
            function cadastro(txt)
            {
              alert(txt);
            }
        </script>
	</head>
	<body>
    <header class="flex">
            <div>
                <h1>SoftEdu</h1>
                <h2>Página de Cadastro do Usuário</h2>                 
            </div>
        </header>

        <nav>
			<a href="login.php">VOLTAR</a>
		</nav>

		<div class="formulario">
			<form action="cadastro_usuario.php" method="post">
				<fieldset >
					<legend><b>NOVO USUÁRIO</b></legend>				
                    <p>
                        <label><b>Nome Completo:</b></label><br>
                        <input type="text" name="nome" placeholder="Nome" required><br>
                        <b><label id="nomeerro"></label></b>
                    </p>

                    <p>
    					<label><b>Nome de Usuário:</b></label><br>
						<input type="text" name="usuario" placeholder="Login" required><br>
                        <b><label id="useraerro"></label></b>
					</p>

                    <p>
						<label><b>Perfil do Usuario:</b></label><br>
						<select type="text" name="perfil" placeholder="Perfil" required>
                            <?php
                                
                                $sql_code = "SELECT * FROM softedu.perfilusuario;";    
                                $dados = mysqli_query ($mysqli, $sql_code);
                    
                                while($linha = mysqli_fetch_assoc($dados))
                                {
                                    $id = $linha['idPerfilUsuario'];
                                    $descricao = $linha['descricao'];

                                    echo "<option value=" . $id . ">$descricao</option>";
                                }
                            ?> 
						</select>
					</p>

                    <p>
						<label><b>Senha:</b></label><br>
						<input type="password" name="senha" placeholder="Senha" required><br>
                        <b><label id="senhaerro"></label></b>
					</p>

				</fieldset>
				<div>
					<input type="submit" name="enviar" value="CADASTRAR" class="botao"><br>
				</div>
			</form>
		</div>
		<footer>
            &copy; 2020 - <?php echo date('Y'); ?> - Daniel Rovetta - Adriano Supeleto<br>
		</footer> 
	</body>
</html>


<?php
    

    if(isset($_POST['nome']) || isset($_POST['usuario']) || isset($_POST['senha']))
    {
        if (strlen($_POST['nome']) == 0 )
        {
            echo "<script>document.getElementById('nomeerro').innerText='Insira o Nome!';</script>";
        }
        else if (strlen($_POST['usuario']) == 0 )
        {
            echo "<script>document.getElementById('usererro').innerText='Insira o Usuário!';</script>";
        }
        else if (strlen($_POST['senha']) == 0 )
        {
            echo "<script>document.getElementById('senhaerro').innerText='Insira a Senha!';</script>";
        }
        else
        {   
            $nome    = $mysqli->real_escape_string($_POST['nome']);
            $usuario = $mysqli->real_escape_string($_POST['usuario']);
            $senha   = $mysqli->real_escape_string(md5($_POST['senha']));
            $perfil   = $mysqli->real_escape_string($_POST['perfil']);

            $sql_code = "INSERT INTO softedu.usuario( nomeCompletoUsuario, senha, login, dataCadastro, perfilUsuarioID) VALUES('$nome','$senha','$usuario', current_date(), $perfil);";
            
            if ($mysqli->query($sql_code)) 
            {
                echo '<script type="text/javascript">','cadastro("Usuário Cadastrado com Sucesso");','</script>';
                echo '<meta http-equiv="refresh" content=0;url="login.php">';
            }
            else 
            {
                echo '<script type="text/javascript">','cadastro("Usuário não foi Cadastrado: Nome de Usuário já existente!");','</script>';
                die($mysqli->error);
            }
        }
    }
?>