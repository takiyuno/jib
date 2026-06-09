<?php 
	include("config.php"); 
		 if(isset($_SESSION["login"]) != true){
				 die();
		 }
	

		 $or_date =  date("Ymd");
		 $sql = "SELECT * FROM tbl_order WHERE id =1 ";
			$query = mysqli_query($config,$sql) or die("<pre>$sql</pre>".mysqli_error($config));
			$result = mysqli_fetch_assoc($query);
			$last_order = $result['ser_order'];
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
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Car Service</title>

		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="js/jquery-ui/jquery-ui.css" rel="stylesheet">
		<script src="js/jquery.js"></script>
		<script src="js/jquery-ui/jquery-ui.js"></script>
    	<script src="js/bootstrap.js"></script>
		
   		<!-- <link href="js/jquery-ui/jquery-ui.min.css" rel="stylesheet"> -->
		<link href='css/style.css' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="js/yearpicker.css">

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
		        
		        <!-- <li><a class="" href="cardetail.php">จัดการข้อมูลรถ</a>
			      </li> -->
		        <li class="active"><a  href="service.php">รายการซ่อม</a></li>
		         <li ><a  href="report.php">รายงานรายได้</a></li>
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
						$e = mysqli_fetch_array(mysqli_query($config,"SELECT * FROM tbl_service WHERE ser_id = '".$_GET["edit"]."' "));
						$e2 = mysqli_fetch_array(mysqli_query($config,"SELECT * FROM tbl_cardetail WHERE car_regis = '".$e['ser_idcar']."' "));
				}else{
						$chk_edit = 0;
				}
				?>
				<div id="page-content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col col-lg-12">

							<div class="row">
								<div class="col-md-3">
									<h2>รายการซ่อม </h2>
								</div>
							
								<div class="col-md-2 float-right">
									<a href="service.php"><button type="button" class="btn btn-primary" >+เพิ่มรายการซ่อม</button></a>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-body">
										<form method="POST" action="addservice.php" enctype="multipart/form-data">

										<div class="form-group">
												<div class="col-md-3">
					                    		<div class="form-group">
												<label>ทะเบียนรถ</label>
													<input type="text" class="form-control" autocomplete="off" name="ser_idcar" id="serIdcar" value="<?php if($chk_edit == 1){echo $e["ser_idcar"];}?>" required >
													<input type="hidden" name="car_id" id="car_id" value="<?=$e2['car_id'];?>">
												</div>
												</div>
												<div class="col-md-3">
												<label>ยี่ห้อ</label>
													<input type="text" name="car_brand" id="carBrand" class="form-control" value="<?php if($chk_edit == 1){echo $e2["car_brand"];}?>" required>
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
													<input type="text" class="form-control" autocomplete="off" name="car_type" id="car_type" value="<?php if($chk_edit == 1){echo $e2["car_type"];}?>" required>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label>รถปี</label>
														<input type="text" class="yearpicker form-control"  autocomplete="off" id="car_year" name="car_year" value="<?php if($chk_edit == 1){echo $e2["car_year"];}?>" required>                                        
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label>ชื่อลูกค้า</label>
														<input type="text" class="form-control"  autocomplete="off" id="car_customer" name="car_customer" value="<?php if($chk_edit == 1){echo $e2["car_customer"];}?>" required>
													</div>
													<div class="col-md-6">
														<label>โทรศัพท์</label>
														<input type="text" class="form-control"  autocomplete="off" id="car_tel" name="car_tel" value="<?php if($chk_edit == 1){echo $e2["car_tel"];}?>" required>
													</div>
												</div>
											</div>  
										<div class="col-lg-12">
										 <div class="row">
					                    	
												
												<div class="col-md-4 ">
													<div class="form-group">
													<label>เลขที่บริการ</label>
													<input type="text" class="form-control" autocomplete="off" name="ser_order" value="<?php if($chk_edit == 1){echo $e["ser_order"];}else{echo $order;}?>" readonly>
													</div>
												</div>
												<div class="col-md-4 ">
													<div class="form-group">
														<label>วันที่รับบริการ</label>
														<input type="date" class="form-control" autocomplete="off" id="ser_date" name="ser_date" data-date="" data-date-format="DD/MM/YYYY" value="<?php if($chk_edit == 1){echo $e["ser_date"];}?>" required >
													</div>
												</div>
											</div>

											</div>
											
											<div class="col-lg-12">
												<div class="row">
													<div class="col-md-7">
														<label>รายการอะไหล่</label>
													</div>
													<div class="col-md-3">
														<label>ราคา</label>
													</div>
													<div class="col-md-2 ">
														<div class="select-box">
													  <input type='button'  class="btn btn-success" aria-label="Left Align" value='+' id='addButton'>
													  <input type='button' class="btn btn-danger" aria-label="Left Align" value='-' id='removeButton'>
													</div>
												</div>
												</div>	
											</div>
											<div class="col-lg-12">
													<div id="row-container">

														<div class="row">
															<div class="col-md-7">
																<input type="hidden" name="ser_id" id="ser_id" value="<?=$e['ser_order']?>">
															<input type="text" class="form-control" placeholder="อะไหล่"  autocomplete="off" id="ser_parts" name="ser_parts[]" value="<?php if($chk_edit == 1){echo $e["ser_parts"];}?>"  required >
															</div>
															<div class="col-md-3">
																<input type="text" class="form-control" placeholder="ราคา" autocomplete="off" id="ser_p_price" name="ser_p_price[]" value="<?php if($chk_edit == 1){echo $e["ser_p_price"];}?>" required>
															</div>
														</div>

														<?php if($chk_edit == 1){
															$q_exten=mysqli_query($config,"SELECT * FROM tbl_service_exten WHERE ser_order = '".$e["ser_order"]."' ");
															while($e3 = mysqli_fetch_array($q_exten)){
																?>
																<div class="row">
																	<input type="hidden" name="exten_id[]" value="<?=$e3['ser_id']?>">
																	<div class="col-md-7">
																		<input type="text" class="form-control"  autocomplete="off" name="ser_parts2[]" value="<?php echo $e3["ser_parts"];?>">
																	</div>
																	<div class="col-md-3">
																		<input type="text" class="form-control"  autocomplete="off" name="ser_p_price2[]" value="<?php echo $e3["ser_p_price"];?>">
																	</div>
																</div>
																<?php
															}
														} ?>
													
												</div>
												
											</div>                      
											<div class="col-lg-12">
												<div class="row ">
												
													<div class="col-md-8">
													<label>รายละเอียด</label>
													<textarea  class="form-control" name="ser_detail" style="height:100px;" id="ser_detail"><?php if($chk_edit == 1){echo $e["ser_detail"];}?></textarea>    
													  
													  </div>                        
												</div>
											</div>
											<div class="col-lg-12">
											<div class="row" style="margin-top:45px;">
											
											
												<div class="col-sm-6">
													<label>Multi Pictures</label>
													<?php 
														if (isset($_GET["edit"]) && $e["ser_pic"] != "") {
														
														?>
													<br/>
													<div class="container">
														<?php 
															$c_img=explode(',', $e['ser_pic']);
														for($i=0;$i<count($c_img)-1;$i++){ ?>
														
														<div class='content' id="<?php echo "content_".$i?>" ><img src='img/<?=$e2['car_id']?>/service/<?=$c_img[$i]?>' width='200' ><span class='delete' id="<?php echo "content_".$i?>">Delete</span></div>
														
															
													<?php }?>
													</div>
													<?php
														}
														?>
													<div class="form-group">
													<input type="hidden" name="Hfile2" value="<?php if($chk_edit == 1){echo $e["ser_pic"];}?>">
													<input name="image[]" type="file" multiple="multiple" class="form-control-file"  />
												</div>
												
											</div> 
											<input type="hidden" name="order" value="<?=$add_order;?>">  

											<input type="hidden" name="h_data_id" value="<?php if($chk_edit == 1){echo $e["ser_id"];}?>">
											<input type="hidden" name="do_what" value="<?=(isset($_GET['edit']))?'edit':'insert'?>">
										
											
										</div>
									</div>
										<div class="col-md-12 ">
												<div class="form-group">
												<input type="submit" class="btn btn-default button_add" id="submit" name="submit" value="Submit">
											</div>
											</div>	
										
										</form>
										<form method="POST" id="frm2">
										</form>
									</div>
								</div>
							</div>

						<div class="container">
							<div class="col col-md-6">
								
								<table id="table-result" class="display table table-bordered">
									<thead>
										<tr>
											<th style="text-align:center;white-space: nowrap;">
												#
											</th>
											<th>
													เลขที่บริการ
											</th>
											<th>
													ทะเบียนรถ
											</th>
											<th>
													วันที่รับบริการ
											</th>
											<th style="text-align:center;width:70px;white-space: nowrap;">
												Option
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
											
												$q = mysqli_query($config,"SELECT * FROM tbl_service WHERE 1 GROUP BY date_create desc");
											
												$count = 0;
												
												while ($p = mysqli_fetch_array($q)) {
												 $count +=1;
											?>
										<tr>
											<td style="text-align:center;width: 1px;">
												<?=$count;?>
											</td>
											<td>
												<?=$p["ser_order"];?>
											</td>
											<td>
												<?=$p["ser_idcar"];?>
											</td>
											<td>
												<?=$p["ser_date"];?>
											</td>
											<td style="text-align:center;">
												<a href="receipt.php?ser_id=<?=$p["ser_id"];?>" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>&nbsp;
												<a href="service.php?edit=<?=$p["ser_id"];?><?=(isset($_GET["t"]))?'&t='.$_GET["t"].'':''?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
												&nbsp;
												<a href="addservice.php?del=<?=$p["ser_id"];?>" onclick="return confirm('Are you sure you want to delete this item?');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
			</div>
			
		<!-- /#wrapper -->
		
		<script src="js/moment.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>

		<script type="text/javascript" language="javascript" class="init">
			$(document).ready(function() {
				$('#table-result').dataTable( {
					"order": [[ 0, "asc" ]],
					"bFilter" : false,               
					"bLengthChange": false,
					"pageLength" : 10,
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
                           url: 'addremoveser.php',
                           type: 'post',
                           data: {path: imgElement_src,request: 2,ser_id:$("#ser_id").val(), },
                           success: function(response){
                         
                                // Remove <div >
                             // alert(response);
                                if(response == 1){
                                    $('#content_'+num).remove();
                                }
                               

                           }
                        });
                    }
                });

            });

                        //plus text box
            var rowTemplate = $(
                '<div class="row added-row">'
                + '<div class="col-md-7"><input type="text" class="form-control" placeholder="อะไหล่" autocomplete="off" name="ser_parts[]"></div>'
                + '<div class="col-md-3"><input type="text" class="form-control" placeholder="ราคา" autocomplete="off" name="ser_p_price[]"></div>'
                + '</div>'
            );
            $('#addButton').click(function(){
                $('#row-container').append(rowTemplate.clone());
            });
            $('#removeButton').click(function(){
                var added = $('#row-container .added-row');
                if (added.length > 0) { added.last().remove(); }
            });
				});
       
			var car = <?php print json_encode($rows);?>;

			//autocomplete(document.getElementById("serIdcar"),car );

			$("#serIdcar").autocomplete({
			        source: car
			    });

			// $("input").on("change", function() {
				
			// 	    this.setAttribute(
			// 	        "data-date",
			// 	        moment(this.value, "YYYY-MM-DD")
			// 	        .format( this.getAttribute("data-date-format") )
			// 	    )
			// 	}).trigger("change");
			var carBrand = ["TOYOTA","ISUZU","TATA","FORD","CHEVROLET","MAZDA","VOLVO","BENZ","BMW","HONDA","HYUNDAI"];
			//autocomplete(document.getElementById("carBrand"),carBrand );
			$("#carBrand").autocomplete({
			        source: carBrand
			    });


			  $(document).ready(function(){
			  	$('#serIdcar').on('autocompleteselect', function (e, ui) {
			  		
        //$('#tagsname').html('You selected: ' + );
    // });
    //            $( "#serIdcar" ).keydown(function() {
                                 
                        // AJAX request

                        $.ajax({
                           url: 'check.php',
                           type: 'post',
                            dataType: 'JSON',
                           data: {car_id: ui.item.value},
                           success: function(response){
				          // var len = response.length;
				           // for(var i=0; i<len; i++){
				           	if(response!=0){
				                var car_id = response[0].car_id;
				                var car_regis = response[0].car_regis;
				                var car_brand = response[0].car_brand;
				                var car_type = response[0].car_type;
				                 var car_year = response[0].car_year;
				                var car_customer = response[0].car_customer;
				                var car_tel = response[0].car_tel;
				                $("#carBrand").val(car_brand);
				                $("#car_type").val(car_type);
				                $("#car_year").val(car_year);
				                $("#car_customer").val(car_customer);
				                $("#car_tel").val(car_tel);
				                $("#car_id").val(car_id);
				            }else{
				            	$("#carBrand").val();
				                $("#car_type").val();
				                $("#car_year").val();
				                $("#car_customer").val();
				                $("#car_tel").val();
				                $("#car_id").val();
				            }
				           // }
				           // alert(response[0].car_regis);
                         	// if(response==1){
                          //      $("#error").html("ซ้ำ");
                          //      $("#submit").prop('disabled', true);
                         	// }else{
                         	// 	 $("#error").html("");
                          //      $("#submit").prop('disabled', false);
                         	// }

                           }
                        });
                });

            });

			</script>
		       
	</body>
</html>