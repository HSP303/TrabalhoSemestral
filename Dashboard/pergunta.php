<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/pergunta.css">
<body>
    <div class="wrapper">
        <form action="salvar_p.php" method="POST">
            <h1>Cadastro de Pergunta</h1>
            <div class="input-box">
                <input type="number" placeholder="Id-Pergunta" name="id_pergunta" id="id_pergunta" onblur="buscaCadastro()">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Pergunta" name="pergunta" id="pergunta">
            </div>
            <div class="input-rd">
                <label for="atv">Ativo:</label>
                <input type="radio" name="sit" id="atv" value="ativa">
                <label for="int">Inativo:</label>
                <input type="radio" name="sit" id="int" value="inativa">
            </div>
            <div class="input-box">
                <input type="number" name="ordem" id="ordem" placeholder="Ordem">
            </div>
            <div class="input-rd">
                <label for="rad">Radio:</label>
                <input type="radio" name="inp" id="rad" value="R">
                <label for="tex">Texto:</label>
                <input type="radio" name="inp" id="tex" value="T">
            </div>
            <br>
            <button type="submit" class="btn">Salvar</button>
            <button type="reset" class="btn">Limpar</button>
            <a href="../Dashboard/">Retornar</a>
        </form>
    </div>
    <script src="js/pergunta.js"></script>
</body>
</html>