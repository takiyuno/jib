<?php 
	include("config.php"); 
		 if(isset($_SESSION["login"]) != true){
				 die();
		 }
	
		 if(isset($_POST["submit"])){

		 	


			if ($_POST["do_what"] == "edit") {
				$id = $_GET["edit"];
			}else if ($_POST["do_what"] == "insert") {

		 	$structure = 'img/'.iconv("UTF-8","TIS-620",$_POST['car_regis']).'/car';
		 	if(!is_dir($structure)){
			if (!mkdir($structure, 0777, true)) {
			    die('Failed to create folders...');
			}
		}
			 $fileImg="";
			$total = count($_FILES['image']['name']);
			for( $i=0 ; $i < $total ; $i++ ) {
				  $fileImg .= $_FILES['image']['name'][$i].",";

				}

			$insertCar = "INSERT INTO tbl_cardetail SET   car_regis='".$_POST['car_regis']."',
    car_brand='".$_POST['car_brand']."', car_type='".$_POST['car_type']."',   car_year='".$_POST['car_year']."', car_customer='".$_POST['car_customer']."', car_tel='".$_POST['car_tel']."',    remark='".$_POST['remark']."', image ='".$fileImg."', ad_type='".$_SESSION['ad_type']."',    date_create=NOW(),    date_update=NOW() ";
				mysqli_query($config,$insertCar)or die(mysqli_error($config));
				$id = mysqli_insert_id($config);
			}
			if (isset($_POST['premium'])) {
				$premium = 1;
			}else{
				$premium = 0;
			}

			if($_POST["do_what"] == "insert"){
		 		

				for( $i=0 ; $i < $total ; $i++ ) {
				  $tmpFilePath = $_FILES['image']['tmp_name'][$i];

				  if ($tmpFilePath != ""){
				   
				    $newFilePath = "./img/".iconv("UTF-8","TIS-620",$_POST['car_regis'])."/car/" . $_FILES['image']['name'][$i];

				    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

				    }
				  }
				}
				header("Location: cardetail.php");
		 	}

		 	if($id!=""){
		 		

		 	if($_FILES['image']['name']!=""){
		 		 $fileImg2="";
			$total = count($_FILES['image']['name']);
			for( $i=0 ; $i < $total ; $i++ ) {
				  $fileImg2 .= $_FILES['image']['name'][$i].",";

				}
				for( $i=0 ; $i < $total ; $i++ ) {
				  $tmpFilePath = $_FILES['image']['tmp_name'][$i];

				  if ($tmpFilePath != ""){
				   
				    $newFilePath = "./img/".iconv("UTF-8","TIS-620",$_POST['car_regis'])."/car/" . $_FILES['image']['name'][$i];

				    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

				    }
				  }
				}
			}
			$f_img= $_POST['Hfile2'].$fileImg2;
			$q="UPDATE tbl_cardetail SET car_regis = '".$_POST['car_regis']."' ,
				car_brand = '".$_POST['car_brand']."' ,
				car_type = '".$_POST['car_type']."' ,
				car_year = '".$_POST['car_year']."' ,
				car_customer = '".$_POST['car_customer']."' ,
				car_tel = '".$_POST['car_tel']."' ,
				remark = '".$_POST['remark']."' ,
				image = '".$f_img."' ,
				date_update = NOW()   

				WHERE car_id ='".$id."' ";
				
				mysqli_query($config,$q)or die (mysqli_error($config));
				header("Location: cardetail.php");
			}
		}
	
		 if (isset($_GET["del"])) {
				 mysqli_query($config,"DELETE FROM tbl_cardetail WHERE car_id = '".$_GET["del"]."' ");
				 header("Location: cardetail.php");
	
		 }
	?>