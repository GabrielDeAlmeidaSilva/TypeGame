/*declaracao da lista de palavras. o split serve 
para transformar a string em um array de palavras, separando a cada espaco
*/
const palavras =
  "Em um bom e verdadeiro, nao um conjunto escolar, eles afirmam que a alta vida considera e nao vem o que tambem para o ponto definido pode querer como enquanto com a ordem da crianca sobre a escola, nunca segure, encontre ordem, cada um tambem entre o programa, o trabalho termina, voce em casa, lugar ao redor, enquanto o problema termina, comece o interesse enquanto o publico ou onde ve o tempo, aqueles aumentam o interesse, seja, de, termine, pense, parece pequeno como ambos, outra crianca, o mesmo olho, voce entre o caminho, quem entra novamente, bom fato do que sob a cabeca, torna-se real, possivel, alguns escrevem, sabem, no entanto, tarde, cada um que com porque esse lugar, nacao, apenas para cada mudanca de forma, considere que teriamos interesse com o mundo, entao ordem ou correr mais aberto que grande escrever, nunca sobre aberto, cada sobre mudanca ainda velho, pegue, segure, precisa dar por, considere a linha, apenas deixe enquanto o que definir, numero, parte, forma, quer contra, grande problema pode porque a cabeca, entao primeiro isso aqui, claro, se tornaria, ajudar, ano, primeiro, fim, quer ambos, fato, publico, longa palavra para baixo tambem, anseia por sem novo, vire contra o porque escrever parece linha, interesse, chame nao se linha coisa o que funciona, as pessoas, maneira pode velho considerar deixar segurar quer vida entre a maioria lugar pode se ir quem precisa fato tal programa onde qual fim fora crianca para baixo mudanca para de pessoas altas durante pessoas encontram para, no entanto, em pequeno novo geral isso faz que poderia velho para ultimo conseguir outra mao muito olho otimo sem trabalho e com, mas bom la ultimo acho que pode usar como numero nunca desde que o mundo precisa do que estamos ao redor parte mostrar novo vir parecer enquanto alguns e desde ainda pequeno estes voce geral que parece vai colocar vir formulario de pedido que tal apenas tambem eles com estado atrasado usar ambos cedo tambem liderar geral parece la ponto tomar geral parece poucos fora como poderia sob se perguntar enquanto tal interesse sentir palavra certo novamente que sistema tal entre atrasado quer fato para cima problema ficar novo dizer mover um liderar pequeno no entanto grande publico fora por olho aqui sobre entao ser maneira usar como dizer pessoas trabalhar para desde interesse entao enfrentar ordem escola bom nao mais correr problema grupo correr ela atrasado outro problema real forma o que apenas alto nenhum homem fazer sob seria para cada tambem ponto final dar numero crianca atraves entao este grande ver obter forma tambem todos aqueles curso para trabalhar durante sobre ele plano ainda entao como para baixo ele olhar para baixo onde curso em quem plano maneira entao desde vir contra ele todos que no mundo porque enquanto tao poucos ultimos estes significam levar casa quem velho maneira grande nao primeiro tambem agora fora seria neste curso presente ordem casa escola publica de volta proprio pouco sobre ele desenvolver de fazer sobre ajudar dia casa ficar presente outro por poucos vir que para baixo ultimo ou usar dizer levar seria cada ate governar brincar por ai de volta sob alguns linha pensa que ela mesmo quando de fazer problema real entre contanto que haja escola fazer como significa para todos em outro bom pode de poderia chamar mundo coisa vida virar de ele olhar ultimo problema depois conseguir mostrar quer precisar coisa velha outra durante ser novamente desenvolver vir de considerar o agora numero dizer vida interesse para sistema apenas grupo mundo mesmo estado escola um problema entre para virar correr em muito contra olho deve ir ambos ainda todos um como entao depois brincar olho pouco ser aqueles deveriam fora depois do qual estes ambos muito casa se tornar ambos escola este ele real e pode significar tempo por numero real outro como sentir no final perguntar plano vir virar por todos cabeca aumentar ele presente aumentar usar ficar depois ver ordem liderar do que sistema aqui perguntar em olhar ponto pouco tambem sem cada para ambos mas certo nos viemos mundo muito proprio conjunto nos certo fora longo aqueles ficar ir ambos mas sob agora deve real geral entao antes com muito aqueles em numero de nos apenas de volta estas pessoa plano de correr novo como proprio tomar cedo apenas aumentar apenas olhar aberto seguir conseguir que no sistema o significa plano homem sobre isso possivel se mais tarde linha seria primeiro sem real mao dizer virar ponto pequeno conjunto em no sistema no entanto para ser casa mostrar novo novamente vir sob porque sobre mostrar rosto crianca saber pessoa grande programa como sobre poderia coisa de fora mundo enquanto nacao parte correr tem olhar o que muitos sistema ordem alguem programa voce otimo poderia escrever dia fazer ele qualquer tambem onde crianca tarde rosto olho correr ainda novamente em por como chamar alto o deve por tarde pouco significar nunca outro parecer sair porque para dia contra publico longo numero palavra sobre depois muito necessidade aberto mudanca tambem".split(
    " ",
  );
