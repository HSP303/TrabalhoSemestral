   

const _elements = {
    loading: document.querySelector(".loading"),
    //switch: document.querySelector(".switch__track"),
    stateSelectToggle: document.querySelector(".state-select-toggle"),
    selectOptions: document.querySelectorAll(".state-select-list__item"),
    selectList: document.querySelector(".state-select-list"),
    selectToggleIcon: document.querySelector(".state-select-toggle__icon"),
    selectSearchBox: document.querySelector(".state-select-list__search"),
    selectStateSelected: document.querySelector(".state-select-toggle__state-selected"),
    respostas: document.querySelector(".info__total--respostas"),
    media: document.querySelector(".info__total--media"),
    deathsDescription: document.querySelector(".data-box__description"),
    hoje: document.querySelector(".info__total--hoje"),
    mes: document.querySelector(".info__total--mes"),
}

const _data = {
    id: "1",
    respostas: document.getElementById("avaliacoes").value,
    media: undefined,
    hoje: document.getElementById("hoje").value,
    mes: document.getElementById("mes").value,
    notas_setor: JSON.parse(document.getElementById("notas_setor").value),
    qtd_perguntas: document.getElementById("qtd_perguntas"),
    qtdava_setor: JSON.parse(document.getElementById("qtdava_setor").value),
    sit_perg: JSON.parse(document.getElementById("sit_perg").value)
}
console.log('Notas: ' + _data.sit_perg[0]['ati'])

const _charts = {};

function cadastraPergunta(){
    window.location.replace("http://localhost/Trabalho_Semestral/Dashboard/pergunta.php");
}

function cadastraDispositivo(){
    window.location.replace("http://localhost/Trabalho_Semestral/Dashboard/dispositivo.php");
}

function cadastraSetor(){
    window.location.replace("http://localhost/Trabalho_Semestral/Dashboard/setor.php");
}


_elements.stateSelectToggle.addEventListener("click", () => {
    _elements.selectToggleIcon.classList.toggle("state-select-toggle__icon--rotate")
    _elements.selectList.classList.toggle("state-select-list--show")
});

_elements.selectOptions.forEach(item => {
    item.addEventListener("click", () => {
        _elements.selectStateSelected.innerText = item.innerText
        _data.id = item.getAttribute("data-id")
        _elements.stateSelectToggle.dispatchEvent(new Event("click"))
    })
});

_elements.selectSearchBox.addEventListener("keyup", (e) => {
    const search = e.target.value.toLowerCase()
    for(const item of _elements.selectOptions){
        const state = item.innerText.toLowerCase()
        
        if(state.includes(search)){
            item.classList.remove("state-select-list__item--hide")
        } else{
            item.classList.add("state-select-list__item--hide")
        }
    }
});

function pegarMedia(id){
    const xmlhttp = new XMLHttpRequest();
    let media = 0;
    
    xmlhttp.onload = function() {
        const Obj_pergunta = JSON.parse(this.responseText);
        let soma = 0;

        const respostas = Object.keys(Obj_pergunta).map(chave => Obj_pergunta[chave])
        let array = respostas[1]["media"].split(','); 
        for(let i in respostas){
            soma = 0;
            for(let j in respostas[i].media.split(',')){
                soma += parseInt(respostas[i].media.split(',')[j])
            }
            media += (soma / respostas[i].media.split(',').length)
        }
        _elements.media.innerText = (media / _data.respostas).toFixed(2)
    }
    xmlhttp.open("GET", "funcoes_dash.php?id=" + id + "&operacao=2");
    xmlhttp.send();
}

function voltarLogin(){
    window.location.replace("http://localhost/Trabalho_Semestral/public/login.php");
}


const loadData = (id) => {
    pegarMedia(_data.id)
    updateCards()
    console.log(_data.notas)
}

const createBasicChart = (element, categories, datas) => {
    var options = {
        chart: {
          type: 'bar'
        },
        series: [{
          name: 'sales',
          data: datas
        }],
        xaxis: {
          categories: categories
        }
      }
      
      var chart = new ApexCharts(document.querySelector(element), options);
      
      chart.render();

    return chart;
}

