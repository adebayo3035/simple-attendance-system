<?php
	include('../config.php');
	$id=$_GET['id'];
	$query=mysqli_query($conn,"select * from `admin_tbl` where id='$id'");
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
    <link rel="icon" type="image/x-icon" href="../resources/images/logo-colored.png">
    <title>Edit and Update Admin Information</title>
</head>
<body>
<?php include('admin-header.php'); ?>
    <section class="container">
    
        <header> EDIT ADMIN DATA</header>
            <form method="post" action="edit_admin.php?id=<?php echo $id; ?>"> 
                <div class="input-group">
                    <input type="email" name="admin_email" placeholder="E-mail Address" required value="<?php echo $row['admin_email']; ?>">
                </div>
                
                <div class="input-group">
                    <input type="text" name="admin_username" placeholder="Enter Username" required value="<?php echo $row['admin_username']; ?>">
                </div>

                 <div class="input-group">
                    <input type="password" name="admin_password" id="password" placeholder="Enter Strong Password" required value="<?php echo $row['admin_password']; ?>">
                    <i class="fa fa-eye" aria-hidden="true" id="togglePassword" class="togglePassword"></i>
                </div>
                
            
                <button type="submit" name="update_admin" id="submitBtn">Update</button>
            </form>

        
    </section>
    
    <!-- validation and insertion -->


				<?php
                        include('../config.php');
                        
						if(isset($_POST['update_admin'])){
                            $id=$_GET['id'];
                            $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
                            $admin_username = mysqli_real_escape_string($conn, $_POST['admin_username']);
                            $admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']);
                            $admin_password1 = ($admin_password); //this is suppose to be an encrypted password

						    $sql = "SELECT * FROM admin_tbl WHERE id != '$id'AND (admin_email='$admin_email' OR admin_username='$admin_username')";
             		        $result = $conn->query($sql);	
             		        if ($result->num_rows == 0) {
                                $sql1 = "SELECT emp_email FROM employee_tbl WHERE emp_email='$admin_email' ";
                                $results = $conn->query($sql1);
                                    if ($results->num_rows > 0) {
                                        $Update_sql = "UPDATE admin_tbl SET admin_email = '$admin_email' , admin_username ='$admin_username', admin_password = '$admin_password1' WHERE id = '$id'";
                                        if (mysqli_query($conn, $Update_sql)) {
                                             echo "<script>location.replace('update_success.php');</script>";
                                        } 
                                        else {
                                             echo "<script>alert('Error Clocking Employee Out') </script>" . $sql . "<br>" . mysqli_error($conn);
                                        }

			        
			                        }
						            else{
                                        echo "<script>alert('Sorry, This E-mail does not match with any Registered Employee!');</script>";
                                    }
                                
                            }
                            else{
                                echo "<script>alert('Sorry, Admin already Exist, Please Check Your Email and Username!');</script>";
                            }
					    }
				    ?> 



	<!-- validation and insertion End-->

    <!-- Toggle Password Visibility -->
<script>
    const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("icon-eye-close");
        });

        // prevent form submit
        const form = document.querySelector("form");
        form.addEventListener('submit', function (e) {
            e.preventDefault();
        });

</script>
</body>
</html>