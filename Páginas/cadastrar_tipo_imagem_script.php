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
          
              $tipo = clear($conn, $_POST['tipo']);
              $descricao = clear($conn, $_POST['descricao']);

              $sql = "INSERT INTO tipoimagem (tipoimagem,descricao)
                      VALUES ('$tipo', '$descricao');";

              if(mysqli_query($conn, $sql)){
               
                 echo '<script type="text/javascript">','cadastro("Tipo Imagem Cadastrado com Sucesso!");','</script>';
                echo '<meta http-equiv="refresh" content=0;url="tipo_imagem.php">';
              }
              else
                  echo '<script type="text/javascript">','cadastro("Tipo Imagem não foi Cadastrado!");','</script>';
                die($mysqli->error);
            ?>

         </div>
       </div>
    </div>

  </body>
</html>