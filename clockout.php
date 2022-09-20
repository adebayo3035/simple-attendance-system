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
        <header> CLOCK OUT</header>
        <form action="clockout.php" method="post">
            <div class="input-group">
                <input type="text" name="clockout_date" id="date" readonly required="">

            </div>
            <div class="input-group">
                <input type="text" name="clockout_time" id="time" readonly required="">
            </div>
            <div class="input-group">
                <select name="clockout_reason" id="clockout-type" required="">
                    <option value="">Select Clock Out Option</option>
                    <option value="Emergency">Emergency Clock Out</option>
                    <option value="Official Assignment">Official Assignment</option>
                    <option value=" Closing Time">Closing Time</option>

                </select>
            </div>
            <div class="input-group">
                <input type="email" name="emp_email" placeholder="Enter Your Email Address" autocomplete="off">
            </div>
            <button type="submit" id="submitBtn" name ="clockout">Clock Out</button>
        </form>

    </section>
    <script src="main.js"></script>

    <!-- pHP SCRIPT TO UPDATE ATENDANCE TABLE -->

    <?php
        include('config.php');
        // Check if Clock Out Button has been clicked
        if(isset($_POST['clockout'])){
            // Collect User Input
            $emp_email = mysqli_real_escape_string($conn, $_POST['emp_email']);
            $clockout_date = mysqli_real_escape_string($conn, $_POST['clockout_date']);
            $clockout_time = mysqli_real_escape_string($conn, $_POST['clockout_time']);
            $clockout_reason = mysqli_real_escape_string($conn, $_POST['clockout_reason']);
            $default_clockout = "0";

            // Validate Form Inputs if it's empty or not
            if($emp_email == ""){
                echo "<script>alert('Please Fill in Your Email Address')</script>";
            }
            else if ($clockout_reason == ""){
                echo "<script>alert('Please Select Your Reason for Clocking Out')</script>";
            }
            // If form input is not Empty then Check if the Supplied email address is registered
            else{
                $sql1 = "SELECT emp_id FROM employee_tbl WHERE emp_email='".$_POST["emp_email"]."'  ";
                $result = $conn->query($sql1);	
                $fetch = mysqli_fetch_array($result);

                //If User E-mail is found in the employee table, then proceed to check if User has already Signed Out
                if ($result->num_rows > 0) {
                    $emp_id = $fetch['emp_id'];

                    // Check if User has already Clock Out
                    $sql2 = "SELECT * FROM attendance WHERE emp_id ='$emp_id' AND attendance_date='$clockout_date' AND clock_out_time !='$default_clockout' ";
                    $result2 = $conn->query($sql2);	
                    $fetch2 = mysqli_fetch_array($result2);

                    //If User has already Sign Out Display Error Message
                    if ($result2->num_rows > 0) {
                        echo "<script>alert('You Already Sign Out, Please Check Back Later to Sign In')</script>";
                    }
                        // If User has not Signed Out, Sign uSER Out for the dau
                    else{
                        $sql = "UPDATE attendance SET clock_out_time = '$clockout_time' , clock_out_reason ='$clockout_reason' WHERE emp_id = '$emp_id' AND attendance_date = '$clockout_date'";
                        if (mysqli_query($conn, $sql)) {
                            echo "<script>location.replace('clock_out_success_msg.php');</script>";
                        } 
                        else {
                            echo "<script>alert('Error Clocking Employee Out') </script>" . $sql . "<br>" . mysqli_error($conn);
                        }
                    }
                }

                // Error Message to be Displayed when User is not found
                else{
                    echo "<script>alert('Employee Does Not Exist, Please Contact Admin');</script>" ;
                }

            }  
        }
         
        // Close connection
        mysqli_close($conn);
    ?>
</body>

</html>