const createSecondChart = (element, categories, datas) => {
    var options = {
        series: [{
        data: datas
      }],
        chart: {
        type: 'bar',
        height: 350
      },
      annotations: {
        xaxis: [{
          x: 500,
          borderColor: '#FF4560',
          label: {
            borderColor: '#FF4560',
            style: {
              color: '#fff',
              background: '#FF4560',
            },
            text: 'X annotation',
          }
        }],
        yaxis: [{
          y: 'July',
          y2: 'September',
          label: {
            text: 'Y annotation'
          }
        }]
      },
      plotOptions: {
        bar: {
          horizontal: true,
        }
      },
      dataLabels: {
        enabled: true
      },
      xaxis: {
        categories: categories,
      },
      grid: {
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      yaxis: {
        reversed: true,
        axisTicks: {
          show: true
        }
      }
      };

    // Cria e renderiza o gráfico
    const chart = new ApexCharts(document.querySelector(element), options);
    chart.render();

    return chart;
};

const createDonutChart = (element, series_ati, series_ina/*, datas*/) => {
    var options = {
        series: [series_ati, series_ina],
        chart: {
        type: 'donut',
      },
      labels: ["Inativa", "Ativa"],
      dataLabels: {
        dropShadow: {
          blur: 3,
          opacity: 1
        }
      },
      responsive: [{
        breakpoint: 480,
        options: {
          chart: {
            width: 200
          },
          legend: {
            position: 'bottom',
            label: ['Maça', 'Banana'],
          }
        }
      }]
      };

    // Cria e renderiza o gráfico
    const chart = new ApexCharts(document.querySelector(element), options);
    chart.render();

    return chart;
};

/*
const createStackedColumnsChart = (element) => {

}*/

const createCharts = () => {
    let array_setores = []
    let array_medias = []
    let array_setores_d = []
    let array_qtd_d = []
    let sit_ina = parseInt(_data.sit_perg[0]['ina'])
    let sit_ati = parseInt(_data.sit_perg[0]['ati'])
    console.log('ina: ')
    getChartOptions(array_setores, array_medias)
    getSecondChartOptions(array_setores_d, array_qtd_d)
    _charts.um = createBasicChart(".data-box__body-1", array_setores, array_medias)
    _charts.dois = createSecondChart(".data-box__body-2", array_setores_d, array_qtd_d)
    _charts.tres = createDonutChart(".data-box__body-3", sit_ina, sit_ati)
}

const updateCards = () => {
    _elements.respostas.innerText = _data.respostas
    _elements.media.innerText = _data.media
    _elements.hoje.innerText = _data.hoje
    _elements.mes.innerText = _data.mes
}


const getChartOptions = (array_setores, array_medias) => {
    let soma = 0; 
    let qtd_ava_setor = 0;
    let id_setor_atual = null;

    for (let avaliacao of _data.notas_setor) {
        // Identifica mudança de setor
        if (avaliacao['id_setor'] !== id_setor_atual) {
            if (id_setor_atual !== null) {
                array_medias.push((soma / qtd_ava_setor).toFixed(2)); 
            }

            // Atualiza setor atual e reseta variáveis
            id_setor_atual = avaliacao['id_setor'];
            array_setores.push(id_setor_atual);
            soma = 0;
            qtd_ava_setor = 0;
        }

        // Processa a avaliação do setor atual
        let notas = avaliacao['resposta'].split(',').map(nota => parseInt(nota));
        soma += notas.reduce((acc, nota) => acc + nota, 0) / notas.length;
        qtd_ava_setor++;
    }


    if (qtd_ava_setor > 0) {
        array_medias.push((soma / qtd_ava_setor).toFixed(2));
    }
};





const getSecondChartOptions = (array_setores, array_qtd) => {
    for(let i of _data.qtdava_setor){
        array_setores.push(i['id_setor'])
        array_qtd.push(i['qtd'])
    }
}

const getDonutChartOptions = (array_setores, array_qtd) => {
    for(let i of _data.qtdava_setor){
        array_setores.push(i['id_setor'])
        array_qtd.push(i['qtd'])
    }
}




loadData(_data.id);
createCharts();
