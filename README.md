# PROJETOIA
 
ESTE PROEJETO TEM COMO OBJETIVO DISPONIBILIZAR UM ALGORITMO SIMPLES, FOCADO NO APRENDIZADO DE IA PARA ALUNOS, ESTUDANTES DE INFORMÁTICA INDEPENDENTE DO NÍVEL. SERÁ DISPONIBILIZADO ONLINE ATRAVÉS DO GIT, E SEUS RESULTADOS MAPEADOS PARA ESTUDOS FUTUROS.
## Banco de dados

Execute o script `create_database.sql` em seu servidor MySQL para criar o banco `alimentaia` e as tabelas utilizadas pela aplicação.

```
mysql -u root -p < create_database.sql
```

## Chatbot

Um chatbot simples em Python está disponível no arquivo `chatbot.py`. Ele responde perguntas sobre o planejamento de aulas gravado na tabela `planejamento` do banco de dados.

Instale a dependência `mysql-connector-python` e execute o script:

```
pip install mysql-connector-python
python3 chatbot.py
```

Digite `sair` para encerrar a conversa.


## Interface Web

O projeto possui agora uma página inicial `index.html` criada com Bootstrap. Ela permite acessar duas funcionalidades principais:

- **Alimentar IA**: formário disponível em `alimento.php` para registrar novos dados no banco.
- **Chatbot**: interface web em `chatbot.php` para consultar o planejamento de aulas diretamente pelo navegador.

Basta abrir `index.html` em um servidor PHP para utilizar a aplicação.
