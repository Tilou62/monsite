<div class="span8">
       <!--notifications -->
       {* commentaire *}
       {if isset($statut_connexion) AND $statut_connexion == FALSE}
      
  <div class="alert alert-error" role="alert">  <!-- alerte pour article si sa ne fonctionne pas --> 
  <strong>Erreur!</strong> Login et / ou mot de passe est incorect.
</div>
            {/if}
    
                 <!-- contenu -->
<form action="connection.php" method="post" enctype="multipart/form-data" id="form_article" name="form_connexion" > <!-- formulaire -->
    <div class="clearfix">
        <label for="titre">Email</label>
        <div class="input"><input type="text" name="email" id="email" value=""></div>
    </div>
    <div class="clearfix">
        <label for="texte">Mot de passe</label>
        <div class="input"><input type="password" name="mdp" id="mdp" value=""></div>
    </div>
 <div class="form-actions">
        <input type="submit" name="connexion" value="Se connecter" class="btn btn-large btn-primary">
    </div>

