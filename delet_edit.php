<?php
include "connexion.php";

function delete_article($id){
    global $conn;
    $sql = "DELETE FROM article WHERE id_article = $id";
    mysqli_query($conn, $sql);
}

if(isset($_POST['delete'])){
    $variable = $_GET['id'];
     delete_article($variable);

    //  echo "<script type='text/javascript'>alert('Deleted Succesfuly');</script>";

     header("Location:article.php");
    
}



function update_article($id,$titre,$nom_cat,$contenue){
    global $conn;
    $sql = " UPDATE article SET titre='$titre', id_category='$nom_cat', contenue='$contenue',date_ajout=NOW() 
    WHERE id_article = $id ";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
}


if(isset($_POST['editer'])){
    $id_article = $_GET['e_id'];
	$titre = $_POST['titre'];
	$nom_cat = $_POST['nom_cat'];
	$contenue = $_POST['contenue'];
    update_article($id_article,$titre,$nom_cat,$contenue);
    header("Location:article.php");
}





?>