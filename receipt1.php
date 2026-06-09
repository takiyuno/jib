<?php 
	include("config.php"); 
	include("js/baht_text.php"); 
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
		<title>Receipt</title>

    	<script src="js/jquery.js"></script>
		<script src="js/moment.js"></script>
		 <script src="js/bootstrap.js"></script>
   		<link href="js/jquery-ui/jquery-ui.min.css" rel="stylesheet" >
		<link href='css/style.css' rel='stylesheet' type='text/css'>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="js/yearpicker.css">
		<style type="text/css" class="init">
		</style>
		<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">

		<style type="text/css">
			

				.padding {
				    padding: 2rem !important
				}

				.card {
				    margin-bottom: 30px;
				    border: none;
				    -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
				    -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
				    box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
				}

				.card-header {
				    background-color: #fff;
				    border-bottom: 1px solid #e6e6f2
				}

				h3 {
				    font-size: 20px
				}

				h5 {
				    font-size: 15px;
				    line-height: 26px;
				    color: #3d405c;
				    margin: 0px 0px 15px 0px;
				    font-family: 'Circular Std Medium'
				}

				.text-dark {
				    color: #3d405c !important
				}

		</style>

		
	</head>
	<body onload="window.print();">
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
			
		<div id="">
			
			<?php
				if(isset($_GET["ser_id"])){
						$chk_edit = 1;
						$e = mysqli_fetch_array(mysqli_query($config,"SELECT * FROM tbl_service WHERE ser_id = '".$_GET["ser_id"]."' "));
				}else{
						$chk_edit = 0;
				}

					  		$s_cus = "SELECT * FROM tbl_cardetail WHERE car_regis='".$e['ser_idcar']."'";
					  		$q_cus = mysqli_query($config,$s_cus);
					  		$cus_rs = mysqli_fetch_array($q_cus);
					  	?>
