"use-strict"

let pollingInterval;
let ultimiRecordAggiornati = [];

// Aspetta 5 secondi prima del primo polling
window.addEventListener("load", (e) => {
    setInterval(getProvvigioni, 10 * 1000);
});

const getProvvigioni = async () => {
    let path = "http://localhost:5000/api/provvigioni";
    try {
        const response = await axios.get(path);
        console.log("Dati provvigioni:", response.data);

        aggiornaTabellaCompleta(response.data);
        evidenziaRecordAggiornati(response.data);
    }
    catch(error) {
        console.log("Errore:", error);
    }
}

const aggiornaTabellaCompleta = async (data) => {
    try {
        const dati_aggiornati = [...data.ultimi_record];
        console.log(dati_aggiornati);
        
        dati_aggiornati.forEach(vendita => {
            const riga = document.querySelector(`tr[data-id="${vendita.idv}"]`);
            if (riga) {
                // Formatta la data
                const dataObj = new Date(vendita.data);
                const dataFormattata = dataObj.toISOString().split('T')[0]; // Formato YYYY-MM-DD
                
                // Aggiorna tutte le celle
                riga.cells[0].textContent = vendita.idv;
                riga.cells[1].textContent = vendita.agente;
                riga.cells[2].textContent = dataFormattata; // Usa la data formattata
                riga.cells[3].textContent = `${vendita.importo} €`;
                riga.cells[4].textContent = `${vendita.provvigione || '-'} €`;
            }
        });
        
        console.log("✅ Tabella completamente aggiornata");
    } catch (error) {
        console.log("Errore nell'aggiornamento tabella:", error);
    }
}

const evidenziaRecordAggiornati = (data) => {
    // Rimuovi evidenziazione precedente
    /* document.querySelectorAll('.record-aggiornato').forEach(riga => {
        riga.classList.remove('record-aggiornato');
    }); */
    
    // Applica evidenziazione ai nuovi record
    const righe = [...data.ultimi_record];
    
    righe.forEach(record => {  // Cambiato da 'riga' a 'record' per chiarezza
        const rigaTR = document.querySelector(`tr[data-id="${record.idv}"]`);  // Usa record.idv        
        if (rigaTR) {
            rigaTR.classList.add('record-aggiornato');
        }
    });
}