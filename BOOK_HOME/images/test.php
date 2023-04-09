<?php
    require 'connection.php';

  if(isset($_POST['submit'])) {
         // declarier les names des inputs
         $titre = $_POST['titre'];
         // $image = $_POST['image'];
         $image = $_FILES['image'];
         $description = $_POST['description'];
         $superficie = $_POST['superficie'];
         $adresse = $_POST['adresse'];
         $montant = $_POST['montant'];
         $date = $_POST['date'];
         $type = $_POST['type'];
        // verifie image
         $uploads_dir = 'uploads/';
         $name = $_FILES['image']['name'];
         if (is_uploaded_file($_FILES['image']['tmp_name']))
         {
             //in case you want to move  the file in uploads directory
              move_uploaded_file($_FILES['image']['tmp_name'], $uploads_dir.$name);
                // echo 'moved file to destination directory';

         }
         $img_des = $uploads_dir.$name;
        //  $img_loc = $_FILES['image']['tmp_name'];
        //  $img_name = $_FILES['image']['name'];
        //  $img_des = 'IMG/'.$img_name;
        //  move_uploaded_file($img_loc, 'IMG/'.$img_des);

    $insert = "INSERT INTO annonce (titre,image,description,superficie, adresse,montant,date,type) VALUES ('$titre','$img_des','$description','$superficie','$adresse','$montant','$date','$type')";
     // lire requete sql pour php
    $insert_qry = mysqli_query($conn, $insert);

     if (isset($insert_qry)) {
         header("Location: index.php");

     }else{
         echo "<h1>erreur</h1>";
     }



  }
?>