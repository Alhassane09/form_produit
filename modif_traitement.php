<?php
require "db/connexion.php";

try {
    $connexion = new Connexion();
} catch (PDOException $ex) {
    echo $ex->getMessage();
    exit;
}

try {
    $connexion = new Connexion();
    $sql = "update Produit set (:nom, :isbn, :prixht, :categorie, :stock) where id=:id";
    $pdoStatement = $connexion->prepare($sql);
    $tab = [":nom"=>$nom, ":isbn"=>$isbn, ":categorie"=>$categorie, ":stock"=>$stock, ":prixht"=>$prixht];
    $pdoStatement->execute($tab);
    header("location:liste_produit.php");
}
catch(PDOException $ex){
    echo "KO";
}
?>