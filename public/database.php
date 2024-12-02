<?php

    function conectaBanco(&$dbconn){
        try {
            /* Etapa 1 - Criar uma instância da classe de conexão e definir os parâmetros de conexão */
            $dbconn = pg_connect("host=localhost port=5432 dbname=TrabalhoSemestral user=postgres password=postgres");
        } catch (Exception $e){
            /* Caso ocorra algum erro, então exibir mensagem */
            echo "<script>
                    alert('Houve falha ao processar a inclusão. " . $e->getMessage() . ");
                 </script>";
        }
    }

?>