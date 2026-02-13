<?php
session_start();

// Vérification de sécurité : Si l'utilisateur n'est pas connecté, on le renvoie au login
if (!isset($_SESSION['user_id'])) {
    header("Location: ./../login/login.php");
    exit();
}

require_once './../index.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nouveauProjet = new Projet($_POST);
    
    header('Location: project.php');
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

    <div class="content_create">
        
        <div class="form-card">
            <div class="form-header">
                <h1>Nouveau Projet</h1>
                <p>Définissez le cadre, le client, le budget et l'équipe pour ce nouveau projet.</p>
            </div>

            <form id="submitform" action="project.php" method="POST">

                <div class="form-section">
                    <h3 class="form-section-title">Informations générales</h3>
                    
                    <div class="form-group-project">
                        <label for="nom_projet">Nom du projet <span class="text-required">*</span></label>
                        <input type="text" id="nom_projet" name="nom_projet" class="form-control" placeholder="Ex: Site E-Commerce Bio">
                        <div id="project_name_error" class="error-text titanic">Le nom du projet est obligatoire.</div>
                    </div>

                    <div class="form-row">
                        <div class="form-group-project">
                            <label for="client">Client rattaché <span class="text-required">*</span></label>
                            <select id="client" name="client" class="form-control">
                                <option disabled selected>-- Sélectionner --</option>
                                <option>GreenMarket SAS</option>
                                <option>Groupe Dupond</option>
                                <option>FastDelivery</option>
                            </select>
                            <div id="client_name_error" class="error-text titanic">Sélectionner un client rattaché.</div>
                        </div>

                        <div class="form-group-project">
                            <label for="statut">Statut du projet <span class="text-required">*</span></label>
                            <select id="statut" name="statut" class="form-control">
                                <option disabled selected>-- Sélectionner --</option>
                                <option value="nouveau">Nouveau</option>
                                <option value="en_cours">En cours</option>
                                <option value="termine">Terminé</option>
                                <option value="en_pause">En pause</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group-project">
                        <label for="description">Description et contexte</label>
                        <textarea id="description" name="description" class="form-control" placeholder="Objectifs du projet, contraintes techniques, livrables attendus..."></textarea>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Planning</h3>
                    
                    <div class="form-row">
                        <div class="form-group-project">
                            <label for="start_date">Date de début <span class="text-required">*</span></label>
                            <input type="date" id="start_date" name="start_date" class="form-control">
                        </div>

                        <div class="form-group-project">
                            <label for="end_date">Date de fin prévisionnelle</label>
                            <input type="date" id="end_date" name="end_date" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Budget et ressources</h3>
                    
                    <div class="form-row">
                        <div class="form-group-project">
                            <label for="budget">Budget total (€)</label>
                            <input type="number" id="budget" name="budget" class="form-control" placeholder="Ex: 45000" step="100">
                            <p class="help-text">Budget alloué au projet en euros</p>
                        </div>

                        <div class="form-group-project">
                            <label for="temps_estime">Temps estimé (heures)</label>
                            <input type="number" id="temps_estime" name="temps_estime" class="form-control" placeholder="Ex: 320" step="1">
                            <p class="help-text">Estimation du nombre d'heures nécessaires</p>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Technologies utilisées</h3>
                    
                    <div class="form-group-project">
                        <label for="technologies">Technologies et outils</label>
                        <div class="tech-input-wrapper">
                            <input type="text" id="technologies" name="technologies" class="form-control" placeholder="Ex: React, Node.js, MongoDB...">
                            <button type="button" class="btn-add-tech">+ Ajouter</button>
                        </div>
                        <div id="tech-list" class="tech-list-container"></div>
                        <p class="help-text">Ajoutez les technologies une par une</p>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Équipe du projet</h3>
                    
                    <div class="form-group-project">
                        <label>Assigner l'équipe initiale</label>
                        <div class="collabs-grid">
                            
                            <label class="collab-option">
                                <input type="checkbox" name="collabs" value="jd">
                                <span class="avatar">JD</span>
                                <span class="collab-text">
                                    <span class="collab-name">Jean Dupont</span>
                                    <span class="collab-role">Chef de projet</span>
                                </span>
                            </label>

                            <label class="collab-option">
                                <input type="checkbox" name="collabs" value="al">
                                <span class="avatar av-yellow">AL</span>
                                <span class="collab-text">
                                    <span class="collab-name">Alice Lefebvre</span>
                                    <span class="collab-role">Développeur Full-Stack</span>
                                </span>
                            </label>

                            <label class="collab-option">
                                <input type="checkbox" name="collabs" value="mr">
                                <span class="avatar av-pink">MR</span>
                                <span class="collab-text">
                                    <span class="collab-name">Marc Robert</span>
                                    <span class="collab-role">Développeur Backend</span>
                                </span>
                            </label>

                            <label class="collab-option">
                                <input type="checkbox" name="collabs" value="ss">
                                <span class="avatar av-blue">SS</span>
                                <span class="collab-text">
                                    <span class="collab-name">Sarah Simon</span>
                                    <span class="collab-role">Designer UI/UX</span>
                                </span>
                            </label>

                            <label class="collab-option">
                                <input type="checkbox" name="collabs" value="kt">
                                <span class="avatar av-green">KT</span>
                                <span class="collab-text">
                                    <span class="collab-name">Kevin Thomas</span>
                                    <span class="collab-role">Développeur Frontend</span>
                                </span>
                            </label>

                            <label class="collab-option">
                                <input type="checkbox" name="collabs" value="pm">
                                <span class="avatar av-purple">PM</span>
                                <span class="collab-text">
                                    <span class="collab-name">Paul Martin</span>
                                    <span class="collab-role">DevOps Engineer</span>
                                </span>
                            </label>

                        </div>
                        <p class="help-text">Cochez les personnes qui travailleront sur ce projet.</p>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="project.php" class="btn-cancel">Annuler</a>
                    <button type="submit" class="btn-submit">Créer le projet</button>
                </div>

            </form>
        </div>

    </div>

    <script src="./../javascript/new_project.js"></script>

</body>
</html>