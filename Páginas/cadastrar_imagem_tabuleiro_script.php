<?php
 include('protect.php');
 include('conexao.php');
?>
<!doctype html>
<html lang="pt-br">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">

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
              $imagem = $_FILES['imagem'];
              $nome_foto = mover_foto($imagem);

              if ($nome_foto == 0) {
                $nome_foto = null;
              }

              $sql = "INSERT INTO imagenstabuleiro (urlimagem,tipoimagemid)
                      VALUES ('$nome_foto','$id');";

              if(mysqli_query($conn, $sql)){

                   echo '<script type="text/javascript">','cadastro("Imagem Cadastrada com Sucesso!");','</script>';
                  echo '<meta http-equiv="refresh" content=0;url="imagem_tabuleiro.php">';
              }
              else
                  echo '<script type="text/javascript">','cadastro("Imagem não foi Cadastrada!");','</script>';
                die($mysqli->error);
            ?>
         </div>
       </div>
    </div>
  </body>
</html>