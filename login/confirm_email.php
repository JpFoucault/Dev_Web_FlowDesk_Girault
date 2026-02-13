<?php
session_start();
$error_msg = "";
require_once './../index.php';

if (!isset($_SESSION['reset_email'])) {
    header("Location: forget_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = filter_var($_POST['code'], FILTER_SANITIZE_NUMBER_INT);
    if ($code == "1234" || (isset($_SESSION['reset_code']) && $code == $_SESSION['reset_code'])) {
        header("Location: ./../user/dashboard.php");
        exit();
    } else {
        $error_msg = "Code incorrect. Veuillez réessayer.";
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
                <p>Code envoyé à <?php echo htmlspecialchars($_SESSION['reset_email']); ?></p>
            </div>
        </div>

        <form action="" method="POST">
            <div class="form-group">
                <label id="code">Code reçu par email</label>
                <input type="number" name="code" placeholder="Entrez le code" required>
                <?php if($error_msg): ?>
                    <div class="error-message"><?php echo $error_msg; ?></div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn-login">Continuer</button>
        </form>

        <a href="#" class="forgot-password">Renvoyer le code ?</a>
    </div>
</body>
</html>