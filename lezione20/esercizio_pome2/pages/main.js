function leggiCane( id ) {
    fetch( 'http://localhost/corso-PHP/lezione20/esercizio_pome2/api/cani/' + id )
    .then( response => response.json() )
    .then( data => {
        alert( JSON.stringify( data ) );
    })
    .catch( error => {
        console.error( 'Errore:', error );
    });
}

function eliminaCane(id) {
  fetch("http://localhost/corso-PHP/lezione20/esercizio_pome2/api/cani/" + id, {
    method: "DELETE",
  })
    .then((response) => response.json())
    .then((data) => {
      alert(JSON.stringify(data));
    })
    .catch((error) => {
      console.error("Errore:", error);
    });
}

function inserisciCane() {
    // Recupera i valori dai campi con ID corretti
    const nome = document.getElementById('nome-post').value;
    const data_n = document.getElementById('data_n-post').value;
    
    // Validazione base
    if (!nome || !data_n) {
        alert('Compila tutti i campi!');
        return;
    }
    
    // Prepara i dati da inviare
    const dati = {
        nome: nome,
        data_n: data_n
    };
    
    // Effettua la richiesta POST
    fetch('http://localhost/corso-PHP/lezione20/esercizio_pome2/api/cani', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dati)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Risposta:', data);
        
        // Mostra il risultato
        if (data.success) {
            alert('✅ ' + data.success);
            // Pulisci i campi
            document.getElementById('nome-post').value = '';
            document.getElementById('data_n-post').value = '';
            // Ricarica la tabella per mostrare il nuovo cane
            caricaElencoCani();
        } else if (data.error) {
            alert('❌ Errore: ' + data.error);
        } else {
            alert('Cane inserito! Risposta: ' + JSON.stringify(data));
            caricaElencoCani();
        }
    })
    .catch(error => {
        console.error('Errore:', error);
        alert('❌ Errore durante l\'inserimento: ' + error.message);
    });
}

////////////////////////////////////////////////////////////////////////////

// Carica l'elenco dei cani all'avvio della pagina
window.onload = function() {
    caricaElencoCani();
};

function caricaElencoCani() {
    fetch('http://localhost/corso-PHP/lezione20/esercizio_pome2/api/cani')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('tabella-cani');
            
            // Pulisci la tabella
            tbody.innerHTML = '';
            
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="3">Nessun cane nel database</td></tr>';
                return;
            }
            
            // Aggiungi una riga per ogni cane
            data.forEach(cane => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${cane.id}</td>
                    <td>${cane.nome}</td>
                    <td>${cane.data_n}</td>`;
                tbody.appendChild(tr);
            });
        })
        .catch(error => {
            console.error('Errore nel caricamento dei cani:', error);
            alert('❌ Errore nel caricamento dei cani');
        });
}

// Funzione per PUT dai form separati
function modificaCanePUT() {
    const id = document.getElementById('id-put').value;
    const nome = document.getElementById('nome-put').value;
    const data_n = document.getElementById('data_n-put').value;
    
    if (!id || !nome || !data_n) {
        alert('❌ PUT richiede tutti i campi compilati!');
        return;
    }
    
    const dati = {
        id: id,
        nome: nome,
        data_n: data_n
    };
    
    fetch('http://localhost/corso-PHP/lezione20/esercizio_pome2/api/cani/' + id, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dati)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('✅ ' + data.success);
            // Pulisci i campi
            document.getElementById('id-put').value = '';
            document.getElementById('nome-put').value = '';
            document.getElementById('data_n-put').value = '';
            // Ricarica la tabella
            caricaElencoCani();
        } else if (data.error) {
            alert('❌ Errore: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Errore:', error);
        alert('❌ Errore durante la modifica: ' + error.message);
    });
}

// Funzione per PATCH dai form separati
function modificaCanePATCH() {
    const id = document.getElementById('id-patch').value;
    const nome = document.getElementById('nome-patch').value;
    const data_n = document.getElementById('data_n-patch').value;
    
    if (!id) {
        alert('❌ ID obbligatorio!');
        return;
    }
    if (!nome && !data_n) {
        alert('❌ PATCH richiede almeno un campo da modificare!');
        return;
    }
    
    const dati = { id: id };
    
    if (nome) dati.nome = nome;
    if (data_n) dati.data_n = data_n;
    
    fetch('http://localhost/corso-PHP/lezione20/esercizio_pome2/api/cani/' + id, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dati)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('✅ ' + data.success);
            // Pulisci i campi
            document.getElementById('id-patch').value = '';
            document.getElementById('nome-patch').value = '';
            document.getElementById('data_n-patch').value = '';
            // Ricarica la tabella
            caricaElencoCani();
        } else if (data.error) {
            alert('❌ Errore: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Errore:', error);
        alert('❌ Errore durante la modifica: ' + error.message);
    });
}