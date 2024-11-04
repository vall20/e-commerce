<?php
require("config/commandes.php"); // Inclut le fichier qui contient des fonctions pour interagir avec le panier et la base de données

if (session_status() === PHP_SESSION_NONE) {
  session_start(); // Démarre une session si elle n'est pas déjà active
}

$userId = $_SESSION['id_user']; // Récupère l'ID de l'utilisateur à partir de la session
$c = $_SESSION['utilisateur']; // Récupère le nom ou les informations de l'utilisateur
if (!isset($userId)) {
    header('Location: Users.php'); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
}

$db = new PDO("mysql:host=localhost;dbname=site_e_commerce;charset=utf8", "root", ""); // Connexion à la base de données

// Prépare une requête pour récupérer les informations de l'utilisateur
$select = $db->prepare("SELECT * FROM user WHERE id_user = ?");
$select->execute(array($userId)); // Exécute la requête
if ($select->rowCount() > 0) {
    $fetch_user = $select->fetch(PDO::FETCH_ASSOC); // Récupère les informations de l'utilisateur
}

$panier = affiche_panier($userId); // Récupère le contenu du panier de l'utilisateur

// Gestion de la suppression d'un produit du panier
if (isset($_POST['supprimer'])) {
  $id = $_POST['id']; // ID du produit à supprimer
  supprimerDuPanier($id); // Appelle la fonction pour supprimer le produit du panier
}

// Initialiser la quantité si elle n'est pas définie
if (!isset($_SESSION['quantite'])) {
    $_SESSION['quantite'] = 1; // Définit une quantité par défaut
}

// Gestion de l'ajout de quantité d'un produit
if (isset($_POST['ajout'])) {
  $qte = $_POST['quantite'];
  $id_produit = $_POST['id_pro'];
  $user = $_POST['id_user'];
  
   $stmt = $db->prepare("UPDATE panier SET quantite = quantite + ? WHERE id_prod = ? AND id_user = ?");
   $stmt->execute(array($qte, $id_produit, $user)); // Met à jour la quantité dans le panier
}

// Gestion de la réduction de quantité d'un produit
if (isset($_POST['sup'])) {
   $qte = $_POST['quantite'];
   $id_produit = $_POST['id_pro'];
   $user = $_POST['id_user'];
   $stmt = $db->prepare("UPDATE panier SET quantite = quantite - ? WHERE id_prod = ? AND id_user = ?");
   $stmt->execute(array($qte, $id_produit, $user)); // Réduit la quantité dans le panier
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Définit le jeu de caractères -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Assure une mise en page responsive -->
    <title>panier?</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> <!-- Inclut Bootstrap pour le style -->
</head>
<body class="panier">
<section class="h-100 h-custom" style="background-color: black;"> <!-- Section principale du panier -->
  <div class="container py-5 h-100">  
        <div class="card card-registration card-registration-2" style="border-radius: 15px;"> <!-- Carte pour le panier -->
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0">PANIER</h1> <!-- Titre de la section -->
                    <h6 class="fa-solid fa-cart-shopping">3 items</h6> <!-- Compteur d'articles -->
                  </div>
                 <?php
                 $total = 0; // Initialisation du total

                 // Vérifie si le panier est vide
                 if (empty($panier)) {
                  echo "Votre panier est vide."; // Message si le panier est vide
                } else {
                  // Boucle pour afficher chaque produit dans le panier
                  foreach($panier as $produit):
                   $total += $produit->quantite * $produit->prix; // Calcule le total
                 ?>
                 <form method="post"> <!-- Formulaire pour chaque produit -->
                  <hr class="my-4">
                  <div class="row mb-4 d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img src="<?=$produit->img?>" class="img-fluid rounded-3"> <!-- Affiche l'image du produit -->
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <h6 name="nom" class="mb-0"><?=$produit->nom?></h6> <!-- Nom du produit -->
                    </div>
                    
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                    <input class="btn btn-danger btn-block" name="sup" type="submit" value="-" style="width: 15px"> <!-- Bouton pour réduire la quantité -->
                    <div name="quantite" value="<?=$produit->quantite?>" style="width: 80px"><?=$produit->quantite?></div> <!-- Affiche la quantité -->
                      <input name="quantite" value="<?=$produit->quantite?>" type="hidden"> <!-- Quantité cachée -->
                      <input class="btn btn-danger btn-block" name="ajout" type="submit" value="+" style="width: 15px"> <!-- Bouton pour augmenter la quantité -->
                    </div>
                   
                    <input type="hidden" name="id" value="<?=$produit->id?>"> <!-- ID du produit -->
                    <input type="hidden" name="id_user" value="<?=$produit->id_user?>"> <!-- ID de l'utilisateur -->
                    <input type="hidden" name="id_prod" value="<?=$produit->id_prod?>"> <!-- ID du produit -->
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h6 class="mb-0"><?=$produit->prix?>&euro;</h6> <!-- Affiche le prix du produit -->
                      <input name="supprimer" type="submit" value="supprimer" class="btn btn-danger btn-block"> <!-- Bouton pour supprimer le produit -->
                    </div>
                    
                  </div>
                  </form>
                  <hr class="my-4">
                    <?php
                    endforeach; // Fin de la boucle foreach
                  } 
                     ?>
                    <div class="d-flex justify-content-between mb-5">
                    <h5 class="text-uppercase">TOTAL</h5> <!-- Affiche le total -->
                    <h5><?=$total?>&euro;</h5> <!-- Montant total -->
                  </div>
                 
                    <h6 class="mb-0"><a href="site.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Retour à l'acceuil</a></h6> <!-- Lien de retour à l'accueil -->
                  <br>
                  <br>
                  <button type="button" data-mdb-button-init data-mdb-ripple-init class="text-center btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">PAYER</button> <!-- Bouton pour payer -->
                </div>
              
        
      </div>
   
  </div>
</section>
</body>
<style>
    @media (min-width: 125px) {
        .h-custom {
            height: 100vh !important; /* Assure que la section a une hauteur complète*/
        }
    }

    .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
    }

    .card-registration .select-arrow {
        top: 13px;
    }
</style>
</html>
