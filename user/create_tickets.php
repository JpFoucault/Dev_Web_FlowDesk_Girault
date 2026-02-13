<?php
session_start();

// Vérification de sécurité : Si l'utilisateur n'est pas connecté, on le renvoie au login
if (!isset($_SESSION['user_id'])) {
    header("Location: ./../login/login.php");
    exit();
}


require_once './../index.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nouveauTicket = new Ticket($_POST);

    if ($nouveauTicket->isValid()) {
        header('Location: tickets.php'); 
        exit();
    } else {
        echo "Erreur : Certains champs obligatoires sont vides.";
    }
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

    <div class="content_create_ticket">
        
        <div class="form-card">
            <div class="form-header">
                <h1>Créer un nouveau ticket</h1>
                <p>Veuillez remplir les informations ci-dessous pour ouvrir une demande.</p>
            </div>

            <form id="create_ticket_form" method="POST" action="create_tickets.php">
                
                <div class="form-group">
                    <label for="titre">Sujet de la demande <span class="text-required">*</span></label>
                    <input type="text" id="titre" name="titre" class="form-control" placeholder="Ex: Erreur lors du paiement...">
                    <div id="titre_error" class="error-text titanic">Veuillez entrer un sujet pour la demande.</div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="projet">Projet concerné <span class="text-required">*</span></label>
                        <select id="projet" name="projet" class="form-control">
                            <option value="" disabled selected>-- Choisir un projet --</option>
                            <option value="ecommerce">Site E-Commerce Bio</option>
                            <option value="crm">CRM Interne</option>
                            <option value="vitrine">Site Vitrine</option>
                        </select>
                        <div id="projet_error" class="error-text titanic">Veuillez sélectionner un projet concerné.</div>
                    </div>

                    <div class="form-group">
                        <label for="type">Type de demande</label>
                        <select id="type" name="type" class="form-control">
                            <option value="bug">Correction de Bug</option>
                            <option value="feature">Nouvelle fonctionnalité</option>
                            <option value="support">Support / Question</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="priorite">Priorité</label>
                        <select id="priorite" name="priorite" class="form-control">
                            <option value="low">Basse</option>
                            <option value="medium" selected>Moyenne</option>
                            <option value="high">Haute</option>
                            <option value="critical">Critique</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="delai">Date souhaitée (Optionnel)</label>
                        <input type="date" id="delai" name="delai" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description détaillée <span class="text-required">*</span></label>
                    <textarea id="description" name="description" class="form-control" placeholder="Décrivez le problème ou le besoin en détail..."></textarea>
                    <div id="description_error" class="error-text titanic">Veuillez entrer une description détaillée.</div>
                </div>

                <div class="form-actions">
                    <a href="tickets.php" class="btn-cancel">Annuler</a>
                    <button type="submit" class="btn-submit">Créer le ticket</button>
                </div>

            </form>
        </div>

    </div>

    <script src="./../javascript/create_ticket.js"></script>
</body>
</html>