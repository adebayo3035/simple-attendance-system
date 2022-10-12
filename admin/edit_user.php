<?php
	include('../config.php');
	$id=$_GET['id'];
	$query=mysqli_query($conn,"select * from `employee_tbl` where emp_id='$id'");
	$row=mysqli_fetch_array($query);
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
    <link rel="stylesheet" href="../css/register.css">
    <!-- <link rel="stylesheet" href="../css/header.css"> -->
    <link rel="icon" type="image/x-icon" href="../resources/images/logo-colored.png">
    <title>Edit and Update User Information</title>
</head>
<body>
<?php include('admin-header.php'); ?>
    <section class="container">
    
        <header> EDIT USER DATA</header>
            <form method="post" action="edit_user.php?id=<?php echo $id; ?>"> 
                <div class="input-group">
                    <input type="text" name="lastname" placeholder="Last Name" required value="<?php echo $row['emp_lastname']; ?>">
                </div>
                
                <div class="input-group">
                    <input type="text" name="firstname" placeholder="First Name" required value="<?php echo $row['emp_firstname']; ?>">
                </div>

                 <div class="input-group">
                    <input type="email" name="email" placeholder="Email Address" required value="<?php echo $row['emp_email']; ?>">
                </div>
                
                <div class="input-group">
                    <input type="text" name="position" placeholder="Your Position" required value="<?php echo $row['emp_position']; ?>">
                </div>
                
            
                <button type="submit" name="update_employee" id="submitBtn">Update</button>
            </form>

        
    </section>
    
    <!-- validation and insertion -->


				<?php
                        include('../config.php');
                        
						if(isset($_POST['update_employee'])){
                            $id=$_GET['id'];
                            $emp_lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
                            $emp_firstname= mysqli_real_escape_string($conn, $_POST['firstname']);
                            $emp_email = mysqli_real_escape_string($conn, $_POST['email']);
                            $emp_position = mysqli_real_escape_string($conn, $_POST['position']);
                            

						    $sql = "SELECT * FROM employee_tbl WHERE emp_id != '$id'AND emp_email='$emp_email'";
             		        $result = $conn->query($sql);	
             		        if ($result->num_rows == 0) {
                                        $Update_sql = "UPDATE employee_tbl SET emp_firstname = '$emp_firstname', emp_lastname = '$emp_lastname', emp_email ='$emp_email', emp_position = '$emp_position' WHERE emp_id = '$id'";
                                        if (mysqli_query($conn, $Update_sql)) {
                                             echo "<script>location.replace('update_success.php');</script>";
                                        } 
                                        else {
                                             echo "<script>alert('An Error Occur, Please Try Again') </script>" . $sql . "<br>" . mysqli_error($conn);
                                        }
                                
                            }
                            else{
                                echo "<script>alert('Sorry, Email Address already been Used by another User, please Try another email!');</script>";
                            }
					    }
				    ?> 



	<!-- validation and insertion End-->
</body>
</html>