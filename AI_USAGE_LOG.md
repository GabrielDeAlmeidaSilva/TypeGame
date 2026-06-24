---

## Registro de Interações

### Interação 1

- **Data:** 23/06/2026
- **Etapa do Projeto:** 1 - Front das ligas
- **Ferramenta de IA Utilizada:** Gemini
- **Objetivo da Consulta:** Geração do CSS da tela 'Ligas'

- **Prompt(s) Utilizado(s):**
  1. "Estamos fazendo um jogo de digitação, pique mokeyType. segue o código da tela ligas.php. Faça o CSS da tela, afim desta ficar como o protótipo anexado. Use flex-box para organização das divs e evite complicações. O código: (...)"
  2. "anexei uma imagem protótipo que fizemos no Figma"

- **Resumo da Resposta da IA:**
  Ela fez exatamente como o protótipo.
- **Análise e Aplicação:**
  No protótipo não consta a posição de cada jogador (1, 2, ...) e a IA fez como tal, terei que tornar visível o marcador de lista ordenada ou usar JS. As cores e a fonte não são as mesmas das que utilizamos no projeto, mas ela apenas seguiu o protótipo (que estava com as cores erradas) e sugeriu a fonte 'Courier New' por ser uma monospace semelhante a do MonkeyType.

- **Referência no Código:**
  Praticamente todo o CSS do sistema de ligas e do rank global
---

### Interação 2

- **Data:** ---
- **Etapa do Projeto:** começo da criacao do jogo
- **Ferramenta de IA Utilizada:** Gemini
- **Objetivo da Consulta:** Sugestão de melhoria

- **Prompt(s) Utilizado(s):**
  utilizei o pre-promt disponivel, e mandei os arquivos do jogo pedindo sugestão de melhoria.
- **Resumo da Resposta da IA:**
  ela disse que do jeito que estava o codigo adicionaria palavra por palavra diretamente na pagina, e isso poderia causar problemas futuros, Complementou falando que adicionar uma função para isso deixaria o codigo mais modular.
- **Análise e Aplicação:**
  Achei valida a sugestão e criei a funcao montarTexto, que tem o objetivo de montar o texto para o jogo e retornar o textoCompleto.
- **Referência no Código:**
  A funcao MontarTexto dentro do script do jogo.

---

### Interação 3

- **Data:** ---
- **Etapa do Projeto:** criacao do jogo
- **Ferramenta de IA Utilizada:** Gemini
- **Objetivo da Consulta:** correcao de bug

- **Prompt(s) Utilizado(s):**
  mandei os arquivos do jogo, e perguntei sobre um bug, onde quando eu apertava Backspace a tela saia para a de login
- **Resumo da Resposta da IA:**
  ela foi bem direta e disse que primeiro eu deveria deixar a div onde eu guardo o texto brevemente focada utilizando o .focus();. e depois falou que se não desse certo o .preventDefault(); dentro da parte que verifica o backspace, resolveria o problema.
- **Análise e Aplicação:**
  primeiro eu testei o .focus(); na minha divJogo, mas acabou não funcionando. Depois de um tempo com a ia insistindo que o problema era o jeito que eu usava o foco, ela sugeriu usar o .preventDefault(); dentra da parte que verifica backspace, e essa soluçao acabou funcionando.
- **Referência no Código:**
  o .focus() no codigo e o .preventDefault(); dentro do codigo.

### Interação 4

- **Data:** ---
- **Etapa do Projeto:** persistencia de dados de pontuacao com o php
- **Ferramenta de IA Utilizada:** Gemini
- **Objetivo da Consulta:** encontar uma maneira de fazer uma requisao post para o salvarPontuacao pelo js.

- **Prompt(s) Utilizado(s):**
  utilizei o pre-promt disponivel, e mandei os arquivos do jogo perguntando maneiras de como mandar o conteudo do pontuacaoFinal para o salvarPontuacao.php
- **Resumo da Resposta da IA:**
  disse para usar fetch API com JSON no JavaScript para enviar os dados de forma assíncrona para um novo arquivo PHP,e me deu um examplo de como funciona
- **Análise e Aplicação:**
  Acabei não usando esse metodo, pq no exemplo ele convertia os dados para JSON, e eu achei desnecessario. Pedi para ele me mostrar um exemplo com formData(); e fetch, e eu acabei usando esse metodo.
- **Referência no Código:**
  A funcionalidade do formData e do fetch na funcao fimJogo();