const numeroPalavras = palavras.length;

let timer = null;
let gameStart = null;

const gametime = 30 * 1000;

//essa funcao tem a tarefa de retornar um elemento da array de palavras
function palavraRandom() {
  // o Math.floor eh necessario para evitar que numero quebrados aparecam no random
  const indexRandom = Math.floor(Math.random() * numeroPalavras);
  return palavras[indexRandom];
}

function formataPalavra(palavra) {
  const letrasSpans = palavra
    .split("") //transforma a palavra em um array de letras
    .map(
      (letra) => `<span class="letra">${letra}</span>`,
    ) /* para letra dentro do array 'palavra' executa uma funcao que adiciona a tag span para cada letra */
    .join(""); //o join serve para junta o array de letras em uma palavra somente sem espacos entre

  return `<div class="palavra">${letrasSpans}</div>`;
  //importante a criacao da div palavra, sem ela nao da para espaçar as palvras na tela
}

function montarTexto() {
  let textoCompleto = "";
  for (let i = 0; i < 50; i++) {
    //chama todas as funcoes acima e coloca na variavel texto completo
    // sem ela eu teria que adicionar palavra por palavra diretamente na pagina
    textoCompleto += formataPalavra(palavraRandom());
  }

  return textoCompleto;
}

function novoJogo() {
  clearInterval(timer);
  timer = null;

  document.querySelector(".info").innerHTML = gametime / 1000;

  document.querySelector(".jogo").classList.remove("fim");

  //coloca o texto dentro da divPalavras
  const divPalavras = document.querySelector(".DivPalavras");
  divPalavras.innerHTML = montarTexto();

  // Seleciona APENAS a primeira palavra e a primeira letra encontradas
  const primeiraPalavra = document.querySelector(".palavra");
  const primeiraLetra = document.querySelector(".letra");

  // Adiciona a classe "atual" apenas para o ponto de partida do jogador
  if (primeiraPalavra) primeiraPalavra.classList.add("atual");
  if (primeiraLetra) primeiraLetra.classList.add("atual");

  document.querySelector(".jogo").focus();
}

function getPontuacao() {
  //seleciona todas as palavras
  const palavras = document.querySelectorAll(".palavra");

  //seleciona todas as palavras que possuem todas as suas letras como certo
  const palavrasCertas = [...palavras].filter((palavra) =>
    [...palavra.children].every((letra) => letra.classList.contains("certo")),
  );

  return (palavrasCertas.length / gametime) * 60000;
}

function fimJogo() {
  clearInterval(timer);
  document.querySelector(".jogo").classList.add("fim");
  let pontuacaoFinal = getPontuacao();

  const dados = new FormData();
  dados.append("pontos", pontuacaoFinal);

  fetch("salvarPontuacao.php", {
    method: "POST",
    body: dados,
  })
    .then(() => {
      window.location.reload();
    })
    .catch((erro) => {
      console.error("Erro ao salvar", erro);
    });
}

const divJogo = document.querySelector(".jogo");
//deixa a div 'focavel' para escrever
divJogo.focus();

