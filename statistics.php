<?php 
    require_once('db.class.php');
    $db = new db();
    $conexao = $db->conecta_mysql();
    $sql_acertos = " SELECT COUNT(*) as acertos FROM progresso WHERE status = 1 ";
    $sql_erros = " SELECT COUNT(*) as erros FROM progresso WHERE status = 0 ";
    $acertos = mysqli_fetch_array(mysqli_query($conexao, $sql_acertos), MYSQLI_ASSOC);
    $erros = mysqli_fetch_array(mysqli_query($conexao, $sql_erros), MYSQLI_ASSOC);
    
    $sql_totalZerado = " SELECT COUNT(*) FROM (SELECT idPlayer i, COUNT(status) c FROM progresso WHERE status = 1 GROUP BY idPlayer ORDER BY c DESC) t WHERE c = 71 ";
    $sql_MenosAcertos = " SELECT idChampion i, COUNT(idChampion) c FROM progresso WHERE status = 0 GROUP BY idChampion ORDER BY c DESC LIMIT 1";
    $sql_MaisAcertos = " SELECT idChampion i, COUNT(idChampion) c FROM progresso WHERE status = 1 GROUP BY idChampion ORDER BY c DESC LIMIT 1";
    
    $sql_MaisAcertos = mysqli_fetch_array(mysqli_query($conexao, $sql_MaisAcertos));
    $sql_MenosAcertos = mysqli_fetch_array(mysqli_query($conexao, $sql_MenosAcertos));
    
    $MaisAcertos = $sql_MaisAcertos['i'];
    $MenosAcertos = $sql_MenosAcertos['i'];

    $sql_MaisAcertosInfo = " SELECT name n FROM champions WHERE id = $MaisAcertos ";
    $sql_MenosAcertosInfo = " SELECT name n FROM champions WHERE id = $MenosAcertos ";
    
    $MaisAcertosInfo = mysqli_fetch_array(mysqli_query($conexao, $sql_MaisAcertosInfo));
    $MenosAcertosInfo = mysqli_fetch_array(mysqli_query($conexao, $sql_MenosAcertosInfo));
    
    $sql_MaisAcertosTotal = " SELECT COUNT(*) c FROM progresso WHERE idChampion = $MaisAcertos ";
    $sql_MaisAcertosAcertos = " SELECT COUNT(*) c FROM progresso WHERE idChampion = $MaisAcertos and status = 1";
    $sql_MenosAcertosTotal = " SELECT COUNT(*) c FROM progresso WHERE idChampion = $MenosAcertos ";
    $sql_MenosAcertosAcertos = " SELECT COUNT(*) c FROM progresso WHERE idChampion = $MaisAcertos and status = 1";
    
    $MaisAcertosTotal = mysqli_fetch_array(mysqli_query($conexao, $sql_MaisAcertosTotal))['c'];
    $MaisAcertosAcertos = mysqli_fetch_array(mysqli_query($conexao, $sql_MaisAcertosAcertos))['c'];
    $MenosAcertosTotal = mysqli_fetch_array(mysqli_query($conexao, $sql_MenosAcertosTotal))['c'];
    $MenosAcertosAcertos = mysqli_fetch_array(mysqli_query($conexao, $sql_MenosAcertosAcertos))['c'];

    $porcentagemMaisAcertos = round(($MaisAcertosAcertos/$MaisAcertosTotal)*100, 1);
    $porcentagemMenosAcertos = round(($MenosAcertosAcertos/$MenosAcertosTotal)*100, 1);

    $arrayFinal = array(
    "acertos"=> $acertos['acertos'], 
    "erros" => $erros['erros'], 
    "nomeMaisAcertos"=> $MaisAcertosInfo['n'], 
    "porcentagemMaisAcertos" => $porcentagemMaisAcertos.'%', 
    "nomeMenosAcertos" => $MenosAcertosInfo['n'], 
    "porcentagemMenosAcertos"=> $porcentagemMenosAcertos.'%');

    echo json_encode($arrayFinal);
?>

