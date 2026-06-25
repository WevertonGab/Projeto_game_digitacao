const jogo = document.getElementById("jogo");
const areablocos = document.getElementById("areablocos");
const direita = document.getElementById("direita");
const esquerda = document.getElementById("esquerda");
let contador = 0;
let mina = [];
let animando = false;
let laterais = 0;
let progresso = 0;
let palavraat;
let erros = 0;
let timerIniciado = false;
let tempoInicio;
let totalLetras = 0;
const tempoTela = document.getElementById("tempo");
let segundosCronometro = 0;
let intervalTimer = null;
const frames = [
    "imagens/sprite1.png",
    "imagens/sprite2.png",
    "imagens/sprite3.png",
    "imagens/sprite4.png",
    "imagens/sprite5.png",
    "imagens/sprite6.png",
    "imagens/sprite1.png", 
];
const bloco1 = document.createElement("div");
const bloco2 = document.createElement("div");
const bloco3 = document.createElement("div");
bloco1.classList.add("pedras");
bloco2.classList.add("pedras");
bloco3.classList.add("pedras");
areablocos.appendChild(bloco1);
areablocos.appendChild(bloco2);
areablocos.appendChild(bloco3);
const palavrasFaceis = [
    "terra","pedra","areia","grama","agua","lava","ferro","ouro","carvao","cobre",
    "arco","livro","cama","bau","porta","vidro","tocha","corda","trigo","peixe",
    "vaca","ovelha","porco","lobo","gato","urso","aldeia","mina","caverna","selva",
    "neve","gelo","rio","oceano","ilha","barco","mapa","pao","bolo","leite",
    "ovo","osso","pele","argila","madeira","musgo","folha","raiz","flor","fungo"
];

const palavrasMedias = [
    "diamante","esmeralda","redstone","obsidiana","bedrock","picareta","machado","enxada","espada","escudo",
    "armadura","flecha","bigorna","fornalha","bancada","caldeirao","estante","lanterna","funil","tridente",
    "creeper","zumbi","aranha","esqueleto","bruxa","phantom","pillager","saqueador","guardiao","gollem",
    "aldeao","fazenda","plantacao","abobora","melancia","beterraba","cenoura","batata","composto","apiario",
    "portal","nether","fortaleza","bastiao","mineshaft","templo","bioma","encanto","totem","bussola"
];

const palavrasDificeis = [
    "encantamento","encantadoria","encantamentos","teletransporte","sobrevivencia","regeneracao","respiracao","invisibilidade","resistencia","velocidade",
    "fortificacao","construcao","exploracao","mineracao","agricultura","ferreiro","bibliotecario","cartografo","arqueologia","expedicao",
    "piglinbruto","enderman","enderdragon","witherboss","evocador","vindicator","ravager","shulker","silverfish","blazespawner",
    "deepdark","ancientcity","stronghold","endgateway","trialchamber","spawner","redstoneiro","observador","comparador","repetidor",
    "enciclopedia","cristalfinal","ressurreicao","subterraneo","sobrecarga","encadeamento","estalactite","estalagmite","luminosidade","desmoronamento"
];

