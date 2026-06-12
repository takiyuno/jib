<?php 
	include("config.php"); 
	include("js/baht_text.php"); 
		 if(isset($_SESSION["login"]) != true){
				 die();
		 }
			
	?>
<!DOCTYPE html>
<!-- saved from url=(0069)https://adminlte.io/themes/AdminLTE/pages/examples/invoice-print.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Receipt</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


  <script src="js/jquery.js"></script>
		<script src="js/moment.js"></script>
		 <script src="js/bootstrap.js"></script>
   		<link href="js/jquery-ui/jquery-ui.min.css" rel="stylesheet" >
		<link href='css/style.css' rel='stylesheet' type='text/css'>
		
  <!-- Font Awesome --><!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
		<link rel="stylesheet" href="js/yearpicker.css">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
 <!--  <link rel="stylesheet" href="css/font-awesome.min.css"> -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <style>
    @media print {
      .no-print { display: none !important; }
    }
  </style>

</head>
<body>
<nav class="navbar navbar-inverse no-print">
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

<div class="wrapper">
  <div class="no-print" style="padding:10px 20px;">
    <button class="btn btn-primary" onclick="window.print();">
      <span class="glyphicon glyphicon-print"></span> Print Invoice
    </button>
    <a href="report.php" class="btn btn-default" style="margin-left:8px;">
      <span class="glyphicon glyphicon-arrow-left"></span> กลับ
    </a>
  </div>
  <!-- Main content -->
  <section class="invoice">
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
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> ฉู้น กลอนประตูรถยนต์ กระจกไฟฟ้า ภูเก็ต
          <small class="pull-right">Date: <?php echo date('d-M-Y');?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        ร้าน:
        <address>
          <strong>ฉู้น กลอนประตูรถยนต์ กระจกไฟฟ้า ภูเก็ต</strong><br>

          60/23 ถ.แม่หลวน ซ.สุขสันติ<br>
           ต.ตลาดเหนือ อ.เมือง จ.ภูเก็ต<br>
            83000<br>
          โทร. 094 990 6999
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        ลูกค้า:
        <address>
          <strong> <?php echo $cus_rs['car_customer'] ;?></strong><br>
         <?php echo "  Tel.".$cus_rs['car_tel']."<br/>   เลขทะเบียน ".$cus_rs['car_regis'];?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>เลขที่บริการ : </b> <?php echo $e['ser_order'];?><br>
        <br>
        <b> วันที่บริการ: </b><?php echo date("d/m/Y", strtotime($e['ser_date']));  ?><br>
        
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>ลำดับ</th>
            <th>รายการ</th>
            <th>จำนวนเงิน</th>
          </tr>
          </thead>
          <tbody>
           <tr>
                <td >1</td>
                <td ><?php echo $e['ser_parts'];?></td>
                <td ><?php echo number_format($e['ser_p_price'],2);?></td>
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
                             <td><?php echo $i;?></td>
                             <td><?php echo $ex_rs['ser_parts'];?></td>
                             <td ><?php echo number_format($ex_rs['ser_p_price'],2);?></td>
                         </tr>
                     <?php 
                     	$total = $total+$ex_rs['ser_p_price'];
                 		}
                 		?>
             <tr>
                <td class="center"></td>
                <td class="left"><?php echo $e['ser_detail'];?></td>
                <td class="right"></td>
            </tr>
            <tr>
                <td class="center">รวมเงิน</td>
                <td ><?php echo baht_text(($total+$price1));?></td>
                <td ><?php echo number_format(($total+$price1),2);?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <!-- accepted payments column -->
	      <div class="col-xs-6">
	      	<br/>
	      	<br/>
	      	<br/>
	      	<br/>
	       <p class="text-center">____________________________</p>
	             <p class="text-center" >ลูกค้า</p>
	    </div>
	     <div class="col-xs-6">
	       <br/>
	      	<br/>
	      	<br/>
	      	<br/>
	       <p class="text-center">____________________________</p>
	             <p class="text-center" >ผู้รับเงิน</p>
	    </div>
	</div>

    <div class="row">
   
      <div class="col-xs-12">
        <?php

 						$pic = explode(",", $e['ser_pic']);

 						for($i=0;$i<count($pic);$i++){
           if($pic[$i]!=""){
           	?>
         <span class="show_pic" id="<?php echo "pop_".$i;?>">
        <img src="<?php echo "img/".$cus_rs['car_id']."/service/".$pic[$i];?>" id="<?php echo "imageresource_".$i;?>" width="20%" >
        </span>
 				<?php
 					}
 						}
             	?>

        
      </div>
      <!-- /.col -->
   
      <!-- /.col -->
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
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<script type="text/javascript">
			
			$(".show_pic").on("click", function() {

				var id = this.id;
                    var split_id = id.split('_');
                    var num = split_id[1];
                   
			   $('#imagepreview').attr('src', $('#imageresource_'+num).attr('src')); // here asign the image to the modal when the user click the enlarge link
			   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
			});
		</script>

</body></html>