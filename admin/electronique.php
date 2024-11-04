<?php
require("../config/commandes.php"); // Inclut le fichier "commandes.php" qui contient  des fonctions pour interagir avec la base de données
#require("panier.php");
$prod=affiche(); // Appelle la fonction "affiche()" pour obtenir une liste de produits
session_start();

if (isset($_POST["ajout_panier"])) {
    $id_produit = $_POST['id_prod'];
    $quantite = $_POST['quantite']; 
    $prix = $_POST['prix'];
    $nom = $_POST['nom']; 
    $image= $_POST['img'];
    
    
    if (isset($_SESSION['utilisateur'])) {
        ajouterAuPanier($id_produit, $quantite ,$prix,$nom,$image,$user);
    } else {
        // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
       header("Location: Users.php");
        exit;
    }
}




// HTML commence ici
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"> <!-- Définit le jeu de caractères utilisé -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Assure une mise en page responsive -->
    <link rel="stylesheet" href="site7.css"> <!-- Inclut le fichier CSS pour les styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> <!-- Inclut les icônes de FontAwesome -->
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>val</title> <!-- Titre de la page -->
</head>
<body>
    <nav class="bar"> <!-- Barre de navigation -->
        <h1>
            <img class="l" src="../logo_.png" width="70" height="70" alt="" > <!-- Logo du site -->
        </h1>
        <form id="searchForm">
    <input type="text" id="searchQuery" placeholder="Rechercher des produits...">
</form>
<div id="searchResults"></div>
<script>
document.getElementById('searchQuery').addEventListener('input', function() {
    var query = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'rex.php?query=' + encodeURIComponent(query), true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('searchResults').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
});
</script>

        <style>
            .l{border-radius: 30px;} <!-- Style pour le logo 
        </style>
        <div class="logo">
            <ul class="menu">
                <li><a href="../site.php" class="act">Accueil</a></li> <!-- Lien vers la page d'accueil -->

                <li class="categorie" ><a>Catégories</a>

                    <ul class="sous_cat">
                       
                       <li> <a href="vetements.php">Vêtements</a></li> <!-- Sous-catégorie Vêtements -->
                       <li><a href="accessoires.php">Accessoires</a></li><!-- Sous-catégorie Accessoires -->

                    </ul>
                </li>

                <li><a href="">À propos</a></li> <!-- Lien vers la page À propos -->
               
              
                <li class="categorie"><a class="fa-solid fa-user" ></a>

                  <ul class="sous_cat">
                      <li><a href="../Users.php" class="fa-solid fa-user">Connexion</a></li>
                      <li><a href="../creation_de compte.php"  class="fa-solid fa-user">Inscription</a></li>
                      <li><a href="../admin.php" class="fa-solid fa-user">Admin</a></li> <!-- Icône deadmin -->
                
                   </ul>
                </li> <!-- Icône de l'utilisateur -->
              

                <li><a href="../panier.php" class="fa-solid fa-cart-shopping">shop</a></li> <!-- Icône du panier -->
               
               
            </ul>
        </div>
    </nav>
    <section class="content"> <!-- Section principale du contenu -->
        <h1>Nouveautés</h1> <!-- Titre de la section -->
        <p>Nouveau catalogue</p> <!-- Description de la section -->
        <button>Découvrir</button> <!-- Bouton pour découvrir les nouveautés -->
    </section>
    <h1 class="produits_text"> Nos produits en ventes</h1> <!-- Titre pour la section des produits -->
   
    <section class="sec_prod">
   
        <div class="produits">
            <?php 
            foreach($prod as $row ):
           // while ($row = $stmt->fetch(PDO::FETCH_OBJ)) { ?> <!-- Boucle pour afficher les produits -->
                <form method="post"  > <!-- Formulaire pour chaque produit -->
                    <div class="carte">
                    <input type='hidden' name="quantite" id="quantite" value='1' >
                    <input type='hidden' name="img"  value='<?= $row->image_prod ?>'>
                        <div name="img" class="img"><img src="<?= $row->image_prod ?>" alt=""></div> <!-- Image du produit -->
                        <div class="desc"><?= $row->description_prod ?></div> <!-- Description du produit -->
                        <div name="nom" class="titre"value="<?= $row->nom_prod ?>"><?= $row->nom_prod ?></div> <!-- Nom du produit -->
                        <div class="box">
                        <input type='hidden' name="nom" id="nom" value='<?= $row->nom_prod ?>' >
                            <div name="prix" class="prix"><?= $row->prix_prod ?>&euro;</div> <!-- Prix du produit -->
                            <input type='hidden' name="prix" id="prix" value='<?= $row->prix_prod ?>'>
                            
                            <input type='hidden' name="id_prod" value='<?= $row->id_prod ?>'> <!-- Ajout de l'input caché -->
                         
                            <input type="submit" name="ajout_panier" class="btn btn-danger btn-block " value="Ajouter au panier"><!-- Bouton d'achat -->
                        </div>
                    </div>
                    </form>
            <?php //}

            endforeach; ?> <!-- Fin de la boucle foreach -->
            
             
        </div>
       
    </section>
    
