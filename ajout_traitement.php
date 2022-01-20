<?php

session_start();
require "includes/utils.php";

$nom = getPostParam("nom");
$isbn = getPostParam("isbn");
$prixht = getPostParam("prixht");
$stock = getPostParam("stock");
$categorie = getPostParam("categorie");

$erreurs = [];


$motif = "/^[a-zA-z]+[\s\-]?[a-zA-Z]+$/";
$valide = preg_match($motif, $nom);
if (!$valide){
    $erreurs["nom"] = "nom est invalide";
}

$numb = "/^[0-9]*$/";
$valide = preg_match($numb, $isbn);
if (!$valide && strlen($valide) < 13){
    $erreurs["isbn"] = "prenom est invalide";
}


if ($prixht < 0) {
    $erreurs["prixht"] = "prix invalide";
}


if ($stock < 0) {
    $erreurs["stock"] = "stock invalide";
}

$categorie = intval($categorie);
if ($categorie < 0){
    $erreurs["categorie"] = "selectionner une categorie";
}

if(count($erreurs)<0){
    $_SESSION["erreurs"] = $erreurs;
    header("location:ajout_produit.php");
}else{
    require "db/connexion.php";
    try {
        $connexion = new Connexion();
        $sql = "insert into Produit values (null, :nom, :isbn, :prixht, :stock, :categorie)";
        $pdoStatement = $connexion->prepare($sql);
        $tab = [":nom"=>$nom, ":isbn"=>$isbn, ":categorie"=>$categorie, ":stock"=>$stock, ":prixht"=>$prixht];
        $pdoStatement->execute($tab);
        header("location:liste_produit.php");
    } catch (PDOException $ex) {
        header("location:ajout_produit.php?erreur=dbErreur");
    }
}

?>