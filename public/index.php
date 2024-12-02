<?php
    require_once("functions.php");
    $dispositivo = $_GET["disp"];
    $setor = pegarSetor($dispositivo);
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Trabalho Semestral</title>
</head>
<body onload="pegaPergunta(1)">
    <main> 
        <div class="area">
            <form action="database.php" method="post" autocomplete="off" id="forms">
                <fieldset>
                    <div>
                        <legend>Avalie-nos!</legend>
                    </div>
                    <div class="pergunta">
                        <p id="pergunta"></p>
                        <input type="hidden" id="id_pergunta" value="1">
                    </div>
                    <div class="inputs">

                        <input type="radio" name="nota" id="0" value="0" class="radio">
                        <label for="0"><span class="zero">0</span></label>
                        <input type="radio" name="nota" id="1" value="1" class="radio">
                        <label for="1"><span class="um">1</span></label>
                        <input type="radio" name="nota" id="2" value="2" class="radio">
                        <label for="2"><span class="dois">2</span></label>
                        <input type="radio" name="nota" id="3" value="3" class="radio">
                        <label for="3"><span class="tres">3</span></label>
                        <input type="radio" name="nota" id="4" value="4" class="radio">
                        <label for="4"><span class="quatro">4</span></label>
                        <input type="radio" name="nota" id="5" value="5" class="radio">
                        <label for="5"><span class="cinco">5</span></label>
                        <input type="radio" name="nota" id="6" value="6" class="radio">
                        <label for="6"><span class="seis">6</span></label>
                        <input type="radio" name="nota" id="7" value="7" class="radio">
                        <label for="7"><span class="sete">7</span></label>
                        <input type="radio" name="nota" id="8" value="8" class="radio">
                        <label for="8"><span class="oito">8</span></label>
                        <input type="radio" name="nota" id="9" value="9" class="radio">
                        <label for="9"><span class="nove">9</span></label>
                        <input type="radio" name="nota" id="10" value="10" class="radio">
                        <label for="10"><span class="dez">10</span></label>

                    </div>
                    <div id="input_txt" hidden="true">
                        <input type="text" name="nota" id="texto_opcional" hidden placeholder="Texto Opcional...">
                    </div>
                    <div id="buttons" class="button_proximo">                    
                        <input type="button" value="Voltar" id="esq" onclick="Voltar()" hidden>
                        <input type="button" value="Próximo" id="dir" onclick="Proximo()">
                    </div>

                </fieldset>
            </form>
        </div>
 
    </main>

    <footer>
        <div>
            <p>
                Sua  avaliação  espontânea  é 
                anônima, nenhuma informação pessoal é solicitada ou armazenada.
            </p>
        </div>
    </footer>

    <input type="hidden" name="disp" id="disp" value=<?php echo $dispositivo ?>>
    <input type="hidden" name="setor" id="setor" value=<?php echo $setor ?>>


<script src="js/script.js"></script>


</body>

</html>

