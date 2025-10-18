"use-strict"

let pollingInterval;
let ultimiRecordAggiornati = [];

// Aspetta 5 secondi prima del primo polling
window.addEventListener("load", (e) => {
    setTimeout(() => {
        pollingInterval = setInterval(getProvvigioni, 30 * 1000);
    }, 10000); // 10 secondi di delay iniziale
});

const getProvvigioni = async () => {
    let path = "http://localhost:5000/api/provvigioni";
    try {
        const response = await axios.get(path);
        console.log("Dati provvigioni:", response.data);

        if (response.data.records_aggiornati > 0) {
            console.log(`${response.data.records_aggiornati} record aggiornati`);
            
            if (response.data.ultimi_record && response.data.ultimi_record.length > 0) {
                ultimiRecordAggiornati = response.data.ultimi_record.map(record => record.idv);
                
                // AGGIORNA TUTTA LA TABELLA
                await aggiornaTabellaCompleta();
                evidenziaRecordAggiornati();
            }
        }
    }
    catch(error) {
        console.log("Errore:", error);
    }
}

const evidenziaRecordAggiornati = () => {
    // Rimuovi evidenziazione precedente
    document.querySelectorAll('.record-aggiornato').forEach(riga => {
        riga.classList.remove('record-aggiornato');
    });
    
    // Applica evidenziazione ai nuovi record
    ultimiRecordAggiornati.forEach(id => {
        const riga = document.querySelector(`tr[data-id="${id}"]`);
        if (riga) {
            riga.classList.add('record-aggiornato');
        }
    });
}

const aggiornaTabellaCompleta = async () => {
    try {
        // Ottieni tutti i dati aggiornati
        const response = await axios.get("http://localhost:5000/api/vendite");
        const vendite = response.data.vendite;
        
        // Aggiorna tutte le righe della tabella
        vendite.forEach(vendita => {
            const riga = document.querySelector(`tr[data-id="${vendita.idv}"]`);
            if (riga) {
                // Aggiorna tutte le celle
                riga.cells[0].textContent = vendita.idv;
                riga.cells[1].textContent = vendita.agente;
                riga.cells[2].textContent = vendita.data;
                riga.cells[3].textContent = `${vendita.importo} €`;
                riga.cells[4].textContent = `${vendita.provvigione || '-'} €`;
            }
        });
        
        console.log("✅ Tabella completamente aggiornata");
    } catch (error) {
        console.log("Errore nell'aggiornamento tabella:", error);
    }
}


// STEP 4: costruzione tabella
/* const buildTable = (data) => {

    let container = document.querySelector("#table-container");
    let table = document.createElement('table');
    container.append(table);

    let tr = document.createElement("tr");
    table.append(tr);

    let isFirstTime = true;

    for(const currentObject of data.data)
    {
        console.log(currentObject);

        let trn = document.createElement("tr");
        table.append(trn);
        
        for(const currentProperty in currentObject)
        {
        if(isFirstTime === true)
        {
            let thTable = document.createElement('th');
            thTable.innerHTML = `${currentProperty}`;

            tr.append(thTable);
        }

        let td = document.createElement("td");

        if(currentProperty === "avatar")
        {
            td.innerHTML = `<img src="${currentObject[currentProperty]}" />`;
            td.className = 'interactiveTd';
            td.addEventListener("click", (e) => {
            //console.log(this);

            //resetTimer();
            //resetElement("pTitolo");

            //intervalID = setInterval(setLetter2, 100, "pTitolo", `${currentObject.first_name} ${currentObject.last_name}`);
            });
        }
        else
        {
            td.innerHTML = `${currentObject[currentProperty]}`;
        }
        
        trn.append(td);
        }

        isFirstTime = false;
    }
}
 */

// Funzione per fermare il polling (utile per debug)
/* function stopPolling() {
    if (pollingInterval) {
        clearInterval(pollingInterval);
        console.log("Polling fermato");
    }
} */