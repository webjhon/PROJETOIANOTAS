import mysql.connector
from datetime import datetime

DB_CONFIG = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'alimentaia'
}

HELP_MSG = (
    "Digite uma pergunta sobre o planejamento das aulas.\n"
    "Por exemplo: 'Qual o planejamento de Matemática?'\n"
    "Digite 'sair' para encerrar."
)

def buscar_planejamento(disciplina: str):
    """Recupera do banco os planejamentos da disciplina informada."""
    conn = mysql.connector.connect(**DB_CONFIG)
    cur = conn.cursor(dictionary=True)
    query = ("SELECT data, conteudo FROM planejamento "
             "WHERE disciplina LIKE %s ORDER BY data")
    cur.execute(query, (f"%{disciplina}%",))
    resultados = cur.fetchall()
    cur.close()
    conn.close()
    return resultados

def responder_pergunta(pergunta: str):
    pergunta_lower = pergunta.lower()
    if 'planejamento' in pergunta_lower or 'aula' in pergunta_lower:
        palavras = pergunta_lower.split()
        disciplina = None
        for palavra in palavras:
            if palavra in {'matemática', 'português', 'informática'}:
                disciplina = palavra
                break
        if not disciplina:
            disciplina = input('Sobre qual disciplina? ').strip().lower()
        planos = buscar_planejamento(disciplina)
        if not planos:
            return 'Nenhum planejamento encontrado.'
        linhas = [
            f"{datetime.strptime(str(p['data']), '%Y-%m-%d').strftime('%d/%m/%Y')}: {p['conteudo']}"
            for p in planos
        ]
        return '\n'.join(linhas)
    return 'Desculpe, não entendi a pergunta.'

def main():
    print('Chatbot do Planejamento de Aulas')
    print(HELP_MSG)
    while True:
        pergunta = input('Você: ').strip()
        if pergunta.lower() in {'sair', 'exit', 'quit'}:
            print('Chatbot: Até logo!')
            break
        resposta = responder_pergunta(pergunta)
        print('Chatbot:', resposta)

if __name__ == '__main__':
    main()

