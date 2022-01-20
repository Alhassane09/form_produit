<?php
$titrePage = "Se connecter";
include "includes/header.php";
$erreur = isset($_GET["erreur"]) ? true : false;
?>
<?php if ($erreur) : ?>
  <div class="alert alert-danger" role="alert">
    login ou mdp incorrect !
  </div>
<?php endif; ?>
<form action="login_traitement.php" method="post">
  <div class="form-group">
    <label for="login">Login</label>
    <input type="text" name="login" id="login" class="form-control">
  </div>
  <div class="form-group">
    <label for="mdp">Mot de passe</label>
    <input type="password" name="mdp" id="mdp" class="form-control">
  </div>
  <div class="form-group">
    <input class="form-control" type="submit" value="Se connecter">
  </div>
</form>
<?php include "includes/footer.php"; ?>