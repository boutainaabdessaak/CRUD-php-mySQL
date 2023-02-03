<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter</title>
</head>
<body>

<?php

       //connexion à la base de donnée
       include_once "connexion.php";

       $id = $_GET['id'];

       //requête pour afficher les infos d etudiant
       $req = mysqli_query($con , "SELECT * FROM etudiant WHERE id=$id");
        $row = mysqli_fetch_assoc($req);


       //vérifier que le bouton ajouter a bien été cliqué
       if(isset($_POST['button'])){
           //extraction des informations envoyé dans des variables par la methode POST
           extract($_POST);
           //verifier que tous les champs ont été remplis
           if(isset($Nom) && isset($Prénom) && $date_de_naissance){
                
             $req = mysqli_query($con , "UPDATE etudiant SET Nom='$Nom' , Prénom='$Prénom' , Date_de_naissance='$date_de_naissance' WHERE id=$id");

                if($req){//si la requête a été effectuée avec succès , on fait une redirection
                    header("location: index.php");
                }else {//si non
                    $message = "etudiant non ajouté";
                }
           }else {
               //si non
               $message = "Veuillez remplir tous les champs !";
           }
       }
    ?>

<div class="form">
<a href="index.php" class="back_btn">
    <img src="images/back.png"> Retour
</a>
        <h2>Modifier étudiant</h2>
        <p class="erreur_message">
            <?php
             if(isset($message)){
                echo $message;
            }
            ?>
        </p>

        <form action="" method="POST">
            <label>Nom</label>
            <input type="text" name="Nom" value="<?=$row['Nom']?>">
            <label>Prénom</label>
            <input type="text" name="Prénom" value="<?=$row['Prénom']?>">

            <label>Date de naissance</label>
            <input type="date" name="date_de_naissance"  value="<?=$row['date_de_naissance']?>">
            <input type="submit" value="Modifier" name="button">
        </form>
</div>
     
</body>
</html>