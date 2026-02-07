function check_account_first_name()
{
    const account_first_name = document.querySelector('#account_first_name');
    console.log(account_first_name.value);
    const titre_error = document.querySelector('#client_first_name_error');

    if(account_first_name.value == "")
    {
        titre_error.classList.remove('titanic');
        return 1;
    } else{
        titre_error.classList.add('titanic');
        return 0;
    }
}

function check_account_family_name()
{
    const account_family_name = document.querySelector('#account_family_name');
    console.log(account_family_name.value);
    const titre_error = document.querySelector('#client_family_name_error');

    if(account_family_name.value == "")
    {
        titre_error.classList.remove('titanic');
        return 1;
    } else{
        titre_error.classList.add('titanic');
        return 0;
    }
}

function verifierEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    
    return regex.test(email);
}

function check_account_email()
{
    const account_email = document.querySelector('#account_email');
    console.log(account_email.value);
    const titre_error = document.querySelector('#client_email_error');

    if(!verifierEmail(account_email.value))
    {
        titre_error.classList.remove('titanic');
        return 1;
    } else{
        titre_error.classList.add('titanic');
        return 0;
    }
}

function check_account_password()
{
    
}

const f = document.querySelector('#create_account_form');

f.addEventListener("submit", function(event) {
    event.preventDefault();
    console.log("Soumission de la creation du compte");

    let nb_errors = 0;
    nb_errors += check_account_first_name();
    nb_errors += check_account_family_name();
    nb_errors += check_account_email();

    console.log("nb errors :" + nb_errors);
});