<?php
 include('protect.php');
 include('conexao.php');
?>
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alteração Tipo de Imagem</title>

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

              $id = $_SESSION['tipo_imagem'];
              $tipo = $_POST['tipo'];
              $descricao = $_POST['descricao'];

                $sql = "UPDATE tipoimagem SET tipoimagem = '$tipo', descricao = '$descricao'
                WHERE idtipoimagem = $id;";

              if(mysqli_query($conn, $sql)){
               
                 echo '<script type="text/javascript">','cadastro("Tipo Imagem Alterado com Sucesso!");','</script>';
                echo '<meta http-equiv="refresh" content=0;url="tipo_imagem.php">';
              }
              else
                  echo '<script type="text/javascript">','cadastro("Tipo Imagem não foi Alterado!");','</script>';
                die($mysqli->error);
            ?>
         </div>
       </div>
    </div>
  </body>
</html>