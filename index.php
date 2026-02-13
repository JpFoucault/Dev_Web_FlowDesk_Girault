<?php

function redirect_with_message(string $location, string $type, string $message): void {
    $separator = strpos($location, '?') === false ? '?' : '&';
    header("Location: {$location}{$separator}{$type}=" . urlencode($message));
    exit;
}

if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        if ($action === 'login') {
            $email = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                redirect_with_message('login/login.php', 'error', 'Email invalide.');
            }

            if ($password === '') {
                redirect_with_message('login/login.php', 'error', 'Mot de passe requis.');
            }

            header('Location: user/dashboard.php');
            exit;
        }

        if ($action === 'create_account') {
            $prenom = trim($_POST['prenom'] ?? '');
            $nom = trim($_POST['nom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $role = trim($_POST['role'] ?? '');
            $firm = trim($_POST['firm_id'] ?? '');

            if ($prenom === '' || $nom === '' || $role === '' || $firm === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                redirect_with_message('login/create_account.php', 'error', 'Formulaire incomplet ou invalide.');
            }

            if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{7,}$/', $password)) {
                redirect_with_message('login/create_account.php', 'error', 'Mot de passe non conforme.');
            }

            redirect_with_message('login/login.php', 'success', 'Compte cree avec succes.');
        }

        if ($action === 'forget_password') {
            $email = trim($_POST['username'] ?? '');

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                redirect_with_message('login/forget_password.php', 'error', 'Email invalide.');
            }

            redirect_with_message('login/confirm_email.php', 'success', 'Code envoye par email.');
        }

        if ($action === 'confirm_email') {
            $code = trim($_POST['code'] ?? '');

            if ($code === '' || !preg_match('/^\d{4,8}$/', $code)) {
                redirect_with_message('login/confirm_email.php', 'error', 'Code invalide.');
            }

            header('Location: user/dashboard.php');
            exit;
        }

        redirect_with_message('login/login.php', 'error', 'Action inconnue.');
    }

    header('Location: login/login.php');
    exit;
}

// --- CLASSE TICKET (create_tickets.php) ---
class Ticket {
    public string $titre;
    public string $projet;
    public string $type;
    public string $priorite;
    public ?string $delai;
    public string $description;

    public function __construct(array $data) {
        $this->titre = trim($data['titre'] ?? '');
        $this->projet = $data['projet'] ?? '';
        $this->type = $data['type'] ?? 'bug';
        $this->priorite = $data['priorite'] ?? 'medium';
        $this->delai = !empty($data['delai']) ? $data['delai'] : null;
        $this->description = trim($data['description'] ?? '');
    }

    public function set_new_row()
    {
        return [
            "titre" => $this->titre,
            "project" => $this->project,
            "type" => $this->type, 
            "priorite" => $this->priorite,
            "delai" => $this->delai,
            "description" => $this->description,
        ];
    }
    
    public function isValid(): bool {
        return !empty($this->titre) && !empty($this->projet) && !empty($this->description);
    }
}

// --- CLASSE PROJET (create_new_project.php) ---
class Projet {
    public string $nom;
    public string $client;
    public string $debut;
    public ?string $fin;
    public float $budget;
    public array $collaborateurs;

    public function __construct(array $data) {
        $this->nom = trim($data['nom_projet'] ?? '');
        $this->client = $data['client'] ?? '';
        $this->debut = $data['date_debut'] ?? '';
        $this->fin = !empty($data['date_fin']) ? $data['date_fin'] : null;
        $this->budget = (float)($data['budget'] ?? 0);
        $this->collaborateurs = $data['collabs'] ?? []; 
    }
}

// --- CLASSE FACTURE (new_bills.php) ---
class Facture {
    public string $numero;
    public string $client;
    public float $montant;
    public string $echeance;
    public string $statut;

    public function __construct(array $data) {
        $this->numero = trim($data['facture_num'] ?? '');
        $this->client = $data['client'] ?? '';
        $this->montant = (float)($data['montant'] ?? 0);
        $this->echeance = $data['echeance'] ?? '';
        $this->statut = $data['statut'] ?? 'sent';
    }
}

// --- CLASSE CONTACT (new_contacts.php) ---
class Contact {
    public string $nom;
    public string $prenom;
    public string $entreprise;
    public string $fonction;
    public string $email;
    public ?string $telephone;
    public ?string $notes;

    public function __construct(array $data) {
        $this->nom = trim($data['nom'] ?? '');
        $this->prenom = trim($data['prenom'] ?? '');
        $this->entreprise = trim($data['entreprise'] ?? '');
        $this->fonction = trim($data['fonction'] ?? '');
        $this->email = trim($data['email'] ?? '');
        $this->telephone = $data['phone'] ?? null;
        $this->notes = $data['notes'] ?? null;
    }
}

// --- CLASSE DOCUMENT (new_documents.php) ---
class Document {
    public string $nom;
    public string $categorie;
    public ?string $projetLie;
    public ?string $notes;

    public function __construct(array $data) {
        $this->nom = trim($data['doc_name'] ?? '');
        $this->categorie = $data['category'] ?? '';
        $this->projetLie = $data['project_link'] ?? null;
        $this->notes = $data['notes'] ?? null;
    }
}


// --- CLASSE USER ---
class User {
    public string $id;
    public string $prenom;
    public string $nom;
    public string $email;
    private string $passwordHash;
    public string $role;
    public string $firm_id;
    public string $created_at;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? uniqid('user_');
        $this->prenom = $this->sanitize($data['prenom'] ?? '');
        $this->nom = $this->sanitize($data['nom'] ?? '');
        $this->email = filter_var($data['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $this->role = $data['role'] ?? 'Collaborateur (Interne)';
        $this->firm_id = $data['firm_id'] ?? '';
        $this->created_at = date('Y-m-d H:i:s');
        
        if (!empty($data['password'])) {
            $this->setPassword($data['password']);
        }
    }

    private function sanitize($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    public function setPassword($password) {
        $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword($password): bool {
        return password_verify($password, $this->passwordHash);
    }

    public static function validate(array $data): array {
        $errors = [];

        if (empty($data['prenom']) || strlen(trim($data['prenom'])) < 2) {
            $errors['prenom'] = "Veuillez entrer un prénom valide (min 2 caractères).";
        }

        if (empty($data['nom']) || strlen(trim($data['nom'])) < 2) {
            $errors['nom'] = "Veuillez entrer un nom valide (min 2 caractères).";
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Veuillez entrer un email professionnel valide.";
        }

        $pwd = $data['password'] ?? '';
        if (strlen($pwd) < 7 || !preg_match('/[A-Z]/', $pwd) || !preg_match('/[0-9]/', $pwd)) {
            $errors['password'] = "Le mot de passe doit contenir 7 caractères, 1 majuscule et 1 chiffre.";
        }

        if (empty($data['firm_id'])) {
            $errors['firm_id'] = "Veuillez sélectionner une entreprise.";
        }

        return $errors;
    }
}
?>