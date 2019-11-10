<?php
// include "connexion.php";

function inserer($titre,$nom_cat,$fileNameNew,$contenue){
    $date_ajout = date('Y/m/d H:i:s');
    global $conn;
    $id_user = $_SESSION['id_utilisateur']; 
    $requete = "INSERT INTO article (titre,image,contenue,date_ajout,id_utilisateur,id_category) 
    VALUES ('$titre','$fileNameNew','$contenue','$date_ajout','$id_user','$nom_cat')";
    if (mysqli_query($conn, $requete)) {
        echo "New records created successfully";
    } else {
        echo "Error: " . $requete . "<br>" . mysqli_error($conn);
    }
}

function afficher(){
    global $conn;
    $article = array();
    $sql = "SELECT * FROM article INNER JOIN categorie ON article.id_category = categorie.id_cat";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result))
    {
        $article[] = $row;
    }
    return $article;

}

function afficher_commentaires(){
    global $conn;
    $commentaires = array();
    $sql = "SELECT * FROM commentaire ";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        $commentaires[] = $row;
    }
    return $commentaires;
    
}


?>