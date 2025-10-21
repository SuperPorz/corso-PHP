from flask import Flask, jsonify, request
import mysql.connector as db
from flask_cors import CORS


app = Flask(__name__)
CORS(app)

connection = db.connect(
    host="127.0.0.1",
    port=3306,
    user="root",
    password="",
    database="php_lez18"
)

cursor = connection.cursor()
cursor.execute("SELECT * FROM notizie") 
rows = cursor.fetchall()

notizie_json = [
    {
        "id": row[0],
        "titolo": row[1],
        "testo": row[2]
    }
    for row in rows
]

@app.route('/notizie')
def notizie():
    return jsonify(notizie_json)


# Avvio dell'app
if __name__ == '__main__':
    app.run(debug=True)