<?php
session_start(); // ouverture de session , qui permet de la conservé a chaque page 
require_once 'settings/bdd.inc.php'; 
require_once 'settings/init.inc.php'; 
include_once 'includes/header.inc.php';   
    
if(isset($_SESSION['statut_connexion']) == TRUE) {
    ?>
   <div class="alert alert-success" role="alert">  <!-- alerte pour article si sa fonctionne --> 
  <strong>Félicitation!</strong> Votre connexion est réussie.
</div>

<?php
}
$nbarticle = 2; // 2 article par page
$mavariable = isset($_GET['p']) ? $_GET['p'] : 1 ; // paramètre dans url pour le nombre de page

 function returnIndex($nbarticle,$mavariable){  // fonction calcul de depart de l'index
$debut = ($mavariable -1) * $nbarticle; // index depart 
return $debut;
 }
 $indexDepart = returnIndex($nbarticle,$mavariable); //execution de la variable selon mes paramètres 


$sql= $bdd->prepare("SELECT COUNT(*)as nbArticles FROM articles WHERE publie = :publie");
$sql->bindValue(':publie', 1, PDO::PARAM_INT); //sécurisation des variables
$sql->execute(); // execution de la requete
$tabResult = $sql->fetchAll(PDO::FETCH_ASSOC); // recupere les valeur dans un tableau
$nbarticles = $tabResult[0] ['nbArticles'];
$nbPages = ceil($nbarticles/$nbarticle);  // calcul de nombre de page

$sth = $bdd->prepare("SELECT id, titre, texte, DATE_FORMAT(date, '%d/%m/%Y') as date_fr FROM articles WHERE publie = :publie LIMIT $indexDepart, $nbarticle"); //preparation de la requête

$sth->bindValue(':publie', 1, PDO::PARAM_INT); //sécurisation des variables

$sth->execute(); // execution de la requete 

$tab_articles = $sth->fetchAll(PDO::FETCH_ASSOC);

//print_r($tab_articiles); // afficher les champs et la clé 
?>

<div class="span8">

    <?php
foreach ($tab_articles as $value) {
    ?>
<h2><?php echo $value['titre'] ?>  </h2> <!-- formulaire -->
<img src="img/<?php echo $value['id'] ?>.jpg" width="100px" alt="titre"/>
<p style="text-align: justify;"><?php echo $value['texte'] ?></p>
<p><em><u> Publié le : <?php echo $value['date_fr'] ?> </u> </em> </p>  
<a href="article.php?id=<?=  $value['id']; ?> ">modifier l'article </a>
<?php
}
?>
<div class="pagination">
    <ul>
        <li><a>Page : </a></li> <!-- graphique des liens vers les pages -->
<?php


for($i = 1; $i <= $nbPages; $i++){

    //echo "$i";    // savoir le nombre de page en tout sur le site
    ?>
<li><a href="index.php?p=<?php echo $i ?>"><?=  $i; ?> </a></li> <!-- pour faire les pages 1,2,3 etc..  --> 
<?php
} // faire la pagination de page
?>
</ul>
</div>

    <!-- notifications -->

    <!-- contenu -->

 

</div>

<?php 
include_once 'includes/menu.inc.php';
include_once 'includes/footer.inc.php'; 
?>


