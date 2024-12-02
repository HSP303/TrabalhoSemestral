<?php
    require_once("/opt/lampp/htdocs/Trabalho_Semestral/public/database.php");

    function cadastrarSetor(&$dbconn){
        if($dbconn){
            $dados_insert = [$_POST["nome"], $_POST["sit"]];

            $query = pg_query_params($dbconn, "insert into setores (nome_setor, sit_setor) values
            ($1, $2)", $dados_insert);
        }
    }

    function alterarSetor(&$dbconn){
        if($dbconn){
            $dados_update = [$_POST["nome"], $_POST["sit"], $_POST["id_setor"]];

            $query = pg_query_params($dbconn, "UPDATE SETORES SET NOME_SETOR = $1, SIT_SETOR = $2 WHERE ID_SETOR = $3", $dados_update);
        }
    }


    conectaBanco($dbconn);
    if($_POST["id_setor"] <> null){
        alterarSetor($dbconn);
    } else {
        echo "Id do dispositivo = " . $_POST["id_setor"] ;
        cadastrarSetor($dbconn);
    }

    header("location: setor.php"); 
?>