<!-- <div id="printableArea" style="display: block;"> -->				
<div class="col-md-6">
     <div class="card">
         <div class="card-header p-4">
         	<div class="row col-sm-12">
             <div class="pull-right">
                 <h3 class="mb-0">เลขที่บริการ <?php echo $e['ser_order'];?><br/>
                 วันที่บริการ: <?php echo date("d/m/Y", strtotime($e['ser_date']));  ?></h3>
             </div>
         </div>
         </div>
         <div class="card-body">
           
                 <div class="col-sm-6">
                     <h5 class="mb-3">ร้าน:</h5>
                     <h3 class="text-dark mb-1">ฉู้น กลอนประตูรถยนต์ กระจกไฟฟ้า ภูเก็ต<br/>
                     		Locks &amp; Windows Car Phuket<br/>
                     		โทร. 094 990 6999

                     </h3>
                     
                 </div>
                 <div class="col-sm-6 ">
                     <h5 class="mb-3">ลูกค้า:</h5>
                     <h3 class="text-dark mb-1">
                     	<?php echo $cus_rs['car_customer']." <br/> Tel.".$cus_rs['car_tel']."<br/>   เลขทะเบียน ".$cus_rs['car_regis'];?>
                     </h3>
                 </div>
            
             <div class="table-responsive-sm">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th><div align="left">ลำดับ</div></th>
                             <th><div align="left">รายการ</div></th>
                             <th><div align="right">จำนวนเงิน</div></th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td ><div align="left">1</div></td>
                             <td ><div align="left"><?php echo $e['ser_parts'];?></div></td>
                             <td ><div align="right"><?php echo number_format($e['ser_p_price'],2);?></div></td>
                         </tr>
                          <?php 

					  		$total = 0;
					  		$price1 = $e['ser_p_price'];

					  		$i=1;
					  		$ex_ser = "SELECT * FROM tbl_service_exten WHERE ser_order = '".$e['ser_order']."'";
					  		$ex_query = mysqli_query($config,$ex_ser);
					  		while ($ex_rs= mysqli_fetch_array($ex_query)) {
					  			
					  		$i++;
					  		
					  ?>
                         <tr>
                             <td><div align="left"><?php echo $i;?></div></td>
                             <td><div align="left"><?php echo $ex_rs['ser_parts'];?></div></td>
                             <td ><div align="right"><?php echo number_format($ex_rs['ser_p_price'],2);?></div></td>
                         </tr>
                     <?php 
                     	$total = $total+$ex_rs['ser_p_price'];
                 		}
                 		?>
                 		 <tr>
                             <td class="center"></td>
                             <td class="left"></td>
                             <td class="right"></td>
                         </tr>
                          <tr>
                             <td class="center"></td>
                             <td class="left"><?php echo $e['ser_detail'];?></td>
                             <td class="right"></td>
                         </tr>
                          <tr>
                             <td class="center">รวมเงิน</td>
                             <td ><div align="center"><?php echo baht_text(($total+$price1));?></div></td>
                             <td ><div align="right"><?php echo number_format(($total+$price1),2);?></div></td>
                         </tr>
                     </tbody>
                 </table>
             </div>
             
         </div>
      
         <div class="row" style="margin-top:60px;"> 
	         <div class="text-center col-md-6 ">
	         	<div class="form-group">
	         	<p>____________________________</p>
	             <p >ลูกค้า</p>
	         </div>
	         </div>
	       
	         <div class="text-center col-md-6 ">
	         	<div class="form-group">
	         	<p>____________________________</p>
	             <p > ผู้รับเงิน</p>
	         </div>
	         </div>  
	     </div>
            
     </div>
 
 <br/><br/>

  		<div class="row ">
			 <div class="col-md-12">         	
             	<?php 

 						$pic = explode(",", $e['ser_pic']);

 						for($i=0;$i<count($pic);$i++){
 						if($pic[$i]!=""){
 				?>
 				 <div class="col-md-4 show_pic text-center" id="<?php echo "pop_".$i;?>">
 					<img src="<?php echo "img/".$cus_rs['car_id']."/service/".$pic[$i];?>" id="<?php echo "imageresource_".$i;?>"  width="60%">
 				</div>

 				

 				<?php
 					}
 						}
             	?>
             	</div>
             </div>
             </div>
             	<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				        <h4 class="modal-title" id="myModalLabel">Image preview</h4>
				      </div>
				      <div class="modal-body">
				        <img src="" id="imagepreview"  >
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>
				  </div>
				</div>
			
             
