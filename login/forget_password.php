<?php
session_start();
$error_msg = "";
require_once './../index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);

    if (!$email) {
        $error_msg = "Veuillez entrer un email valide.";
    } else {
        $_SESSION['reset_email'] = $email;
        $_SESSION['reset_code'] = "1234";
        
        header("Location: confirm_email.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowDesk</title>
    <link rel="stylesheet" href="./../styles.css" />
    <style>
        body {
            margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif;
            background-color: #f3f4f6; height: 100vh;
            display: flex; justify-content: center; align-items: center;
            background-image: url('./../assets/DSCF0997.jpg');
            background-size: cover; background-position: center;
        }
        .error-message { color: #e74c3c; font-size: 0.85rem; margin-top: 5px; }
    </style>
    <link rel="icon" type="image/png" sizes="32x32" href="./../assets/Onlylogo.png">
</head>
<body>
    <div class="login-card">
        <div>
            <img src="./../assets/FlowDesklogo.png" alt="Logo FlowDesk" class="logo-img">
            <div class="description_forget_password">
                <p>Mot de passe oublié.</p>
                <div class="already_have_account">
                    <p>Revenir en arrière ?</p>
                    <a href="login.php" class="link_aha">Cliquez-ici</a>
                </div>
            </div>
        </div>

        <form action="" method="POST">
            <div class="form-group">
                <label for="email_input">Adresse E-Mail<span class="text-required">*</span></label>
                <input id="email_input" type="email" name="username" placeholder="Entrez votre E-Mail">
                <?php if($error_msg): ?>
                    <div class="error-message"><?php echo $error_msg; ?></div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn-login">Continuer</button>
        </form>

        <a href="#" class="forgot-password">Autres techniques ?</a>
    </div>
</body>
</html>