<?php
 include('protect.php');
 include('conexao.php');
?>
<!doctype html>
<html lang="pt-br">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Exclusão de Cenário</title>

    <script>
      function cadastro(txt)
      {
        alert(txt);
      }
  </script>
  </head>
  <body>
      <div class="container">
          <div class="row">
              
            <?php

                $id = $_POST['id'];
                $login = clear($conn, $_POST['login']);
                $senha = clear($conn, md5($_POST['senha']));

                $sql_code = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";
                $sql_query = $mysqli->query($sql_code) or 
                die("Falha na execusão do codigo SQL: " . $mysqli->error);

                $quantidade = $sql_query->num_rows;

              if ($quantidade == 1){

                 $sql = "DELETE FROM tabuleiro_imagenstabuleiro WHERE idtabuleiro_imagenstabuleiro = '$id';";

                 if(mysqli_query($conn, $sql)){
               
                    echo '<script type="text/javascript">','cadastro("Cenário Excluído com Sucesso!");','</script>';
                    echo '<meta http-equiv="refresh" content=0;url="tabuleiro_imagem_tabuleiro.php">';
                  }
                    else
                      echo '<script type="text/javascript">','cadastro("Cenário não foi Excluído!");','</script>';
                      die($mysqli->error);
              }
              else{
                echo '<script type="text/javascript">','cadastro("Você não possui acesso! Verifique os dados de login");','</script>';
                      die($mysqli->error);
              }
            ?>
         </div>
       </div>
    </div>
  </body>
</html>