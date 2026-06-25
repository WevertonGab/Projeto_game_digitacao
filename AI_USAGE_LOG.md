Relatório de Uso de Inteligência Artificial Generativa

Este documento registra todas as interações significativas com ferramentas de IA generativa durante o desenvolvimento deste projeto. O objetivo é promover o uso ético e transparente da IA como ferramenta de apoio, e não como substituta para a compreensão dos conceitos fundamentais.

Política de Uso
O uso de IA foi permitido para as seguintes finalidades:
- Geração de ideias e brainstorming de algoritmos.
- Explicação de conceitos complexos.
- Geração de código boilerplate.
- Sugestões de refatoração e otimização de código.
- Debugging e identificação de causas de erros.
- Geração de casos de teste.

É proibido submeter código gerado por IA sem compreendê-lo completamente e sem adaptá-lo ao projeto. Todo trecho de código influenciado pela IA deve ser referenciado neste log.

---

Registro de Interações

Interação 1

- Data: Junho/2025
- Etapa do Projeto: Banco de Dados
- Ferramenta de IA Utilizada: Claude (Anthropic)
- Objetivo da Consulta: Entender como estruturar o banco de dados MySQL para o sistema de login, partidas e ligas do jogo de digitação.
- Prompt(s) Utilizado(s):
  1. "Vamos desenvolver um sistema de login e rank/ligas em PHP para um sistema de game de digitação HTML, CSS e JS"
  2. "O banco de dados deve ter tabelas para usuário, partida, ligas e membros de liga"
- Resumo da Resposta da IA:
  A IA explicou os conceitos de tipos de dados (INT, VARCHAR, DATETIME), chaves primárias, AUTO_INCREMENT, UNIQUE e Foreign Keys. Guiou a criação das quatro tabelas do projeto: `usuario`, `partida`, `ligas` e `liga_membro`, explicando o propósito de cada coluna e constraint.
- Análise e Aplicação:
  O aluno montou cada comando SQL de forma incremental, com a IA apenas explicando os conceitos e corrigindo erros de sintaxe. O código final do banco foi escrito pelo aluno após compreender cada parte.
- Referência no Código: Script SQL de criação do banco `miningdb`.

---

Interação 2

- Data: Junho/2025
- Etapa do Projeto: Sistema de Login e Cadastro (PHP)
- Ferramenta de IA Utilizada: Claude (Anthropic)
- Objetivo da Consulta: Compreender como conectar PHP ao MySQL e implementar cadastro seguro com hash de senha e prepared statements.
- Prompt(s) Utilizado(s):
  1. "O que é PDO e mysqli? Qual a diferença?"
  2. "O que é password_hash e como funciona?"
  3. "O que são prepared statements e por que são mais seguros?"
- Resumo da Resposta da IA:
  A IA explicou a diferença entre mysqli e PDO, o conceito de hash de mão única com `password_hash()` e `password_verify()`, e como prepared statements protegem contra SQL Injection usando `?` como placeholder separando SQL dos dados.
- Análise e Aplicação:
  O aluno montou os arquivos `config.php`, `conexao.php` e `cadastro.php` progressivamente, testando cada etapa. A IA corrigiu erros de sintaxe e lógica (como o `else` fora do bloco POST e o `$` indevido antes de nomes de função), mas o código foi escrito pelo aluno.
- Referência no Código: `config.php`, `conexao.php`, `cadastro.php`

---

Interação 3

- Data: Junho/2025
- Etapa do Projeto: Sistema de Login e Sessões (PHP)
- Ferramenta de IA Utilizada: Claude (Anthropic)
- Objetivo da Consulta: Entender como funciona `$_SESSION` no PHP e implementar login seguro com verificação de senha e controle de sessão.
- Prompt(s) Utilizado(s):
  1. "O que é sessão no PHP e como funciona?"
  2. "Como verificar a senha com password_verify no login?"
  3. "Cookies salvam que o usuário está conectado? Quando ele é desconectado?"
- Resumo da Resposta da IA:
  A IA explicou o funcionamento de `session_start()`, `$_SESSION` como "mochila" do servidor, e o comportamento de cookies de sessão (apagados ao fechar o navegador). Explicou também a diferença entre `session_unset()` e `session_destroy()` para o logout.
- Análise e Aplicação:
  O aluno implementou `login.php`, `logout.php` e `verifica_login.php` com base nas explicações, compreendendo a lógica antes de escrever o código.
- Referência no Código: `login.php`, `logout.php`, `verifica_login.php`

---

Interação 4

