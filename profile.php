<?php 
session_start();
require_once "connexion.php";
include "affichefunction.php";

?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="codepixer">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Ruft Blog</title>

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500|Rubik:500" rel="stylesheet">
	<!--
			CSS
			============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<body>
	<!--================ Start header Top Area =================-->
	<section class="header-top">
		<div class="container box_1170">
			<div class="row align-items-center justify-content-between">
				<div class="col-lg-6 col-md-6 col-sm-6">
					<a href="blog.html" class="logo">
						<img src="img/logo.png" alt="">
					</a>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 search-trigger">
					<a href="#" class="search">
						<i class="lnr lnr-magnifier" id="search"></i></a>
					</a>
				</div>
			</div>
		</div>
	</section>
	<!--================ End header top Area =================-->

	<!-- Start header Area -->
	<header id="header">
		<div class="container box_1170 main-menu">
			<div class="row align-items-center justify-content-center d-flex">
				<nav id="nav-menu-container">
					<ul class="nav-menu">
						<li class="menu-active"><a href="profile.php">Home</a></li>
						<li class="menu-has-children"><a href="category.html">Category</a>
							<ul>
							<?php
	   
	   $sql = "SELECT * FROM categorie";
	   $result = mysqli_query($conn, $sql);
   
	   while($row = mysqli_fetch_assoc($result))
	   {
		   
		?>
							
								<li><a href="#" value="<?php echo $row['id_cat']; ?>"> <?php echo $row['nom_cat'] ; ?></a></li>
								<?php
	   }
	   ?>

							</ul>
						<li><a href="archive.html">Archive</a></li>
						<li class="menu-has-children"><a href="">Pages</a>
							<ul>
								<li><a href="elements.html">Elements</a></li>
							</ul>
						</li>
						<li class="menu-has-children"><a href="">Blog</a>
							<ul>
								<li><a href="blog-details.html">Blog Details</a></li>
							</ul>
						</li>
						<li><a
								href="contact.php">Contact</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;</li>

						<li><a href="logout.php"><span class="lnr lnr-user"></span> Logout</a></li>



					</ul>

				</nav>
			</div>
		</div>

	</header>

	<div class="main-body section-gap">
		<div class="container box_1170">
			<div class="row">
				<div class="col-lg-8 post-list">
					<!-- Start Post Area -->
					<section class="post-area">

						<h2>Ajouter une article</h2><br>
						<form method="POST" action="profile.php" enctype="multipart/form-data">
							<div class="form-group">
								<label for="exampleFormControlInput1">Titre de l'article</label>
								<input type="text" name="titre" class="form-control" id="exampleFormControlInput1"
									placeholder="Title" value="<?php if(isset($titre)){ echo $titre; }  ?>">
							</div>
							<div class="form-group">
								<label for="exampleFormControlSelect1">Choisi la category</label>
								<select class="form-control" name="nom_cat" id="exampleFormControlSelect1">
									<?php
	   
	   $sql = "SELECT * FROM categorie";
	   $result = mysqli_query($conn, $sql);
   
	   while($row = mysqli_fetch_assoc($result))
	   {
		   
		?>
									<option value="<?php echo $row['id_cat']; ?>"> <?php echo $row['nom_cat'] ; ?>
									</option>
									<?php
	   }

	   ?>
								</select>
							</div>


							<div class="custom-file">
								<input type="file" name="image" class="custom-file-input" id="customFile">
								<label class="custom-file-label" for="customFile">Choisissez une image</label>
							</div>

							<div class="form-group">
								<label for="exampleFormControlTextarea1">Le contenue de l'article</label>
								<textarea class="form-control" name="contenue" id="exampleFormControlTextarea1"
									rows="3" <?php if(isset($contenue)){ echo $contenue; }  ?>></textarea>
							</div>
							<div class="form-group form-button">
								<input type="submit" name="poster" id="poster" class="form-submit" value="Poster" />
							</div>
						</form>
						<hr />
						

						<?php

    $id_user = $_SESSION['id_utilisateur']; 
	if(isset($_POST['poster'])){
	$titre = htmlspecialchars(trim($_POST['titre']));
	$nom_cat = $_POST['nom_cat'];
	$contenue = htmlspecialchars(trim($_POST['contenue']));
        $file=$_FILES['image'];
		$fileName=$_FILES['image']['name'];
		$filesize=$_FILES['image']['size'];
		$fileTmpName=$_FILES['image']['tmp_name'];
		$fileError=$_FILES['image']['error'];
		$fileType=$_FILES['image']['type'];
		$fileNameNew="";
		$fileExt= explode('.',$fileName);
		$fileActulExt=strtolower(end($fileExt));
		$allowed=array('jpg','jpeg','png');
		if(in_array($fileActulExt,$allowed)){
			if($fileError === 0){
                if($filesize < 1000000){
					$fileNameNew = uniqid('', true).".".$fileActulExt;
				    $fileDestination= 'uploads/'.$fileNameNew;
				    move_uploaded_file($fileTmpName,$fileDestination);
				    // header("Location:profile.php?uploadSuccess");
				}else{
					echo "Your file is too big!";
				}
			}else{
				echo "There was an error uploading your file";
			}
	}else {
		?>
	<span class='label label-danger' style="color:red">You cannot upload files of this type!</span>
		<?php
	
	}

	if((empty($titre)) || (empty($nom_cat)) || (empty($fileNameNew)) || (empty($contenue))){
?>
	<span class='label label-danger' style="color:red">Veuillez saisir tous les champs!!!</span>
		<?php
	}
	else{
	inserer($titre,$nom_cat,$fileNameNew,$contenue);
	echo "<script type='text/javascript'>alert('Article a bien posté');</script>";	
}
	}
				