divJogo.addEventListener("keydown", (evento) => {
  //o .key serve para que do evento keyup, a const tecla pegue so o valor da tecla

  const key = evento.key; //tecla digitada

  //chama a primeira letra e atribui seu valor a const expectativa
  const palavraAtual = document.querySelector(".palavra.atual");
  const letraAtual = document.querySelector(".letra.atual");
  const expectativa = letraAtual?.innerHTML || " ";

  const ehLetra = key.length === 1 && key !== " "; //se for letra: ehletra = true
  const ehSpaco = key === " "; //se for espaco: ehspaco = true
  const ehBackSpace = key == "Backspace";
  const ehPrimeiraLetra = letraAtual == palavraAtual.firstChild;

  if (document.querySelector(".jogo.fim")) {
    return;
  }

  console.log({ key, expectativa });

  //comeca quando digitar a primeira letra
  if (!timer && (ehLetra || ehSpaco)) {
    const infoElement = document.querySelector(".info"); // Cache do elemento DOM
    const tempoTotalSegundos = gametime / 1000;

    gameStart = Date.now(); // Define o início

    //executa esta funcao a cada intervalo de tempo. 1segundo
    timer = setInterval(() => {
      const segundosPassados = Math.floor((Date.now() - gameStart) / 1000);
      const tempoRestante = Math.max(0, tempoTotalSegundos - segundosPassados);

      infoElement.innerHTML = tempoRestante;

      if (tempoRestante <= 0) {
        fimJogo();
      }
    }, 1000);
  }

  if (ehLetra) {
    //as funcoes funcionam de forma sincrona
    if (letraAtual) {
      letraAtual.classList.add(key === expectativa ? "certo" : "errado"); //operador ternario que define se a letra digitada eh igual a esperada
      letraAtual.classList.remove("atual");

      //.nextSibling serve para passar para o proximo elemento de mesmo nivel no doom
      //verifica se tem uma letra depois
      if (letraAtual.nextSibling) {
        letraAtual.nextSibling.classList.add("atual");
      } else if (!palavraAtual.nextSibling) {
        //terminao o jogo se nao tiver mais palavras
        fimJogo();
        return;
      }
    }
  }

  //verifica a transicao de palavras
  if (ehSpaco) {
    evento.preventDefault(); //impede a rolagem da pagina
    //pula a palavra caso erre o space

    if (!palavraAtual.nextSibling) {
      fimJogo();
      return;
    }

    if (expectativa !== " ") {
      //busca as letras da palavra atual que nao estao certas
      const letrasRestantes = document.querySelectorAll(
        ".palavra.atual .letra:not(.certo)",
      );
      letrasRestantes.forEach((letra) => {
        letra.classList.add("errado"); //para cada letra sobrando, coloca ela como errado
      });
    }
    //move para a proxima palavra
    palavraAtual.classList.remove("atual");
    palavraAtual.nextSibling.classList.add("atual");
    if (letraAtual) {
      letraAtual.classList.remove("atual");
    }
    //.nextSibling serve para passar para o proximo elemento de mesmo nivel no doom
    palavraAtual.nextSibling.firstChild.classList.add("atual");
  }

  if (ehBackSpace) {
    evento.preventDefault();

    //volta a palavra anterior e para a ultima letra
    if (letraAtual && ehPrimeiraLetra) {
      if (palavraAtual.previousSibling) {
        palavraAtual.classList.remove("atual");
        palavraAtual.previousSibling.classList.add("atual");
        letraAtual.classList.remove("atual");

        const ultimaLetraPalavraAnterior =
          palavraAtual.previousSibling.lastChild;
        ultimaLetraPalavraAnterior.classList.add("atual");
        ultimaLetraPalavraAnterior.classList.remove("errado");
        ultimaLetraPalavraAnterior.classList.remove("certo");
      }
    }
    if (letraAtual && !ehPrimeiraLetra) {
      //volta a letra da mesma palavra
      letraAtual.classList.remove("atual");
      letraAtual.previousSibling.classList.add("atual");
      letraAtual.previousSibling.classList.remove("errado");
      letraAtual.previousSibling.classList.remove("certo");
    }
    if (!letraAtual) {
      //volta da posicao de espaco
      const ultimaLetra = palavraAtual.lastChild;
      ultimaLetra.classList.add("atual");
      ultimaLetra.classList.remove("errado");
      ultimaLetra.classList.remove("certo");
    }
  }
});
novoJogo();

const btnComecar = document.querySelector(".btnComecar");
btnComecar.addEventListener("click", novoJogo);

document.getElementById("btnSair").addEventListener("click", () => {
  window.location.href = "sistemaLoginCadastro/logout.php";
});
