<?php
 include('protect.php');
 include('conexao.php');
?>
<!doctype html>
<html lang="pt-br">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mensagem</title>

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

              $planta = clear($conn, $_POST['planta']);
              $descricao = clear($conn, $_POST['descricao']);
              $id = $_SESSION['id'];

              $sql = "INSERT INTO tabuleiro (plantaTabuleiro,descricao,dataCriacao,usuarioid)
                      VALUES ('$planta','$descricao', current_date(),'$id');";

              if(mysqli_query($conn, $sql)){
               
                 echo '<script type="text/javascript">','cadastro("Tabuleiro Cadastrado com Sucesso!");','</script>';
                echo '<meta http-equiv="refresh" content=0;url="tabuleiro.php">';
              }
              else
                  echo '<script type="text/javascript">','cadastro("Tabuleiro não foi Cadastrado!");','</script>';
                die($mysqli->error);
            ?>

         </div>
       </div>
    </div>

  </body>
</html>