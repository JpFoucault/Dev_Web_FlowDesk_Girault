<?php
session_start();

// Vérification de sécurité : Si l'utilisateur n'est pas connecté, on le renvoie au login
if (!isset($_SESSION['user_id'])) {
    header("Location: ./../login/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
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
                <li><a href="project.php" class="active">Mes Projets</a></li>
                <li><a href="tickets.php">Tickets</a></li>
                <li><a href="bills.php">Facturation</a></li>
                <li><a href="documents.php">Documents</a></li>
                <li><a href="contacts.php">Contacts</a></li>
                <li><a href="settings.php">Settings</a></li>
            </ul>
        </nav>

        <div class="user-profile">
            <span>user</span>
            <div class="avatar">U</div>
        </div>
    </header>

    <div class="content">
        <div class="page-actions">
            <h1>Liste des Projets</h1>
            <a href="create_new_project.php" class="btn-create">+ Nouveau Projet</a>
        </div>

        <div class="projects-grid">

            <article class="project-card">
                <div class="card-header">
                    <h2>Site E-Commerce Bio</h2>
                    <span class="client-name">Client : GreenMarket SAS</span>
                </div>

                <div class="tickets-section">
                    <h3>Tickets Récents</h3>
                    <ul class="ticket-list">
                        <li class="ticket-item">
                            <span>Bug ajout panier</span>
                            <span class="status-badge status-new">Nouveau</span>
                        </li>
                        <li class="ticket-item">
                            <span>Intégration Stripe</span>
                            <span class="status-badge status-progress">En cours</span>
                        </li>
                        <li class="ticket-item">
                            <span>Mise en prod v1.0</span>
                            <span class="status-badge status-done">Terminé</span>
                        </li>
                    </ul>
                </div>

                <div class="card-footer">
                    <div class="avatars">
                        <div class="avatar av-yellow">JD</div>
                        <div class="avatar av-pink">AL</div>
                    </div>
                    <a href="modif_project.php" class="btn-add-collab">+ Collaborateur</a>
                </div>
                <a href="project_detail.php" class="btn-project-details">+ de détails</a>
            </article>

            <article class="project-card">
                <div class="card-header">
                    <h2>Intranet RH</h2>
                    <span class="client-name">Client : Groupe Dupond</span>
                </div>

                <div class="tickets-section">
                    <h3>Tickets Récents</h3>
                    <ul class="ticket-list">
                        <li class="ticket-item">
                            <span>Export PDF fiches</span>
                            <span class="status-badge status-progress">En cours</span>
                        </li>
                        <li class="ticket-item">
                            <span>Connexion LDAP</span>
                            <span class="status-badge status-done">Terminé</span>
                        </li>
                    </ul>
                </div>

                <div class="card-footer">
                    <div class="avatars">
                        <div class="avatar av-blue">MR</div>
                    </div>
                    <a href="modif_project.php" class="btn-add-collab">+ Collaborateur</a>
                </div>
                <a href="project_detail.php" class="btn-project-details">+ de détails</a>
            </article>

            <article class="project-card">
                <div class="card-header">
                    <h2>App Mobile Livraison</h2>
                    <span class="client-name">Client : FastDelivery</span>
                </div>

                <div class="tickets-section">
                    <h3>Tickets Récents</h3>
                    <ul class="ticket-list">
                        <li class="ticket-item">
                            <span>Géolocalisation</span>
                            <span class="status-badge status-new">Nouveau</span>
                        </li>
                        <li class="ticket-item">
                            <span>Push Notifications</span>
                            <span class="status-badge status-new">Nouveau</span>
                        </li>
                        <li class="ticket-item">
                            <span>Design Login</span>
                            <span class="status-badge status-progress">En cours</span>
                        </li>
                    </ul>
                </div>

                <div class="card-footer">
                    <div class="avatars">
                        <div class="avatar av-yellow">JD</div>
                        <div class="avatar av-green">KT</div>
                        <div class="avatar av-purple">SS</div>
                    </div>
                    <a href="modif_project.php" class="btn-add-collab">+ Collaborateur</a>
                </div>
                <a href="project_detail.php" class="btn-project-details">+ de détails</a>
            </article>

        </div>
    </div>
</body>
</html>