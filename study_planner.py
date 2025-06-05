import pandas as pd
from sklearn.linear_model import LinearRegression
import mysql.connector

# Carrega configuracoes do PHP
from pathlib import Path
import re

CONFIG_PATH = Path('php/conectabanco.php')


def carregar_config():
    host = 'localhost'
    database = 'alimentaia'
    user = 'root'
    password = ''
    if CONFIG_PATH.exists():
        text = CONFIG_PATH.read_text()
        m = re.search(r"\$host\s*=\s*'([^']+)'", text)
        if m:
            host = m.group(1)
        m = re.search(r"\$db\s*=\s*'([^']+)'", text)
        if m:
            database = m.group(1)
        m = re.search(r"\$user\s*=\s*'([^']+)'", text)
        if m:
            user = m.group(1)
        m = re.search(r"\$pass\s*=\s*'([^']*)'", text)
        if m:
            password = m.group(1)
    return dict(host=host, database=database, user=user, password=password)


def carregar_dados(cfg):
    conn = mysql.connector.connect(host=cfg['host'], user=cfg['user'], password=cfg['password'], database=cfg['database'])
    df = pd.read_sql('SELECT Disciplina, Nota, Hora FROM dados', conn)
    conn.close()
    df['Nota'] = pd.to_numeric(df['Nota'], errors='coerce')
    df['Hora'] = pd.to_numeric(df['Hora'], errors='coerce')
    df = df.dropna()
    return df


def treinar_modelos(df):
    modelos = {}
    for disciplina, grupo in df.groupby('Disciplina'):
        if len(grupo) < 2:
            continue
        X = grupo[['Hora']].values
        y = grupo['Nota'].values
        modelo = LinearRegression().fit(X, y)
        modelos[disciplina] = modelo
    return modelos


def recomendar_horas(modelos, disciplina, nota_desejada):
    modelo = modelos.get(disciplina)
    if not modelo or modelo.coef_[0] == 0:
        return None
    horas = (nota_desejada - modelo.intercept_) / modelo.coef_[0]
    return max(horas, 0.0)


if __name__ == '__main__':
    cfg = carregar_config()
    dados = carregar_dados(cfg)
    modelos = treinar_modelos(dados)
    if not modelos:
        print('Base de dados insuficiente para gerar recomendacoes.')
    else:
        disc = input('Disciplina: ').strip()
        try:
            nota_alvo = float(input('Nota desejada: '))
        except ValueError:
            print('Nota invalida.')
        else:
            horas = recomendar_horas(modelos, disc, nota_alvo)
            if horas is None:
                print('Sem dados suficientes para disciplina informada.')
            else:
                print(f'Para obter nota {nota_alvo:.1f} em {disc}, recomenda-se estudar aproximadamente {horas:.2f} horas.')
