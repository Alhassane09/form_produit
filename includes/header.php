<?php
session_start();
$connected = isset($_SESSION["connected"]) ? true : false;

?>

<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title><?php echo $titrePage; ?></title>
</head>

<body class="container">
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand">Ma boutique</a>
      <div class="d-flex">
        <?php if ($connected) : ?>
          <a href="logout.php" class="btn btn-danger">Se Déconnecter</a>
        <?php else : ?>
          <a href="login.php" class="btn btn-primary">Se Connecter</a>
        <?php endif; ?>

      </div>
    </div>
  </nav>