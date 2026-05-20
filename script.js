/* 
Definindo lista de palavras que iremos ultilizar no jogo
as palavras tem 5 caracteres e são simples sem acentos
*/

const palavras = [
  "pudim", "pingu", "pipos", "gatoo", "pavao", "zebra", "porco", "touro",
  "peixe", "arara", "cisne", "bicho", "ursoo", "leoni", "tigre", "cobra",
  "poney", "koala", "panda", "polvo", "sushi", "torta", "cacau", "melao",
  "limao", "manga", "amora", "bacon", "balas", "doces", "papas", "creme",
  "glace", "pizza", "nozes", "milho", "tampa", "balao", "pipca", "circo",
  "magia", "palco", "festa", "danca", "canto", "jogos", "dados", "pista",
  "bomba", "foguet", "astro", "terra", "marte", "venus", "rocha", "gruta",
  "areia", "praia", "ondas", "lagoa", "navio", "barco", "balsa", "frota",
  "carro", "aviao", "trenz", "motor", "rodaa", "pneus", "farol", "pista",
  "risco", "traço", "linha", "bloco", "tijol", "gesso", "ferro", "metal",
  "prata", "bronz", "perla", "rubii", "gemaa", "coroa", "trono", "reino",
  "heroi", "capas", "lazer", "frias", "parqu", "praça", "campo", "grama"
];

const sortea_frase = () => {
    //Esta função retorna 20 palavras de 5 caracteres
    let frase = "";
    for(let i = 0; i<20; i++){
        //                                   indice aleatorio do vetor
        frase += `${palavras[Math.floor(Math.random()*palavras.length)]} `;
    }
    return frase;
}

//INICIO{VAR GLOBAL}
const divPalavras = document.querySelector(".divPalavras");
let posicao = -1;
let pontuacao = 120;
//FIM{VAR GLOBAL}

addEventListener("DOMContentLoaded",  (evento) => {
    let frase = sortea_frase();
    divPalavras.textContent = "";
    
    

    for(let i = 0; i<frase.length; i++){
        //gerar spans
        const spans = document.createElement("span");
        spans.classList.add("span-frase");
        spans.textContent = frase[i];

        divPalavras.append(spans);
    }

    const allspans = document.querySelectorAll(".span-frase");
    allspans[0].style.backgroundColor = "gray";
});

addEventListener("keydown", (evento) => {

    //verificar se o jogo acabou
    if(posicao>120){
        return;
    }

    posicao++;
    const allspans = document.querySelectorAll(".span-frase");
    const pontu = document.querySelector("#pontuacao");

    let digitado = evento.key;

    

    if((digitado >= 'a' && digitado <= 'z') || (digitado === ' ')){
        
        if(allspans[posicao].textContent === digitado){
            allspans[posicao].style.backgroundColor = "green";
        } else {
            allspans[posicao].style.backgroundColor = "red";
            pontuacao--;
        }

        if(posicao<120){
            allspans[posicao+1].style.backgroundColor = "gray";
        }
    }
    pontu.innerHTML = pontuacao;
});