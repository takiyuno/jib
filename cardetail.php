<?php 
	include("config.php"); 
		 if(isset($_SESSION["login"]) != true){
				 die();
		 }
	
		//  if(isset($_POST["submit"])){

		 	


		// 	if ($_POST["do_what"] == "edit") {
		// 		$id = $_GET["edit"];
		// 	}else if ($_POST["do_what"] == "insert") {

		//  	$structure = 'img/'.iconv("UTF-8","TIS-620",$_POST['car_regis']).'/car';
		//  	if(!is_dir($structure)){
		// 	if (!mkdir($structure, 0777, true)) {
		// 	    die('Failed to create folders...');
		// 	}
		// }
		// 	 $fileImg="";
		// 	$total = count($_FILES['image']['name']);
		// 	for( $i=0 ; $i < $total ; $i++ ) {
		// 		  $fileImg .= $_FILES['image']['name'][$i].",";

		// 		}

		// 	$insertCar = "INSERT INTO tbl_cardetail SET   car_regis='".$_POST['car_regis']."',
  //   car_brand='".$_POST['car_brand']."', car_type='".$_POST['car_type']."',   car_year='".$_POST['car_year']."', car_customer='".$_POST['car_customer']."', car_tel='".$_POST['car_tel']."',    remark='".$_POST['remark']."', image ='".$fileImg."',    date_create=NOW(),    date_update=NOW() ";
		// 		mysqli_query($config,$insertCar)or die(mysql_error());
		// 		$id = mysql_insert_id();
		// 	}
		// 	if (isset($_POST['premium'])) {
		// 		$premium = 1;
		// 	}else{
		// 		$premium = 0;
		// 	}

		// 	if($_POST["do_what"] == "insert"){
		 		

		// 		for( $i=0 ; $i < $total ; $i++ ) {
		// 		  $tmpFilePath = $_FILES['image']['tmp_name'][$i];

		// 		  if ($tmpFilePath != ""){
				   
		// 		    $newFilePath = "./img/".iconv("UTF-8","TIS-620",$_POST['car_regis'])."/car/" . $_FILES['image']['name'][$i];

		// 		    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

		// 		    }
		// 		  }
		// 		}
		//  	}

		//  	if($id!=""){
		 		

		//  	if($_FILES['image']['name']!=""){
		//  		 $fileImg2="";
		// 	$total = count($_FILES['image']['name']);
		// 	for( $i=0 ; $i < $total ; $i++ ) {
		// 		  $fileImg2 .= $_FILES['image']['name'][$i].",";

		// 		}
		// 		for( $i=0 ; $i < $total ; $i++ ) {
		// 		  $tmpFilePath = $_FILES['image']['tmp_name'][$i];

		// 		  if ($tmpFilePath != ""){
				   
		// 		    $newFilePath = "./img/".iconv("UTF-8","TIS-620",$_POST['car_regis'])."/car/" . $_FILES['image']['name'][$i];

		// 		    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

		// 		    }
		// 		  }
		// 		}
		// 	}
		// 	$f_img= $_POST[Hfile2].$fileImg2;
		// 	$q="UPDATE tbl_cardetail SET car_regis = '".$_POST['car_regis']."' ,
		// 		car_brand = '".$_POST['car_brand']."' ,
		// 		car_type = '".$_POST['car_type']."' ,
		// 		car_year = '".$_POST['car_year']."' ,
		// 		car_customer = '".$_POST['car_customer']."' ,
		// 		car_tel = '".$_POST['car_tel']."' ,
		// 		remark = '".$_POST['remark']."' ,
		// 		image = '".$f_img."' ,
		// 		date_update = NOW()   

		// 		WHERE car_id ='".$id."' ";
				
		// 		mysqli_query($config,$q)or die (mysql_error());
		// 	}
		// }
	
		//  if (isset($_GET["del"])) {
		// 		 mysqli_query($config,"DELETE FROM tbl_cardetail WHERE car_id = '".$_GET["del"]."' ");
		// 		 header("Location: cardetail.php");
	
		//  }
	?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Car Detail</title>

    	<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/jquery.min.js"></script>
    	<script src="js/bootstrap.js"></script>
		<link href='css/style.css' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="js/yearpicker.css">
		<script src="js/jquery.js"></script>
    	<script src="js/jquery-ui/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<style>
			input[type='date']::-webkit-inner-spin-button { display:none; -webkit-appearance:none; }
			input[type='date']::-webkit-calendar-picker-indicator { opacity:1; }
		</style>
		
	</head>
	<body>
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="service.php">
        <div class="brand-logo"><img src="images/wrench.png"></div>
        <div class="brand-text"><strong>MotorFix</strong><small>กลอนประตูรถยนต์ ภูเก็ต</small></div>
      </a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav">
		        
		        <li class="active"><a class="" href="cardetail.php">จัดการข้อมูลรถ</a>
			      </li>
		        <li ><a  href="service.php">รายการซ่อม</a></li>
		      </ul>
		     <!--  <ul class="nav navbar-nav navbar-right">
		        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
		        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		      </ul> -->
		    </div>
		  </div>
		</nav>
		
			<?php
				if(isset($_GET["edit"])){
						$chk_edit = 1;
						$e = mysqli_fetch_array(mysqli_query($config,"SELECT * FROM tbl_cardetail WHERE car_id = '".$_GET["edit"]."' "));
				}else{
						$chk_edit = 0;
				}
				?>
			<div id="page-content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col col-lg-12">
							<h2>จัดการข้อมูลรถ</h2>
							<div class="col-md-7">
								<a href="cardetail.php"><button type="button" class="btn btn-primary" style="position:absolute;right:15px;top:-50px;font-family:tahoma;margin-left:10px;font-size:15px;font-weight:bold;">+ เพิ่มข้อมูลใหม่</button></a>
								<div class="panel panel-default">
									<div class="panel-body">
										<form method="POST" action="addcardetail.php" enctype="multipart/form-data">
										
											<div class="form-group">
												<div class="col-md-3">
												<label>ทะเบียนรถ</label>
													<input type="text" class="form-control" autocomplete="off" name="car_regis" id="car_regis" value="<?php if($chk_edit == 1){echo $e["car_regis"];}?>" required>
													<p id="error" class="text-danger"></p>
												</div>
												<div class="col-md-3">
												<label>ยี่ห้อ</label>
													<input type="text" name="car_brand" id="carBrand" class="form-control" value="<?php if($chk_edit == 1){echo $e["car_brand"];}?>" required>
													<!-- <select  name="car_brand" class="form-control">
														<option value="TOYOTA">TOYOTA</option>
														<option value="ISUZU">ISUZU</option>
														<option value="TATA">TATA</option>
														<option value="FORD">FORD</option>
														<option value="CHEVROLET">CHEVROLET</option>
														<option value="MAZDA">MAZDA</option>
														<option value="VOLVO">VOLVO</option>
														<option value="BENZ">BENZ</option>
														<option value="BMW">BMW</option>
														<option value="HONDA">HONDA</option>
														<option value="HYUNDAI">HYUNDAI</option>
													</select> -->
													
												</div>
												<div class="col-md-3">
												<label>รุ่น</label>
													<input type="text" class="form-control" autocomplete="off" name="car_type" value="<?php if($chk_edit == 1){echo $e["car_type"];}?>" required>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label>รถปี</label>
														<input type="text" class="yearpicker form-control"  autocomplete="off" name="car_year" value="<?php if($chk_edit == 1){echo $e["car_year"];}?>" required>                                        
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label>ชื่อลูกค้า</label>
														<input type="text" class="form-control"  autocomplete="off" id="car_customer" name="car_customer" value="<?php if($chk_edit == 1){echo $e["car_customer"];}?>" required>
													</div>
													<div class="col-md-6">
														<label>โทรศัพท์</label>
														<input type="text" class="form-control"  autocomplete="off" id="car_tel" name="car_tel" value="<?php if($chk_edit == 1){echo $e["car_tel"];}?>" required>
													</div>
												</div>
											</div>                      

											<div class="form-group">
												<label>รายละเอียด</label>
												<textarea  class="form-control" name="remark" style="height:100px;" id="remark"><?php if($chk_edit == 1){echo $e["remark"];}?></textarea>    
												                          
											</div>
											<div class="form-group">
											<div class="row" style="margin-top:45px;">
												<div class="col-sm-7">
													<label>Multi Pictures</label>
													<?php 
														if (isset($_GET["edit"]) && $e["image"] != "") {
														
														?>
													<br/>
													<div class="container">
														<?php 
															$c_img=explode(',', $e['image']);
														for($i=0;$i<count($c_img)-1;$i++){ 
															if($c_img[$i]!=""){
															?>
														
														<div class='content' id="<?php echo "content_".$i?>" ><img src='img/<?=$e['car_regis']?>/car/<?=$c_img[$i]?>' width='200' ><span class='delete' id="<?php echo "content_".$i?>">Delete</span></div>
														
															
													<?php } }?>
													</div>
													<?php
														}
														?>
													<input type="hidden" name="Hfile2" value="<?php if($chk_edit == 1){echo $e["image"];}?>">
													<input name="image[]" type="file" multiple="multiple" />
												</div>
												
											</div>
										</div>
											            											
											<input type="hidden" name="h_data_id" value="<?php if($chk_edit == 1){echo $e["car_id"];}?>">
											<input type="hidden" name="do_what" value="<?=(isset($_GET['edit']))?'edit':'insert'?>">

											<input type="submit" class="btn btn-default button_add" id="submit" name="submit" value="Submit">
										</form>
										<form method="POST" id="frm2">
										</form>
									</div>
								</div>
							</div>


							<div class="col col-md-5">
								
								<table id="table-result" class="display table table-bordered">
									<thead>
										<tr>
											<th style="text-align:center;white-space: nowrap;">
												#
											</th>
											<th>
													ทะเบียนรถ
											</th>
											<th style="text-align:center;width:70px;white-space: nowrap;">
												Option
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
											
												$q = mysqli_query($config,"SELECT * FROM tbl_cardetail WHERE 1 ORDER BY car_id ASC");
											
												$count = 0;
												
												while ($p = mysqli_fetch_array($q)) {
												 $count +=1;
											?>
										<tr>
											<td style="text-align:center;width: 1px;">
												<?=$count;?>
											</td>
											<td>
												<?=$p["car_regis"];?>
											</td>
											<td style="text-align:center;">
												<a href="cardetail.php?edit=<?=$p["car_id"];?><?=(isset($_GET["t"]))?'&t='.$_GET["t"].'':''?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
												&nbsp;
												<a href="addcardetail.php?del=<?=$p["car_id"];?>" onclick="return confirm_delete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
											</td>
										</tr>
										<?php
											}
											?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		<script src="js/jquery.js"></script>
    	<script src="js/jquery-ui/jquery-ui.min.js"></script>
		<script src="js/autocomplete.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>

		<script type="text/javascript" language="javascript" class="init">
			$(document).ready(function() {
				$('#table-result').dataTable( {
					"order": [[ 0, "asc" ]],
					"bFilter" : false,               
					"bLengthChange": false,
					"pageLength" : 3,
					"searching": true,
					"language": {
						"paginate": {
							"previous": "«",
							"next": "»",
						},
						"info": "หน้าที่ _PAGE_ / _PAGES_",
						"lengthMenu": "ผลลัพธ์ _MENU_ แถว",
						"search": "ค้นหา:"
					}
			 } );
			});
		</script>
		<script src="js/yearpicker.js"></script>
     <script>
      $(document).ready(function() {
        $(".yearpicker").yearpicker({
          year: 2020,
          startYear: 1990,
          endYear: 2100
        });
      });
     
            $(document).ready(function(){

                // Remove file
                $('.container').on('click','.content .delete',function(){
                    
                    var id = this.id;
                    var split_id = id.split('_');
                    var num = split_id[1];

                     // Get image source
                    var imgElement_src = $( '#content_'+num+' img' ).attr("src");
                    
                    var deleteFile = confirm("Do you really want to Delete?");
                    if (deleteFile == true) {
                        // AJAX request
                        $.ajax({
                           url: 'addremove.php',
                           type: 'post',
                           data: {path: imgElement_src,request: 2},
                           success: function(response){
                         
                                // Remove <div >
                                //alert(response);
                                if(response == 1){
                                    $('#content_'+num).remove();
                                }
                               

                           }
                        });
                    }
                });

            });

            var carBrand = ["TOYOTA","ISUZU","TATA","FORD","CHEVROLET","MAZDA","VOLVO","BENZ","BMW","HONDA","HYUNDAI"];
			autocomplete(document.getElementById("carBrand"),carBrand );



			  $(document).ready(function(){

               $( "#car_regis" ).keyup(function() {
                                 
                        // AJAX request
                        $.ajax({
                           url: 'check.php',
                           type: 'post',
                           data: {car_id: $('#car_regis').val()},
                           success: function(response){
                         	
                         	if(response==1){
                               $("#error").html("ซ้ำ");
                               $("#submit").prop('disabled', true);
                         	}else{
                         		 $("#error").html("");
                               $("#submit").prop('disabled', false);
                         	}

                           }
                        });
                });

            });
        </script>
		       
	</body>
</html>