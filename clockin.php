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
        
        <header> CLOCK IN</header>
        <form method="post" action ="clockin.php">
            <div class="input-group">
                <input type="text" name="attendance_date" id="date" readonly required="">

            </div>
            <div class="input-group">
                <input type="text" name="clockin_time"  id="time" readonly required="">
            </div>
            <div class="input-group">
                <input type="email" name="emp_email" id="email" placeholder="Enter Email Address" autocomplete ="off" required="">
            </div>

            <button type="submit" id="submitBtn" name="clockin">Clock IN</button>
        </form>
        

    </section>
    <script src="main.js"></script>

     <!-- validation and insertion -->


				<?php
						include('config.php');
						if(isset($_POST['clockin'])){
                            $emp_email = mysqli_real_escape_string($conn, $_POST['emp_email']);
                            $attendance_date = mysqli_real_escape_string($conn, $_POST['attendance_date']);
                            $clockin_time = mysqli_real_escape_string($conn, $_POST['clockin_time']);

                            if($emp_email == ""){
                                echo "<script>alert('Please Fill in Your Email Address')</script>";
                            }
                            // else if($attendance_date = ""){
                            //     echo "<script>alert('Please Refresh Your Browser or Set the Computer Date')</script>";
                            // }
                            // else if($clockin_time = ""){
                            //     echo "<script>alert('Please Refresh Your Browser or Set the Computer Time')</script>";
                            // }
                            else{
                                $sql1 = "SELECT emp_id FROM employee_tbl WHERE emp_email='".$_POST["emp_email"]."' ";
                                $result = $conn->query($sql1);	
                                 $fetch = mysqli_fetch_array($result);
             		            if ($result->num_rows > 0) {
                                    $emp_id = $fetch['emp_id'];
                                    $clock_out_time = "0";
                                     $clock_out_reason ="0";

                                     // Check if User has already Clocked In
                                    $sql2 = "SELECT emp_id, attendance_date FROM attendance WHERE emp_id ='$emp_id' AND attendance_date='$attendance_date' ";
                                    $result2 = $conn->query($sql2);	
                                    $fetch2 = mysqli_fetch_array($result2);
                                    if ($result2->num_rows > 0) {
                                        echo "<script>alert('You Already Sign In, Please Check Back Later to Sign Out')</script>";
                                    }
                                    else{
                                        $sql = "INSERT INTO attendance (emp_id, attendance_date, clock_in_time, clock_out_time, clock_out_reason)
							            VALUES ('$emp_id', '" . $_POST["attendance_date"] . "','" . $_POST["clockin_time"] . "', '$clock_out_time', '$clock_out_reason' )";

							                if ($conn->query($sql) === TRUE) {
							                    echo "<script>location.replace('clock_in_success_msg.php');</script>";
							                } else {
							                    echo "<script>alert('There was an Error')</script>" . $sql . "<br>" . $conn->error;
							                }

							                $conn->close();
			                        }
                                }
                                else{
                                    echo "<script>alert('Employee Does Not Exist, Please Contact Admin');</script>" ;
						        }

                            

                            

                                    
					        }


                        }
						
				?> 
</body>

</html>