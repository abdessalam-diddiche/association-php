<?php
session_start();
session_destroy();
unset($_SESSION['username']);
unset($_SESSION['id_utilisateur']);
header("Location:login.php");

?>