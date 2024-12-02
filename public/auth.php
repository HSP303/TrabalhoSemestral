<?php

require_once ("session.php");
require_once("/opt/lampp/htdocs/Trabalho_Semestral/public/database.php");


//Inicializar a aplicação, sendo a sessão controlada pela classe session
//1 - Criar uma instância da classe session que será utilizada na aplicação toda.

function pegaDadosUser(&$user, &$password){
    $user = $_POST["user"];
    $password = $_POST["psword"];
}

function verificarUserBanco($user, $password){
    conectaBanco($dbconn);
    $params = [$user, $password];

    $return = pg_query_params($dbconn, "SELECT * FROM usuarios_administrativos WHERE LOGIN = $1 AND SENHA = $2", $params);
    if ($return){
        $return = pg_fetch_assoc($return);
        if($return["login"] == $user){
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
} 
function verificaUser($user, $password){
    if(!isset($user) or !isset($password)) {
        header("location: http://localhost/Trabalho_Semestral/public/login.php"); 
    }
    else {
        if (verificarUserBanco($user, $password) == false){
            header("location: http://localhost/Trabalho_Semestral/public/login.php"); 
        } else {
            if(!isset($session)){
                $session = new session();
                $session->iniciaSessao();
                $session->gravaDadoSessao("userName", $user);
                
                $session->getUsuario()->setUserName($session->buscaDadoSessao("userName"));
    
                return $session;
            } else {
                return $session;
            }

        }
    }

    //header("location: /Trabalho_Semestral/Dashboard/"); 
    
}

function verificarAutenticacao() {
    session_start();
    if (!isset($_SESSION['userName']) || empty($_SESSION['userName'])) {
        //header("Location: /Trabalho_Semestral/public/login.php");
        pegaDadosUser($user, $password);
        verificaUser($user, $password);
        exit();
    }
}


?>