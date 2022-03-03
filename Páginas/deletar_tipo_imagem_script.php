<?php
 include('protect.php');
 include('conexao.php');
  ?>
<!doctype html>
<html lang="pt-br">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Exclusão do Tipo de Imagem</title>

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

              $id =  $_POST['id'];
              $login = clear($conn, $_POST['login']);
              $senha = clear($conn, md5($_POST['senha']));

              $sql_code = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";
              $sql_query = $mysqli->query($sql_code) or 
              die("Falha na execusão do codigo SQL: " . $mysqli->error);

              $quantidade = $sql_query->num_rows;

              if ($quantidade == 1)
              {

                 $sql = "DELETE FROM tipoimagem WHERE idtipoimagem = '$id';";

                 if(mysqli_query($conn, $sql)){
               
                    echo '<script type="text/javascript">','cadastro("Tipo da Imagem Excluído com Sucesso!");','</script>';
                    echo '<meta http-equiv="refresh" content=0;url="tipo_imagem.php">';
                  }
                  else 
                  {
                    echo '<script type="text/javascript">','cadastro("Não foi Possivel deletar o Tipo da Imagem: Verifique se há Imagens cadastradas com esse tipo");','</script>';
                    echo '<meta http-equiv="refresh" content=0;url="tipo_imagem.php">';
                    die($mysqli->error);
                  }

              }

                else
              {
                  echo "<script>document.getElementById('usererro').innerText='Usuário incorreto!';</script>";
                  echo "<script>document.getElementById('senhaerro').innerText='Senha incorreta!';</script>";
              }

            ?>

         </div>
       </div>
    </div>
  </body>
</html>