<?php
session_start();

// Vérification de sécurité : Si l'utilisateur n'est pas connecté, on le renvoie au login
if (!isset($_SESSION['user_id'])) {
    header("Location: ./../login/login.php");
    exit();
}

require_once './../index.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nouveauContact = new Contact($_POST);
    header('Location: contacts.php?success=1');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

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

    <div class="content_create"> <div class="form-card">
            <div class="form-header">
                <h1>Ajouter un contact</h1>
                <p>Créez une fiche pour un client, un collaborateur ou un partenaire.</p>
            </div>

            <form id="new_contact_form" action="contacts.php" method="POST">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="prenom">Prénom <span class="text-required">*</span></label>
                        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Ex: Jean">
                        <div id="prenom_error" class="error-text titanic">Veuillez entrer un prénom.</div>
                    </div>

                    <div class="form-group">
                        <label for="nom">Nom <span class="text-required">*</span></label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Ex: Dupont">
                        <div id="nom_error" class="error-text titanic">Veuillez entrer un nom.</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="poste">Poste / Fonction <span class="text-required">*</span></label>
                        <input type="text" id="poste" name="poste" class="form-control" placeholder="Ex: Chef de projet, CTO...">
                        <div id="poste_error" class="error-text titanic">Veuillez indiquer le poste.</div>
                    </div>

                    <div class="form-group">
                        <label for="entreprise">Entreprise rattachée <span class="text-required">*</span></label>
                        <select id="entreprise" name="entreprise" class="form-control">
                            <option value="" disabled selected>-- Choisir une structure --</option>
                            <option value="greenmarket">GreenMarket SAS</option>
                            <option value="dupond">Groupe Dupond</option>
                        </select>
                        <div id="entreprise_error" class="error-text titanic">Veuillez sélectionner une entreprise.</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Adresse Email <span class="text-required">*</span></label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="jean.dupont@exemple.com">
                        <div id="email_error" class="error-text titanic">Veuillez entrer un email valide.</div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Numéro de téléphone</label>
                        <input type="tel" id="phone" name="phone" class="form-control" placeholder="06 12 34 56 78">
                    </div>
                </div>

                <div class="form-group">
                    <label for="notes">Notes internes (Optionnel)</label>
                    <textarea id="notes" name="notes" class="form-control" placeholder="Informations complémentaires, disponibilités, etc." style="min-height: 80px;"></textarea>
                </div>

                <div class="form-actions">
                    <a href="contacts.php" class="btn-cancel">Annuler</a>
                    <button type="submit" class="btn-submit">Enregistrer le contact</button>
                </div>

            </form>
        </div>

    </div>

    <script src="./../javascript/new_contacts.js"></script>
</body>
</html>