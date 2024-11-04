<?php
require("../config/commandes.php");
if(isset($_POST["connexion"]) ){
$email=$_POST['mail'];
$mdp=$_POST['mdp'];
$user=connexion_users($email,$mdp);
}


?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
   

    <title>Connexion</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
   
  </head>

  <body class="text-center">
    <form method="post" class="form-signin">
      <img class="mb-4" src="logo_.png" alt="" width="70" height="70">
      
      <h2  class="text-uppercase text-center mb-5">Compte</h2>
      <div data-mdb-input-init class="form-outline mb-4">
      <label for="inputEmail" class="sr-only"> Address email</label>
      <input name="mail" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      </div>

      <div data-mdb-input-init class="form-outline mb-4">
      <label for="inputPassword" class="sr-only">Mot de passe</label>
      <input name="mdp" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      </div>

    
         <label class="form-check-label" for="form2Example3g">
                  <a href="../site.php" >&leftarrow;</a> Retour a l'accueil
                  </label>
                  <br>
                  <br>
                  <div class="d-flex justify-content-center">
      <button name="connexion" class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
      </div>

      <br>
      <p >vous avez pas de compte? <a href="creation_de compte.php"
                   > Inscription</a></p>
                  
                   
      <p >&copy; 2024-2025</p>
    </form>
  </body>
  <style>
body{
    
    background-color: black;
    box-shadow: 0 .5rem 1rem #84fab0;
    width: 315px;
    height:max-content;
  
    border-radius: 25px;
  margin-top: 100px;
   margin-left: 45%;
}

.btn-block {
/* fallback for old browsers */
background: #84fab0;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
}
label{
    color:antiquewhite;
    font-family: 'Courier New', Courier, monospace;
}
p{
    color:antiquewhite;
    font-family: 'Courier New', Courier, monospace;
}
a{
    text-decoration: none;
    font-size: 20px;
    color: #84fab0;
    font-family: 'Courier New', Courier, monospace;
}
.erreur{
    color:red;


}
  </style>
</html>
