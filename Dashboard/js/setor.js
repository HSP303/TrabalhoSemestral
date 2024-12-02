function pesquisa(id_setor=0, operacao=2){
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        const Obj_pergunta = JSON.parse(this.responseText);
        console.log(Obj_pergunta["nome_setor"])
        if(Obj_pergunta["nome_setor"] === undefined ){
            window.alert("Id de pergunta inexistênte!")
            zerarCampos()
        } else {
            document.getElementById("nome").value = Obj_pergunta["nome_setor"]
            alteraSituacao(Obj_pergunta["sit_setor"])
        }
    }
    xmlhttp.open("GET", "functions.php?id_setor=" + id_setor + "&operacao=3");
    xmlhttp.send();
}

function alteraSituacao(situacao){
    if (situacao == "ativo"){
        document.getElementById("atv").checked = true
    } else {
        document.getElementById("int").checked = true
    }
}

function zerarCampos(){
    document.getElementById("id_setor").value = null
    document.getElementById("nome").value = ""
    document.getElementById("atv").checked = false
    document.getElementById("int").checked = false
}

function buscaCadastro(){
    const id_setor = document.getElementById("id_setor")
    console.log("Teste: " + id_setor.value)
    pesquisa(id_setor.value)
    
}
