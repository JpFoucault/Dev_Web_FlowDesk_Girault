<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ./../login/login.php");
    exit();
}

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

    if (!$user) {
        header("Location: ./../login/logout.php");
        exit();
    }

    $role_label = ($user['role'] == 1) ? "Collaborateur (Interne)" : "Client (Externe)";

} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowDesk</title>
    <link rel="stylesheet" href="./../styles.css" />
    <link rel="icon" type="image/png" sizes="32x32" href="./../assets/Onlylogo.png">
</head>

<body>
    
    <header class="main-header">
        <div class="logo-container">
            <a href="dashboard.php"><img src="./../assets/FlowDesklogo.png" alt="Logo FlowDesk" class="logo-img"></a>
        </div>

        <nav class="main-nav">
            <ul>
                <li><a href="dashboard.php">Tableau de bord</a></li>
                <li><a href="project.php">Mes Projets</a></li>
                <li><a href="tickets.php">Tickets</a></li>
                <li><a href="bills.php">Facturation</a></li>
                <li><a href="documents.php">Documents</a></li>
                <li><a href="contacts.php">Contacts</a></li>
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
                <h1 style="margin: 0; font-size: 22px; color: #f8fafc;">
                    <?php echo htmlspecialchars($user['Prenom'] . ' ' . $user['Nom']); ?>
                </h1>
                <p style="color: #94a3b8; margin: 5px 0; font-size: 14px;">
                    <?php echo htmlspecialchars($role_label); ?>
                </p>
            </div>

            <form action="#">
                
                <span class="section-title">Informations Personnelles</span>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['Prenom']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['Nom']); ?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label>Adresse Email</label>
                    <input type="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Entreprise</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['firm']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Date d'inscription</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['create_date']); ?>" readonly>
                    </div>
                </div>

                <span class="section-title">Préférences</span>

                <div class="toggle-row">
                    <span class="toggle-label">Notifications email</span>
                    <label class="switch">
                        <input type="checkbox" checked> <span class="slider"></span>
                    </label>
                </div>

                <div class="toggle-row" style="border-bottom: none;">
                    <span class="toggle-label">Rapport hebdomadaire</span>
                    <label class="switch">
                        <input type="checkbox"> <span class="slider"></span>
                    </label>
                </div>
                
                <span class="section-title">Sécurité</span>

                <div class="form-group">
                    <a href="update_password.php" class="btn-link-style btn-password-link">Modifier le mot de passe</a>
                </div>

                <div class="form-group">
                    <a href="logout.php" class="btn-link-style btn-logout-link">Se déconnecter</a>
                </div>

            </form>
        </div>

    </div>

</body>
</html>
