<?php

require "db/connexion.php";

try {
    $connexion = new Connexion();
} catch (PDOException $ex) {
    echo $ex->getMessage();
    exit;
}

$pdoStatement = $connexion->prepare("select p.*, c.nom as categorie_nom from Produit p, Categorie c where c.id=p.categorie_id");
$pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
$pdoStatement->execute();
$produits = $pdoStatement->fetchAll();


$titrePage = "Liste des produits";
include "includes/header.php";
$connected = isset($_SESSION["connected"]) ? true : false;
?>


<h1>Liste des produits</h1>
<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>isbn</th>
            <th>Prix HT</th>
            <th>Stock</th>
            <th>Catégorie</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($produits as $pr): ?>
            <tr>
                <td> <?php echo $pr["nom"]?> </td>
                <td> <?php echo $pr["isbn"]?> </td>
                <td> <?php echo $pr["prixHT"]?> </td>
                <td> <?php echo $pr["stock"]?> </td>
                <td> <?php echo $pr["categorie_nom"]?> </td>
                <td>
                <a class="btn btn-primary" href="fiche_stagiaire.php?id=<?php echo $pr['id']?>">Afficher</a>
                <?php if ($connected):?>
                <a class="btn btn-warning" href="form_modif.php?id=<?php echo $pr['id']?>">Modifier</a>
                <button class="btn btn-danger suppBtn" data-id="<?php echo $pr['id']?>">Supprimer</button>
                <?php endif;?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
let btnElements = document.querySelectorAll(".suppBtn");
    
for(let i = 0;i<btnElements.length;i++){
    let btn = btnElements[i];
        btn.addEventListener("click", function(event){
            let suppBtn = event.target;
            let id = suppBtn.dataset.id;

                var xhr = new XMLHttpRequest();
                xhr.open("POST", 'supp_traitement.php', true);

                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.onreadystatechange = function() 
                    {
                        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) 
                        {
                            let reponse = xhr.responseText;
                            console.log(reponse);
                            if (reponse == "OK") {
                            window.location.reload();
                                } else {
                                alert("opération échouée !");
                                 }
                        }
                    }
                xhr.send("id="+id);
        })
    }
</script>
<script>
let btnElements = document.querySelectorAll(".modBtn");
    
for(let i = 0;i<btnElements.length;i++){
    let btn = btnElements[i];
        btn.addEventListener("click", function(event){
            let modBtn = event.target;
            let id = modBtn.dataset.id;

                var xhr = new XMLHttpRequest();
                xhr.open("POST", 'modif_traitement.php', true);

                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.onreadystatechange = function() 
                    {
                        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) 
                        {
                            let reponse = xhr.responseText;
                            console.log(reponse);
                            if (reponse == "OK") {
                            window.location.reload();
                                } else {
                                alert("opération échouée !");
                                 }
                        }
                    }
                xhr.send("id="+id);
        })
    }
</script>
<?php
include "includes/footer.php"
?>