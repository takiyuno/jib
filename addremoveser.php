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
	$r_dat=explode("/", $path);

	$return_text = 0;

	// Check file exist or not
	$path= "img/".$r_dat[1]."/service/".$r_dat[3];
	if( file_exists($path) ){

	// Remove file 
	 unlink($path);

	// Set status
	 $return_text = 1;
	}else{

	// Set status
	 $return_text = 0;
	}

// 	
	
	$query = mysqli_query($config,"SELECT * FROM tbl_service WHERE ser_order = '".$_POST['ser_id']."'");

	$res_car = mysqli_fetch_array($query) or die (mysqli_error($config));

	$pic_data = explode(",", $res_car['ser_pic']);

	$image_t = "";

	for($i=0;$i<count($pic_data);$i++){

		if($pic_data[$i]==$r_dat[3]){
			continue;
		}else{
			if($pic_data[$i]!=""){
		$image_t .= $pic_data[$i].",";
	}

}

	}

mysqli_query($config,"UPDATE tbl_service SET ser_pic='".$image_t."', date_update = NOW() WHERE ser_order ='".$_POST['ser_id']."' ") or die (mysqli_error($config));
// 	// Return status
	echo $return_text ;
	exit;
}