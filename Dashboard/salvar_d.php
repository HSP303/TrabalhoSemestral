<?php
    require_once("/opt/lampp/htdocs/Trabalho_Semestral/public/database.php");

    function cadastrarDispositivo(&$dbconn){
        if($dbconn){
            $dados_insert = [$_POST["nome"], $_POST["sit"], $_POST["setor"]];

            $query = pg_query_params($dbconn, "insert into dispositivos (nome_dispositivo, status_dispositivo, id_setor) values
            ($1, $2, $3)", $dados_insert);
        }
    }

    function alterarDispositivo(&$dbconn){
        if($dbconn){
            $dados_update = [$_POST["nome"], $_POST["sit"], $_POST["setor"], $_POST["id_dispositivo"]];

            $query = pg_query_params($dbconn, "UPDATE DISPOSITIVOS SET NOME_DISPOSITIVO = $1, STATUS_DISPOSITIVO = $2, ID_SETOR = $3 WHERE ID_DISPOSITIVO = $4", $dados_update);
        }
    }


    conectaBanco($dbconn);
    if($_POST["id_dispositivo"] <> null){
        alterarDispositivo($dbconn);
    } else {
        echo "Id do dispositivo = " . $_POST["id_dispositivo"] ;
        cadastrarDispositivo($dbconn);
    }

    header("location: dispositivo.php"); 
?>