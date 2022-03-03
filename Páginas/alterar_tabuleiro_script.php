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
              $id = clear($conn, $_POST['id']);
              $planta = clear($conn, $_POST['planta']);
              $descricao = clear($conn, $_POST['descricao']);

             $sql = "UPDATE tabuleiro SET plantaTabuleiro = '$planta', descricao = '$descricao'
                     WHERE idtabuleiro = '$id';";

              if(mysqli_query($conn, $sql)){
               
                 echo '<script type="text/javascript">','cadastro("Tabuleiro Alterado com Sucesso!");','</script>';
                echo '<meta http-equiv="refresh" content=0;url="tabuleiro.php">';
              }
              else
                  echo '<script type="text/javascript">','cadastro("Tabuleiro não foi Alterado!");','</script>';
                die($mysqli->error);
            ?>

         </div>
       </div>
    </div>

  </body>
</html>