?>
					</section>
					<!-- Start Post Area -->

					<?php
$date_ajout=date('Y/m/d à H:i:s');
$afficher = afficher();
foreach($afficher as $afficher_article){
	?>
<a href="#"><?php echo $_SESSION['username']; ?>
<p style="text-align:right"><?php echo $date_ajout,strtotime($afficher_article['date_ajout']);?></p>
	<h2><?php echo $afficher_article['titre']; ?></h2><br>
	<h5 style="color:purple"><?php echo "La categorie : ".$afficher_article['nom_cat']; ?></h5><br>
	<img width="700px" height="420px" src="<?php echo 'uploads/'.$afficher_article['image']; ?>" alt=""><br><br>
	<p style="color:gray; font-size:20px"><?php echo $afficher_article['contenue']; ?></p><br/>
					<a href="article.php?id=<?php echo $afficher_article['id_article'] ?>">Lire la suite</a>
					<p>-----------------------------------------------------------------------------</p>

					<?php
$commentaires = afficher_commentaires();

foreach($commentaires as $commentaire){
if($afficher_article['id_article'] == $commentaire['id_article']){

    echo date('d/m/Y à H:i:s',strtotime($commentaire['date_ajout']))."<br/>";
    echo $commentaire['commentaire']."<br/>";
    echo "..........................................................................................";
}
}
	?>
					<hr />
					<?php
}
?>
				</div>


				<div class="col-lg-4 sidebar">
					<div class="single-widget protfolio-widget">
					<form class="md-form">
  <div class="file-field">
    <div class="mb-2">
      <img width="100%" src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg"
        class="rounded-circle z-depth-1-half avatar-pic" alt="example placeholder avatar">
    </div>
    <div class="d-flex justify-content-center">
      <div class="btn btn-mdb-color btn-rounded float-left">
        <span>Add photo</span>
        <input type="file" name="img_profile">
      </div>
    </div>
  </div>
</form>
<?php
// if(isset($_POST['img_profile'])){
// 	$file=$_FILES['image'];
// 	$fileName=$_FILES['image']['name'];
// 	$filesize=$_FILES['image']['size'];
// 	$fileTmpName=$_FILES['image']['tmp_name'];
// 	$fileError=$_FILES['image']['error'];
// 	$fileType=$_FILES['image']['type'];
// 	$fileNameNew="";
	
// 	$fileExt= explode('.',$fileName);
// 	$fileActulExt=strtolower(end($fileExt));
// 	$allowed=array('jpg','jpeg','png');

