<?php
include("config.php"); 
$request = $_POST['request'];

// Upload file
if($request == 1){

	$filename = $_FILES['file']['name'];
	/* Location */
	$location = "upload/".$filename;
	$uploadOk = 1;
	$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

	// Check image format
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	 && $imageFileType != "gif" ) {
	 	$uploadOk = 0;
	}

	if($uploadOk == 0){
	 	echo 0;
	}else{
	 /* Upload file */
	 	if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
	 		echo $location;
	 	}else{
	 		echo 0;
	 	}
	}
	exit;
}

// Remove file
if($request == 2){
	$path = $_POST['path'];
	
	$return_text = 0;

	// Check file exist or not
	if( file_exists($path) ){

	// Remove file 
	 unlink($path);

	// Set status
	 $return_text = 1;
	}else{

	// Set status
	 $return_text = 0;
	}

	$r_dat=explode("/", $path);

	$query = mysqli_query($config,"SELECT * FROM tbl_cardetail WHERE car_regis ='".$r_dat[1]."' ");
	$res_car = mysqli_fetch_array($query) or die (mysqli_error($config));

	$pic_data = explode(",", $res_car['image']);

	$image_t = "";

	for($i=0;$i<count($pic_data);$i++){

		if($pic_data[$i]==$r_dat[3]){
			continue;
		}else{
			if($pic_data[$i]!=""){
		$image_t .= $pic_data[$i].",";}}

	}

mysqli_query($config,"UPDATE tbl_cardetail SET image='".$image_t."', date_update = NOW() WHERE car_regis ='".$r_dat[1]."' ") or die (mysqli_error($config));
	// Return status
	echo $return_text ;
	exit;
}