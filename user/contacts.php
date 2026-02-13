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
                <li><a href="tickets.php">Tickets</a></li>
                <li><a href="bills.php">Facturation</a></li>
                <li><a href="documents.php">Documents</a></li>
                <li><a href="contacts.php" class="active">Contacts</a></li>
                <li><a href="settings.php">Settings</a></li>
            </ul>
        </nav>

        <div class="user-profile">
            <span>user</span>
            <div class="avatar">U</div>
        </div>
    </header>

    <div class="content_contact">
        
        <div class="page-actions">
            <h1>Répertoire Contacts</h1>
            <a href="new_contacts.php" class="btn-create">+ Nouveau Contact</a>
        </div>

        <div class="table-card">
            <table class="contact-table">
                <thead>
                    <tr>
                        <th>Nom & Prénom</th>
                        <th>Poste / Rôle</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Entreprise</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td>
                            <div class="contact-name-cell">
                                <div class="avatar av-yellow">SM</div>
                                <span>Sophie Martin</span>
                            </div>
                        </td>
                        <td class="job-title">Directrice Marketing</td>
                        <td>06 12 34 56 78</td>
                        <td>s.martin@greenmarket.fr</td>
                        <td><span class="company-badge">GreenMarket SAS</span></td>
                        <td class="text-right">
                            <a href="#popup-contact-1" class="btn-view">Voir fiche</a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="contact-name-cell">
                                <div class="avatar av-blue">PD</div>
                                <span>Pierre Durand</span>
                            </div>
                        </td>
                        <td class="job-title">Responsable IT</td>
                        <td>01 45 67 89 00</td>
                        <td>it@dupond-groupe.com</td>
                        <td><span class="company-badge">Groupe Dupond</span></td>
                        <td class="text-right">
                            <a href="#popup-contact-1" class="btn-view">Voir fiche</a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="contact-name-cell">
                                <div class="avatar av-green">JL</div>
                                <span>Julie Lefebvre</span>
                            </div>
                        </td>
                        <td class="job-title">CEO / Fondatrice</td>
                        <td>06 99 88 77 66</td>
                        <td>j.lefebvre@fastdelivery.io</td>
                        <td><span class="company-badge">FastDelivery</span></td>
                        <td class="text-right">
                            <a href="#popup-contact-1" class="btn-view">Voir fiche</a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="contact-name-cell">
                                <div class="avatar av-purple">TR</div>
                                <span>Thomas Robert</span>
                            </div>
                        </td>
                        <td class="job-title">Chef de Projet</td>
                        <td>07 00 11 22 33</td>
                        <td>thomas.robert@agency.com</td>
                        <td><span class="company-badge">WebAgency (Interne)</span></td>
                        <td class="text-right">
                            <a href="#popup-contact-1" class="btn-view">Voir fiche</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
    <div id="popup-contact-1" class="modal-overlay">
        <div class="modal-content">
            
            <a href="#" class="close-btn">&times;</a>

            <div class="contact-header">
                <div class="avatar av-pink">SM</div>
                <div class="contact-title">
                    <h2>Sophie Martin</h2>
                    <p>Directrice Marketing chez <strong>GreenMarket SAS</strong></p>
                </div>
            </div>

            <div class="modal-body">
                
                <div class="contact-grid">
                    <div class="contact-item">
                        <span class="ci-label">Téléphone</span>
                        <span class="ci-value">06 12 34 56 78</span>
                    </div>
                    <div class="contact-item">
                        <span class="ci-label">Email</span>
                        <span class="ci-value"><a href="mailto:s.martin@greenmarket.fr">s.martin@greenmarket.fr</a></span>
                    </div>
                    <div class="contact-item">
                        <span class="ci-label">Poste</span>
                        <span class="ci-value">Directrice Marketing</span>
                    </div>
                    <div class="contact-item">
                        <span class="ci-label">Type</span>
                        <span class="ci-value">Client (VIP)</span>
                    </div>
                </div>

                <p class="info-label">Notes internes & Description :</p>
                <div class="description-box">
                    Contact principal pour le projet de refonte E-Commerce. <br>
                    Disponible principalement le matin. Préfère les échanges par email pour le suivi technique.<br><br>
                    A relancer en début de mois pour la validation des factures.
                </div>

            </div>

            <div class="modal-footer" style="display: flex; justify-content: space-between;">
                <a href="modif_contacts.php" class="btn-edit-contact">Modifier le contact</a>
                <a href="#" class="btn-supr">Supprimer le contact</a>
                <a href="#" class="btn-modal-action" style="background-color: #334155; border: 1px solid #475569;">Fermer</a>
            </div>

        </div>
    </div>

</body>
</html>