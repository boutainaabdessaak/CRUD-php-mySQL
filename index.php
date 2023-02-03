<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD etudiant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2> Gestion des étudiants</h2>
        <a href="ajouter.php" class="Btn_add"> 
              <img src="images/plus.png"> 
            </a>

        <!-- table -->

        <table>
            <tr id="items">
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>

            <?php 
                //inclure la page de connexion
                include_once "connexion.php";
                //requête pour afficher la liste des étudiants
                $req = mysqli_query($con , "SELECT id,Nom,Prénom,date_de_naissance FROM etudiant");
                if(mysqli_num_rows($req) == 0){
                    //s'il n'existe pas d'employé dans la base de donné , alors on affiche ce message :
                    echo "Il n'y a pas encore d'étudiant ajouter !" ;
                    
                }else {
                    //int(date('Y'))
                    $datetest = date('Y');
                    //si non , affichons la liste de tous les étudiants
                    while($row=mysqli_fetch_assoc($req)){
                        ?>
                        <tr>
                            <td><?=$row['Nom']?></td>
                            <td><?=$row['Prénom']?></td>
                            <td><?= $datetest - $row['date_de_naissance'] ?></td>
                            <!--Nous alons mettre l'id de chaque étudiant dans ce lien -->
                             <td><a href="modifier.php?id=<?=$row['id']?>"> <img src="images/pen.png"></a></td> 
                             <td><a href="supprimer.php?id=<?=$row['id']?>"><img src="images/corbeille.png"></a></td> 
                            
                        </tr>
                        <?php
                    }
                    
                }
            ?>

            </table>
    </div>
</body>
</html>