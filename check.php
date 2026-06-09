<?php
include("config.php"); 

	$car_id = $_POST["car_id"];
	$return_arr = array();
	$sql = "SELECT * FROM tbl_cardetail WHERE car_regis = '$car_id'";
	$query = mysqli_query($config,$sql);
	$r = mysqli_num_rows($query);

	if($r!=0){
		//while($row = mysqli_fetch_array($query)){
		$row = mysqli_fetch_array($query);
		    $car_id = $row['car_id'];
		    $car_regis = $row['car_regis'];
		    $car_brand = $row['car_brand'];
		    $car_type = $row['car_type'];
		    $car_year =$row['car_year'];
		    $car_customer =$row['car_customer'];
		    $car_tel = $row['car_tel'];

		    $return_arr[] = array("car_id" => $car_id,
		                    "car_regis" => $car_regis,
		                    "car_brand" => $car_brand,
		                    "car_type" => $car_type,
		                    "car_year" => $car_year,
		                    "car_customer" => $car_customer,
		                    "car_tel" => $car_tel,
		                    );
		//}

// Encoding array in JSON format
echo json_encode($return_arr);
	}else{
		echo 0 ;
	}

?>