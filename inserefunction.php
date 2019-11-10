<?php

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

function inserer_commentaire($commentaire){
    // $date_ajout = date('Y/m/d à H:i:s');
    global $conn;
    $id_user = $_SESSION['id_utilisateur'];
    $result="INSERT INTO commentaire (id_article,commentaire,date_ajout,id_utilisateur) 
    VALUES ('{$_GET['id']}','$commentaire',NOW(),'$id_user')";
    if (mysqli_query($conn, $result)) {
        echo "commentaire created successfully";
    } else {
        echo "Error: " . $result . "<br>" . mysqli_error($conn);
    }
}

function afficher_commentaires($id){
    global $conn;
    // $id = $_GET['id'];
    $commentaires = array();
    $sql = "SELECT * FROM commentaire INNER JOIN article ON commentaire.id_article = article.id_article";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $commentaires[] = $row;
    }
    return $commentaires;
}

?>