<?php
session_start();
include "fonction.php";
if(isset($_POST['action'])){

$action=$_POST['action'];

switch($action){
    case "newvente":
        unset($_SESSION['panier']);
        header("location:index.php");
        break;

    case 'prixproduit':
        $indiceprod=$_POST['indiceprod'];
        $prix=$tab_prod[$indiceprod]['prix'];
        echo number_format($prix,3,'.','');
        break;

    case 'deleteproduit':
        $indicevente=$_POST['indicevente'];
        unset($_SESSION['panier'][$indicevente]);
        echo "suppression avec succes";
        break;

    case 'editproduit':
        $indicevente=$_POST['indicevente'];
        $qteedit=$_POST['qteedit'];
        $prixedit=$_POST['prixedit'];

        $_SESSION['panier'][$indicevente]['qte']=$qteedit;
        $_SESSION['panier'][$indicevente]['prix']=$prixedit;
        break;

    default : echo "FORBIDEN";
}



}else{
    echo "FORBIDEN";
}
?>