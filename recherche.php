<?php
require("config/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
</head>
<body>

    <section class="sec_prod">
   
   <div class="produits">
       <?php 
     if (isset($_GET['query'])) {
        $query = $_GET['query'];
    
        // Prépare la requête SQL pour rechercher les produits correspondants
        $stmt = $db->prepare("SELECT * FROM produits WHERE nom_prod LIKE ? OR description_prod LIKE ?");
        $stmt->execute(['%' . $query . '%', '%' . $query . '%']);
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        // Génère le HTML pour les résultats de la recherche
    if (!empty($results)) {
        foreach ($results as $row) {
          echo"
               <div class='carte'>
               <input type='hidden' name='quantite' id='quantite' value='1' >
               <input type='hidden' name='img'  value='<?= $row->image_prod ?>'>
                   <div ><img src=src='" . htmlspecialchars($row->image_prod) . "'alt=''></div> <!-- Image du produit -->
                   <div class='desc'>" . htmlspecialchars($row->description_prod) . "</div> <!-- Description du produit -->
                   <div name='nom' class='titre' value='<?= $row->nom_prod ?>'>" . htmlspecialchars($row->nom_prod) . "</div> <!-- Nom du produit -->
                   <div class='box'>
                   <input type='hidden' name='nom' id='nom' value='<?= $row->nom_prod ?>' >
                       <div name='prix' class='prix'>" . htmlspecialchars($row->prix_prod) . "&euro;</div> <!-- Prix du produit -->
                       <input type='hidden' name='prix' id='prix' value='<?= $row->prix_prod ?>'>
                       
                       <input type='hidden' name='id_prod' value='<?= $row->id_prod ?>'> <!-- Ajout de l'input caché -->
                    
                       <input type='submit' name='ajout_panier' class='btn btn-danger btn-block ' value='Ajouter au panier'><!-- Bouton d'achat -->
                   </div>
               </div>
               </form> 
               ";
            }
        } else {
            echo "<p>Aucun produit trouvé.</p>";
        }
    }
        ?> 
       
        
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