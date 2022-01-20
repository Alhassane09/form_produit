<?php
session_start();


include "includes/utils.php";

// var_dump($_POST);
//login = admin mdp=greta92

$login = getPostParam("login");
$mdp = getPostParam("mdp");
if ($login == "admin" && $mdp == "greta92") {
  //ajouter l'élément "connected" dans le tableau $_SESSION
  $_SESSION["connected"] = true;
  //renvoyer l'user vers la page d'accueil d'admin
  header("location:index_admin.php");
  exit;
} else {
  //renvoyer l'user ver le formulaire de login
  header("location:login.php?erreur=1");
  exit;
}
