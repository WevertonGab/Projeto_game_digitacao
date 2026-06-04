const jogo = document.getElementById("jogo");
const areablocos = document.getElementById("areablocos");
let contador = 0;
let mina = [];
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
}
function mostramina(){
    bloco1.textContent= mina[contador];
    bloco2.textContent= mina[contador + 1];
    bloco3.textContent= mina[contador + 2];
}
function quebrabloco(){
    contador++;
    mostramina();
}
criarmina();
mostramina();