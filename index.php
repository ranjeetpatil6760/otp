<!DOCTYPE html>
<html>
<head>
<title>How to Implement OTP SMS Mobile Verification in PHP with TextLocal</title>
<link href="style.css" type="text/css" rel="stylesheet" />
<style>
body{
	background-color: #87CEFA;
	font-family: calibri;
}

.tblLogin {
	border: #95bee6 1px solid;
    background: #d1e8ff;
    border-radius: 4px;
    max-width: 300px;
	padding:20px 30px 30px;
	text-align:center;
}
.tableheader { font-size: 20px; }
.tablerow { padding:20px; }
.error_message {
	color: #b12d2d;
    background: #ffb5b5;
    border: #c76969 1px solid;
}
.message {
	width: 100%;
    max-width: 300px;
    padding: 10px 30px;
    border-radius: 4px;
    margin-bottom: 5px;    
}
.login-input {
	border: #CCC 1px solid;
    padding: 10px 20px;
	border-radius:4px;
}
.btnSubmit {
	padding: 10px 20px;
    background: #2c7ac5;
    border: #d1e8ff 1px solid;
    color: #FFF;
	border-radius:4px;
}
</style>
</head>
<body>

	<div class="container">
		<div class="error"></div>
		<div class="row">
			<div class="col-md-9 col-md-offset-2">

				<?php
				if(isset($_POST['sendotp'])){
                      require('textlocal.class.php');
                      require('credentials.php');
                    $mobile_number = $_POST['mobile'];
                     $textlocal = new Textlocal(false,false,API_KEY);

                     $numbers = array($mobile_number);
					$sender = 'TXTLCL';
					$otp = mt_rand(10000,99999);
					$message = "Hello Client This is your OTP:".$otp;

				try {
                     $result = $textlocal->sendSms($numbers, $message, $sender);
                     setcookie('otp',$otp);
                     echo "Otp successfully send";
                     } catch (Exception $e) {
                     die('Error: ' . $e->getMessage());
                       }
                   }
                  

                   if (isset($_POST['verifyotp'])) {
                   	$otp = $_POST['otp'];
                   	if ($_COOKIE['otp'] == $otp) {
                   		echo "Congratulations Your Mobile Verified...";
                   	}else
                   	{
                   		echo "Please Enter Correct otp";
                   	}
                   }
                     ?>
		</div>
		<div class="tblLogin">
		<div>
		<form role="form" method="post" id="frm-mobile-verification">
			<div class="form-heading"><h3 style="color:	#DC143C;">Mobile Number Verification</h3></div>

			<div class="form-row">
			<div class="tablerow">	<input type="number" name="mobile" id="mobile" class="login-input"
					placeholder="Enter the 10 digit mobile"></div>
			</div>

			<div class="tableheader"><input type="submit" name="sendotp" class="btnSubmit" value="Send OTP"></div>
		</form>
</div>
		<form method="post" action="">
			<div class="row">
				<div class="col-sm-9 form-group">
					
					<div class="tablerow"><input type="text" class="login-input" id="otp" name="otp" placeholder="Enter Your OTP" maxlength="5" required=""></div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-9 form-group">
						<div class="tableheader"><input type="submit" name="verifyotp" class="btnSubmit" value="Verify"></div>
						
					</div>
					
				</div>
		</form>
	</div>
</div>

	
</body>
</html>