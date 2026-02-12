<?php

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
        // Récupère les cases cochées pour les collaborateurs
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
