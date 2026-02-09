function check_titre() {
    const titre_input = document.querySelector('#titre');
    console.log("Titre ticket : " + titre_input.value);
    const titre_error = document.querySelector('#titre_error');

    if (titre_input.value.trim() === "") {
        titre_error.classList.remove('titanic');
        return 1;
    } else {
        titre_error.classList.add('titanic');
        return 0;
    }
}

function check_projet() {
    const projet_select = document.querySelector('#projet');
    console.log("Projet sélectionné : " + projet_select.value);
    const projet_error = document.querySelector('#projet_error');

    if (projet_select.value === "") {
        projet_error.classList.remove('titanic');
        return 1;
    } else {
        projet_error.classList.add('titanic');
        return 0;
    }
}

function check_description() {
    const description_input = document.querySelector('#description');
    const description_error = document.querySelector('#description_error');

    if (description_input.value.trim() === "") {
        description_error.classList.remove('titanic');
        return 1;
    } else {
        description_error.classList.add('titanic');
        return 0;
    }
}

const f = document.querySelector('#create_ticket_form');

f.addEventListener("submit", function(event) {
    event.preventDefault();
    console.log("Tentative de création de ticket");

    let nb_errors = 0;
    nb_errors += check_titre();
    nb_errors += check_projet();
    nb_errors += check_description();

    console.log("nb errors :" + nb_errors);

    if (nb_errors === 0) {
        f.submit();
    }
});