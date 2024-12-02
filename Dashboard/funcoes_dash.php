<?php

    require_once("/opt/lampp/htdocs/Trabalho_Semestral/public/database.php");

    function contarAvaliacoes($id){
        conectaBanco($dbconn);
        $params = [$id];
    
        $perguntas = pg_query($dbconn, "SELECT COUNT(*) AS AVALIACOES FROM AVALIACOES");
        if ($perguntas){
            $perguntas = pg_fetch_assoc($perguntas);
            return $perguntas["avaliacoes"];
        } else {
            echo json_encode("Não encontrado");
        }
    }

    function contarAvaliacoesHoje($id){
        conectaBanco($dbconn);
        $params = [$id];
    
        $perguntas = pg_query($dbconn, "SELECT COUNT(*) AS AVALIACOES FROM AVALIACOES WHERE EXTRACT(DAY FROM DATA_HORA_AVALIACAO) = EXTRACT(DAY FROM CURRENT_DATE)");
        if ($perguntas){
            $perguntas = pg_fetch_assoc($perguntas);
            return $perguntas["avaliacoes"];
        } else {
            echo json_encode("Não encontrado");
        }
    }

    function contarAvaliacoesMes($id){
        conectaBanco($dbconn);
        $params = [$id];
    
        $perguntas = pg_query($dbconn, "SELECT COUNT(*) AS AVALIACOES FROM AVALIACOES WHERE EXTRACT(MONTH FROM DATA_HORA_AVALIACAO) = EXTRACT(MONTH FROM CURRENT_DATE)");
        if ($perguntas){
            $perguntas = pg_fetch_assoc($perguntas);
            return $perguntas["avaliacoes"];
        } else {
            echo json_encode("Não encontrado");
        }
    }

    function quantidadePerguntas(&$dbconn){
        $perguntas = pg_query($dbconn, "SELECT COUNT(*) AS QTD FROM PERGUNTAS WHERE STATUS_PERGUNTA = 'ativa'");
        if ($perguntas){
            $perguntas = pg_fetch_assoc($perguntas);
            $perguntas_json = json_encode($perguntas);
            echo $perguntas_json;
        } else {
            echo json_encode("Não encontrado");
        }
    }

    function calcularMedia(&$dbconn){
        $params = [$_GET["id"]];
        $response = [];
        $perguntas = pg_query($dbconn, "SELECT RESPOSTA AS MEDIA FROM AVALIACOES --WHERE ID_SETOR = $1");

        if ($perguntas){
            while($row = pg_fetch_assoc($perguntas)){
                $response[] = $row;
            }
            //$perguntas = pg_fetch_assoc($perguntas);
            $response_json = json_encode($response);
            echo $response_json;
        } else {
            echo json_encode("Não encontrado");
        }
    }

    function levarRespostas($id){

        conectaBanco($dbconn);
        $params = [$id];
        $response = [];
        $perguntas = pg_query($dbconn, "SELECT RESPOSTA, ID_SETOR FROM AVALIACOES ORDER BY ID_SETOR");

        if ($perguntas){
            while($row = pg_fetch_assoc($perguntas)){
                $response[] = $row;
            }
            //$response = $response[0];
            return json_encode($response);                                  //$response[0]["resposta"]; //explode(',', $response[0]["media"])[0];
        } else {
            return json_encode("Não encontrado");
        }
    }

    function contaAvaSetor($id){

        conectaBanco($dbconn);
        $params = [$id];
        $response = [];
        $perguntas = pg_query($dbconn, "SELECT COUNT(*) AS QTD, ID_SETOR FROM AVALIACOES GROUP BY 2 ORDER BY ID_SETOR");

        if ($perguntas){
            while($row = pg_fetch_assoc($perguntas)){
                $response[] = $row;
            }
            //$response = $response[0];
            return json_encode($response);                                  //$response[0]["resposta"]; //explode(',', $response[0]["media"])[0];
        } else {
            return json_encode("Não encontrado");
        }
    }

    function perguntasInativasAtivas(){

        conectaBanco($dbconn);

        $response = [];
        $perguntas = pg_query($dbconn, "SELECT SUM(CASE WHEN STATUS_PERGUNTA = 'ativa' THEN 1 ELSE 0 END) AS ATI, SUM(CASE WHEN STATUS_PERGUNTA = 'inativa' THEN 1 ELSE 0 END) AS INA FROM PERGUNTAS");

        if ($perguntas){
            while($row = pg_fetch_assoc($perguntas)){
                $response[] = $row;
            }
            //$response = $response[0];
            return json_encode($response);                                  //$response[0]["resposta"]; //explode(',', $response[0]["media"])[0];
        } else {
            return json_encode("Não encontrado");
        }
    }
    

    

    conectaBanco($dbconn);
    if($_GET["operacao"] == 1){
        contarAvaliacoes($dbconn);
    } elseif($_GET["operacao"] == 2){
        calcularMedia($dbconn);
    } elseif($_GET["operacao"] == 3){
        quantidadePerguntas($dbconn);
    }



    

?>