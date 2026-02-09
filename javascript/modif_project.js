function check_project_name() {
    const project_name = document.querySelector('#nom_projet');
    console.log("Projet : " + project_name.value);
    const project_error = document.querySelector('#project_name_error');

    if (project_name.value.trim() === "") {
        project_error.classList.remove('titanic');
        return 1;
    } else {
        project_error.classList.add('titanic');
        return 0;
    }
}

function check_client() {
    const client_select = document.querySelector('#client');
    console.log("Client value : " + client_select.value);
    const client_error = document.querySelector('#client_error');

    if (client_select.value === "") {
        client_error.classList.remove('titanic');
        return 1;
    } else {
        client_error.classList.add('titanic');
        return 0;
    }
}

const f = document.querySelector('#modif_project_form');

f.addEventListener("submit", function(event) {
    event.preventDefault();
    console.log("Tentative de modification du projet");

    let nb_errors = 0;
    nb_errors += check_project_name();
    nb_errors += check_client();

    console.log("nb errors :" + nb_errors);

    if (nb_errors === 0) {
        f.submit();
    }
});