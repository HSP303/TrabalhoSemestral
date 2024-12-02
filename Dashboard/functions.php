<?php
    require_once("/opt/lampp/htdocs/Trabalho_Semestral/public/database.php");
    function pegarPergunta(&$dbconn){
        if ($dbconn){
            $params = [$_GET["id_pergunta"]];
            
            $perguntas = pg_query_params($dbconn, "SELECT * FROM PERGUNTAS WHERE ID_PERGUNTA = $1", $params);
            if ($perguntas){
                $perguntas = pg_fetch_assoc($perguntas);
                $perguntas_json = json_encode($perguntas);
                echo $perguntas_json;
            } else {
                echo json_encode("Não encontrado");
            }
        }
    }

    function pegarDispotivo(&$dbconn){
        if ($dbconn){
            $params = [$_GET["id_dispositivo"]];

            $perguntas = pg_query_params($dbconn, "SELECT * FROM DISPOSITIVOS WHERE ID_DISPOSITIVO = $1", $params);
            if ($perguntas){
                $perguntas = pg_fetch_assoc($perguntas);
                $perguntas_json = json_encode($perguntas);
                echo $perguntas_json;
            } else {
                echo json_encode("Não encontrado");
            }
        }
    }

    function pegarSetor(&$dbconn){
        if ($dbconn){
            $params = [$_GET["id_setor"]];

            $perguntas = pg_query_params($dbconn, "SELECT * FROM SETORES WHERE ID_SETOR = $1", $params);
            if ($perguntas){
                $perguntas = pg_fetch_assoc($perguntas);
                $perguntas_json = json_encode($perguntas);
                echo $perguntas_json;
            } else {
                echo json_encode("Não encontrado");
            }
        }
    }

    conectaBanco($dbconn);    //$dbconn = pg_connect("host=localhost port=5432 dbname=TrabalhoSemestral user=postgres password=postgres");
    
    if ($_GET["operacao"] == 1){
        pegarPergunta($dbconn);
    } elseif($_GET["operacao"] == 2){
        pegarDispotivo($dbconn);
    } elseif($_GET["operacao"] == 3){
        pegarSetor($dbconn);
    }
    
?>