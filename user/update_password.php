<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ./../login/login.php");
    exit();
}

$message = "";
$msg_type = "";

$host = 'localhost';
$dbname = 'FlowDesk';
$db_user = 'root';
$db_pass = 'root';
$port = '8888';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM User WHERE Id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $message = "Veuillez remplir tous les champs.";
        $msg_type = "error";
    } elseif ($new_password !== $confirm_password) {
        $message = "Les nouveaux mots de passe ne correspondent pas.";
        $msg_type = "error";
    } elseif (strlen($new_password) < 7 || !preg_match('/[A-Z]/', $new_password) || !preg_match('/[0-9]/', $new_password)) {
        $message = "Le mot de passe doit contenir 7 caractères, 1 majuscule et 1 chiffre.";
        $msg_type = "error";
    } else {
        if ($user && password_verify($current_password, $user['password'])) {
            $new_hash = password_hash($new_password, PASSWORD_BCRYPT);
            $updateStmt = $pdo->prepare("UPDATE User SET password = ? WHERE Id = ?");
            
            if ($updateStmt->execute([$new_hash, $_SESSION['user_id']])) {
                $message = "Mot de passe modifié avec succès !";
                $msg_type = "success";
            } else {
                $message = "Erreur technique lors de la mise à jour.";
                $msg_type = "error";
            }
        } else {
            $message = "Le mot de passe actuel est incorrect.";
            $msg_type = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowDesk - Modifier Mot de Passe</title>
    <link rel="stylesheet" href="./../styles.css" />
    <link rel="icon" type="image/png" sizes="32x32" href="./../assets/Onlylogo.png">
</head>

<body>
    
    <header class="main-header">
        <div class="logo-container">
            <a href="dashboard.html"><img src="./../assets/FlowDesklogo.png" alt="Logo FlowDesk" class="logo-img"></a>
        </div>

        <nav class="main-nav">
            <ul>
                <li><a href="dashboard.html">Tableau de bord</a></li>
                <li><a href="project.html">Mes Projets</a></li>
                <li><a href="tickets.html">Tickets</a></li>
                <li><a href="bills.html">Facturation</a></li>
                <li><a href="documents.html">Documents</a></li>
                <li><a href="contacts.html">Contacts</a></li>
                <li><a href="settings.php" class="active">Settings</a></li>
            </ul>
        </nav>

        <div class="user-profile">
            <span><?php echo htmlspecialchars($user['Prenom']); ?></span>
            <div class="avatar">
                <?php echo strtoupper(substr($user['Prenom'], 0, 1)); ?>
            </div>
        </div>
    </header>

    <div class="content_create">
        
        <div class="form-card">
            
            <div class="profile-header-section">
                <div class="avatar" style="width: 80px; height: 80px; font-size: 32px;">
                    <?php echo strtoupper(substr($user['Prenom'], 0, 1) . substr($user['Nom'], 0, 1)); ?>
                </div>
                <h1 style="margin: 0; font-size: 22px; color: #f8fafc;">Sécurité du compte</h1>
                <p style="color: #94a3b8; margin: 5px 0; font-size: 14px;">Modification du mot de passe</p>
            </div>

            <?php if (!empty($message)): ?>
                <div class="alert <?php echo ($msg_type == 'success') ? 'alert-success' : 'alert-error'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <?php if ($msg_type !== 'success'): ?>
            <form action="" method="POST">
                
                <span class="section-title">Nouveau mot de passe</span>
                
                <div class="form-group">
                    <label>Mot de passe actuel</label>
                    <input type="password" name="current_password" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="form-group">
                    <label>Nouveau mot de passe</label>
                    <input type="password" name="new_password" class="form-control" placeholder="••••••••" required>
                    <span style="font-size: 12px; color: #94a3b8; margin-top: 5px; display:block;">Requis : 7 caractères, 1 Majuscule, 1 Chiffre</span>
                </div>

                <div class="form-group">
                    <label>Confirmer le nouveau mot de passe</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <button type="submit" class="btn-password" style="width: 100%; cursor: pointer;">Sauvegarder</button>
                    <a href="settings.php" class="btn-cancel">Annuler</a>
                </div>

            </form>
            <?php else: ?>
                <div class="form-group">
                    <a href="settings.php" class="btn-password" style="display:block; text-align:center; text-decoration:none;">Retour aux paramètres</a>
                </div>
            <?php endif; ?>
        </div>

    </div>

</body>
</html>