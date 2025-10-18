from flask import Flask, request, jsonify
from sqlalchemy import text, create_engine
from flask_cors import CORS
from datetime import datetime
import traceback

app = Flask(__name__)
CORS(app)

# Connessione al database "recupero03" di XAMPP
try:
    engine = create_engine('mysql+pymysql://root:@localhost:3306/recupero03')
    print("✅ Connessione al database creata")
except Exception as e:
    print("❌ Errore connessione database:", e)
    engine = None

# Rotta API che cerca le provvigioni NULL, le calcola e le inserisce nel DB
@app.get('/api/provvigioni')
def calcola_provvigioni():
    """Endpoint che calcola effettivamente le provvigioni"""
    try:
        with engine.connect() as conn:
            # Query 1: Update
            query1 = text("""
                UPDATE vendite 
                SET provvigione = ROUND(importo * 0.10, 2)
                WHERE provvigione IS NULL OR provvigione = 0
            """)
            conn.execute(query1)
            
            # ACOMMIT DELLE MODIFICHE
            conn.commit()
            
            # Query 2: Conta record aggiornati
            count_query = text("SELECT ROW_COUNT()")
            count_result = conn.execute(count_query)
            row = count_result.fetchone()
            updated_count = row[0] if row else 0
            
            # Query 3: Seleziona record aggiornati
            query2 = text("""
                SELECT idv, agente, importo, provvigione
                FROM vendite 
                WHERE ABS(provvigione - (importo * 0.10)) < 0.01
                AND importo > 0
                ORDER BY idv DESC
                LIMIT 10
            """)
            result2 = conn.execute(query2)
            data = [dict(row._mapping) for row in result2]
            
            return jsonify({
                'success': True,
                'records_aggiornati': updated_count,
                'ultimi_record': data,
                'timestamp': datetime.now().isoformat()
            })
            
    except Exception as e:
        print("❌ ERRORE COMPLETO:")
        print(traceback.format_exc())
        return jsonify({
            'success': False,
            'error': str(e)
        }), 500


@app.get('/api/vendite')
def vendite_registrate():
    """Endpoint che restituisce tutte le vendite"""
    try:
        if not engine:
            return jsonify({'success': False, 'error': 'Database non connesso'}), 500
            
        with engine.connect() as conn:
            query = text("SELECT * FROM vendite")
            result = conn.execute(query)
            data = [dict(row) for row in result.mappings()]
            
            return jsonify({
                'success': True,
                'vendite': data,
                'count': len(data),
                'timestamp': datetime.now().isoformat()
            })
    except Exception as e:
        print("❌ ERRORE in /api/vendite:")
        print(traceback.format_exc())
        return jsonify({
            'success': False,
            'error': str(e)
        }), 500

if __name__ == '__main__':
    app.run(host='127.0.0.1', port=5000, debug=True)