'use strict'

document.addEventListener('DOMContentLoaded', function() {
    // Funzione per il caricamento incrementale delle pagine
    function initPagination() {
        const magazineList = document.querySelector('.magazine-list');
        if (!magazineList) return;
        
        const itemsPerPage = 10;
        const allItems = document.querySelectorAll('.magazine-item');
        const loadMoreButton = document.querySelector('.load-more');
        const loadLessButton = document.querySelector('.load-less');
        
        if ((!loadMoreButton && !loadLessButton) || allItems.length === 0) return;
        
        let currentPage = parseInt(magazineList.getAttribute('data-current-page'));
        const totalPages = parseInt(magazineList.getAttribute('data-total-pages'));
        
        // Funzione per mostrare una specifica pagina
        function showPage(page) {
            // Nascondi tutti gli elementi
            allItems.forEach(item => {
                item.classList.add('hidden-item');
            });
            
            // Mostra solo gli elementi della pagina richiesta
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = Math.min(startIndex + itemsPerPage, allItems.length);
            
            for (let i = startIndex; i < endIndex; i++) {
                allItems[i].classList.remove('hidden-item');
            }
            
            // Aggiorna il numero di pagina
            currentPage = page;
            magazineList.setAttribute('data-current-page', currentPage);
            
            // Gestisci la visibilità dei pulsanti
            if (currentPage === 1) {
                // Siamo alla prima pagina
                loadLessButton.classList.add('hidden-item');
                loadMoreButton.classList.remove('hidden-item');
            } else if (currentPage === totalPages) {
                // Siamo all'ultima pagina
                loadLessButton.classList.remove('hidden-item');
                loadMoreButton.classList.add('hidden-item');
            } else {
                // Siamo in una pagina intermedia
                loadLessButton.classList.remove('hidden-item');
                loadMoreButton.classList.remove('hidden-item');
            }
        }
        
        // Gestione click sul pulsante "+"
        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', function() {
                if (currentPage < totalPages) {
                    showPage(currentPage + 1);
                }
            });
        }
        
        // Gestione click sul pulsante "-"
        if (loadLessButton) {
            loadLessButton.addEventListener('click', function() {
                if (currentPage > 1) {
                    showPage(currentPage - 1);
                }
            });
        }
    }
    
    // Inizializza la paginazione
    initPagination();
});