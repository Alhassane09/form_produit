<?php
require "db/connexion.php";

try {
    $connexion = new Connexion();
} catch (PDOException $ex) {
    echo $ex->getMessage();
    exit;
}

try{
$sql="delete from Produit where id=:id";
$pdoStat = $connexion->prepare($sql);
$pdoStat->bindParam(":id", $_POST["id"]);
$pdoStat->execute();
echo "OK";
}
catch(PDOException $ex){
    echo "KO";
}
?>