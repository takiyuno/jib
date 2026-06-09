<?php
	include("config.php");
	if(isset($_SESSION["login"]) == true){
		header("Location: service.php");
    }
?>
<?php
	if(isset($_POST["submit"])){

	$q = mysqli_query($config,"SELECT * FROM `member` WHERE username='".$_POST['username']."' AND password='".$_POST['password']."' ");
	$n = mysqli_num_rows($q);

		if($n>0){
			$db = mysqli_fetch_array($q);
			$_SESSION['login'] = $db["mem_id"];
			$_SESSION['ad_type'] = $db["type"];
			header("Location: service.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="th">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>เข้าสู่ระบบ — MotorFix</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap');

		* { box-sizing: border-box; }
		body {
			font-family: 'Sarabun', sans-serif;
			margin: 0; padding: 0;
			min-height: 100vh;
			background: #0f172a;
			display: flex;
			align-items: stretch;
		}

		/* Left panel */
		.login-left {
			flex: 1;
			background: linear-gradient(160deg, #1e3a5f 0%, #0f172a 60%, #1e293b 100%);
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			padding: 60px 40px;
			position: relative;
			overflow: hidden;
		}
		.login-left::before {
			content: '';
			position: absolute;
			width: 500px; height: 500px;
			background: radial-gradient(circle, rgba(37,99,235,.18) 0%, transparent 70%);
			top: -100px; left: -100px;
		}
		.login-left::after {
			content: '';
			position: absolute;
			width: 400px; height: 400px;
			background: radial-gradient(circle, rgba(245,158,11,.10) 0%, transparent 70%);
			bottom: -80px; right: -80px;
		}
		.login-left-inner { position: relative; z-index: 1; text-align: center; max-width: 380px; }
		.brand-icon {
			width: 80px; height: 80px;
			background: linear-gradient(135deg, #2563eb, #1d4ed8);
			border-radius: 20px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			margin-bottom: 28px;
			box-shadow: 0 10px 40px rgba(37,99,235,.4);
		}
		.brand-icon img { width: 48px; filter: brightness(0) invert(1); }
		.login-left h1 {
			color: #fff;
			font-size: 30px;
			font-weight: 800;
			margin: 0 0 10px;
			letter-spacing: -.3px;
		}
		.login-left p {
			color: rgba(255,255,255,.5);
			font-size: 15px;
			margin: 0;
			line-height: 1.6;
		}
		.feature-list {
			margin-top: 48px;
			text-align: left;
			width: 100%;
		}
		.feature-item {
			display: flex;
			align-items: center;
			gap: 14px;
			padding: 12px 0;
			border-bottom: 1px solid rgba(255,255,255,.06);
		}
		.feature-item:last-child { border-bottom: none; }
		.feature-dot {
			width: 36px; height: 36px; flex-shrink: 0;
			background: rgba(37,99,235,.2);
			border-radius: 8px;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.feature-dot .glyphicon { color: #60a5fa; font-size: 15px; }
		.feature-item span {
			color: rgba(255,255,255,.7);
			font-size: 14px;
		}

		/* Right panel / form */
		.login-right {
			width: 440px;
			background: #f8fafc;
			display: flex;
			flex-direction: column;
			justify-content: center;
			padding: 60px 50px;
		}
		.login-right h2 {
			font-size: 24px;
			font-weight: 800;
			color: #0f172a;
			margin: 0 0 6px;
		}
		.login-right .subtitle {
			color: #64748b;
			font-size: 14px;
			margin: 0 0 36px;
		}
		.form-label {
			font-size: 12px;
			font-weight: 700;
			color: #475569;
			letter-spacing: .6px;
			text-transform: uppercase;
			margin-bottom: 6px;
			display: block;
		}
		.input-wrap { position: relative; }
		.input-wrap .icon {
			position: absolute;
			top: 50%; left: 13px;
			transform: translateY(-50%);
			color: #94a3b8;
			font-size: 14px;
		}
		.input-wrap input {
			width: 100%;
			height: 46px;
			border: 1.5px solid #e2e8f0;
			border-radius: 9px;
			padding: 0 14px 0 38px;
			font-family: 'Sarabun', sans-serif;
			font-size: 15px;
			color: #1e293b;
			background: #fff;
			outline: none;
			transition: border-color .18s, box-shadow .18s;
		}
		.input-wrap input:focus {
			border-color: #2563eb;
			box-shadow: 0 0 0 3px rgba(37,99,235,.12);
		}
		.input-wrap input::placeholder { color: #cbd5e1; }
		.form-field { margin-bottom: 20px; }
		.btn-signin {
			width: 100%;
			height: 46px;
			background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
			color: #fff;
			border: none;
			border-radius: 9px;
			font-family: 'Sarabun', sans-serif;
			font-size: 15px;
			font-weight: 700;
			cursor: pointer;
			letter-spacing: .3px;
			margin-top: 8px;
			transition: opacity .18s, box-shadow .18s, transform .18s;
		}
		.btn-signin:hover {
			opacity: .92;
			box-shadow: 0 6px 24px rgba(37,99,235,.38);
			transform: translateY(-1px);
		}
		.login-footer {
			margin-top: auto;
			padding-top: 40px;
			color: #94a3b8;
			font-size: 12px;
			text-align: center;
		}

		@media (max-width: 768px) {
			body { flex-direction: column; }
			.login-left { padding: 40px 24px; min-height: 220px; }
			.feature-list { display: none; }
			.login-right { width: 100%; padding: 36px 24px; }
		}
	</style>
</head>
<body>

	<!-- Left branding panel -->
	<div class="login-left">
		<div class="login-left-inner">
			<div class="brand-icon">
				<img src="images/wrench.png" alt="logo">
			</div>
			<h1>MotorFix</h1>
			<p>ระบบจัดการศูนย์บริการ<br>กลอนประตูรถยนต์ ภูเก็ต</p>

			<div class="feature-list">
				<div class="feature-item">
					<div class="feature-dot"><span class="glyphicon glyphicon-wrench"></span></div>
					<span>บันทึกรายการซ่อม-อะไหล่</span>
				</div>
				<div class="feature-item">
					<div class="feature-dot"><span class="glyphicon glyphicon-print"></span></div>
					<span>ออกใบเสร็จรับเงิน</span>
				</div>
				<div class="feature-item">
					<div class="feature-dot"><span class="glyphicon glyphicon-stats"></span></div>
					<span>รายงานรายได้ตามช่วงวันที่</span>
				</div>
				<div class="feature-item">
					<div class="feature-dot"><span class="glyphicon glyphicon-camera"></span></div>
					<span>บันทึกภาพงานซ่อม</span>
				</div>
			</div>
		</div>
	</div>

	<!-- Right login form -->
	<div class="login-right">
		<h2>ยินดีต้อนรับ</h2>
		<p class="subtitle">กรุณาเข้าสู่ระบบเพื่อดำเนินการต่อ</p>

		<form method="POST">
			<div class="form-field">
				<label class="form-label">ชื่อผู้ใช้</label>
				<div class="input-wrap">
					<span class="icon glyphicon glyphicon-user"></span>
					<input type="text" name="username" placeholder="Username" autocomplete="off">
				</div>
			</div>
			<div class="form-field">
				<label class="form-label">รหัสผ่าน</label>
				<div class="input-wrap">
					<span class="icon glyphicon glyphicon-lock"></span>
					<input type="password" name="password" placeholder="Password">
				</div>
			</div>
			<button type="submit" name="submit" class="btn-signin">
				เข้าสู่ระบบ &nbsp;→
			</button>
		</form>

		<div class="login-footer">© 2024 ฉู้น กลอนประตูรถยนต์ กระจกไฟฟ้า ภูเก็ต</div>
	</div>

</body>
</html>
