
function check_project_name()
{
    const project_name = document.querySelector('#nom_projet');
    console.log("project name : ", project_name.value);
    const titre_error = document.querySelector('#project_name_error');

    if(project_name.value == "") {
        titre_error.classList.remove('titanic');
        return 1;
    } else {
        titre_error.classList.add('titanic');
        return 0;
    }
}

function check_clients()
{
    const client_name = document.querySelector('#client');
    console.log(client_name.value);
    const client_name_error = document.querySelector('#client_name_error');

    if (client_name.value == "-- Sélectionner --")
    {
        client_name_error.classList.remove('titanic');
        return 1;
    } else {
        client_name_error.classList.add('titanic');
        return 0;
    }
} 

const f = document.querySelector('#submitform');



f.addEventListener("submit", function(event) {
    event.preventDefault();
    console.log("Soumission du formulaire")

    let nb_errors = 0;
    nb_errors += check_project_name();
    nb_errors += check_clients();
    

});