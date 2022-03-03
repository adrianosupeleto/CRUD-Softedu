<?php
   include('protect.php');
   include('conexao.php');

    $id = $_SESSION['id'];
    $sql_code = "CALL dados_usuario('$id');";
    $dados = mysqli_query($mysqli, $sql_code);

    while($linha = mysqli_fetch_assoc($dados))
    {
        $idusuario = $linha['idusuario'];
        $nome = $linha['nomeCompletoUsuario'];
        $data = $linha['dataCadastro'];
        $perfil = $linha['descricao'];
        $login = $linha['login'];
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Alterar Dados</title>
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
                <h2>Página de Alteração de Dados</h2>                 
            </div>
        </header>

        <nav>
			<a href="dados_usuario.php">VOLTAR</a>
		</nav>

		<div class="formulario">
			<form action="alterar_usuario.php" method="post">
				<fieldset class="flex">
					<legend><b>ALTERAR DADOS</b></legend>				
                    <p>
                        <label><b>Nome Completo:</b></label><br>
                        <input type="text" name="nome" value="<?php echo $nome ?>" required><br>
                        <b><label id="nomeerro"></label></b>
                    </p>

                    <p>
    					<label><b>Nome de Usuário:</b></label><br>
						<input type="text" name="usuario" value="<?php echo $login ?>" readonly><br>
                        <b><label>Não pode ser Alterado!</label></b>
					</p>

                    <p>
						<label><b>Perfil do Usuario:</b></label><br>
						<select type="text" name="perfil" required>
                            <?php
                                $sql_code = "SELECT * FROM softedu.perfilusuario;";    
                                $dados = mysqli_query($conn, $sql_code);
                    
                                while($linha = mysqli_fetch_assoc($dados))
                                {
                                    $id = $linha['idPerfilUsuario'];
                                    $descricao = $linha['descricao'];

                                    if($descricao == $perfil){
                                        echo "<option selected='selected' value=" . $id . ">$descricao</option>";
                                    }
                                    else{
                                        echo "<option value=" . $id . ">$descricao</option>";

                                    }

                                }
                            ?> 
						</select>
					</p>

                    <p>
						<label><b>Senha:</b></label><br>
						<input type="password" name="senha" placeholder="Senha" required><br>
                        <b><label id="senhaerro"></label></b>
					</p>

                    <p>
						<label><b>Nova Senha:</b></label><br>
						<input type="password" name="novasenha" placeholder="Noma Senha" required><br>
                        <b><label id="novasenhaerro"></label></b>
					</p>

				</fieldset>
				<div>
					<input type="submit" name="enviar" value="CONFIRMAR ALTERAÇÃO" class="botao"><br>
				</div>
			</form>
		</div>
		<footer>
            &copy; 2020 - <?php echo date('Y'); ?> - Daniel Rovetta - Adriano Supeleto<br>
		</footer> 
	</body>
</html>


<?php

    if(isset($_POST['nome']) || isset($_POST['senha']) || isset($_POST['novasenha'])  )
    {
        if (strlen($_POST['nome']) == 0 )
        {
            echo "<script>document.getElementById('nomeerro').innerText='Insira o Nome!';</script>";
        }
        else if (strlen($_POST['senha']) == 0 )
        {
            echo "<script>document.getElementById('senhaerro').innerText='Insira a Senha!';</script>";
        }
        else if (strlen($_POST['novasenha']) == 0 )
        {
            echo "<script>document.getElementById('novasenhaerro').innerText='Insira a Nova Senha!';</script>";
        }
        else
        {   

            $usuario = $conn->real_escape_string($_POST['usuario']);
            $senha   = $conn->real_escape_string($_POST['senha']);

            $sql_code = "SELECT * FROM usuario WHERE login = '$usuario' AND senha = '$senha'";
            $sql_query = $conn->query($sql_code) or die("Falha na execusão do codigo SQL: " . $conn->error);

            $quantidade = $sql_query->num_rows;

            if ($quantidade == 1)
            {
                $id = $_SESSION['id'];
                $nome = $conn->real_escape_string($_POST['nome']);
                $novasenha = $conn->real_escape_string($_POST['novasenha']);
                $perfil = $conn->real_escape_string($_POST['perfil']);
    
                $sql_code1 = "UPDATE softedu.usuario SET nomeCompletoUsuario = '$nome' WHERE idusuario = $id;";
                $sql_code2 = "UPDATE softedu.usuario SET perfilUsuarioID = '$perfil' WHERE idusuario = $id;";
                $sql_code3 = "UPDATE softedu.usuario SET senha = '$novasenha' WHERE idusuario = $id;";

                
                if ($conn->query($sql_code1)) 
                {
                    if ($conn->query($sql_code2)) 
                    {
                        if ($conn->query($sql_code3)) 
                        {
                            echo '<script type="text/javascript">','cadastro("Dados Alterados com Sucesso");','</script>';
                            //header("Location: dados_usuario.php");
                            echo '<meta http-equiv="refresh" content=0;url="dados_usuario.php">';
                        }
                        else 
                        {
                            echo '<script type="text/javascript">','cadastro("Não foi Possivel Alterar os Dados");','</script>';
                            die($conn->error);
                        }
                    }
                    else 
                    {
                        echo '<script type="text/javascript">','cadastro("Não foi Possivel Alterar os Dados");','</script>';
                        die($conn->error);
                    }
                }
                else 
                {
                    echo '<script type="text/javascript">','cadastro("Não foi Possivel Alterar os Dados");','</script>';
                    die($conn->error);
                }

            }
            else
            {
                echo "<script>document.getElementById('senhaerro').innerText='Senha incorreta!';</script>";
            }
        }
    }
?>