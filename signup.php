<?php
include "connexion.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up for blog</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>



    <!-- <div class="main"> -->

        <!-- Sign up form -->
        
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" action="">
                            <div class="form-group">
                                <label for="nom"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nom" id="nom" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="prenom"><i class="zmdi zmdi-account-edit-outline"></i></label>
                                <input type="text" name="prenom" id="prenom" placeholder="Your Last-Name"/>
                            </div>
                            
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-ansible"></i></label>
                                <input type="text" name="username" id="username" placeholder="Username"/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="img/signup-image.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>

            <?php
if(isset($_POST['signup'])){

    $name = htmlspecialchars(trim($_POST['nom']));
    $last_name = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));
    
    // $ins=$conn -> prepare('INSERT INTO utilisateur(`nom`,`prenom`,`age`, `email`, `password`,`username`) VALUES (:nom,:prenom,:email,:password,:username)');
    // $ins->execute(array(
    //     'nom'=>$name,
    //     'prenom'=>$last_name,
    //     'email'=>$email,
    //     'password'=>$password,
    //     'username'=>$username
    // ));


    $query = "INSERT INTO utilisateur (nom, prenom, email, username, password)
   VALUES ('$name','$last_name','$email','$username','$password')";

if (mysqli_query($conn, $query)) {
    header("Location:login.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}



}   
    
?>
        </section>

  

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    
   

 </body>
 </html>