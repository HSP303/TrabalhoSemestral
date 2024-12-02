
function pesquisa(id_dispositivo=0, operacao=2){
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        const Obj_pergunta = JSON.parse(this.responseText);
        console.log(Obj_pergunta["nome_dispositivo"])
        if(Obj_pergunta["id_setor"] === undefined ){
            window.alert("Id de pergunta inexistênte!")
            zerarCampos()
        } else {
            document.getElementById("nome").value = Obj_pergunta["nome_dispositivo"]
            alteraSituacao(Obj_pergunta["status_dispositivo"])
            document.getElementById("setor").value = Obj_pergunta["id_setor"]
        }
    }
    xmlhttp.open("GET", "functions.php?id_dispositivo=" + id_dispositivo + "&operacao=2");
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
    document.getElementById("id_dispositivo").value = null
    document.getElementById("nome").value = ""
    document.getElementById("atv").checked = false
    document.getElementById("int").checked = false
    document.getElementById("setor").value = null
}

function buscaCadastro(){
    const id_dispositivo = document.getElementById("id_dispositivo")
    console.log("Teste: " + id_dispositivo.value)
    pesquisa(id_dispositivo.value)
    
}

