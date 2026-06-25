# Mining Game — Sistema de Digitação com Tema de Mineração

Projeto web desenvolvido como trabalho acadêmico para a disciplina de WEB 1 (UFPR). Trata-se de um jogo de digitação com temática de mineração, integrado a um sistema completo de autenticação, ranking global e ligas privadas.

---

## Descrição do Sistema

O jogador assume o papel de um minerador que quebra blocos digitando corretamente as palavras exibidas em cada um deles. A cada palavra digitada corretamente, um bloco é quebrado e o jogador avança na mina. O sistema registra o desempenho de cada partida e disponibiliza rankings globais e por liga.

---

## Funcionalidades

### Autenticação
- Cadastro com nome completo, nickname e senha (armazenada com hash bcrypt)
- Login com verificação segura via `password_verify()`
- Controle de sessão com `$_SESSION`
- Logout com destruição completa da sessão
- Proteção de páginas: usuários não autenticados são redirecionados automaticamente para o login

### Jogo
- 50 blocos divididos em três níveis de dificuldade: fácil (20), médio (15) e difícil (15)
- Palavras com temática de mineração e universo de jogos de sobrevivência
- Animação do personagem ao quebrar blocos
- Cronômetro em tempo real
- Pontuação calculada com base em WPM, precisão e profundidade atingida
- Ao finalizar, os dados da partida são enviados automaticamente ao servidor via `fetch()`

### Ranking Global
- Exibe todos os jogadores ordenados pela soma total de pontos
- Filtro alternável entre **Desde o início** e **Semanal** (semana atual via `YEARWEEK`)

### Sistema de Ligas
- Criação de ligas com nome único e senha opcional (liga aberta ou fechada)
- Entrada em ligas: senha verificada com `password_verify()` para ligas fechadas
- Um usuário pode participar de apenas uma liga privada por vez
- Cada liga possui seu próprio ranking com os mesmos filtros do ranking global
- Saída de liga disponível a qualquer momento

### Histórico de Partidas
- Exibe todas as partidas do usuário logado em ordem cronológica
- Mostra pontos, WPM, precisão e data/hora de cada partida

### Tela de Pontuação
- Exibida automaticamente ao finalizar uma partida
- Mostra os dados da última partida salva no banco

---

## Estrutura do Banco de Dados

### Tabela `usuario`

| Coluna | Tipo | Descrição |
|---|---|---|
| id | INT AUTO_INCREMENT | Chave primária |
| nome | VARCHAR(100) | Nome completo |
| nickname | VARCHAR(50) UNIQUE | Apelido único |
| senha | VARCHAR(255) | Hash da senha |

### Tabela `partida`

| Coluna | Tipo | Descrição |
|---|---|---|
| id | INT AUTO_INCREMENT | Chave primária |
| usuario_id | INT | Referência ao usuário |
| pontos | INT | Pontuação da partida |
| wpm | INT | Palavras por minuto |
| precisao | INT | Percentual de acerto |
| criado_em | DATETIME | Data e hora da partida |

### Tabela `ligas`

| Coluna | Tipo | Descrição |
|---|---|---|
| id | INT AUTO_INCREMENT | Chave primária |
| nome | VARCHAR(100) UNIQUE | Nome da liga |
| senha | VARCHAR(255) | Hash da senha (nullable) |
| criador_id | INT | Referência ao usuário criador |
| criado_em | DATETIME | Data de criação |

### Tabela `liga_membro`

| Coluna | Tipo | Descrição |
|---|---|---|
| usuario_id | INT | Referência ao usuário |
| liga_id | INT | Referência à liga |
| entrou_em | DATETIME | Data de entrada |

---

## Estrutura de Arquivos
