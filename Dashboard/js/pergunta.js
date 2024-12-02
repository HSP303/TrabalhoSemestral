
function pesquisa(id_pergunta, operacao=1){
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        const Obj_pergunta = JSON.parse(this.responseText);
        console.log(Obj_pergunta["texto_pergunta"])
        if(Obj_pergunta["status_pergunta"] === undefined ){
            window.alert("Id de pergunta inexistênte!")
            zerarCampos()
        } else {
            document.getElementById("pergunta").value = Obj_pergunta["texto_pergunta"]
            alteraSituacao(Obj_pergunta["status_pergunta"])
            document.getElementById("ordem").value = Obj_pergunta["ordem"]
            colocarTipoInput(Obj_pergunta["tipo_input"])
        }
    }
    xmlhttp.open("GET", "functions.php?id_pergunta=" + id_pergunta + "&operacao=1");
    xmlhttp.send();
}

function alteraSituacao(situacao){
    if (situacao == "ativa"){
        document.getElementById("atv").checked = true
    } else {
        document.getElementById("int").checked = true
    }
}

function colocarTipoInput(input){
    if (input == 'R'){
        document.getElementById("rad").checked = true
    } else {
        document.getElementById("tex").checked = true
    }
}

function zerarCampos(){
    document.getElementById("id_pergunta").value = null
    document.getElementById("pergunta").value = ""
    document.getElementById("atv").checked = false
    document.getElementById("int").checked = false
    document.getElementById("ordem").value = null
    document.getElementById("rad").checked = false
    document.getElementById("tex").checked = false
}

function buscaCadastro(){
    const id_pergunta = document.getElementById("id_pergunta")
    console.log("Teste: " + id_pergunta.value)
    pesquisa(id_pergunta.value)
    
}