</body>
</html>

<style>
 /* Réinitialise les marges et les remplissages de tous les éléments */
 *{
    margin: 0;
    padding: 0;
}

/* Définit la hauteur du corps du document à 100% */
body{
    height: 100%;
}

/* Style pour la barre de navigation */
.bar {
    padding: 20px 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0%;
    z-index: 999; /* S'assure que la barre reste au-dessus des autres éléments */
    background-color: black;
}



/* Style pour les éléments du menu dans la barre */
.bar .menu {
    list-style: none; /* Retire les puces de la liste */
   display: flex;/* Affiche les éléments en ligne */
  
}
/* Style pour les liens du menu */
.bar li a{
    color:darkseagreen;
    padding:20px;
    display: block;
    font-size: 15px;
    font-weight: bold;
    text-decoration: none;
}


.categorie{
    color:darkseagreen;
    position:relative ;
  
}



.sous_cat {
list-style: none;
display:none;
position: absolute;
top: 50px;
left: 0;
background-color: black;
width: max-content;
border-radius: 25px;
}



.categorie:hover .sous_cat{
display: block;
}


.sous_cat li a:hover{
    background: floralwhite;
border-radius: 25px;
}


 /*Style pour le contenu principal */
.content{
    background-image: url(https://images.pexels.com/photos/8058637/pexels-photo-8058637.jpeg?auto=compress&cs=tinysrgb&w=400);
    background-size: cover;
    display: flex;
    padding: 0 5%;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    height: 100vh; /* Hauteur de la vue complète */
   /* color: slategray;*/
    
    background-repeat: no-repeat;
}*/

/* Style pour le titre principal du contenu */
.content h1{
    font-size: 40px;
}

/* Style pour les paragraphes du contenu */
.content p{
    font-size: 20px;
    margin-top: 20px;
}

/* Style pour les boutons du contenu */
.content button{
    margin-top: 30px;
    padding: 15px;
    border: none;
    background: #f6f6;
    color: azure;
    border-radius: 5px;
    cursor: pointer;
}

/* Style pour le texte des produits */
.produits_text{
    text-align: left;
    font-size: 30px;
    font-weight: 300;
    margin-top: 30px;
    margin-left: 80px;
    color: #424144;
}

/* Style pour la section des produits */
.section_produit{
    padding: 40px 5;
}

/* Style pour l'affichage des produits en grille */
.produits{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
}

/* Style pour chaque carte produit */
.produits .carte{
    width: 310px;
    background: silver;
    box-shadow: 0 10px 20px rgba(0,0,0,0.3);
    border-radius: 20px;
    margin-bottom: 20px;
}

/* Style pour les images dans les cartes produit */
.produits .carte img{
    height: 250px;
    width: 100%;
    border-radius: 10px;
}

/* Style pour la description dans les cartes produit */
.produits .carte .desc{
    padding: 5px 20px;
    opacity: 0.8;
}

/* Style pour les titres des cartes produit */
.produits .carte .titre{
    font-weight: 900;
    font-size: 20px;
    color: #424144;
    padding: 0 20px;
}

/* Style pour le conteneur de la boîte des cartes produit */
.produits .carte .box{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
}

/* Style pour les prix des produits */
.produits .carte .prix{
    color: rosybrown;
    font-size: 20px;
    font-weight: bold;
}


/* Style pour le bouton d'achat au survol */
.produits .carte .box .achat:hover{
    cursor: pointer;
    background: black;
    color: white;
}
</style>

   

</body>
</html>