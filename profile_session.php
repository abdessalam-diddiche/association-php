<?php
session_start();
if(isset($_POST['signin'])){
   $_SESSION['username'];
   $_SESSION['id_utilisateur'];
   header("Location:profile.php");

}

?>