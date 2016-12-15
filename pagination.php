<?php

require_once 'settings/bdd.inc.php';
require_once 'settings/init.inc.php';

$nbarticle = 2; // 2 article par page
$mavariable = isset($_GET['p']) ? $_GET['p'] : 1; // paramètre dans url pour le nombre de page
//$debut = ($mavariable -1) * $nbarticle; // index depart ( ancien )

function returnIndex($nbarticle, $mavariable) {  // fonction calcul de depart de l'index
    $debut = ($mavariable - 1) * $nbarticle; // index depart 
    return $debut;
}

$indexDepart = returnIndex(2, 10); //execution de la variable selon mes paramètres 
//echo '<br/><h2><b>Page: '. $mavariable . ' -Index de départ : <u>' . $debut .'</u></b></h2>';

$sql = $bdd->prepare("SELECT COUNT(*)as nbArticles FROM articles WHERE publie = :publie");
$sql->bindValue(':publie', 1, PDO::PARAM_INT); //sécurisation des variables
$sql->execute(); // execution de la requete
$tabResult = $sql->fetchAll(PDO::FETCH_ASSOC); // recupere les valeur dans un tableau
$nbarticles = $tabResult[0] ['nbArticles'];
$nbPages = ceil($nbarticles / $nbarticle);  // calcul  
//echo '<br/><h2><b>Page: '. $mavariable . ' -Index de départ : <u>' . $indexDepart .'</u></b></h2><h2>Nombre d\'article en bdd : ' .$nbarticles . ' -Nombre de pages à créer : ' .$nbPages . '</h2> ';
//travail a fiare 
// dans l'index pour  chaque article avoir un bouton on doit pouvoir modifier un articles et chareger le contenue de articles
//for each crre un lien dynamique
//  preparler sql et la securiser
//changer la valeur ajouter à modifier

if (!empty($id)) {
    $sql = "UPDATE articles SET titre = '$titre', texte = '$texte', publie='$publie' WHERE id='$id'";
} 
    else$sql = "INSERT INTO articles (titre, texte, date, publie) VALUE ('$titre', '$texte', '$date_ajout', '$publie')";
mysql_query("set names 'utf8'");
mysql_query($sql);
{
    
}

// champs caché 
<input type = "HIDDEN" value = "valeur_que_tu_veux_transmettre" >
        // UTILISATEURS
        // HTML
        // création d'une nouvelle page qui se nomme connexion.php
        // formulaire html ou on va rentrer les informatioons 2 champs et bouton
        // 
        // PHP
        // on verifie si des valeurs ont été poster 
        // comparer en base les couple login /mdp
        // 
        //  si ok :
        // cree une variable aléatoire 
        // inserer cette variable en base
        // creer le cookie
        // Rediriger l'utilisateur vers accueil
        // afficher message de confirmation
        // si NON :
        // rediriger vers la page login 
        // afficher message erreur



       // $sql = "SELECT * FROM utilisateurs WHERE email = :email AND mdp= :mdp";
$sql->bindValue(':email', $_POST['email'], PDO::PARAM_STR); //sécurisation des variables
$sql->bindValue(':mdp', $_POST['mdp'], PDO::PARAM_STR); //sécurisation des variables
$sql->execute();

$sth = $bdd ->prepare("SELECT * FROM utilisateurs WHERE email = :email AND mdp= :mdp");
$sth->bindValue(':email', $_POST['email'], PDO::PARAM_STR); //sécurisation des variables
$sth->bindValue(':mdp', $_POST['mdp'], PDO::PARAM_STR); //sécurisation des variables
$sth->execute();
$count = $sth->rowCount();

= 0 pas bon 
        
        = 1 bon
        
$sid = md5($email . time());

setcookie('sid', $sid, time()+30);

// creation d'une session avec le message
?>


// cree un fichier connection.inc.php ( inclure dans toute les pages )
// tester la presence du cookie sid et s'assurer qu'il n'est pas vide
// si condition ok :
requette dans la table utilisateur pour vérifier la correspondance du sid
Rowcount >0 alors créér une varible $connecte = true

si Rowcount ==0 :
$connecte= FALSE

else {
       echo 'le login et mot de passe sont incorrecte';
      header("Location: connection.php"); 
}  