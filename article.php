<?php
session_start(); // ouverture de session , qui permet de la conservé a chaque page 
require_once 'settings/bdd.inc.php'; 
require_once 'settings/init.inc.php'; 


if(isset($_POST['ajouter'])){
    //print_r($_FILES); // recupere les images
//exit(); //  arrete le script 

$date_ajout = date("Y-m-d"); // cree une date contenant la date de jour
$_POST['date'] = $date_ajout; // cree une nouvelle clé dans le tableau


/*if(isset($_POST['publie'])){  // condition si la valeur publie existe  pour eviter les erreurs php
    $_POST['publie'] = 1;
} else {
    $_POST['publie'] = 0;
} */    

// condition ternaire
$_POST['publie'] = isset($_POST['publie'])? 1 : 0; // : = sinon  ? = si le texte est concluent

//print_r($_POST); // recupere les formulaires de type post


 if($_FILES['image']['error'] ==0){  // condition si l'image  existe  pour eviter les erreurs php
   
     
      $sth= $bdd->prepare("INSERT INTO articles (titre, texte, publie, date) VALUES (:titre, :texte, :publie, :date)");
      
     $sth->bindValue(':titre',$_POST['titre'], PDO::PARAM_STR); //sécurisation des variables
     $sth->bindValue(':texte',$_POST['texte'], PDO::PARAM_STR); //sécurisation des variables
     $sth->bindValue(':publie',$_POST['publie'], PDO::PARAM_INT); //sécurisation des variables
     $sth->bindValue(':date',$_POST['date'], PDO::PARAM_STR); //sécurisation des variables
     
      $sth->execute(); // execution de la requete
     
     $id = $bdd->lastInsertID(); // retourner l'identifiant qui vient detre inserer
     
     
    //echo '<br/> <b><u>' . $dernier_id . '</u></b>'; test insertion 
     
    move_uploaded_file($_FILES['image']['tmp_name'], dirname(_FILE_). "/img/$id.jpg"); // inserer l'image 
    
    $_SESSION['ajout_article'] = TRUE; 
    
  
    
    header("Location: article.php"); // redirection de la page article après mise en ligne d'un article
     
} else {
    
    echo "erreur sur l'image";
    exit();
}
}

elseif(isset($_POST['modifier'])) {
    
    $_POST['publie'] = isset($_POST['publie'])? 1 : 0; // = sinon  ? = // test pour publie
    
    $sql = $bdd->prepare("UPDATE articles SET titre = :titre, texte= :texte, publie= :publie WHERE id= :id"); // requete pour modifier un article
     $sql->bindValue(':titre',$_POST['titre'], PDO::PARAM_STR); //sécurisation des variables
     $sql->bindValue(':texte',$_POST['texte'], PDO::PARAM_STR); //sécurisation des variables
     $sql->bindValue(':publie',$_POST['publie'], PDO::PARAM_INT); //sécurisation des variables
     $sql->bindValue(':id',$_POST['id'], PDO::PARAM_STR); //sécurisation des variables
     $sql->execute();

    $_SESSION['modif_article'] = TRUE; 
    
    header("Location: article.php");

} else {
include_once 'includes/header.inc.php';

if(isset($_GET['id'])){
    
   $sql= $bdd->prepare("SELECT * FROM articles WHERE id = :id"); // modifier un article
      
     $sql->bindValue(':id',$_GET['id'], PDO::PARAM_STR); //sécurisation des variables
      $sql->execute(); // execution de la requete
     $result = $sql->fetchAll(PDO::FETCH_ASSOC); // recupere les valeur dans un tableau
     // print_r($result);
     $titre = $result[0]['titre'];
     $texte = $result[0]['texte'];
     $publie = $result[0]['publie'];
}
$publie = isset($publie)? $publie : 0 ; // verifie si publie n'est pas cocher pour ne pas avoir d'erreur , on dit qu'il est égale à 0 ( pas coché)


?>

<div class="span8">
    <!-- notifications -->
    
    <?php
        if(isset($_SESSION['ajout_article'])){  // condition si la valeur ajout_article existe
             
         
            ?>

   
 
    <div class="alert alert-success" role="alert">  <!-- alerte pour article si sa fonctionne --> 
  <strong>Félicitation!</strong> Votre article à eté ajouté.
</div>
    <?php
        unset($_SESSION['ajout_article']) ; // détruire la session
        }
        elseif(isset($_SESSION['modif_article'])){  // condition si la valeur ajout_article existe
             
         
            ?>

   
 
    <div class="alert alert-success" role="alert">  <!-- alerte pour article si sa fonctionne --> 
  <strong>Félicitation!</strong> Votre article a eté modifié.
</div>
    <?php
        unset($_SESSION['modif_article']) ; // détruire la session
        }
     ?>
    
   
    <!-- contenu -->

    <form action="article.php" method="post" enctype="multipart/form-data" id="form_article" name="form_article" > <!-- formulaire -->
    <div class="clearfix">
        <label for="titre">Titre</label>
        <div class="input"><input type="text" name="titre" id="titre" value="<?php if(isset($titre)){ echo $titre; } // verifie la valeur si elle existe ?>"></div>
    </div>
    <div class="clearfix">
        <label for="texte">Texte</label>
        <div class="input"><textarea name="texte" id="texte"><?php if(isset($texte)){ echo $texte; } // verifie la valeur si elle existe ?></textarea></div>
    </div>
    <div class="clearfix">
        <label for="image">Image</label>
        <div class="input"><input type="file" name="image" id="image"></div>
    </div>
    <div class="clearfix">
        <label for="publie">Publié
            <div class="input"><input type="checkbox" name="publie" id="publie" <?php if($publie == 1) { echo "checked"; } // verifie la valeur si elle existe ?>></div>
        </label>
    </div>
        <?php
        if(isset($_GET['id']))  // si j'ai une valeur id , je modifie
            {
            ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
            <div class="form-actions">
        <input type="submit" name="modifier" value="modifier" class="btn btn-large btn-primary">
    </div>
<?php
        }
 else { // si rien j'ajoute
     ?>
    <div class="form-actions">
        <input type="submit" name="ajouter" value="ajouter" class="btn btn-large btn-primary">
    </div>
        
<?php
 }
 ?>
 </form>
</div>

<?php
include_once 'includes/menu.inc.php';
include_once 'includes/footer.inc.php'; 
}

?>



  



