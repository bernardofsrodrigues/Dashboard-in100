from flask import Flask, request, render_template
import pandas as pd
import requests
from mysql.connector import connect
from datetime import datetime
import time
import json

app = Flask(__name__, template_folder="../../templates/", static_folder="../static/")

def mysql_connection(host, user, passwd, database):
    connection = connect(
        host=host,
        user=user,
        passwd=passwd,
        database=database
    )
    return connection

def consultar_api(df):
    host = '191.252.157.162'
    user = 'sa'
    passwd = 'Triang@31'
    database = 'inmaster'

    connection = mysql_connection(host, user, passwd, database)

    resultados = []

    for index, row in df.iterrows():
        cpf_cliente = row['cpf']
        matricula_cliente = row['numeroMatricula']

        token = obter_token()
        resultado_consulta = consultar_in100(token, cpf_cliente, matricula_cliente)

        if resultado_consulta is not None:
            resultados.append({'cpf': cpf_cliente, 'nome': resultado_consulta.get('nome', '')})

        atualizar_registro(connection, cpf_cliente, resultado_consulta)

    connection.close()

    return resultados

def obter_token():
    url = "https://api-parceiro.bancomaster.com.br/token"
    payload = json.dumps({
        "usuario": "35042619000143",
        "senha": "?1JxZ75bkH/(<O2v"
    })
    headers = {
        'Content-Type': 'application/json'
    }
    response = requests.request("POST", url, headers=headers, data=payload)
    resposta_token = json.loads(response.text)
    return resposta_token.get('accessToken', None)

def consultar_in100(token, cpf, matricula):
    url = "https://api-parceiro.bancomaster.com.br/consignado/v3/in100-online/"
    payload = json.dumps({
        "cpf": cpf,
        "matricula": matricula,
        "celular": "1199999999",
        "cdAutorizacao": "1"
    })
    headers = {
        'Content-Type': 'application/json',
        'Authorization': f'Bearer {token}'
    }
    response = requests.request("POST", url, headers=headers, data=payload)
    if response.status_code == 200:
        return json.loads(response.text)
    else:
        return None

def atualizar_registro(connection, cpf, resultado_consulta):
    cursor = connection.cursor()
    query = "UPDATE in100master SET sit = 1,"

    set_clauses = []

    for key, value in resultado_consulta.items():
        if value:
            if isinstance(value, str):
                set_clause = f"{key} = '{value}'"
            else:
                set_clause = f"{key} = {value}"
            set_clauses.append(set_clause)

    query += ", ".join(set_clauses)

    query += f" WHERE cpf = '{cpf}'"

    cursor.execute(query)
    connection.commit()
    cursor.close()

@app.route('/')
def index():
    return render_template('login.html')

@app.route('/consultar', methods=['POST'])
def consultar():
    file = request.files['file']
    if file:
        df = pd.read_excel(file)
        
        resultados = consultar_api(df)
        
        return render_template('index.html', resultados=resultados)
    else:
        return "Erro: Arquivo não enviado."

if __name__ == '__main__':
    app.run(debug=True)
