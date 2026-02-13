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
                <li><a href="dashboard.php" class="active">Tableau de bord</a></li>
                <li><a href="project.php">Mes Projets</a></li>
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
        <h1>Bienvenue sur votre espace Projets</h1>
        <br>
        
        <div class="Stat">
            <div class="Info">
                <ul>
                    <li class="box">
                        <h1>Projets</h1>
                        <h2>34</h2>
                    </li>
                    <li class="box">
                        <h1>Tickets</h1>
                        <h2>128</h2>
                    </li>
                    <li class="box">
                        <h1>Bills</h1>
                        <h2>67€</h2>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="table-card">
            <div class="card-header-padding">
                <h2>Vos tickets récents</h2>
            </div>
            <table class="ticket-table">
                <thead>
                    <tr>
                        <th>Ticket & Projet</th>
                        <th>Description</th>
                        <th>État</th>
                        <th class="text-right">Plus d'informations</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="ticket-info">
                                <span class="ticket-title">Correction Bug Login</span>
                                <span class="ticket-project">Projet E-Commerce</span>
                            </div>
                        </td>
                        <td>Le bouton de connexion est décalé sur mobile...</td>
                        <td><span class="status-badge status-new">Nouveau</span></td>
                        <td class="text-right">
                            <a href="#popup-ticket-1" class="btn-details">Plus de détails</a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="ticket-info">
                                <span class="ticket-title">Mise à jour Base de données</span>
                                <span class="ticket-project">Projet CRM Interne</span>
                            </div>
                        </td>
                        <td>Migration des données clients vers la v2...</td>
                        <td><span class="status-badge status-progress">En cours</span></td>
                        <td class="text-right">
                            <a href="#popup-ticket-1" class="btn-details">Plus de détails</a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="ticket-info">
                                <span class="ticket-title">Refonte Header</span>
                                <span class="ticket-project">Projet Site Vitrine</span>
                            </div>
                        </td>
                        <td>Intégration du nouveau logo et menus...</td>
                        <td><span class="status-badge status-done">Terminé</span></td>
                        <td class="text-right">
                            <a href="#popup-ticket-1" class="btn-details">Plus de détails</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div id="popup-ticket-1" class="modal-overlay">
        <div class="modal-content">
            
            <a href="#" class="close-btn">&times;</a>

            <div class="modal-header">
                <h2>Correction Bug Login</h2>
                <p>Projet : E-Commerce Bio</p>
            </div>

            <div class="modal-body">
                <div class="info-row">
                    <span class="info-label">Statut :</span>
                    <span class="modal-status-badge">NOUVEAU</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Demandé par :</span>
                    <span class="info-value">Sophie Martin (Client)</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Date :</span>
                    <span class="info-value">30 Janvier 2026</span>
                </div>

                <p class="info-label">Description détaillée :</p>
                <div class="description-box">
                    Bonjour,<br><br>
                    Sur la version mobile (iPhone 14), le bouton de connexion se chevauche avec le logo. Il est impossible de cliquer dessus.<br>
                    Le problème semble venir du CSS sur les écrans inférieur à 400px.<br><br>
                    Merci de corriger rapidement avant la mise en prod.
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn-modal-action">Fermer</a>
            </div>

        </div>
    </div>
</body>
</html>