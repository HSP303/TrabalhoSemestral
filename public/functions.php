<?php
    require_once("database.php");

    conectaBanco($dbconn);    //$dbconn = pg_connect("host=localhost port=5432 dbname=TrabalhoSemestral user=postgres password=postgres");
    function pegarPergunta(&$dbconn){
        if ($dbconn){
            $asw_params = [$_GET["id_pergunta"], "ativa"];

            $perguntas = pg_query_params($dbconn, "SELECT * FROM PERGUNTAS WHERE ORDEM = $1 AND STATUS_PERGUNTA = $2 ORDER BY ORDEM", $asw_params);
            if ($perguntas){
                $perguntas = pg_fetch_assoc($perguntas);
                $perguntas_json = json_encode($perguntas);
                echo $perguntas_json;
            }
        }
    }
    function enviarRespostas(&$dbconn){
        if($dbconn){
            $dados_insert = [$_GET["setor"], $_GET["dispositivo"], $_GET["respostas"], $_GET["txtopc"]];

            $query = pg_query_params($dbconn, "insert into avaliacoes (id_setor, id_dispositivo, resposta, feedback_textual, data_hora_avaliacao) values
            ($1, $2, $3, $4, CURRENT_DATE)", $dados_insert);
        }
    }

    function pegarSetor($dispositivo){
        conectaBanco($dbconn); 
        
        $params = [$dispositivo];

        $query = pg_query_params($dbconn, "SELECT ID_SETOR FROM DISPOSITIVOS WHERE ID_DISPOSITIVO = $1", $params);

        if ($query){
            $query = pg_fetch_assoc($query);
            //$query = json_encode($query);
            return $query["id_setor"];
        }
    }


    if ($_GET["operacao"] == 1){
        pegarPergunta($dbconn);
    } elseif($_GET["operacao"] == 2) {
        enviarRespostas($dbconn);
    }
?>
