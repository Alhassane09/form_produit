<?php
$titrePage = "Ajouter un produit";
include "includes/header.php";
//messages d'erreurs
$erreurs = isset($_SESSION["erreurs"]) ? $_SESSION["erreurs"] : [];
unset($_SESSION["erreurs"]);
require "db/connexion.php";
//création d'objet connexion
try {
  $connexion = new Connexion();
} catch (PDOException $ex) {
  echo $ex->getMessage(); //débogage
  exit;
}

$pdoStatement = $connexion->prepare("select * from Categorie");
$pdoStatement->setFetchMode(PDO::FETCH_ASSOC); //tableau associatif
$pdoStatement->execute();
$categories = $pdoStatement->fetchAll();
?>
<h1>Ajouter un produit</h1>
<?php foreach ($erreurs as $e) : ?>
  <p class="badge badge-alert"><?php echo $e; ?></p>
<?php endforeach; ?> 
<form action="ajout_traitement.php" method="post">
  <div class="form-group">
    <label for="nom">Nom</label>
    <input class="form-control" type="text" id="nom" name="nom">
  </div>
  <div class="form-group">
    <label for="isbn">ISBN</label>
    <input class="form-control" type="text" id="isbn" name="isbn">
  </div>
  <div class="form-group">
    <label for="prixht">Prix HT €</label>
    <input class="form-control" type="text" id="prixht" name="prixht" >
  </div>
  <div class="form-group">
    <label for="stock">Stock</label>
    <input class="form-control" type="number" id="stock" name="stock" >
  </div>
  <div class="form-group">
    <label for="centre">Catégorie</label>
    <select class="form-control" name="categorie" id="categorie">
      <?php foreach ($categories as $c) : ?>
        <option value="<?php echo $c["id"]; ?>"><?php echo $c["nom"]; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div>
    <input class="btn btn-primary" type="submit" value="Ajouter un produit">
  </div>
</form>

<?php
include "includes/footer.php";
?>