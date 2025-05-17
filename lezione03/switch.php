<?php

    #COSTRUTTO SWITCH-CASE (permette di compattare un blocco con troppi elseif)  
    # switch(variabile da valutare){
    #        case:
    #        break
    #        }

    switch($_GET['id']) {
        case 1:
            echo 'ID vale uno';
            break;
        case 2:
            echo 'ID vale due';
            break;
        case 3:
            echo 'ID vale tre';
        break;
    }