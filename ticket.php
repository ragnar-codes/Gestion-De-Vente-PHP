<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css" media="print">
    <title>Ticket</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
<div class="contaier d-flex flex-column justify-content-center align-items-center mt-5">
    <button class="btn btn-info" id="imprime" onclick="window.print()">Imprimer</button>
    <h1>BOUTIQUE ABC</h1>
    <h6>Route de tunis km3</h6>
    <h6>**************************************<br>Bienvenue chez notre boutique<br>**************************************</h6>
    
    <?php
    session_start();
    $ventes=$_SESSION['panier'];
    echo "<table class='table table-striped table-responsive-sm w-25'>
    <tr class='net'>
        <th>Produit</th>
        <th>qte</th>
        <th>prix U</th>
    </tr>";
$net=0;
    foreach($ventes as $indice=>$vente){
        $total=$vente['qte']*$vente['prix'];
        $net+=$total;
        echo "<tr>
            <td>".$vente['produit']."</td>
            <td id='qte_$indice'>".$vente['qte']."</td>
            <td id='prix_$indice'>".$vente['prix']."</td>
        </tr>";
    }
    echo "<tr class='net table-dark'>
        <td colspan=2>Net a payer</td>
        <td>$net</td>
    </tr>";
echo "</table>";
?>
</div>
</body>
</html>