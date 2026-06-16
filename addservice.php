 <?php 
	include("config.php"); 
	include("resize.php"); 
		 if(isset($_SESSION["login"]) != true){
				 die();
		 }
	

	 // Handle AJAX delete of extension row
	 if (isset($_POST['del_ext'])) {
		 $ext_id = (int)$_POST['del_ext'];
		 mysqli_query($config, "DELETE FROM tbl_service_exten WHERE ser_id = '$ext_id'");
		 echo 1;
		 die();
	 }
		 if ($_POST["do_what"] == "edit") {
				$id = $_GET["edit"] ?? '';
			}else if ($_POST["do_what"] == "insert") {

		 	 $fileImg="";
			$total = count($_FILES['image']['name']);

		
		$id_Car='';	
		if($_POST['car_id']=="" && $_POST['ser_idcar']!=""){
		 		
		 		$insertCar = "INSERT INTO tbl_cardetail SET   car_regis='".$_POST['ser_idcar']."',
    car_brand='".$_POST['car_brand']."', car_type='".$_POST['car_type']."',   car_year='".$_POST['car_year']."', car_customer='".$_POST['car_customer']."', car_tel='".$_POST['car_tel']."',    remark='".$_POST['remark']."', image ='', ad_type='".$_SESSION['ad_type']."',    date_create=NOW(),    date_update=NOW() ";
				mysqli_query($config,$insertCar)or die(mysqli_error($config));
				$id_Car = mysqli_insert_id($config);

				$structure = 'img/'.$id_Car.'/car';
		 	if(!is_dir($structure)){
			if (!mkdir($structure, 0777, true)) {
			    die('Failed to create folders...');
			}
		}

           $structure2 = 'img/'.$id_Car.'/service';
		 	if(!is_dir($structure2)){
			if (!mkdir($structure2, 0777, true)) {
			    die('Failed to create folders...');
			}
                         
		 	}
}
		 	 //order id

		 $or_date =  date("Ymd");
		 $sql = "SELECT * FROM tbl_order WHERE id =1 ";
			$query = mysqli_query($config,$sql) or die("<pre>$sql</pre>".mysqli_error($config));
			$result = mysqli_fetch_assoc($query);
			$last_order = $result['order'];
			$add_order = ($last_order + 1);
			$zero = "";
			for($i=0;$i<(3 - strlen($add_order));$i++){
				$zero .= "0";
			}
			//$order = "01".$zero.$add_order;  // test
			 $order = $or_date.$zero.$add_order; // real


			
		 	
			
			if(!empty($_FILES['image']['tmp_name'][0])){
				for( $i=0 ; $i < $total ; $i++ ) {
				  $fileImg .= $_FILES['image']['name'][$i].",";
				}
			}

			$i_ser = "INSERT INTO tbl_service SET   ser_idcar='".$_POST['ser_idcar']."',
    ser_order='".$_POST['ser_order']."', ser_parts='".$_POST['ser_parts'][0]."',   ser_p_price='".$_POST['ser_p_price'][0]."',ser_p_cost='".$_POST['ser_p_cost'][0]."', ser_detail='".$_POST['ser_detail']."', ser_date='".$_POST['ser_date']."', ser_pic ='".$fileImg."' , ad_type='".$_SESSION['ad_type']."', date_create=NOW(), date_update=NOW() ";
				mysqli_query($config,$i_ser)or die(mysqli_error($config));
				$id = mysqli_insert_id($config);

			for($i=1;$i<count($_POST['ser_parts']);$i++){
			$i_ex_ser = "INSERT INTO tbl_service_exten SET   ser_idcar='".$_POST['ser_idcar']."',
    ser_order='".$_POST['ser_order']."', ser_parts='".$_POST['ser_parts'][$i]."',   ser_p_price='".$_POST['ser_p_price'][$i]."',ser_p_cost='".$_POST['ser_p_cost'][$i]."',ser_date='".$_POST['ser_date']."' , ad_type='".$_SESSION['ad_type']."',    date_create=NOW(),    date_update=NOW() ";
				mysqli_query($config,$i_ex_ser)or die(mysqli_error($config));
			}

			$up_order = "UPDATE tbl_order set ser_order ='".$_POST['order']."' WHERE id = 1";

				mysqli_query($config,$up_order);
		 		
			if(!empty($_FILES['image']['tmp_name'][0])){
				for( $i=0 ; $i < $total ; $i++ ) {
					$images = $_FILES["image"]["tmp_name"][$i];
					$new_images = $_FILES["image"]["name"][$i];
					$width=500;
					$size=GetimageSize($images);
					$height=round($width*$size[1]/$size[0]);
					$images_orig = ImageCreateFromJPEG($images);
					$photoX = ImagesX($images_orig);
					$photoY = ImagesY($images_orig);
					$images_fin = ImageCreateTrueColor($width, $height);
					ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
					ImageJPEG($images_fin,"img/".$id_Car."/service/".$new_images);
					ImageDestroy($images_orig);
					ImageDestroy($images_fin);
				}
			}
				header("Location: service.php");
				exit();
			}


			if (isset($_POST['premium'])) {
				$premium = 1;
			}else{
				$premium = 0;
			}

			
		
		 	if($_POST['do_what']=="edit"){

		 		$structure2 = 'img/'.$_POST['car_id'].'/service';
		 	if(!is_dir($structure2)){
			if (!mkdir($structure2, 0777, true)) {
			    die('Failed to create folders...');
			}
                         
		 	}
		 		
		 	$fileImg2 = '';
		 	if(!empty($_FILES['image']['tmp_name'][0])){
		 		 $fileImg2="";
			 $total = count($_FILES['image']['name']);
			
			for( $i=0 ; $i < $total ; $i++ ) {
				  $fileImg2 .= $_FILES['image']['name'][$i].",";

				}
				for( $i=0 ; $i < $total ; $i++ ) {
					$images = $_FILES["image"]["tmp_name"][$i];
					$new_images = $_FILES["image"]["name"][$i];
					//copy($_FILES["image"]["tmp_name"][$i],"./img/".iconv("UTF-8","TIS-620",$_POST['ser_idcar'])."/service/".$_FILES["image"]["name"][$i]);
					
					$width=500; //*** Fix Width & Heigh (Autu caculate) ***//
					$size=GetimageSize($images);
					$height=round($width*$size[1]/$size[0]);
					$images_orig = ImageCreateFromJPEG($images);
					$photoX = ImagesX($images_orig);
					$photoY = ImagesY($images_orig);
					
					$images_fin = ImageCreateTrueColor($width, $height);
					ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
					ImageJPEG($images_fin,"img/".$_POST['car_id']."/service/".$new_images);
					ImageDestroy($images_orig);
					ImageDestroy($images_fin);
				  // $tmpFilePath = $_FILES['image']['tmp_name'][$i];

				  // if ($tmpFilePath != ""){
				   
				  //   $newFilePath = "./img/".iconv("UTF-8","TIS-620",$_POST['ser_idcar'])."/service/" . $_FILES['image']['name'][$i];

				  //   if(move_uploaded_file($tmpFilePath, $newFilePath)) {

				  //   }
				  // }
				}
			}
			if($fileImg2!=','){
			$f_img= $_POST['Hfile2'].$fileImg2;
			}else{
				$f_img= $_POST['Hfile2'];
			}
			$updateCar = "UPDATE tbl_cardetail SET   car_regis='".$_POST['ser_idcar']."',
    car_brand='".$_POST['car_brand']."', car_type='".$_POST['car_type']."',   car_year='".$_POST['car_year']."', car_customer='".$_POST['car_customer']."', car_tel='".$_POST['car_tel']."',    remark='".$_POST['remark']."', image ='',  date_update=NOW() where  car_id ='".$_POST['car_id']."'";
				mysqli_query($config,$updateCar)or die(mysqli_error($config));

			$q="UPDATE tbl_service SET ser_idcar = '".$_POST['ser_idcar']."' ,
				ser_order = '".$_POST['ser_order']."' ,
				ser_date = '".$_POST['ser_date']."' ,
				ser_parts = '".$_POST['ser_parts'][0]."' ,
				ser_p_price = '".$_POST['ser_p_price'][0]."' ,
				ser_detail = '".$_POST['ser_detail']."' ,
				ser_pic = '".$f_img."' ,
				date_update = NOW()   

				WHERE ser_id ='".$_POST['h_data_id']."' ";
				
				mysqli_query($config,$q)or die (mysqli_error($config));

				for($i=1;$i<count($_POST['ser_parts']);$i++){
			$i_ex_ser = "INSERT INTO tbl_service_exten SET   ser_idcar='".$_POST['ser_idcar']."',
    ser_order='".$_POST['ser_order']."', ser_parts='".$_POST['ser_parts'][$i]."',   ser_p_price='".$_POST['ser_p_price'][$i]."',ser_p_cost='".$_POST['ser_p_cost'][$i]."',ser_date='".$_POST['ser_date']."', ad_type='".$_SESSION['ad_type']."',    date_create=NOW(),    date_update=NOW() ";
				mysqli_query($config,$i_ex_ser)or die(mysqli_error($config));
			}

				for($i=0;$i<count($_POST['exten_id'] ?? []);$i++){
					$q2="UPDATE tbl_service_exten SET ser_idcar = '".$_POST['ser_idcar']."' ,
				ser_order = '".$_POST['ser_order']."' ,
				ser_date = '".$_POST['ser_date']."' ,
				ser_parts = '".$_POST['ser_parts2'][$i]."' ,
				ser_p_cost = '".$_POST['ser_p_cost2'][$i]."' ,
				ser_p_price = '".$_POST['ser_p_price2'][$i]."' ,
						
				date_update = NOW()   

				WHERE ser_id ='".$_POST['exten_id'][$i]."' ";
				
				mysqli_query($config,$q2)or die (mysqli_error($config));
				
				}
			header("Location: service.php");
				exit();
			}
		
	
		 if (isset($_GET["del"])) {
				 mysqli_query($config,"DELETE FROM tbl_service WHERE ser_id = '".$_GET["del"]."' ");
				 header("Location: service.php");
	
		 }

		 //order id

		 $or_date =  date("Ymd");
		 $sql = "SELECT * FROM tbl_order WHERE id =1 ";
			$query = mysqli_query($config,$sql) or die("<pre>$sql</pre>".mysqli_error($config));
			$result = mysqli_fetch_assoc($query);
			$last_order = $result['order'];
			$add_order = ($last_order + 1);
			$zero = "";
			for($i=0;$i<(3 - strlen($add_order));$i++){
				$zero .= "0";
			}
			//$order = "01".$zero.$add_order;  // test
			 $order = $or_date.$zero.$add_order; // real

			// select licen car
			$sql_car = "SELECT car_regis FROM tbl_cardetail GROUP BY car_regis";
			$query_car = mysqli_query($config,$sql_car);
			$rows = array();
			while($r = mysqli_fetch_array($query_car)) {
			    $rows[] = $r['car_regis'];
			}
			$car_ar=json_encode($rows);
			
	?>