// 	if(in_array($fileActulExt,$allowed)){
// 		if($fileError === 0){
// 			if($filesize < 1000000){
// 				$fileNameNew = uniqid('', true).".".$fileActulExt;
// 				$fileDestination= 'uploads/'.$fileNameNew;
// 				move_uploaded_file($fileTmpName,$fileDestination);
// 				// header("Location:profile.php?uploadSuccess");
// 			}else{
// 				echo "Your file is too big!";
// 			}
// 		}else{
// 			echo "There was an error uploading your file";
// 		}
// }else {
// 	echo "You cannot upload files of this type!";
// }
?>
						<a href="#"><?php echo $_SESSION['username']; ?></a>
						<p class="p-text">
						
							Boot camps have its supporters andit sdetractors. Some people do not understand why you
							should have to spend
							money on boot camp whenyou can get. Boot camps have itssuppor ters andits detractors.
						</p>
						<ul class="social-links">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li><a href="#"><i class="fa fa-behance"></i></a></li>
						</ul>
						<img src="img/sign.png" alt="">
					</div>

					<div class="single-widget popular-posts-widget">
						<div class="jq-tab-wrapper" id="horizontalTab">
							<div class="jq-tab-menu">
								<div class="jq-tab-title active" data-tab="1">Popular</div>
								<div class="jq-tab-title" data-tab="2">Latest</div>
							</div>
							<div class="jq-tab-content-wrapper">
								<div class="jq-tab-content active" data-tab="1">
									<div class="single-popular-post d-flex flex-row">
										<div class="popular-thumb">
											<img class="img-fluid" src="img/posts/carousel/stories1.jpg" alt="">
										</div>
										<div class="popular-details">
											<h6><a href="">2nd Gen Smoke Alarm <br>
													get up from sleep</a></h6>
											<p>September 14, 2018</p>
										</div>
									</div>
									<div class="single-popular-post d-flex flex-row">
										<div class="popular-thumb">
											<img class="img-fluid" src="img/posts/carousel/stories2.jpg" alt="">
										</div>
										<div class="popular-details">
											<h6><a href="">2nd Gen Smoke Alarm <br>
													get up from sleep</a></h6>
											<p>September 14, 2018</p>
										</div>
									</div>
									<div class="single-popular-post d-flex flex-row">
										<div class="popular-thumb">
											<img class="img-fluid" src="img/posts/carousel/stories3.jpg" alt="">
										</div>
										<div class="popular-details">
											<h6><a href="">2nd Gen Smoke Alarm <br>
													get up from sleep</a></h6>
											<p>September 14, 2018</p>
										</div>
									</div>
									<div class="single-popular-post d-flex flex-row">
										<div class="popular-thumb">
											<img class="img-fluid" src="img/posts/carousel/stories4.jpg" alt="">
										</div>
										<div class="popular-details">
											<h6><a href="">2nd Gen Smoke Alarm <br>
													get up from sleep</a></h6>
											<p>September 14, 2018</p>
										</div>
									</div>
								</div>

								<div class="jq-tab-content active" data-tab="2">

									<div class="single-popular-post d-flex flex-row">
										<div class="popular-thumb">
											<img class="img-fluid" src="img/posts/carousel/stories2.jpg" alt="">
										</div>
										<div class="popular-details">
											<h6><a href="">2nd Gen Smoke Alarm <br>
													get up from sleep</a></h6>
											<p>September 14, 2018</p>
										</div>
									</div>
									<div class="single-popular-post d-flex flex-row">
										<div class="popular-thumb">
											<img class="img-fluid" src="img/posts/carousel/stories3.jpg" alt="">
										</div>
										<div class="popular-details">
											<h6><a href="">2nd Gen Smoke Alarm <br>
													get up from sleep</a></h6>
											<p>September 14, 2018</p>
										</div>
									</div>
									<div class="single-popular-post d-flex flex-row">
										<div class="popular-thumb">
											<img class="img-fluid" src="img/posts/carousel/stories1.jpg" alt="">
										</div>
										<div class="popular-details">
											<h6><a href="">2nd Gen Smoke Alarm <br>
													get up from sleep</a></h6>
											<p>September 14, 2018</p>
										</div>
									</div>
									<div class="single-popular-post d-flex flex-row">
										<div class="popular-thumb">
											<img class="img-fluid" src="img/posts/carousel/stories4.jpg" alt="">
										</div>
										<div class="popular-details">
											<h6><a href="">2nd Gen Smoke Alarm <br>
													get up from sleep</a></h6>
											<p>September 14, 2018</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="single-widget category-widget">
						<h4 class="title">Post Categories</h4>
						<ul>
							<li>
								<a href="#" class="justify-content-between align-items-center d-flex">
									<p><img src="img/bullet.png" alt="">International (56)</p>
								</a>
							</li>
							<li>
								<a href="#" class="justify-content-between align-items-center d-flex">
									<p><img src="img/bullet.png" alt="">Tours and Travels (45)</p>
								</a>
							</li>
							<li>
								<a href="#" class="justify-content-between align-items-center d-flex">
									<p><img src="img/bullet.png" alt="">Cooking Tips (23)</p>
								</a>
							</li>
							<li>
								<a href="#" class="justify-content-between align-items-center d-flex">
									<p><img src="img/bullet.png" alt="">Life Style and Fashion (72)</p>
								</a>
							</li>
							
							<li>
								<a href="#" class="justify-content-between align-items-center d-flex">
									<p><img src="img/bullet.png" alt="">Games and Sports (19)</p>
								</a>
							</li>
						</ul>
					</div>

					<div class="single-widget tags-widget">
						<h4 class="title">Post Tags</h4>
						<ul>
							<li><a href="#">Lifestyle</a></li>
							<li><a href="#">Art</a></li>
							<li><a href="#">Adventure</a></li>
							<li><a href="#">Food</a></li>
							<li><a href="#">Techlology</a></li>
							<li><a href="#">Fashion</a></li>
							<li><a href="#">Architecture</a></li>
							<li><a href="#">Food</a></li>
							<li><a href="#">Technology</a></li>
						</ul>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- Start main body Area -->

	<!-- start footer Area -->
	<footer class="footer-area section-gap">
		<div class="container box_1170">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6 class="footer_title">About Us</h6>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
							labore dolore
							magna aliqua.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6 class="footer_title">Newsletter</h6>
						<p>Stay updated with our latest trends</p>
						<div id="mc_embed_signup">
							<form target="_blank"
								action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
								method="get" class="subscribe_form relative">
								<div class="input-group d-flex flex-row">
									<input name="EMAIL" placeholder="Email Address" onfocus="this.placeholder = ''"
										onblur="this.placeholder = 'Email Address '" required="" type="email">
									<button class="btn sub-btn"><span class="lnr lnr-arrow-right"></span></button>
								</div>
								<div class="mt-10 info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="single-footer-widget instafeed">
						<h6 class="footer_title">Instagram Feed</h6>
						<ul class="list instafeed d-flex flex-wrap">
							<li><img src="img/i1.jpg" alt=""></li>
							<li><img src="img/i2.jpg" alt=""></li>
							<li><img src="img/i3.jpg" alt=""></li>
							<li><img src="img/i4.jpg" alt=""></li>
							<li><img src="img/i5.jpg" alt=""></li>
							<li><img src="img/i6.jpg" alt=""></li>
							<li><img src="img/i7.jpg" alt=""></li>
							<li><img src="img/i8.jpg" alt=""></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="single-footer-widget f_social_wd">
						<h6 class="footer_title">Follow Us</h6>
						<p>Let us be social</p>
						<div class="f_social">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row footer-bottom d-flex justify-content-between align-items-center">
				<p class="col-lg-12 footer-text text-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>
						document.write(new Date().getFullYear());
					</script> All rights reserved | This template is made with <i class="fa fa-heart-o"
						aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Abdessalam</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
			</div>
		</div>
	</footer>
	<!-- End footer Area -->

	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
	</script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript"
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
	<script src="js/easing.min.js"></script>
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.tabs.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/waypoints.min.js"></script>
	<script src="js/mail-script.js"></script>
	<script src="js/main.js"></script>

</body>
</html>