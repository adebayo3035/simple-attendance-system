<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="icon" type="image/x-icon" href="../resources/images/logo-colored.png">
    <title>Admin Login Page</title>
</head>
<body>
<?php //include('header.php'); ?>
    <section class="container">
    
        <header>ADMIN LOGIN</header>
            <form method="post" action="login.php" autocomplete="off"> 
                <div class="input-group">
                    <input type="text" name="username" placeholder="Enter Username" required autocomplete="off">
                </div>
                
                <div class="input-group">
                    <input type="password" name="password" placeholder="Enter Password"required autocomplete="off">
                </div>

                <button type="submit" name="login" id="submitBtn">Login</button>
            </form>
            
    </section>
    
    <!-- validation and insertion -->


                <?php
                        session_start();
						include('../config.php');
						if(isset($_POST['login'])){
                            $username = mysqli_real_escape_string($conn, $_POST['username']);
                            $password = (mysqli_real_escape_string($conn, $_POST['password']));

						$sql = "SELECT * FROM admin_tbl WHERE admin_username='$username' AND admin_password = '$password'  ";
                        $result = $conn->query($sql) or die($conn->error);
                        $fetch = mysqli_fetch_array($result);	
             		    if ($result->num_rows > 0) {
                            $_SESSION["admin_email"] = $fetch['admin_email'];
                            $_SESSION['userLogin'] = "Loggedin";
                            $_SESSION["login_time_stamp"] = time();
                              echo "<script>location.replace('login_success.php');</script>";
                              echo " <noscript>
                              Your browser does not support JavaScript!
                           </noscript>";
			             }
						else{
							echo "<script>location.replace('login_fail.php');</script>";
							
                        }
                        $conn->close();
					}
				?> 



	<!-- validation and insertion End-->
</body>
</html>