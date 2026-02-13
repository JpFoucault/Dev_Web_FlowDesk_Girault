<?php
session_start();
$error_msg = "";

$host = 'localhost';
$dbname = 'FlowDesk'; 
$db_user = 'root';
$db_pass = 'root'; 
$port = '8888';

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error_msg = "Veuillez remplir tous les champs.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT * FROM User WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['Id'];
                $_SESSION['user_prenom'] = $user['Prenom'];
                $_SESSION['user_nom'] = $user['Nom'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_firm'] = $user['firm'];

                header("Location: ./../user/dashboard.php");
                exit();

            } else {
                $error_msg = "Identifiant ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            $error_msg = "Erreur technique lors de la connexion.";
        }
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
        .error-global { color: red; text-align: center; margin-bottom: 10px; font-weight: bold; }
    </style>
    <link rel="icon" type="image/png" sizes="32x32" href="./../assets/Onlylogo.png">
</head>
<body>

    <div class="login-card">
        <div>
            <img src="./../assets/FlowDesklogo.png" alt="Logo FlowDesk" class="logo-img">
            <div class="description_login">
                <p>Connectez-vous à votre espace.</p>
                <a href="create_account.php" class="create_account"> Ou Créez en un</a>
            </div>
        </div>

        <form id="login_form" action="" method="POST">
            <?php if($error_msg): ?>
                <div class="error-global"><?php echo $error_msg; ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="username">Identifiant</label>
                <input type="email" name="username" id="username" placeholder="Entrez votre identifiant" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="••••••••">
            </div>

            <button type="submit" class="btn-login">Se connecter</button>
        </form>

        <a href="forget_password.php" class="forgot-password">Mot de passe oublié ?</a>
    </div>
</body>
</html>
