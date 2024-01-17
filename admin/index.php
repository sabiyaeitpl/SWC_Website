<?php
require('database/connection.inc.php');
require('database/function.inc.php');

$msg='';
if(isset($_POST['submit'])){
    //prx($_POST);
	$email=get_safe_value($con,$_POST['email']);
	$password=get_safe_value($con,$_POST['password']);
	$sql="select * from admin_users where email='$email' and password='$password' and status=1";
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	if($count>0){
		$_SESSION['ADMIN_LOGIN']='yes';
		$_SESSION['ADMIN_USERNAME']=$email;
        header('location:dashboard.php');
	    }else{
		$msg="Please enter correct login details";	
	}
	
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SWCW Admin</title>
    <!-- <link rel="icon" type="image/x-icon" href="logos/creative-rm-bg.png"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="font/iconsmind-s/css/iconsminds.css" />
    <link rel="stylesheet" href="font/simple-line-icons/css/simple-line-icons.css" />

    <link rel="stylesheet" href="css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap.rtl.only.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap-float-label.min.css" />
    <link rel="stylesheet" href="css/main.css" />
</head>

<body class="background show-spinner no-footer">
    <!-- <div class="fixed-background"></div> -->
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side ">

                            <p class=" text-white h2">MAGIC IS IN THE DETAILS</p>

                            <p class="white mb-0">
                                Please use your credentials to login.
                                <br>If you are not a member, please
                                <a href="#" class="white">register</a>.
                            </p>
                        </div>
                        <div class="form-side">
                            <a href="/">
                                <!-- <img src="logos/creative-rm-bg-rs.png" alt="creative logo" style="margin-bottom: 40px;"> -->
                                <!-- <span class="logo-single"></span> -->
                            </a>
                            <!-- <h6 class="mb-4">Login</h6> -->
                            <form method="post"> 
                                <label class="form-group has-float-label mb-4">
                                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                                    <span>Email</span>
                                </label>

                                <label class="form-group has-float-label mb-4">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    <span>Password</span>
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="#">Forget password?</a>
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-shadow">LOGIN</button>
                                </div>
                                <div class="field_error"><?php echo $msg?></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/vendor/jquery-3.3.1.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
    <script src="js/dore.script.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>