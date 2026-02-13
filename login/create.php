<?php
session_start();

$host = 'localhost';
$dbname = 'FlowDesk'; 
$db_user = 'root';
$db_pass = 'root'; 
$port = '8888'; 

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $prenom = htmlspecialchars(trim($_POST['prenom'] ?? ''));
    $nom = htmlspecialchars(trim($_POST['nom'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $role_str = $_POST['role'] ?? '';
    $firm = htmlspecialchars(trim($_POST['firm_id'] ?? ''));
    
    $error = null;

    if (strlen($prenom) < 2 || strlen($nom) < 2) {
        $error = "Nom ou prénom trop court.";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email invalide.";
    }
    elseif (strlen($password) < 7 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $error = "Le mot de passe invalide (min 7 car., 1 Maj, 1 Chiffre).";
    }
    elseif (empty($firm)) {
        $error = "Veuillez choisir une entreprise.";
    }

    if (!$error) {
        try {
            $stmt = $pdo->prepare("SELECT Id FROM User WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $error = "Cet email est déjà utilisé.";
            } else {
                $role_id = ($role_str === 'Client (Externe)') ? 2 : 1;
                
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                $date_creation = date('Y-m-d');

                $sql = "INSERT INTO User (Nom, Prenom, email, password, role, firm, create_date) 
                        VALUES (:nom, :prenom, :email, :password, :role, :firm, :create_date)";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':nom' => $nom,
                    ':prenom' => $prenom,
                    ':email' => $email,
                    ':password' => $passwordHash,
                    ':role' => $role_id,
                    ':firm' => $firm,
                    ':create_date' => $date_creation
                ]);
                unset($_SESSION['form_data']);
                header("Location: login.php?success=created");
                exit();
            }
        } catch (PDOException $e) {
            $error = "Erreur technique : " . $e->getMessage();
        }
    }

    $_SESSION['form_data'] = $_POST;
    
    header("Location: create_account.php?error=" . urlencode($error));
    exit();
}
?>