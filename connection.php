<?php
session_start(); // ouverture de session , qui permet de la conservé a chaque page 
require_once 'settings/bdd.inc.php'; 
require_once 'settings/init.inc.php';
require_once 'libs/Smarty.class.php';



if(isset($_POST['connexion'])) {

//$email = $_POST['email'];
// $mdp = $_POST['mdp'];   
// echo $email;
// echo $mdp;
$sth = $bdd ->prepare("SELECT * FROM utilisateurs WHERE email = :email AND mdp= :mdp");
$sth->bindValue(':email', $_POST['email'], PDO::PARAM_STR); //sécurisation des variables
$sth->bindValue(':mdp', $_POST['mdp'], PDO::PARAM_STR); //sécurisation des variables
$sth->execute();
$count = $sth->rowCount();


if($count ==1 ) {
    echo 'la connection est réussie';
    $sid = md5($email . time());
    echo $sid;
    setcookie('sid', $sid, time()+30);
      $sql = $bdd->prepare("UPDATE utilisateurs SET sid = :sid WHERE email= :email"); // requete pour modifier un article
     $sql->bindValue(':sid',$sid, PDO::PARAM_STR); //sécurisation des variables
     $sql->bindValue(':email',$_POST['email'], PDO::PARAM_STR); //sécurisation des variables
      $sql->execute();
      $_SESSION['statut_connexion'] = TRUE;
      header("Location: index.php");
} else {
     $_SESSION['statut_connexion'] = FALSE;
     header("Location: connection.php");
    
}
    
}else {

    $smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
//$smarty->setConfigDir('/web/www.example.com/guestbook/configs/');
//$smarty->setCacheDir('/web/www.example.com/guestbook/cache/');

if(isset($_SESSION['statut_connexion'])){
$smarty->assign('statut_connexion',$_SESSION['statut_connexion']);
}
   unset($_SESSION['statut_connexion']) ; // détruire la session
   
   //** un-comment the following line to show the debug console
$smarty->debugging = true;


   include_once 'includes/header.inc.php';
   $smarty->display('connection.tpl');

   include_once 'includes/menu.inc.php';
include_once 'includes/footer.inc.php'; 

}

    
   
    ?>






  
    
    

    
    
   