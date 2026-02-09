function verifierEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return regex.test(email);
}

function check_email() {
    const email_input = document.querySelector('#email_input');
    console.log(email_input.value);
    const titre_error = document.querySelector('#email_error');

    if (!verifierEmail(email_input.value)) {
        titre_error.classList.remove('titanic');
        return 1;
    } else {
        titre_error.classList.add('titanic');
        return 0;
    }
}

const f = document.querySelector('#forget_password_form');

f.addEventListener("submit", function(event) {
    event.preventDefault();
    console.log("Soumission de mot de passe oublié");

    let nb_errors = 0;
    nb_errors += check_email();

    console.log("nb errors :" + nb_errors);

    if (nb_errors === 0) {
        f.submit();
    }
});