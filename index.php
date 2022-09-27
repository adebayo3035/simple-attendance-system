<?php
session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location:admin/login.php");
    die();
}
?>
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
    <link rel="stylesheet" href="css/register.css">
    <title>User Registration Form</title>
</head>
<body>
<?php include('header.php'); ?>
    <section class="container">
    
        <header> CREATE ACCOUNT</header>
            <form method="post" action="index.php"> 
                <div class="input-group">
                    <input type="text" name="lastname" placeholder="Last Name" required>
                </div>
                
                <div class="input-group">
                    <input type="text" name="firstname" placeholder="First Name" required>
                </div>

                 <div class="input-group">
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>
                
                <div class="input-group">
                    <input type="text" name="position" placeholder="Your Position" required>
                </div>
               


                <button type="submit" name="register" id="submitBtn">Register</button>
            </form>
        
    </section>
    
    <!-- validation and insertion -->


				<?php
						include('config.php');
						if(isset($_POST['register'])){

						$sql1 = "SELECT * FROM employee_tbl WHERE emp_email='".$_POST["email"]."' ";
             		    $result = $conn->query($sql1);	
             		    if ($result->num_rows > 0) {
			                  echo "<script>alert('Sorry, user already exist!');</script>";
			             }
						else{
							$sql = "INSERT INTO employee_tbl (emp_firstname, emp_lastname, emp_email, emp_position)
							VALUES ('" . $_POST["firstname"] . "','" . $_POST["lastname"] . "','" . $_POST["email"] ."','" . $_POST["position"] . "' )";

							if ($conn->query($sql) === TRUE) {
							    echo "<script>location.replace('staff_reg_success_msg.php');</script>";
							} else {
							    echo "<script>alert('There was an Error')</script>" . $sql . "<br>" . $conn->error;
							}

							$conn->close();
						}
					}
				?> 



	<!-- validation and insertion End-->
</body>
</html>