// Sélectionne l'élément HTML select par son id
const selectElement = document.getElementById("selectid");
// Sélectionne les éléments HTML input et select par leur id
const inputElement = document.getElementById("keywords");
const selectEl1 = document.getElementById("selectContrat");
const selectEl2 = document.getElementById("selectParcours");


inputElement.disabled = true;
selectEl2.disabled = true; 
selectEl1.disabled = true;


// Ajoute un écouteur d'événements pour détecter les changements de sélection
selectElement.addEventListener("change", function() {

    // Récupère la valeur de l'option sélectionnée
    const selectedOption = this.value;

    // Vérifie la valeur de l'option sélectionnée et affiche le résultat correspondant dans la console
    switch(selectedOption) {
        case "tout":
            inputElement.disabled = false;
            selectEl2.disabled = false; 
            selectEl1.disabled = false;
        break;
        case "type1":
            inputElement.disabled = false;
            selectEl2.disabled = true; 
            selectEl1.disabled = true;
        break;
        case "type2":
            selectEl1.disabled = false;
            inputElement.disabled = true; 
            selectEl2.disabled = true; 
        break;
        case "type3":
            selectEl2.disabled = false; 
            selectEl1.disabled = true;
            inputElement.disabled = true; 
        break;
        default:
            console.log("Option invalide");
    }
});
