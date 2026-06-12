<?php 
	include("config.php"); 
		 if(isset($_SESSION["login"]) != true){
				 die();
		 }
			
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
		        <li ><a  href="service.php">รายการซ่อม</a></li>
		        <li class="active"><a  href="report.php">รายงานรายได้</a></li>
		      </ul>
		     <!--  <ul class="nav navbar-nav navbar-right">
		        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
		        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		      </ul> -->
		    </div>
		  </div>
		</nav>
			
				<!-- <div id="page-content-wrapper">
				<div class="container-fluid"> -->
					<div class="row">
						<div class="col col-lg-12">

							<div class="row">
								<div class="col-md-3">
									<h2>รายงานยอดขาย </h2>
								</div>
							
							</div>
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-body">
										<form method="POST" action="report.php" enctype="multipart/form-data">							
										
										<div class="col-lg-12">
										 <div class="row">
					                    	<div class="col-md-4 ">
													<div class="form-group">
														<label>วันที่เริ่ม</label>
														<input type="date" class="form-control" autocomplete="off" id="date_from" name="date_from" data-date="" data-date-format="DD/MM/YYYY" value="" required >
													</div>
												</div>
												<div class="col-md-4 ">
													<div class="form-group">
														<label>วันที่วันที่สิ้นสุด</label>
														<input type="date" class="form-control" autocomplete="off" id="date_to" name="date_to" data-date="" data-date-format="DD/MM/YYYY" value="" required >
													</div>
												</div>
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
							<div class="col col-md-12">
								<?php
											 $date_from = $_POST['date_from'];
											 $date_to = $_POST['date_to'];
								 ?>
								<h4><?php echo "จากวันที่ ".$date_from." ถึงวันที่ ".$date_to;?></h4>
								<table id="table-result" class="display table table-bordered">
									<thead>
										<tr>
											<th style="text-align:center;white-space: nowrap;">
												#
											</th>
											<th>
													วันที่รับบริการ
											</th>
											<th>
													เลขที่บริการ
											</th>
											<th>
													ทะเบียนรถ
											</th>
											<th>
													ต้นทุน
											</th>
											<th>
													รายรับ
											</th>
											<th style="text-align:center;width:70px;white-space: nowrap;">
												Option
											</th>
										</tr>
									</thead>
									
										<?php
											


												$q = mysqli_query($config,"SELECT * FROM tbl_service WHERE ser_date BETWEEN '$date_from' AND '$date_to' AND ad_type='".$_SESSION['ad_type']."' ORDER BY ser_date");
											
												$count = 0;
												$total = 0 ;
												$total_cost = 0 ;
												while ($p = mysqli_fetch_array($q)) {
												 $count +=1;

												 $price_ex = "SELECT SUM(ser_p_price) AS price_ext, SUM(ser_p_cost) AS cost_ext FROM tbl_service_exten WHERE ser_order ='".$p['ser_order']."' AND ad_type='".$_SESSION['ad_type']."'";
												 $q2= mysqli_query($config,$price_ex);
												 $f = mysqli_fetch_array($q2);

												 $total = ($total+$p["ser_p_price"])+$f['price_ext'];
												  $total_cost = ($total_cost+$p["ser_p_cost"])+$f['cost_ext'];
											?>
											<tbody>
										<tr>
											<td style="text-align:center;width: 1px;">
												<?=$count;?>
											</td>
											<td>
												<?=$p["ser_date"];?>
											</td>
											<td>
												<?=$p["ser_order"];?>
											</td>
											<td>
												<?=$p["ser_idcar"];?>
											</td>
										
											<td>
												<?php echo ($p["ser_p_cost"]+$f['cost_ext']);?>
											</td>
											<td>
												<?php echo ($p["ser_p_price"]+$f['price_ext']);?>
											</td>
											<td style="text-align:center; white-space:nowrap;">
												 
												<a href="receipt.php?ser_id=<?=$p["ser_id"];?>" class="btn btn-xs btn-warning" title="Print Invoice" target="_blank"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
											</td>
										</tr>
									</tbody>
									<tbody>
										<tr >
											<td >

											</td>
											<td>
												
											</td>
											<td colspan="2">
												<?php echo $p["ser_parts"] ?>
											</td>
											<td>
												
											</td>
											<td>
												<?php echo $p["ser_p_price"] ?>
											</td>
											<td>
												
											</td>

										</tr>
										</tbody>
										<?php
											 $price_ex2 = "SELECT * FROM tbl_service_exten WHERE ser_order ='".$p['ser_order']."'";
												 $q3= mysqli_query($config,$price_ex2);
											while ($f2 = mysqli_fetch_array($q3)) {
												?>
												<tbody>
										<tr>
											<td>
											</td>
											<td>
												
											</td>
											<td colspan="2">
												<?php echo $f2["ser_parts"] ?>
											</td>
											<td>
												
											</td>
											<td>
												<?php echo $f2["ser_p_price"] ?>
											</td>
											<td>
												
											</td>
										</tr>	 
											</tbody>
										<?php
											}
											}
											?>
								
									<tbody>
										<tr>
										<td colspan="4" align="center">รวมรายได้</td>
										<td ><?=$total_cost;?></td>
										<td ><?=$total;?></td>
										<td ></td>
										</tr>
									</tbody>
								</table>
							</div>
							</div>
						</div>
					</div>
			<!-- 	</div>
			</div> -->
			
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
            var row = $('#row-container .row:eq(0)').clone();
				$('#addButton').data('row',row);
				$('#addButton').click(function(){
				  $('#row-container').append($(this).data('row').clone());
				});
				$('#removeButton').click(function(){
				  $('#row-container .row').eq(  $('#row-container .row').length-1 ).remove();
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