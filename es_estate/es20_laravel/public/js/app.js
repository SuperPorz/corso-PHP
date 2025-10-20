console.log('script caricato correttamente');

'use strict'

// Aspetta 5 secondi prima del primo polling
window.addEventListener("load", (e) => {
    pageLoaded();
});

const pageLoaded = () => {
    let dataButtonsNodeList = document.querySelectorAll(".collocazione");

    // Converto la node-list in array
    const dataButtons = [...dataButtonsNodeList];

    // Itero sull'array per aggiungere a ciascun bottone il listener
    dataButtons.forEach(bottone => {
        bottone.addEventListener("click", e => {
            e.preventDefault(); // Previeni il submit del form
            
            // Trova lo span con la collocazione più vicino
            let spanCollocazione = e.target.closest('form').querySelector('.hidden-span');
            let collocazione = spanCollocazione.textContent;
            
            console.log('Collocazione:', collocazione);
            // logica per mostrare l'immagine
            showImage(collocazione);
        });
    });
}

const showImage = (collocazione) => {
    let primo_carattere = collocazione.charAt(0).toLowerCase();
    let ultimo_carattere = collocazione.slice(-1);
    let nome_img = primo_carattere + 'x' + ultimo_carattere;

    const width = 760;
    const height = 700;
    const left = (window.innerWidth - width) / 2 + window.screenX;
    const top = (window.innerHeight - height) / 2 + window.screenY;

    const windowFeatures = `left=${left},top=${top},width=${width},height=${height}`;
    let path = '../img/' + nome_img + '.png';
    console.log(path);
    window.open(path, "chromeWindow", windowFeatures);
}