# Note:


In primis lanciare "php artisan migrate:fresh --seed" su backend, dopo per visualizzare il pulsante elimina su ogni articolo bisogna loggarsi, con qualsiasi utente, anche creato ex novo (dopo registrazione, sloggarsi e riloggarsi per far comparire il pulsante).
Dopo aver premuto sul pulsante elimina, non son riuscito a re-renderizzare in automatico il componente anche cambiando la key, si ottiene unknown error. Ma se si cambia scheda o si aggiorna la pagina si vede che l'articolo viene effettivamente eliminato (anche su db). 
