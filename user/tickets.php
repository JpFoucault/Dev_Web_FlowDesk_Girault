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
                <li><a href="project.php">Mes Projets</a></li>
                <li><a href="tickets.php" class="active">Tickets</a></li>
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
        <div class="filter-section" style="margin-bottom: 20px;">
            <p style="font-weight: 600; margin-bottom: 10px;">Filtrer par :</p>
            
            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 10px;">
                <button class="filter-btn btn-cancel" data-category="all">Tout voir</button>
            </div>

            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 10px;">
                <span style="align-self: center; font-size: 13px; color: #94a3b8;">État :</span>
                <button class="filter-btn btn-cancel" data-category="status" data-value="Nouveau">Nouveau</button>
                <button class="filter-btn btn-cancel" data-category="status" data-value="En cours">En cours</button>
                <button class="filter-btn btn-cancel" data-category="status" data-value="Terminé">Terminé</button>
            </div>

            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <span style="align-self: center; font-size: 13px; color: #94a3b8;">Facturation :</span>
                <button class="filter-btn btn-cancel" data-category="billable" data-value="Oui">Facturable</button>
                <button class="filter-btn btn-cancel" data-category="billable" data-value="Non">Non facturable</button>
            </div>
        </div>

        <div class="table-card">
            <table class="ticket-table">
                <thead>
                    <tr>
                        <th>Ticket & Projet</th>
                        <th>Facturé</th> 
                        <th>Date souhaitée</th>
                        <th>Description</th>
                        <th>État</th>
                        <th class="text-right">
                            <a href="create_tickets.php" class="btn-create">+ Nouveau Ticket</a>
                        </th>
                    </tr>
                </thead>
                <tbody id="ticket-rows"> 
                    <tr>
                        <td>
                            <div class="ticket-info">
                                <span class="ticket-title">Correction Bug Login</span>
                                <span class="ticket-project">Projet E-Commerce</span>
                            </div>
                        </td>
                        <td class="col-unbillable">Non</td> <td>05 Fév 2026</td>
                        <td>Le bouton de connexion est décalé...</td>
                        <td class="col-status"><span class="status-badge status-new">Nouveau</span></td>
                        <td class="text-right">
                            <a href="#popup-ticket-1" class="btn-details">Plus de détails</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="ticket-info">
                                <span class="ticket-title">Correction Bug Login</span>
                                <span class="ticket-project">Projet E-Commerce</span>
                            </div>
                        </td>
                        <td class="col-billable">Oui</td> <td>05 Fév 2026</td>
                        <td>Le bouton de connexion est décalé...</td>
                        <td class="col-status"><span class="status-badge status-progress">En cours</span></td>
                        <td class="text-right">
                            <a href="#popup-ticket-1" class="btn-details">Plus de détails</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="ticket-info">
                                <span class="ticket-title">Correction Bug Login</span>
                                <span class="ticket-project">Projet E-Commerce</span>
                            </div>
                        </td>
                        <td class="col-billable">Oui</td> <td>05 Fév 2026</td>
                        <td>Le bouton de connexion est décalé...</td>
                        <td class="col-status"><span class="status-badge status-new">Nouveau</span></td>
                        <td class="text-right">
                            <a href="#popup-ticket-1" class="btn-details">Plus de détails</a>
                        </td>
                    </tr>
                </tbody>
            </table>
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
                        <span class="info-label">Facturable :</span>
                        <span class="info-value">Oui</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Prix estimé :</span>
                        <span class="info-value" style="font-weight: bold; color: #4ade80;">150.00 €</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Date souhaitée :</span>
                        <span class="info-value">05 Fév 2026</span>
                    </div>
                    
                    <p class="info-label">Description détaillée :</p>
                    <div class="description-box">
                        Le bouton de connexion se chevauche avec le logo sur mobile.
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="modif_tickets.php" class="btn-cancel btn-outline-primary">✎ Modifier le ticket</a>
                    <a href="#" class="btn-modal-action">Fermer</a>
                </div>
            </div>
        </div>
    </div>
    <script src="./../javascript/filter_tickets.js"></script>
</body>
</html>