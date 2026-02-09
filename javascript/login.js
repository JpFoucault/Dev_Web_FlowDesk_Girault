function verifierEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return regex.test(email);
}

function check_username() {
    const username_input = document.querySelector('#username');
    console.log("Username: " + username_input.value);
    const username_error = document.querySelector('#username_error');

    if (!verifierEmail(username_input.value)) {
        username_error.classList.remove('titanic');
        return 1;
    } else {
        username_error.classList.add('titanic');
        return 0;
    }
}

function check_password() {
    const password_input = document.querySelector('#password');
    const password_error = document.querySelector('#password_error');

    if (password_input.value === "") {
        password_error.classList.remove('titanic');
        return 1;
    } else {
        password_error.classList.add('titanic');
        return 0;
    }
}

const f = document.querySelector('#login_form');

f.addEventListener("submit", function(event) {
    event.preventDefault();
    console.log("Tentative de connexion");

    let nb_errors = 0;
    nb_errors += check_username();
    nb_errors += check_password();

    console.log("nb errors :" + nb_errors);

    if (nb_errors === 0) {
        f.submit();
    }
});