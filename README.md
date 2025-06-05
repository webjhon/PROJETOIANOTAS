# PROJETOIA

Este projeto coleta dados de estudantes para analisar quanto tempo de estudo foi necessario para alcancar determinadas notas. A base de dados eh alimentada pelo formulario em `alimento.php`.

Foi adicionado o script `study_planner.py` que consulta o banco de dados MySQL, ajusta um modelo de regressao linear por disciplina e sugere quantas horas de estudo sao recomendadas para atingir uma nota alvo.

## Como usar o planejador

1. Instale as dependencias em um ambiente Python: `pip install pandas scikit-learn mysql-connector-python`.
2. Configure o acesso ao banco em `php/conectabanco.php` e no script Python se necessario.
3. Execute: `python3 study_planner.py` e siga as instrucoes.
