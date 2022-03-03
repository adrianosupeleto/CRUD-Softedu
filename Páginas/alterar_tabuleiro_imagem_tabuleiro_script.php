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
            
              $id = clear($conn,$_POST['id']);
              $idtabuleiro = clear($conn, $_POST['idtabuleiro']);
              $idimagem = clear($conn, $_POST['idimagem']);
              $posicao = clear($conn, $_POST['posicao']);

              $sql = "UPDATE tabuleiro_imagenstabuleiro SET tabuleiroID = '$idtabuleiro',
                      imagenstabuleiroID  = '$idimagem',
                      posicaoTabuleiro = '$posicao'
                      WHERE idtabuleiro_imagenstabuleiro = '$id';";

              
              if(mysqli_query($conn, $sql)){
               
                 echo '<script type="text/javascript">','cadastro("Cenário Alterado com Sucesso!");','</script>';
                echo '<meta http-equiv="refresh" content=0;url="tabuleiro_imagem_tabuleiro.php">';
              }
              else
                  echo '<script type="text/javascript">','cadastro("Cenário não foi Alterado!");','</script>';
                die($mysqli->error);
          
            ?>

            <br>
            <a href="painel.php" class="btn btn-primary">Voltar</a>

         </div>
       </div>
    </div>
  </body>
</html>