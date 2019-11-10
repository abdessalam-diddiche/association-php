<?php
session_start();
include "connexion.php";

?>
<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $message ="";

// try {
//     $conn = new PDO("mysql:host=$servername;dbname=blog", $username, $password);

//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// if(isset($_POST['blog'])){
// if(empty($_POST["email"])) || empty($_POST["password"])
// {
//     $message = '<label>All field is required</label>';
// }
// else{
// $query ="SELECT email,password FROM utilisateur WHERE email = :email AND password = :password";
// $statement = $conn->prepare($query);
// $statement->execute(
//     array(
//         'email' => $_POST["email"],
//         'password' => $_POST["password"]
//     )
//     );
//     $count = $statement->rowCount();
//     if($count > 0)
//     {
//         $_SESSION["email"] = $_POST["email"];
//         header("Location:profile.php");
//     }
//     else{
//         $message = '<label>Email OR Password is wrong</label>'
//     }
// }
// }
// }
// catch(PDOException $error){
//     $message = $error->getMessage()
// }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign in for blog</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="sign-in">
            <div class="container">

                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="img/signin-image.jpg" alt="sing up image"></figure>
                        <a href="signup.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        <form method="POST" class="register-form" id="login-form" action="">
                            <div class="form-group">
                            <label for="username"><i class="zmdi zmdi-ansible"></i></label>
                                <input type="text" name="username" id="username" placeholder="Username"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
            
					<button type="submit" name="signin">Sign in</button>

	        
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
</section>

<section>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 

    $username = htmlspecialchars(trim(mysqli_real_escape_string($conn,$_POST['username'])));
    $password = htmlspecialchars(trim(mysqli_real_escape_string($conn,$_POST['password']))); 
    
    $sql = "SELECT * FROM utilisateur WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn,$sql);
    if($row = mysqli_fetch_array($result))
        {
            $_SESSION['username'] = $row['username'];
            $_SESSION['id_utilisateur']= $row['id_utilisateur'];
            header("Location:profile_user.php");
        
            if($_SESSION['id_utilisateur'] == 26){
                $_SESSION['id_utilisateur'];
                $_SESSION['nom'];
                $_SESSION['prenom'];
                $_SESSION['email'];
                $_SESSION['username'];
                header("Location:admin.php");
        }
    }
        else{
            ?>
        <span class='label label-danger' style="color:red">Username OR Password is Wrong!!!</span>
        <?php
        }
    }
/* if(isset($_POST['signin'])){
    $message = "Email OR Password is Wrong";
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM utilisateur WHERE email ='$email' AND password='$password'";
    
   $run=mysqli_query($conn,$query);
    if($row = mysqli_fetch_array($run))
        {
            $_SESSION["email"] = $_POST["email"];
            header("Location:profile.php");
            
        }
        else{
            // header("Location:login.php?Invalid = Email OR Password is Wrong");
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
}
*/
?>

</section>


        <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script type="text/javascript">

//     $(function(){
//         $('#signup').click(function(){
// var valid = this.form.checkValidity();
// if(valid){
    
//                var name = $('#nom').val();
//                var last_name = $('#prenom').val();
//                var email = $('#email').val();
//                var username = $('#username').val();
//                var password = $('#password').val();


//                e.preventDefault();
//                $.ajax({

//                      type: 'POST',
//                      url: 'login.php',
//                      data:{name:nom,last_name:prenom,email:email,username:username,password:password},
//                      success: function(data){
              Swal.fire({
                        'title':'Inscription réussite',
                        'text':'You are a membre now',
                        'type':'success'
            });

//         },
//                      error: function(data){
//               Swal.fire({
//                          'title':'Errors!!',
//                          'text':'There were errors',
//                          'type':'error'
//             })
//         }

//         });
// }

//     });
// });
   
    
    </script>



</body>
</html>