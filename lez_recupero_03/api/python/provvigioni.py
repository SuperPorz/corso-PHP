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
            
            # PRIMA: Seleziona gli ID dei record che hanno provvigione NULL
            # (questi sono quelli che verranno aggiornati)
            query_select_ids = text("""
                SELECT idv
                FROM vendite 
                WHERE provvigione IS NULL OR provvigione = 0
            """)
            result_ids = conn.execute(query_select_ids)
            ids_da_aggiornare = [row.idv for row in result_ids]
            
            if not ids_da_aggiornare:
                return jsonify({
                    'success': True,
                    'ultimi_record': [],
                    'record_aggiornati': 0,
                    'timestamp': datetime.now().isoformat()
                })
            
            # POI: Fai l'UPDATE
            query_update = text("""
                UPDATE vendite 
                SET provvigione = ROUND(importo * 0.10, 2)
                WHERE provvigione IS NULL OR provvigione = 0
            """)
            conn.execute(query_update)
            
            # COMMIT
            conn.commit()
            
            # INFINE: Seleziona SOLO i record che hai appena aggiornato
            placeholders = ','.join([':id' + str(i) for i in range(len(ids_da_aggiornare))])
            query_select = text(f"""
                SELECT idv, agente, data, importo, provvigione
                FROM vendite 
                WHERE idv IN ({placeholders})
                ORDER BY idv DESC
            """)
            
            params = {f'id{i}': id_val for i, id_val in enumerate(ids_da_aggiornare)}
            result_select = conn.execute(query_select, params)
            data = [dict(row._mapping) for row in result_select]
            
            return jsonify({
                'success': True,
                'ultimi_record': data,
                'record_aggiornati': len(ids_da_aggiornare),
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