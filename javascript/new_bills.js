function check_reference() {
    const reference_input = document.querySelector('#reference');
    const reference_error = document.querySelector('#reference_error');

    if (reference_input.value.trim() === "") {
        reference_error.classList.remove('titanic');
        return 1;
    } else {
        reference_error.classList.add('titanic');
        return 0;
    }
}

function check_client() {
    const client_select = document.querySelector('#client');
    const client_error = document.querySelector('#client_error');

    if (client_select.value === "") {
        client_error.classList.remove('titanic');
        return 1;
    } else {
        client_error.classList.add('titanic');
        return 0;
    }
}

function check_date() {
    const date_input = document.querySelector('#date_facture');
    const date_error = document.querySelector('#date_error');

    if (date_input.value === "") {
        date_error.classList.remove('titanic');
        return 1;
    } else {
        date_error.classList.add('titanic');
        return 0;
    }
}

function check_montant() {
    const montant_input = document.querySelector('#montant');
    const montant_error = document.querySelector('#montant_error');

    if (montant_input.value === "") {
        montant_error.classList.remove('titanic');
        return 1;
    } else {
        montant_error.classList.add('titanic');
        return 0;
    }
}

function check_file() {
    const file_input = document.querySelector('#facture_pdf');
    const file_error = document.querySelector('#file_error');

    console.log("Fichier sélectionné : " + file_input.value);

    if (file_input.value === "") {
        file_error.classList.remove('titanic');
        return 1;
    } else {
        file_error.classList.add('titanic');
        return 0;
    }
}

const f = document.querySelector('#new_bill_form');

f.addEventListener("submit", function(event) {
    event.preventDefault();
    console.log("Tentative de création de facture");

    let nb_errors = 0;
    nb_errors += check_reference();
    nb_errors += check_client();
    nb_errors += check_date();
    nb_errors += check_montant();
    nb_errors += check_file();

    console.log("nb errors :" + nb_errors);

    if (nb_errors === 0) {
        f.submit();
    }
});