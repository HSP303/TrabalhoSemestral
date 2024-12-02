var notas = new Array()
var texto_opcional = " "
var dispositivo = document.getElementById("disp").value
var setor = document.getElementById("setor").value
console.log('setor = ' + setor)
function pegaPergunta(id_pergunta){
    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onload = function() {
        const Obj_pergunta = JSON.parse(this.responseText);
        if(!Obj_pergunta){
            notas = notas.filter(x => x.trim());
            console.log('Disp = ' + dispositivo)
            enviarRespostas(dispositivo, setor)
            window.location.replace("http://localhost/Trabalho_Semestral/public/obrigado.html?disp=" + dispositivo);
        }
        pergunta.innerHTML = Obj_pergunta.texto_pergunta;
        let tipo_input = Obj_pergunta.tipo_input 
        window.console.log("Tipo_input: ", tipo_input)
        if (tipo_input != 'R'){
            escondeRadio()
        } else { 
            mostraRadio()
        }
    }

    xmlhttp.open("GET", "functions.php?id_pergunta=" + id_pergunta + "&operacao=1");
    xmlhttp.send();
}

function enviarRespostas(disp, setor){
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "functions.php?operacao=2" + "&setor=" + setor + "&dispositivo=" + disp + "&txtopc=" + texto_opcional + "&respostas=" + notas.toString());
    xmlhttp.send(); 
}

function escondeRadio(){
    document.querySelector(".inputs").style.display = "none";
    document.getElementById("texto_opcional").hidden = false
}

function mostraRadio(){
    document.querySelector(".inputs").style.display = "flex"; // ou "inline-block", etc.
    document.getElementById("texto_opcional").hidden = true
}

function pegaNota(id_pergunta){
    let input_radios = Array.from(document.getElementsByClassName("radio"));
    let temResposta = false

    if(document.getElementById("texto_opcional").hasAttribute("hidden")){
        input_radios.forEach((element, index) => {
            if(element.checked){
                window.console.log('Selectionado: ', index)
                notas[id_pergunta] = element.value
                temResposta = true
            } 
        })
    }else{
        temResposta = true
        texto_opcional += String(document.getElementById("texto_opcional").value) + " | "
    }

    if(temResposta){
        document.getElementById("forms").reset()
        return true
    } 

}

function verificaPerguntaRespondida(id_pergunta){
    window.console.log('Id:', id_pergunta)
    if(notas[id_pergunta - 1]){
        window.console.log(notas[id_pergunta - 1])
        return true
    } else{
        return false
    }
}
function Proximo(){
    let id_pergunta = document.getElementById("id_pergunta")

    if (pegaNota(parseInt(id_pergunta.value)-1)){
        id_pergunta.value = parseInt(id_pergunta.value) + 1
        pegaPergunta(id_pergunta.value)
        document.getElementById("esq").hidden = false;
        document.getElementById("buttons").classList.remove('button_proximo')
        document.getElementById("buttons").classList.add('buttons')
    } else {
        window.alert("Selecione uma resposta!")
    }
    if (verificaPerguntaRespondida(id_pergunta.value)){
        window.console.log("Marcado")
        document.getElementById(notas[parseInt(id_pergunta.value)-1]).checked = true
    }else{
        window.console.log("Desmarcado")
    }
}
function Voltar(){
    let id_pergunta = document.getElementById("id_pergunta")
    window.console.log("Id_pergunta: ", id_pergunta.value - 1)
    pegaNota(parseInt(id_pergunta.value)-1)
    id_pergunta.value = parseInt(id_pergunta.value) - 1
    pegaPergunta(id_pergunta.value)
    document.getElementById(notas[parseInt(id_pergunta.value)-1]).checked = verificaPerguntaRespondida(id_pergunta.value);
    if (id_pergunta.value == 1){
        document.getElementById("esq").hidden = true;
        document.getElementById("buttons").classList.remove('buttons')
        document.getElementById("buttons").classList.add('button_proximo')
    }
}

