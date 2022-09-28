
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
    <title>Admin Registration Form</title>
</head>
<body>
<?php include('admin-header.php'); ?>
    <section class="container">
    
        <header> CREATE NEW ADMIN</header>
            <form method="post" action="create_admin.php"> 
                <div class="input-group">
                    <input type="email" name="admin_email" placeholder="E-mail Address" required>
                </div>
                
                <div class="input-group">
                    <input type="text" name="admin_username" placeholder="Enter Username" required>
                </div>

                 <div class="input-group">
                    <input type="password" name="admin_password" placeholder="Enter Strong Password" required>
                </div>
                
            
                <button type="submit" name="create_admin" id="submitBtn">Register</button>
            </form>

        
    </section>
    
    <!-- validation and insertion -->


				<?php
						include('../config.php');
						if(isset($_POST['create_admin'])){
                            $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
                            $admin_username = mysqli_real_escape_string($conn, $_POST['admin_username']);
                            $admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']);
                            $admin_password1 = md5($admin_password);

						    $sql = "SELECT * FROM admin_tbl WHERE admin_email='$admin_email' OR admin_username='$admin_username' ";
             		        $result = $conn->query($sql);	
             		        if ($result->num_rows == 0) {
                                $sql1 = "SELECT emp_email FROM employee_tbl WHERE emp_email='$admin_email' ";
                                $results = $conn->query($sql1);
                                    if ($results->num_rows > 0) {
                                        $Insert_sql = "INSERT INTO admin_tbl (admin_email, admin_username, admin_password)
                                        VALUES ('$admin_email','$admin_username','$admin_password1' )";
    
                                            if ($conn->query($Insert_sql) === TRUE) {
                                                echo "<script>location.replace('../staff_reg_success_msg.php');</script>";
                                            } else {
                                                echo "<script>alert('There was an Error')</script>" . $Insert_sql . "<br>" . $conn->error;
                                            }

			        
			                        }
						            else{
                                        echo "<script>alert('Sorry, This User is not a Registered Employee!');</script>";
                                    }
                                
                            }
                            else{
                                echo "<script>alert('Sorry, Admin already Exist, Please Check Your Email and Username!');</script>";
                            }
					    }
				    ?> 



	<!-- validation and insertion End-->
</body>
</html>