- Data:Junho/2025
- Etapa do Projeto: Integração JS com PHP (fetch e salvar partida)
- Ferramenta de IA Utilizada: Claude (Anthropic)
- Objetivo da Consulta: Entender como enviar dados do JavaScript para o PHP sem recarregar a página, para salvar a pontuação ao final do jogo.
- Prompt(s) Utilizado(s):
  1. "Como o fetch funciona no JavaScript?"
  2. "Como o PHP recebe dados JSON enviados pelo fetch?"
  3. "Como responder com JSON no PHP?"
- Resumo da Resposta da IA:
  A IA explicou o conceito de requisição assíncrona com `fetch()`, o uso de `JSON.stringify()` no JS e `json_decode(file_get_contents("php://input"), true)` no PHP para receber os dados, e `json_encode()` para responder. Explicou também o encadeamento de `.then()` para tratar a resposta.
- Análise e Aplicação:
  O aluno implementou o bloco de `fetch` no `game.js` e o arquivo `salvar_partida.php`, compreendendo o fluxo completo de comunicação entre frontend e backend.
- Referência no Código: `game.js` (bloco `if (contador >= 50)`), `salvar_partida.php`

---

Interação 5

- Data: Junho/2025
- Etapa do Projeto: Sistema de Ligas e Rank (PHP + MySQL)
- Ferramenta de IA Utilizada: Claude (Anthropic)
- Objetivo da Consulta: Entender como construir queries SQL com JOIN e GROUP BY para montar rankings, e implementar o sistema completo de criação e entrada em ligas.
- Prompt(s) Utilizado(s):
  1. "Como funciona JOIN no SQL?"
  2. "Como filtrar por semana atual no MySQL com YEARWEEK?"
  3. "Como pegar o ID do último INSERT no PHP com mysqli_insert_id?"
- Resumo da Resposta da IA:
  A IA explicou o conceito de JOIN para combinar tabelas, GROUP BY com SUM para rankings, a função YEARWEEK para filtro semanal, e mysqli_insert_id para obter o ID gerado após um INSERT — usado para inserir o criador automaticamente como membro da liga recém-criada.
- Análise e Aplicação:
  O aluno montou os arquivos `ligas.php`, `criar_liga.php`, `entrar_liga.php` e `sair_liga.php` progressivamente, escrevendo e corrigindo o código com orientação da IA sobre os conceitos envolvidos.
- Referência no Código: `ligas.php`, `criar_liga.php`, `entrar_liga.php`, `sair_liga.php`

---

---

Interação 6

- Data: Maio/2026
- Etapa do Projeto: Planejamento inicial do jogo
- Ferramenta de IA Utilizada: ChatGPT
- Objetivo da Consulta: Organizar a ideia do projeto e estruturar como funcionaria o jogo de digitação com tema de mineração, além de pensar na divisão das funcionalidades do sistema.
- Prompt(s) Utilizado(s):
  1. Conversas sobre a mecânica de digitação, quebra dos blocos, pontuação, cronômetro, histórico de partidas e sistema de ranking.
- Resumo da Resposta da IA: A IA ajudou a organizar a ideia do projeto em partes mais claras, separando mecânica do jogo, sistema de palavras, cronômetro, pontuação, histórico e ranking.
- Análise e Aplicação: A IA não foi usada para implementar o projeto, mas para ajudar a pensar melhor na divisão das etapas e no que precisaria ser desenvolvido primeiro.
- Referência no Código: Estrutura geral do projeto e separação das telas e funcionalidades principais do sistema.

---

 Interação 7

- Data: Maio/2026
- Etapa do Projeto: Estudo de PHP e aplicação no sistema
- Ferramenta de IA Utilizada: ChatGPT
- Objetivo da Consulta: Entender conceitos de PHP ligados a segurança, requisições e exibição de dados.
- Prompt(s) Utilizado(s):
  1. "Para que serve htmlspecialchars?"
  2. "Para que serve prepared statement?"
  3. "Diferença entre echo '$variavel' e echo \"$variavel\""
  4. "O que seria SQL Injection e XSS?"
- Resumo da Resposta da IA: A IA explicou o fluxo de uma aplicação web desde a requisição do navegador até a resposta do servidor, o uso de `htmlspecialchars()`, prepared statements, diferença entre aspas simples e duplas no `echo`, e superglobais como `$_POST`, `$_GET` e `$_SESSION`.
- Análise e Aplicação: A interação ajudou a entender a parte teórica por trás do que estava sendo desenvolvido, especialmente formulários, login, sessões e segurança no sistema.
- Referência no Código: Partes do projeto relacionadas a formulários, autenticação, sessões e exibição de dados do usuário.

