<?php
require("../config/commandes.php");

if(isset($_POST["envoyer"])){
    $nom=$_POST["nom"];
    $email=$_POST["email"] ;
    $mot_de_passe=$_POST["mot_de_passe"] ;
    $confirm=$_POST["confirm"] ;

    if($mot_de_passe!= $confirm){
   echo"<p class='erreur'>les mot de passe sont différents</p>";
    }else{
        $user=utilisateurs($nom,$email,$mot_de_passe);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREER UN COMPTE</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="text-center">

             

              <form method="post">
              <img class="mb-4" src="logo_.png" alt="" width="70" height="70">
              <h2 class="text-uppercase text-center mb-5">CREER UN COMPTE</h2>

              <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form3Example1cg">Nom</label>
                  <input name="nom" type="text" id="form3Example1cg" class="form-control form-control-lg" />
                  </div>

               
                  <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form3Example3cg"> Email</label>
                  <input name="email" type="email" id="form3Example3cg" class="form-control form-control-lg" />
                  </div>


                  <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form3Example4cg">Mot de passe</label>
                  <input name="mot_de_passe" type="password" id="form3Example4cg" class="form-control form-control-lg" />
                  </div>

           

                  <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form3Example4cdg">Confirmer votre mot de passe</label>
                  <input name="confirm" type="password" id="form3Example4cdg" class="form-control form-control-lg" />
                  </div>

             
                <div class="form-check d-flex justify-content-center mb-5">
                 
                  <label class="form-check-label" for="form2Example3g">
                  <a href="../site.php" >&leftarrow;</a> Retour a l'accueil
                  </label>
                </div>

                <div class="d-flex justify-content-center">
                  <button name="envoyer" type="submit" data-mdb-button-init
                  class="btn btn-lg btn-primary btn-block">Inscription</button>
                </div>

                <p >vous avez dejà un compte? <a href="Users.php"
                    >Connexion</a></p>

                    <p >&copy; 2024-2025</p>

              </form>

</body>
<style>
body{
    
    background-color: black;
    box-shadow: 0 .5rem 2rem #84fab0;
   
    height: max-content  ;
    width: 25vh;
    border-radius: 25px;
  margin-top: 100px;
   margin-left: 45%;
}
label{
    color:antiquewhite;
    font-family: 'Courier New', Courier, monospace;
}
.gradient-custom-3 {
/* fallback for old browsers */
background:black;

/* Chrome 10-25, Safari 5.1-6 */
/*background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));*/

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
/*background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))*/
}
.btn-block {
/* fallback for old browsers */
background: #84fab0;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
}

a{
    text-decoration: none;
    font-size: 25px;
    color: #84fab0;
    font-family: 'Courier New', Courier, monospace;
}
.erreur{
    color:red;
}

.valider{
    color:green;


}
p{
    text-decoration: none;
    font-size: 20px;
    color:antiquewhite;
    font-family: 'Courier New', Courier, monospace;
}
</style>
</html>