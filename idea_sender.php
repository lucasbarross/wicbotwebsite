<?php
    
    require_once('db.class.php');
    $db = new db();
    $conexao = $db->conecta_mysql();

    $representacao = $_POST['representacao'];
    $champion = strtolower($_POST['nome']);
    
    if($representacao === "" || $champion == ""){
        echo 'Invalid champion name.';
    }
    
    if(!is_null(mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM sugestoes WHERE champion = '$champion' AND representacao = '$representacao'")))){
        echo 'This idea has already been submitted.';
        return;
    }  

    $checkChampion = explode(" ",$champion);
    for($i = 0; $i < count($checkChampion); $i++){
        $checkChampion[$i] = ucfirst($checkChampion[$i]);
    }
    $checkChampion = implode("", $checkChampion);

    if(@fopen("http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/$checkChampion.png",'r')){
        if(substr($representacao, 0, 1) === ':' && substr($representacao, -1) === ':'){
            $sql = "insert into sugestoes(champion,representacao) values('$champion','$representacao')";
            mysqli_query($conexao, $sql);
            echo 'Thanks! Your idea has been submitted.';
        } else{
            echo 'Invalid representation.';
        }
    } else {
        echo 'Invalid champion name.';
    }

?>