function sortedor(array){
 const indice = Math.floor(Math.random() * array.length);
 let at = array[indice];
 array.splice(indice, 1)
    return at;
}
function calcularPontuacao() {
    const segundos = (Date.now() - tempoInicio) / 1000;
    const minutos = segundos / 60;
    const wpm = Math.round((totalLetras / 5) / minutos);
    const totalDigitado = totalLetras + erros;
    const precisao = Math.round((totalLetras / totalDigitado) * 100);
    const bonusProfundidade = contador * 10;
    const pontos = Math.round(wpm * (precisao / 100) + bonusProfundidade);
    return { pontos, wpm, precisao };
}
function criarmina(){
    mina = [];
    let i;
    let faceis = [...palavrasFaceis];
    let medias = [...palavrasMedias];
    let dificeis = [...palavrasDificeis];
    for (i = 0; i < 20; i++){
        mina.push(sortedor(faceis));
    }
    for (i = 0; i < 15; i++){
        mina.push(sortedor(medias));
    }
    for (i = 0; i < 15; i++){
        mina.push(sortedor(dificeis));
    }
    palavraat = mina[contador]
}
function mostramina(){
      function textura(indice) {
        if (indice < 20) return "url('imagens/bloco_terra.png')";
        else if (indice < 35) return "url('imagens/bloco_pedra_clara.png')";
        else return "url('imagens/bloco_pedra_escura.png')";
    }

    bloco1.style.backgroundImage = textura(contador);
    bloco2.style.backgroundImage = textura(contador + 1);
    bloco3.style.backgroundImage = textura(contador + 2);

    if(contador < 48){
        bloco1.textContent= mina[contador];
        bloco2.textContent= mina[contador + 1];
        bloco3.textContent= mina[contador + 2];
    }
    if (contador === 48){
        areablocos.style.height = "202px";
        bloco1.remove()
        bloco2.textContent= mina[contador];
        bloco3.textContent= mina[contador + 1];
    }
    if (contador === 49){
        areablocos.style.height = "101px";
        bloco1.remove()
        bloco2.remove()
        bloco3.textContent= mina[contador];
        
    }
    if (contador === 50){
        areablocos.style.height = "10px";
        bloco1.remove()
        bloco2.remove()
        bloco3.style.height = "10px";
        bloco3.textContent = "";
        bloco3.style.border = "none";
        bloco3.style.width = "105px";
    }
}
function animarPlayer(callback) {
    const sprite = document.getElementById("player-sprite");
    let frame = 0;
    const intervalo = setInterval(() => {
        sprite.src = frames[frame];
        frame++;
        if (frame >= frames.length) {
            clearInterval(intervalo);
            if (callback) callback();
        }
    }, 70);
}

document.addEventListener("keydown", function(event) {
    const letra = event.key;
    const letracerta = palavraat[progresso];
    if (letra.length > 1){
        return;
    }
     if (!timerIniciado) {
        timerIniciado = true;
        tempoInicio = Date.now();
        intervalTimer = setInterval(() => {
            segundosCronometro++;
            const m = Math.floor(segundosCronometro / 60);
            const s = segundosCronometro % 60;
            tempoTela.textContent =
                String(m).padStart(2, "0") + ":" + String(s).padStart(2, "0");
        }, 1000);
    }
        if (letra === letracerta){
            progresso++;
            totalLetras++;
            atualizatexto();
            if (progresso === palavraat.length){
                quebrabloco();
            }

        }
        else {
            erros++;
        }
    
} );

function atualizatexto(){
    bloco1.textContent=palavraat.substring(progresso);
}
function quebrabloco(){
    if (contador < 50){
        if (animando) return;
        animando = true;
        animarPlayer(() => {
            bloco1.classList.add("block-flash");

            setTimeout(() => {
                bloco1.classList.remove("block-flash");

                contador++;
                mostramina();
                palavraat = mina[contador];
                progresso = 0;
                if (timerIniciado) {
                    const r = calcularPontuacao();
                    document.getElementById("pontos").textContent = r.pontos + " pontos";
                }
                if (contador >= 50) {
                    clearInterval(intervalTimer);
                    const resultado = calcularPontuacao();
                    const dados = {
                        pontos: resultado.pontos,
                        wpm: resultado.wpm,
                        precisao: resultado.precisao
                    };
                    fetch("salvar_partida.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify(dados)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.sucesso) {
                            window.location.href = "pontuacao.php";
                        }
                    animando = false;
                    return;
                    });
                    
                }
                areablocos.classList.remove("animating");
                void areablocos.offsetWidth;
                areablocos.classList.add("animating");
                if (contador < 49){
                    laterais -= 101;
                    direita.style.backgroundPositionY = laterais + "px";
                    esquerda.style.backgroundPositionY = laterais + "px";
                }
                setTimeout(() => {
                    areablocos.classList.remove("animating");
                    animando = false;
                }, 400);
            }, 180);
        });
    }
}

criarmina();
mostramina();