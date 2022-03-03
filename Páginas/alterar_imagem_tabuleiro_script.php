<?php
 include('protect.php');
 include('conexao.php');
?>
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Alteração de Imagens para Tabuleiro</title>

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
              $tipo = clear($conn,$_POST['tipo']);
              
              $imagem = $_FILES['imagem'];
              $nome_foto = mover_foto($imagem);

              if ($nome_foto == 0) {
                $nome_foto = null;
              }

              $sql = "UPDATE imagenstabuleiro SET urlImagem = '$nome_foto', tipoimagemid = '$tipo'
              WHERE idimagenstabuleiro = '$id';";

              
              if(mysqli_query($conn, $sql)){
               
                 echo '<script type="text/javascript">','cadastro("Imagem Alterada com Sucesso!");','</script>';
                echo '<meta http-equiv="refresh" content=0;url="imagem_tabuleiro.php">';
              }
              else{
                  echo '<script type="text/javascript">','cadastro("Imagem não foi Alterada!");','</script>';
                die($mysqli->error);
              }
            ?>
         </div>
       </div>
    </div>
  </body>
</html>