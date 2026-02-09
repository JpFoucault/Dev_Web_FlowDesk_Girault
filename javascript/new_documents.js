function check_file() {
    const file_input = document.querySelector('#document_file');
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

function check_name() {
    const name_input = document.querySelector('#doc_name');
    const name_error = document.querySelector('#name_error');

    if (name_input.value.trim() === "") {
        name_error.classList.remove('titanic');
        return 1;
    } else {
        name_error.classList.add('titanic');
        return 0;
    }
}

function check_category() {
    const category_select = document.querySelector('#category');
    const category_error = document.querySelector('#category_error');

    if (category_select.value === "") {
        category_error.classList.remove('titanic');
        return 1;
    } else {
        category_error.classList.add('titanic');
        return 0;
    }
}

const f = document.querySelector('#new_document_form');

f.addEventListener("submit", function(event) {
    event.preventDefault();
    console.log("Tentative d'import de document");

    let nb_errors = 0;
    nb_errors += check_file();
    nb_errors += check_name();
    nb_errors += check_category();

    console.log("nb errors :" + nb_errors);

    if (nb_errors === 0) {
        f.submit();
    }
});