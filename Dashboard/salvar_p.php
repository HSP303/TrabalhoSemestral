<?php
    require_once("/opt/lampp/htdocs/Trabalho_Semestral/public/database.php");

    function cadastrarPergunta(&$dbconn){
        if($dbconn){
            $dados_insert = [$_POST["pergunta"], $_POST["sit"], $_POST["ordem"], $_POST["inp"]];

            $query = pg_query_params($dbconn, "insert into perguntas (texto_pergunta, status_pergunta, ordem, tipo_input) values
            ($1, $2, $3, $4)", $dados_insert);
        }
    }

    function alterarPergunta(&$dbconn){
        $dados_update = [$_POST["pergunta"], $_POST["sit"], $_POST["ordem"], $_POST["inp"], $_POST["id_pergunta"]];

        $query = pg_query_params($dbconn, "UPDATE PERGUNTAS SET TEXTO_PERGUNTA = $1, STATUS_PERGUNTA = $2, ORDEM = $3, TIPO_INPUT = $4
        WHERE ID_PERGUNTA = $5", $dados_update);
    }


    conectaBanco($dbconn);
    if ($_POST["id_pergunta"] <> null){
        alterarPergunta($dbconn);
    } else {
        cadastrarPergunta($dbconn);
    }

    header("location: pergunta.php"); 
?>