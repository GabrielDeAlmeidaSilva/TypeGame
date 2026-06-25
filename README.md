

# TypeGame: Jogo Digitação
## Trabalho Final DS122 - Desenvolvimento Web 1
* Cezar Anthonio
* Christian Santana
* Eduardo Grando
* Gabriel de Almeida Silva
---
## Especificação do trabalho
O trabalho prático envolve a criação de uma aplicação WEB completa. Ou seja, que inclua a implementação de front-end, back-end e que possua integração com um banco de dados, de um jogo de digitação. O objetivo principal do jogo é testar a velocidade e a precisão do usuário ao digitar palavras na tela. O sistema possui as seguintes funcionalidades:

## Funcionalidades
1. **Sistema de Login/Cadastro:** Autenticação de usuários.
2. **Jogo de Digitação:** Mecânica principal de teste de velocidade e precisão.
3. **Histórico de Pontuação:** Registro das melhores pontuações e do último jogo.
4. **Sistema de Ligas Personalizadas:** Criação e participação em ligas/grupos com ranking geral e semanal.

## Tecnologias Utilizadas
* **Front-end:** HTML5, CSS3, JavaScript
* **Back-end:** PHP
* **Banco de Dados:** MySQL

## Demonstração do Projeto

### Gameplay:


https://github.com/user-attachments/assets/9548fef4-7704-48a5-b06e-fb8ce36e3682


### Sistema de Login/Cadastro:


https://github.com/user-attachments/assets/19c2fbd5-a367-4a5c-b3b6-90d0a3259a16


### Sistema de Ligas: 


https://github.com/user-attachments/assets/42a146f0-3791-4dbf-9a46-bb5354533791


---
### Configuração do Banco de Dados
Siga os passos abaixo executando os arquivos via navegador (acessando `http://localhost/sua-pasta-do-projeto/bd/...`):

1. Edite o arquivo `credenciais.php` (localizado na pasta do banco) colocando o usuário e a senha do seu MySQL local.
2. Acesse o arquivo `mysqli_criar_db.php` para criar o Banco de Dados.
3. Acesse o arquivo `mysqli_criar_tables.php` para criar as tabelas necessárias.
4. Acesse o arquivo `mysqli_inserir_valores.php` para inserir valores iniciais de teste.

**Observação:** Em caso de problema ou se precisar reiniciar o banco do zero, acesse o arquivo `mysqli_reset_db.php`. Ele deletará o banco de dados e o criará novamente (após isso, repita os passos 3 e 4).
