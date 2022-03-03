<?php
 include('protect.php');
 include('conexao.php');
?>
<!doctype html>
<html lang="pt-br">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Exclusão de Tabuleiro</title>

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

              $idusuariocriador = $_POST['idusuariocriador'];
              $idtabuleiro = $_POST['idtabuleiro'];
              $idlogado = $_SESSION['id'];
              $login = clear($conn, $_POST['login']);
              $senha = clear($conn, md5($_POST['senha']));

              if($idusuariocriador == $idlogado){

                $sql_code = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";
                $sql_query = $mysqli->query($sql_code) or 
                die("Falha na execusão do codigo SQL: " . $mysqli->error);

                $quantidade = $sql_query->num_rows;

              if ($quantidade == 1)
              {

                 $sql = "DELETE FROM tabuleiro WHERE idtabuleiro = '$idtabuleiro';";

                 if(mysqli_query($conn, $sql)){
               
                    echo '<script type="text/javascript">','cadastro("Tabuleiro Excluído com Sucesso!");','</script>';
                    echo '<meta http-equiv="refresh" content=0;url="tabuleiro.php">';
                  }
                    else{
                      echo '<script type="text/javascript">','cadastro("Tabuleiro não foi Excluído! Verifique se há Cenários ou Avalições cadastrados com esse tabuleiro!");','</script>';
                    
                    echo '<meta http-equiv="refresh" content=0;url="dados_tabuleiro.php">';
                      die($mysqli->error);
                  }
              }
            }
              else{
                echo '<script type="text/javascript">','cadastro("Você não possui acesso!");','</script>';
                      die($mysqli->error);
              }
            ?>

         </div>
       </div>
    </div>

  </body>
</html>