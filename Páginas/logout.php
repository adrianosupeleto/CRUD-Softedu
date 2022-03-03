<?php
    include('conexao.php');
    include('protect.php');

    if(!isset($_SESSION)) 
    {
        session_start();
    }

    $entrada = $_SESSION['entrada'];
    $saida = date('Y:m:d:H:i:s');
    
    $hora1 = explode(":",$entrada);
    $hora2 = explode(":",$saida);
    
    if($hora2[5] >= $hora1[5])
    {
        $secs_ponto = $hora2[5] - $hora1[5];
    }
    else
    {
        $hora2[4] = $hora2[4] - 1;
        $hora2[5] = $hora2[5] + 60;

        $secs_ponto = $hora2[5] - $hora1[5];
    }

    if($hora2[4] >= $hora1[4])
    {
        $min_ponto = $hora2[4] - $hora1[4];
    }
    else
    {
        $hora2[3] = $hora2[3] - 1;
        $hora2[4] = $hora2[4] + 60;
        
        $min_ponto = $hora2[4] - $hora1[4];
    }

    if($hora2[3] >= $hora1[3])
    {
        $hora_ponto = $hora2[3] - $hora1[3];
    }
    else
    {
        $hora2[2] = $hora2[2] - 1;
        $hora2[3] = $hora2[3] + 24;
        
        $hora_ponto = $hora2[3] - $hora1[3];
    }

    if($hora2[2] >= $hora1[2])
    {
        $dia_ponto = $hora2[2] - $hora1[2];
    }
    else
    {
        $hora2[1] = $hora2[1] - 1;
        $hora2[2] = $hora2[2] + 31;
        
        $dia_ponto = $hora2[2] - $hora1[2];
    }

    if($hora2[1] >= $hora1[1])
    {
        $mes_ponto = $hora2[1] - $hora1[1];
    }
    else
    {
        $hora2[0] = $hora2[0] - 1;
        $hora2[1] = $hora2[1] + 12;
        
        $mes_ponto = $hora2[1] - $hora1[1];
    }

    if($hora2[0] >= $hora1[0])
    {
        $ano_ponto = $hora2[0] - $hora1[0];
    }

    $hora_ponto = $hora_ponto + ($dia_ponto * 24) + ($mes_ponto * 30 * 24) + ($ano_ponto * 12 * 30 * 24);

    $tempo = $hora_ponto.":".$min_ponto.":".$secs_ponto;
    
    $id = $_SESSION['id'];
    $data = $_SESSION['data'];

    $sql_code = "INSERT INTO softedu.historicoacessos(idusuarioid, hora_data, tempoacesso) VALUES('$id', '$data', '$tempo');";    
    $mysqli->query($sql_code);
  
    session_destroy();

    header("Location: index.php");
?>