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
        <form action="salvar_s.php" method="POST">
            <h1>Cadastro de Setor</h1>
            <div class="input-box">
                <input type="text" placeholder="Id-Setor" name="id_setor" id="id_setor" onblur="buscaCadastro()">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Setor" name="nome" id="nome">
            </div>
            <div class="input-rd">
                <label for="atv">Ativo:</label>
                <input type="radio" name="sit" id="atv" value="ativo">
                <label for="int">Inativo:</label>
                <input type="radio" name="sit" id="int" value="inativo">
            </div>
            <br>
            <button type="submit" class="btn">Salvar</button>
            <button type="reset" class="btn">Limpar</button>
            <a href="../Dashboard/">Retornar</a>
        </form>
    </div>
    <script src="js/setor.js"></script>
</body>
</html>