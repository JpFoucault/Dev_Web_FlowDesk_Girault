function check_prenom() {
    const prenom_input = document.querySelector('#prenom');
    const prenom_error = document.querySelector('#prenom_error');

    if (prenom_input.value.trim() === "") {
        prenom_error.classList.remove('titanic');
        return 1;
    } else {
        prenom_error.classList.add('titanic');
        return 0;
    }
}

function check_nom() {
    const nom_input = document.querySelector('#nom');
    const nom_error = document.querySelector('#nom_error');

    if (nom_input.value.trim() === "") {
        nom_error.classList.remove('titanic');
        return 1;
    } else {
        nom_error.classList.add('titanic');
        return 0;
    }
}

function check_poste() {
    const poste_input = document.querySelector('#poste');
    const poste_error = document.querySelector('#poste_error');

    if (poste_input.value.trim() === "") {
        poste_error.classList.remove('titanic');
        return 1;
    } else {
        poste_error.classList.add('titanic');
        return 0;
    }
}

function check_entreprise() {
    const entreprise_select = document.querySelector('#entreprise');
    const entreprise_error = document.querySelector('#entreprise_error');

    if (entreprise_select.value === "") {
        entreprise_error.classList.remove('titanic');
        return 1;
    } else {
        entreprise_error.classList.add('titanic');
        return 0;
    }
}

function verifierEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return regex.test(email);
}

function check_email() {
    const email_input = document.querySelector('#email');
    const email_error = document.querySelector('#email_error');

    if (!verifierEmail(email_input.value)) {
        email_error.classList.remove('titanic');
        return 1;
    } else {
        email_error.classList.add('titanic');
        return 0;
    }
}

const f = document.querySelector('#new_contact_form');

f.addEventListener("submit", function(event) {
    event.preventDefault();
    console.log("Tentative de création de contact");

    let nb_errors = 0;
    nb_errors += check_prenom();
    nb_errors += check_nom();
    nb_errors += check_poste();
    nb_errors += check_entreprise();
    nb_errors += check_email();

    console.log("nb errors :" + nb_errors);

    if (nb_errors === 0) {
        f.submit();
    }
});