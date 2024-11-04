 <?php
 try{/*test si il n'y pas d'erreur*/
   global $db;
    $db= new PDO("mysql:host=localhost;dbname=site_e_commerce;chraset=utf8","root","");

    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
 }catch(Exception $e){ 
$e->getMessage();
 }
 

 ?>
