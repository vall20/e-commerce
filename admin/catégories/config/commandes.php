<?php
// Fonction pour ajouter un produit à la base de données
function ajout_prod($nom, $image, $prix, $desc) {
    // Inclut le fichier de connexion à la base de données
    if (require("connection.php")) {
        // Prépare une requête d'insertion dans la table 'produits'
        $req = $db->prepare("INSERT INTO produits(nom_prod, image_prod, prix_prod, description_prod) VALUES(?,?,?,?)");
        // Exécute la requête avec les paramètres fournis
        $req->execute(array($nom, $image, $prix, $desc));
        echo "<p class='valider'>Votre produit a bien été ajouté</p>";
        $req->closeCursor(); // Ferme le curseur pour libérer la mémoire
    }
}

// Fonction pour afficher tous les produits
function affiche() {
    if (require("connection.php")) {
        if (isset($db)) { // Vérifie si la connexion a réussi
            try {
                // Prépare une requête pour sélectionner tous les produits, triés par ID décroissant
                $req = $db->prepare("SELECT * FROM produits ORDER BY id_prod DESC");
                $req->execute(); // Exécute la requête
                $data = $req->fetchAll(PDO::FETCH_OBJ); // Récupère toutes les données sous forme d'objet
                $req->closeCursor(); // Ferme le curseur
                return $data; // Retourne les données
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage(); // Affiche les erreurs éventuelles
            }
        } else {
            echo "Connexion à la base de données échouée."; // Message d'erreur si la connexion échoue
        }
    } 
}

// Fonction pour gérer l'inscription des utilisateurs
function utilisateurs($nom, $email, $mot_de_passe) {
    if (require("connection.php")) {
        if (isset($db)) {
            // Vérifie si l'adresse e-mail est déjà utilisée
            $req = $db->prepare("SELECT * FROM user WHERE email = :email");
            $req->execute([':email' => $email]);
            if ($req->fetchColumn() > 0) {
                echo "<p class='erreur'>Vous avez déjà un compte à cette adresse email</p>";
            } else {
                // Hachage du mot de passe pour le stockage sécurisé
                $hachage = password_hash($mot_de_passe, PASSWORD_DEFAULT);
                // Prépare une requête pour insérer un nouvel utilisateur
                $req = $db->prepare("INSERT INTO user(nom, email, mot_de_passe) VALUES(?,?,?)");
                $req->execute(array($nom, $email, $hachage)); // Exécute la requête
                echo "<p class='valider'>Votre compte a bien été enregistré</p>";
            }
        }
    }
}

// Fonction pour supprimer un produit du panier et de la base de données
function sup($id) {
    if (require("connection.php")) {
        $req = $db->prepare("DELETE FROM panier WHERE id_prod = ?"); // Supprime du panier
        $req->execute(array($id));
        $req = $db->prepare("DELETE FROM produits WHERE id_prod = ?"); // Supprime le  produit
        $req->execute(array($id));
    }
}

// Fonction pour connecter un utilisateur
function connexion_users($email, $mdp) {
    if (require("connection.php")) {
        $req = $db->prepare("SELECT id_user FROM user WHERE email = ? AND mot_de_passe = ?");
        $req->execute(array($email, $mdp)); // Exécute la requête
        $utilisateur = $req->fetch();
        if ($utilisateur) {
            echo "<p class='valider'>Vous êtes connecté</p>";
            session_start(); // Démarre une session
            $_SESSION['id_user'] = $utilisateur['id_user']; // Stocke l'ID utilisateur dans la session
            header("Location:user_connecter.php"); // Redirige l'utilisateur
        } else {
            echo "<p class='erreur'>Mot de passe ou email incorrect</p>"; // Affiche une erreur si la connexion échoue
        }
    }
}

// Fonction pour connecter un administrateur
function connexion_admin($email, $mdp) {
    if (require("connection.php")) {
        if (isset($db)) {
            $req = $db->prepare("SELECT id_admin FROM tb_admin WHERE email = ? AND mot_de_passe = ?");
            $req->execute(array($email, $mdp));
            if ($req->fetchColumn() > 0) {
                header("Location:ajout_produits.php"); // Redirige vers l'ajout de produits
                echo "<p class='valider'>Vous êtes connecté</p>";
            } else {
                echo "<p class='erreur'>Mot de passe ou email incorrect</p>";
            }
        } 
    }
}

// Fonction pour supprimer un produit du panier
function supprimerDuPanier($id) {
    if (require("connection.php")) {
        $req = $db->prepare("DELETE FROM panier WHERE id=?");
        $req->execute(array($id));
    }
}

// Fonction pour ajouter un produit au panier
function ajouterAuPanier($id_produit, $quantite, $prix, $nom, $image, $user) {
    if (require('connection.php')) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Démarre une session si ce n'est pas déjà fait
        }
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = []; // Initialise le panier s'il n'existe pas
        }
        if (isset($_SESSION['panier'])) {
            // Vérifie si le produit est déjà dans le panier
            $session_array_id = array_column($_SESSION['panier'], $id_produit); 
            if (!in_array($id_produit, $session_array_id)) {
                $stmt = $db->prepare("SELECT * FROM panier WHERE id_prod = ? AND id_user = ?");
                $stmt->execute(array($id_produit, $user));
                if ($stmt->rowCount() == 0) {
                    $session_array = array($id_produit, $quantite, $prix, $nom, $image);
                    $_SESSION['panier'][] = $session_array; // Ajoute le produit au panier en session
                    // Insère le produit dans la base de données
                    $stmt = $db->prepare("INSERT INTO panier (id_prod, quantite, nom, img, prix, id_user) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute(array($id_produit, $quantite, $nom, $image, $prix, $user));
                    echo "4";
                }
            } 
        }
    }
}

// Fonction pour afficher le contenu du panier d'un utilisateur
function affiche_panier($userId) {
    if (require("connection.php")) {
        // Sélectionne les produits du panier de l'utilisateur
        $req = $db->prepare("SELECT * FROM panier WHERE id_user = :userId ORDER BY id DESC");
        $req->execute(array(':userId' => $userId)); // Exécute la commande en liant l'ID de l'utilisateur
        $data = $req->fetchAll(PDO::FETCH_OBJ); // Récupère les données sous forme d'objet
        $req->closeCursor(); // Ferme le curseur
        return $data; // Retourne les données
    } 
}
?>
