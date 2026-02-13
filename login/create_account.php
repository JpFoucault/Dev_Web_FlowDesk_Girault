<?php
session_start();

$old_input = $_SESSION['form_data'] ?? [];
$error_msg = $_GET['error'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">
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
        .error-banner { 
            background-color: #f8d7da; color: #721c24; 
            padding: 10px; border-radius: 5px; margin-bottom: 15px; 
            text-align: center; border: 1px solid #f5c6cb;
        }
    </style>
    <link rel="icon" type="image/png" sizes="32x32" href="./../assets/Onlylogo.png">
</head>
<body>

    <div class="create_account_card">
        <div>
            <img src="./../assets/FlowDesklogo.png" alt="Logo FlowDesk" class="logo-img">
            <div class="description_login">
                <p>Création d'un compte FlowDesk.</p>
                <div class="already_have_account">
                    <p>Vous possédez déjà un compte ?</p>
                    <a href="login.php" class="link_aha">Cliquez-ici</a>
                </div>
            </div>
        </div>

        <?php if($error_msg): ?>
            <div class="error-banner"><?php echo htmlspecialchars($error_msg); ?></div>
        <?php endif; ?>

        <form id="create_account_form" action="create.php" method="post">

            <div class="form-group">
                <label>Prénom<span class="text-required">*</span></label>
                <input type="text" name="prenom" value="<?php echo htmlspecialchars($old_input['prenom'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label>Nom<span class="text-required">*</span></label>
                <input type="text" name="nom" value="<?php echo htmlspecialchars($old_input['nom'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label>Email professionnel<span class="text-required">*</span></label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($old_input['email'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label>Mot de passe provisoire<span class="text-required">*</span></label>
                <input type="password" name="password" required>             
                <span class="required_password">Requis: 1 Majuscule, 1 Chiffre, Min 7 caractères</span>
            </div>

            <div class="form-group">
                <label>Rôle dans l'application<span class="text-required">*</span></label>
                <select name="role">
                    <option <?php echo (isset($old_input['role']) && $old_input['role'] == 'Collaborateur (Interne)') ? 'selected' : ''; ?>>Collaborateur (Interne)</option>
                    <option <?php echo (isset($old_input['role']) && $old_input['role'] == 'Client (Externe)') ? 'selected' : ''; ?>>Client (Externe)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Entreprise rattachée<span class="text-required">*</span></label>
                <select id="account_firm" name="firm_id" required>
                    <option disabled <?php echo empty($old_input['firm_id']) ? 'selected' : ''; ?>>-- Choisir une entreprise --</option>
                    <option value="Entreprise A" <?php echo (isset($old_input['firm_id']) && $old_input['firm_id'] == 'Entreprise A') ? 'selected' : ''; ?>>Entreprise A</option>
                    <option value="Entreprise B" <?php echo (isset($old_input['firm_id']) && $old_input['firm_id'] == 'Entreprise B') ? 'selected' : ''; ?>>Entreprise B</option>
                </select>
            </div>

            <button type="submit" class="btn-login">Créer l'utilisateur</button>
        </form>
    </div>
</body>
</html>