---

 Interação 8

- Data: Maio/2026
- Etapa do Projeto: Banco de dados e segurança das consultas
- Ferramenta de IA Utilizada: ChatGPT
- Objetivo da Consulta: Entender como funcionam os prepared statements em PHP com MySQLi, principalmente `prepare()`, `bind_param()` e `execute()`.
- Prompt(s) Utilizado(s):
  1. "Explique esse código"
  2. "O que dessa linha é padrão e o que pode ser mudado?"
- Resumo da Resposta da IA: A IA explicou que `prepare()` cria a consulta com placeholders, `bind_param()` associa variáveis reais e `execute()` envia ao banco. Explicou os tipos do `bind_param()` como `"i"` para inteiro e `"s"` para string.
- Análise e Aplicação: A explicação ajudou a compreender melhor a ligação entre PHP e banco de dados, importante para login, salvamento de partidas, histórico, ranking e ligas.
- Referência no Código: Arquivos PHP que utilizam `mysqli_prepare`, `mysqli_stmt_bind_param` e `mysqli_stmt_execute`.

---

 Interação 9

- Data: Maio/2026
- Etapa do Projeto: Manipulação de elementos da interface
- Ferramenta de IA Utilizada: ChatGPT
- Objetivo da Consulta: Tirar dúvidas sobre como manipular elementos visuais da tela com JavaScript e CSS, principalmente divs e blocos do jogo.
- Prompt(s) Utilizado(s):
  1. "Como remover um bloco completamente da tela?"
  2. "Tem como diminuir o tamanho de uma div pelo JS?"
  3. "Como possibilitar o overflow em uma div?"
- Resumo da Resposta da IA: A IA explicou como remover elementos do DOM, alterar largura, altura e borda via JavaScript e controlar `overflow` em CSS.
- Análise e Aplicação: Útil na construção da interface da mina, especialmente para adaptar os blocos da tela, remover elementos e ajustar tamanhos dinamicamente.
- Referência no Código: Parte visual da mina, blocos de digitação e manipulação dinâmica de elementos da interface.

---

### Interação 10

- Data: Maio/2026
- Etapa do Projeto: Parte visual do jogo
- Ferramenta de IA Utilizada: ChatGPT
- Objetivo da Consulta: Tirar dúvidas sobre cores, gradientes e detalhes visuais da interface.
- Prompt(s) Utilizado(s):
  1. "Como fazer um gradiente em CSS?"
  2. "Como personalizar o ícone exibido na aba do navegador?"
- Resumo da Resposta da IA: A IA explicou como utilizar valores RGB, montar gradientes em CSS e configurar o favicon da aplicação.
- Análise e Aplicação: Ajudou na identidade visual do projeto, deixando a interface mais próxima do estilo desejado para o jogo.
- Referência no Código: Arquivos de estilo da interface e configuração visual da aplicação.

---

### Interação 11

- Data: Junho/2026
- Etapa do Projeto: Versionamento do projeto com GitHub
- Ferramenta de IA Utilizada: ChatGPT
- Objetivo da Consulta: Entender por que o `git push` não estava funcionando ao conectar a pasta local ao repositório remoto.
- Prompt(s) Utilizado(s):
  1. Envio do erro exibido no terminal ao executar `git push origin main`.
- Resumo da Resposta da IA: A IA explicou que o erro ocorreu porque o repositório remoto já possuía commits e a branch local estava atrás da remota, explicando o significado do erro de non-fast-forward.
- Análise e Aplicação: A interação foi importante para entender o funcionamento do Git em vez de apenas repetir comandos sem saber o motivo do erro.
- Referência no Código: Repositório Git do projeto e processo de envio das alterações para o GitHub.

---

Interação 12

- Data: Junho/2026
- Etapa do Projeto: Configuração do ambiente local
- Ferramenta de IA Utilizada: ChatGPT
- Objetivo da Consulta: Confirmar o endereço padrão do MySQL no XAMPP para revisar a configuração da conexão do projeto com o banco de dados.
- Prompt(s) Utilizado(s):
  1. Pergunta direta sobre o endereço do MySQL no XAMPP.
- Resumo da Resposta da IA: A IA explicou que o host padrão no XAMPP é `localhost` e relacionou isso à configuração usada no arquivo de conexão PHP.
- Análise e Aplicação:Útil para revisar a configuração do ambiente local e garantir que a conexão com o banco de dados estivesse correta durante os testes.
- Referência no Código: Arquivo `config.php` e ambiente local do projeto.

---
