<?php  
    require_once("/opt/lampp/htdocs/Trabalho_Semestral/Dashboard/funcoes_dash.php");
    require_once("/opt/lampp/htdocs/Trabalho_Semestral/public/session.php");
    require_once("/opt/lampp/htdocs/Trabalho_Semestral/public/auth.php");

    pegaDadosUser($user, $password);
    $session = verificaUser($user, $password);

    $qtd_avaliacoes = contarAvaliacoes(1);
    $qtd_avaliacoes_hoje = contarAvaliacoesHoje(1);
    $qtd_avaliacoes_mes = contarAvaliacoesMes(1);
    $notas_setor = levarRespostas(1);
    $qtdAva_setor = contaAvaSetor(1);
    $per_ini_ati = perguntasInativasAtivas();
?>

<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body id="body">
    <header>
        <div class="loading loading--hide">
            <i class="fas fa-spinner loading_spinner"></i>
        </div>
        <div class="navbar">
            <div class="logo">
                <img src="http://localhost/Trabalho_Semestral/src/logo-white.jpg" alt="Logo" width="56" height="49.6">
            </div>
            <div class="logout">
                <button class="pro cad" onclick="cadastraPergunta()">Cadastrar Perguntas</button>
                <button class="disp cad" onclick="cadastraDispositivo()">Cadastrar Dispositivos</button>
                <button class="setor cad" onclick="cadastraSetor()">Cadastrar Setores</button>
                <button class="btn" onclick="voltarLogin()"><i class='bx bx-log-out-circle' ></i></button>
            </div>

        </div>
    </header>  

    <div class="container">
        <div class="state-select">
            <div class="state-select-toggle">
                <span class="state-select-toggle__state-selected">Setor</span>
                <i class="fas fa-chevron-down state-select-toggle__icon"></i>
            </div>
            <div class="state-select-list">
                <input type="text" class="state-select-list__search" placeholder="Selecionar Setor...">  
                <ul>
                    <li class="state-select-list__item" data-id="hsp">Hospital</li>
                    <li class="state-select-list__item" data-id="1">Recepção</li>
                    <li class="state-select-list__item" data-id="2">Enfermaria</li>
                    <li class="state-select-list__item" data-id="3">Sala de Espera</li>
                    <li class="state-select-list__item" data-id="4">Ambulatório</li>
                    <li class="state-select-list__item" data-id="5">Leito</li>
                </ul>
            </div>
        </div>

        <section class="status">
            <div class="status__icon status__icon--respostas">
                <i class="fa fa-virus"></i>
            </div>
            <div class="info">
                <span class="info__total info__total--respostas">123,456,789</span>
                <h2 class="info__label">Testes</h2>
            </div>
        </section>

         <section class="status">
            <div class="status__icon status__icon--media">
                <i class="fa fa-smile"></i>
            </div>
            <div class="info">
                <span class="info__total info__total--media">123,456,789</span>
                <h2 class="info__label">Media</h2>
            </div>
        </section>

        <section class="status">
            <div class="status__icon status__icon--hoje">
                <i class="fa fa-syringe"></i>
            </div>
            <div class="info">
                <span class="info__total info__total--hoje">123,456,789</span>
                <h2 class="info__label">Hoje</h2>
            </div>
        </section>

        <section class="status">
            <div class="status__icon status__icon--mes">
                <i class="fa fa-syringe"></i>
            </div>
            <div class="info">
                <span class="info__total info__total--mes">123,456,789</span>
                <h2 class="info__label">Mes</h2>
            </div>
        </section>

        <section class="data-box data-box--1">
            <h2 class="data-box__header">Média das notas por setor</h2>
            <div class="data-box__body data-box__body-1"></div>
        </section>

        <section class="data-box data-box--2">
            <h2 class="data-box__header">Quantidade de Respostas por Setor</h2>
            <p class="data-box__description"></p>
            <div class="data-box__body data-box__body-2"></div>
        </section>

        <section class="data-box data-box--3">
            <h2 class="data-box__header">Perguntas Ativas e Inativas</h2>
            <p class="data-box__description"></p>
            <div class="data-box__body data-box__body-3"></div>
        </section>
    </div>

    <input type="hidden" name="avaliacoes" id="avaliacoes" value=<?php echo $qtd_avaliacoes?>>
    <input type="hidden" name="hoje" id="hoje" value=<?php echo $qtd_avaliacoes_hoje?>>
    <input type="hidden" name="mes" id="mes" value=<?php echo $qtd_avaliacoes_mes?>>
    <input type="hidden" name="notas_setor" id="notas_setor" value=<?php echo $notas_setor ?>>
    <input type="hidden" name="qtdava_setor" id="qtdava_setor" value=<?php echo $qtdAva_setor ?>>
    <input type="hidden" name="sit_perg" id="sit_perg" value=<?php echo $per_ini_ati ?>>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.27.3/apexcharts.min.js" integrity="sha512-nKTh1Ik8Kzbrxo9A6xOBtEbzdNYcjI4Pr5XE88sNJQk87sY8mBlUfh61lYm0i710r5mGcIZ9tWSwORQbQ4plQQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="js/apexcharts-pt-br.js"></script>
	<script src="js/apiCovid.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>