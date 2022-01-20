<?php
$titrePage = "Modifier un produit";
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

$id = $_GET["id"];
if (!$id){
  header("location:liste_produit.php");
  exit;
}
$pdoStatement = $connexion->prepare("select p.*, c.nom as categorie_nom from Produit p inner join Categorie c on p.categorie_id = c.id where p.id=:id");
$pdoStatement->setFetchMode(PDO::FETCH_ASSOC); //tableau associatif
$pdoStatement->execute( array('id' => $id) );
$produits = $pdoStatement->fetch();

$pdoStat = $connexion->prepare("select * from Categorie");
$pdoStat->setFetchMode(PDO::FETCH_ASSOC); //tableau associatif
$pdoStat->execute();
$categories = $pdoStat->fetchAll();


?>
<h1>Modifier un produit</h1>
<?php foreach ($erreurs as $e) : ?>
  <p class="badge badge-alert"><?php echo $e; ?></p>
<?php endforeach; ?> 
<form action="modif_traitement.php" method="post">
  <div class="form-group">
    <label for="nom">Nom</label>
    <input class="form-control" type="text" id="nom" name="nom" value="<?php echo $produits["nom"]; ?>">
  </div>
  <div class="form-group">
    <label for="isbn">ISBN</label>
    <input class="form-control" type="text" id="isbn" name="isbn" value="<?php echo $produits["isbn"]; ?>">
  </div>
  <div class="form-group">
    <label for="prixht">Prix HT €</label>
    <input class="form-control" type="text" id="prixht" name="prixht" value="<?php echo $produits["prixHT"]; ?>">
  </div>
  <div class="form-group">
    <label for="stock">Stock</label>
    <input class="form-control" type="number" id="stock" name="stock" value="<?php echo $produits["stock"]; ?>">
  </div>
  <div class="form-group">
    <label for="centre">Catégorie</label>
    <select class="form-control" name="categorie" id="categorie">
    <?php foreach ($categories as $c) : ?>
        <?php $selected = $c["id"] == $produits["categorie_id"];
        ?>
        <option 
          value="<?php echo $c["id"]; ?>" 
          <?php if ($selected) echo "selected";?>>
        <?php echo $c["nom"]; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div><input type="hidden" name="id" value="<?php echo $id; ?>"></div>
  <div>
    <input class="btn btn-primary" type="submit" value="Modifier le produit" >
  </div>
</form>

<?php
include "includes/footer.php";
?>