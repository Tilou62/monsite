<?php

session_start(); // ouverture de session , qui permet de la conservé a chaque page 
require_once 'settings/bdd.inc.php'; 
require_once 'settings/init.inc.php';
include_once 'includes/header.inc.php';



if(isset($_POST['nom'])) {

$sth = $bdd ->prepare("INSERT INTO utilisateurs (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :mdp)");
$sth->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR); //sécurisation des variables
$sth->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR); //sécurisation des variables
$sth->bindValue(':email', $_POST['email'], PDO::PARAM_STR); //sécurisation des variables
$sth->bindValue(':mdp', $_POST['mdp'], PDO::PARAM_STR); //sécurisation des variables
$sth->execute();




    $_SESSION['inscription'] = TRUE; 
    
 
}
  ?>

<div class="span8">
    <!-- notifications -->
    
    <?php
        if(isset($_SESSION['inscription'])){  // condition si la valeur ajout_article existe
             
         
            ?>

   
 
    <div class="alert alert-success" role="alert">  <!-- alerte pour article si sa fonctionne --> 
  <strong>Félicitation!</strong> Votre inscription est réussie, veuillez vous connectez.
</div>
    <?php
        unset($_SESSION['inscription']) ; // détruire la session
           
        }
        
?>

    


                <!-- contenu -->
<form action="inscription.php" method="post" enctype="multipart/form-data" id="form_article" name="form_inscription" > <!-- formulaire -->
    <div class="clearfix">
        <label for="titre">Nom</label>
        <div class="input"><input type="text" name="nom" id="nom" value=""></div>
    </div>
    <div class="clearfix">
        <label for="titre">Prenom</label>
        <div class="input"><input type="text" name="prenom" id="prenom" value=""></div>
    </div>
    <div class="clearfix">
        <label for="titre">Email</label>
        <div class="input"><input type="text" name="email" id="email" value=""></div>
    </div>
    <div class="clearfix">
        <label for="texte">Mot de passe</label>
        <div class="input"><input type="password" name="mdp" id="mdp" value=""></div>
    </div>
 <div class="form-actions">
        <input type="submit" name="Inscription" value="S'inscrire" class="btn btn-large btn-primary">
    </div>

    
  <?php

 
   include_once 'includes/menu.inc.php';
   include_once 'includes/footer.inc.php'; 


        
    
?>

