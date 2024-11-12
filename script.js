async function SaveCheck(id) {
    try {
        const element = document.getElementById(id);
        const isChecked = element.classList.contains('checked');
        
        // Envoie une requête à PHP pour mettre à jour la base de données
        const rep = await fetch("check.php?id=" + id);
        if (!rep.ok) throw new Error("Erreur de requête");
        const txt = await rep.text();
        
        // Change visuellement l'état de la case
        if (isChecked) {
            element.classList.remove('checked');
            element.classList.add('unchecked');
        } else {
            element.classList.remove('unchecked');
            element.classList.add('checked');
        }
        
        // Affiche le message retourné par PHP si nécessaire
        const check = document.getElementById('check');
        if (check) {
            check.innerHTML = txt;
        }
    } catch (error) {
        console.error(error);
    }
}
