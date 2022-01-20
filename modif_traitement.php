<?php

session_start();
require "includes/utils.php";


$id = getPostParam("id");
$nom = getPostParam("nom");
$isbn = getPostParam("isbn");
$prixht = getPostParam("prixht");
$stock = getPostParam("stock");
$categorie = getPostParam("categorie");


if(!$id){
    header("location : liste_produit.php");
    exit;
}

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

$numb = "/^[0-9]*$/";
$valide = preg_match($numb, $prixht);
if ($valide < 0) {
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
    header("location:form_modif.php?id=".$id);
}else{
    require "db/connexion.php";
    try {
        $connexion = new Connexion();
        $sql = "UPDATE Produit set nom=:nom, isbn=:isbn, prixHT=:prixht, stock=:stock, categorie_id=:categorie WHERE id=:id;";
        $pdoStatement = $connexion->prepare($sql);
        $tab = [":nom"=>$nom, ":isbn"=>$isbn, ":categorie"=>$categorie, ":stock"=>$stock, ":prixht"=>$prixht, ":id"=>$id];
        $pdoStatement->execute($tab);
        header("location:liste_produit.php");
    } catch (PDOException $ex) {
        var_dump($ex);
        header("location:form_modif.php?erreur=dbErreur");
    }
}

?>