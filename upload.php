<?php
session_start();
include "connexion.php";
$id = $_SESSION['id_utilisateur'];

if(isset($_POST['submit'])){
    $photo=$_FILES['file'];
    
	$photoName=$_FILES['file']['name'];
	$photosize=$_FILES['file']['size'];
	$photoTmpName=$_FILES['file']['tmp_name'];
	$photoError=$_FILES['file']['error'];
	$photoType=$_FILES['file']['type'];
	
	$photoExt= explode('.',$photoName);
	$photoActulExt=strtolower(end($photoExt));
	$allowed=array('jpg','jpeg','png');

	if(in_array($photoActulExt,$allowed)){
		if($photoError === 0){
			if($photosize < 1000000){
				$photoNameNew = "profile_user.php".$id.".".$photoActulExt;
				$photoDestination= 'uploads/'.$photoNameNew;
                move_uploaded_file($photoTmpName,$photoDestination);
                $sql = "UPDATE profileimage SET status = 0 WHERE id_utilisateur='$id' ";
                $result = mysqli_query($conn,$sql);
				header("Location:profile_user.php?uploadSuccess");
			}else{
				echo "Your file is too big!";
			}
		}else{
			echo "There was an error uploading your file";
		}
}else {
	echo "You cannot upload files of this type!";
}
}
?>