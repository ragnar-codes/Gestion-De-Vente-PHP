<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>Application de vente</title>
</head>
<body>
<?php session_start();
include "fonction.php"; 
?>
<!-- form ajouter vente -->
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light text-center">
    <form class="col " action="" method="post">
        <label for="produit" class="form-label">Produit</label>
        <select class="form-select-md" aria-label="Default select example" name="produit" id="produit" required onchange="prixproduit(this.value)">
        <option selected value="">----Choisir un produit----</option>
        <?php 
        foreach($tab_prod as $key=>$prod){
        echo "<option value='$key'>".$prod['produit']."</option>";
        }
        ?>
        </select>
        <label class="form-label" for="qte">Quantité</label>
        <input class="form-control-md" type="number" name="qte" value="1" id="qte" required>

        <label class="form-label" for="prix">Prix</label>
        <input class="form-control-md" readonly type="number" step="0.001" name="prix" id="prix" required>
        <button class="btn btn-primary" name="submit">Ajouter</button>
    </form>
</nav>
    

<?php
//ajouter vente dans la session
$ventes=[];
if(!isset($_SESSION['panier']))
$_SESSION['panier']=[];

if(isset($_POST['submit'])){
    $produit=$tab_prod[$_POST['produit']]['produit'];
    $qte=$_POST['qte'];
    $prix=$_POST['prix'];
    $tabvente=['produit'=>$produit,'qte'=>$qte,'prix'=>$prix];
    $_SESSION['panier'][]=$tabvente;
    //array_push($_SESSION['panier'],$tabvente);
    header("location:index.php");
}
$ventes=$_SESSION['panier'];

//afficher la liste des ventes

echo "<div class='mt-5'><h1 class='text-center'>Liste des ventes</h1>
<table class=\"table table-striped\">
    <tr>
        <th>Produit</th>
        <th>Quantite</th>
        <th>Prix Unitaire</th>
        <th>Prix Total</th>
        <th>Action</th>
    </tr>";
$net=0;
    foreach($ventes as $indice=>$vente){
        $total=$vente['qte']*$vente['prix'];
        $net+=$total;
        echo "<tr id='tr_$indice'>
            <td>".$vente['produit']."</td>
            <td id='qte_$indice'>".$vente['qte']."</td>
            <td id='prix_$indice'>".$vente['prix']."</td>
            <td id='total_$indice'>".$total."</td>
            <td><input type='button' class='btn btn-primary mx-2' id='btnedit_$indice' value='Modifier' onclick='editproduit($indice)'><button class='btn btn-danger' onclick='deleteproduit($indice)'>Supprimer</button></td>
        </tr>";
    }
    echo "<tr class='table-info'>
        <td colspan=3 >Net a payer</td>
        <td id='net'>$net</td>
    </tr>";
echo "</table></div>";
?>
<form method='post' action='action.php'>
<input type='hidden' name='action' value='newvente'>
<button class='btn btn-danger'>Nouvelle Vente</button>
<a href='ticket.php' target='_blank'><button class='btn btn-dark' type='button'>Imprimer</button></a>
</form>
</div>
    <script src="js/main.js"></script>
</body>
</html>