<!-- </div>
 -->



			<!-- <div id="page-content-wrapper">
				<div class="container-fluid">
					<div id="printableArea">
					<tbody>
					<table width="703" height="580" border="1">
					  <tr>
					    <td height="87" colspan="3"><p><strong>ฉู้น กลอนประตูรถยนต์ กระจกไฟฟ้า ภูเก็ต</strong><br/>
					   <strong>Locks &amp; Windows Car Phuket</strong><br/> <strong>โทร. 094 990 6999</strong></p></td>
					    <td width="165"><p><strong>เลขที่บริการ</strong> <?php echo $e['ser_order'];?></p>
					    <p><strong>วันที่ </strong><?php echo date("d-m-Y");  ?></p></td>
					  </tr>
					  <tr>
					  	<?php
					  		$s_cus = "SELECT * FROM tbl_cardetail WHERE car_regis='".$e['ser_idcar']."'";
					  		$q_cus = mysqli_query($config,$s_cus);
					  		$cus_rs = mysqli_fetch_array($q_cus);
					  	?>
					    <td colspan="4"><strong>ชื่อ &nbsp; <?php echo $cus_rs['car_customer']."  Tel.".$cus_rs['car_tel']."   เลขทะเบียน ".$cus_rs['car_regis'];?> </strong></td>
					  </tr> 
					  <tr>
					    <td width="66"><div align="center"><strong>ลำดับที่</strong></div></td>
					    <td colspan="2"><div align="center"><strong>รายการ</strong></div>      <div align="center"></div></td>
					    <td><div align="center"><strong>จำนวนเงิน</strong></div></td>
					  </tr>
					  <tr>
					    <td><div align="center">1</div></td>
					    <td colspan="2"><?php echo $e['ser_parts'];?></td>
					    <td><div align="right"><?php echo number_format($e['ser_p_price'],2);?></div></td>
					  </tr>
					  <?php 

					  		$total = 0;
					  		$price1 = $e['ser_p_price'];

					  		$i=1;
					  		$ex_ser = "SELECT * FROM tbl_service_exten WHERE ser_order = '".$e['ser_order']."'";
					  		$ex_query = mysqli_query($config,$ex_ser);
					  		while ($ex_rs= mysqli_fetch_array($ex_query)) {
					  			# code...
					  		$i++;
					  		
					  ?>
					   <tr>
					    <td><div align="center"><?=$i;?></div></td>
					    <td colspan="2"><?php echo $ex_rs['ser_parts'];?></td>
					    <td><div align="right"><?php echo number_format($ex_rs['ser_p_price'],2);?></div></td>
					  </tr>
						<?
							$total = $total+$ex_rs['ser_p_price'];
						 }?>
					  <tr>
					    <td>&nbsp;</td>
					    <td colspan="2">&nbsp;</td>
					    <td>&nbsp;</td>
					  </tr>
					  <tr>
					    <td>&nbsp;</td>
					    <td colspan="2">&nbsp;</td>
					    <td>&nbsp;</td>
					  </tr>
					  <tr>
					   <td>&nbsp;</td>
					    <td colspan="2"><?php echo $e["ser_detail"];?></td>
					    <td>&nbsp;</td>
					  </tr>
					  <tr>
					    <td>&nbsp;</td>
					    <td colspan="2">&nbsp;</td>
					    <td>&nbsp;</td>
					  </tr>
					  <tr>
					    <td>&nbsp;</td>
					    <td colspan="2">&nbsp;</td>
					    <td>&nbsp;</td>
					  </tr>
					  <tr>
					    <td><div align="center">รวมเงิน</div></td>
					    <td colspan="2"><div align="center"><?php echo baht_text(($total+$price1));?></div></td>
					    <td><div align="right"><?php echo number_format(($total+$price1),2);?></div></td>
					  </tr>
					  <tr>
					    <td>&nbsp;</td>
					    <td colspan="2">&nbsp;</td>
					    <td>&nbsp;</td>
					  </tr>
					  <tr>
					    <td>&nbsp;</td>
					    <td colspan="2"><div align="center"><strong>ผู้รับเงิน</strong></div></td>
					    <td>&nbsp;</td>
					  </tr>
					</table>
					</tbody>	
				</div> -->
				<br/>
				<div class="col-md-8 ">
					<button style="font-size:24px"  onclick="printDiv('printableArea')">
						Print <i class="glyphicon glyphicon-print"></i>
					</button>
				</div>
				</div>
			</div>
			<!-- /#page-content-wrapper -->
		</div>
		<!-- /#wrapper -->
		

		<!-- <script src="ckeditor/ckeditor.js"></script>  
		<script src="ckfinder/ckfinder.js"></script> 
		<script src="js/autocomplete.js"></script> -->
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>

		<script type="text/javascript">
			function printDiv(divName) {
			     var printContents = document.getElementById(divName).innerHTML;
			     var originalContents = document.body.innerHTML;

			     document.body.innerHTML = printContents;

			     window.print();

			     document.body.innerHTML = originalContents;
			}
			$(".show_pic").on("click", function() {

				var id = this.id;
                    var split_id = id.split('_');
                    var num = split_id[1];
                   
			   $('#imagepreview').attr('src', $('#imageresource_'+num).attr('src')); // here asign the image to the modal when the user click the enlarge link
			   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
			});
		</script>
		       
	</body>
</html>