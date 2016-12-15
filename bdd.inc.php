<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=u231586484_vango;charset=utf8', 'u231586484_vango', 'VDNHkhxj0F');
   $bdd->exec('set names utf8');
   $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (Exception $e) {
    die ('Erreur !: ' . $e->getMessage()) . "<br/>";
   
}
?>