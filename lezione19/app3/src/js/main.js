function caricaNotizie() {
    fetch('http://localhost/corso-PHP/lezione19/app3/notizie.php')
    .then(response => {
    if (!response.ok) {
        throw new Error(`Errore HTTP: ${response.status}`);
    }
    return response.json();
    })
    .then(data => {
    if (data && data.length > 0) {
        console.log(data);
        buildTable(data);
    } else {
        container.innerHTML = '<p>Nessuna notizia</p>';
    }

    })
    .catch(error => {
    console.error('Errore in lettura:', error);
    document.getElementById('notizie').innerHTML =
        '<p>Errore nel caricamento delle notizie.</p>';
    });
}

// Carica subito le notizie al primo avvio
caricaNotizie();

// Ricarica le notizie ogni 10 secondi (10000 ms)
setInterval(caricaNotizie, 10000);

//////////////////////////////////////////////////////////////
const buildTable = (data) => {
    let container = document.querySelector("#notizie");
    
    // Pulisce il container prima di creare una nuova tabella
    container.innerHTML = "";
    
    let table = document.createElement('table');
    table.className = "table";
    container.append(table);

    let tr = document.createElement("tr");
    table.append(tr);

    let isFirstTime = true;

    for(const currentObject of data) {

        let trn = document.createElement("tr");
        table.append(trn);
        
        for(const currentProperty in currentObject) {
            if(isFirstTime === true) {
                let thTable = document.createElement('th');
                thTable.innerHTML = `${currentProperty}`;
                tr.append(thTable);
            }
            let td = document.createElement("td");
            td.innerHTML = `${currentObject[currentProperty]}`;
            trn.append(td);
        }
        //bottone modifica
        let modifica = document.createElement("th");
        modifica.innerHTML = 'MODIFICA'


        

        isFirstTime = false;
    }
}