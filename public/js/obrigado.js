const urlParams = new URLSearchParams(window.location.search);

const dispositivo = urlParams.get("disp") 

console.log("O disp é " + dispositivo)

setTimeout(comeBack, 5000)

function comeBack (){
    window.location.replace("http://localhost/Trabalho_Semestral/public/index.php?disp=" + dispositivo)
}