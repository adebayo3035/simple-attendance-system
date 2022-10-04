<?php
session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location:admin/login.php");
    die();
}
else{
    if(time()-$_SESSION["login_time_stamp"] >12000) 
    {
        session_unset();
        session_destroy();
        header("Location:login.php");
    }
}

include('../config.php');
//  Count Total Number of Registered Employee
$countUser ="SELECT * FROM employee_tbl";

if ($result=mysqli_query($conn,$countUser))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  mysqli_free_result($result);
  }

//   Count Total Number of Admin
$countAdmin ="SELECT * FROM admin_tbl";

if ($Adminresult=mysqli_query($conn,$countAdmin))
  {
  // Return the number of rows in result set
  $Admincount=mysqli_num_rows($Adminresult);
  mysqli_free_result($Adminresult);
  }

//   Count Signed in User for the Day
$today = date("Y-m-d");
echo $today;
$clockinCount ="SELECT * FROM attendance where attendance_date = '$today' ";

if ($Clockinresult=mysqli_query($conn,$clockinCount))
  {
  // Return the number of rows in result set
  $countClockin=mysqli_num_rows($Clockinresult);
  mysqli_free_result($Clockinresult);
  }

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Plusone Technology Attendance Management System</title>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard.css">

</head>

<body>
    <section class="container">
        <section class="navigation">
            <div class="header">
                <p> PlusOne Technology Attendance Management System</p>
            </div>
            <div class="nav">
                <ul>
                    <li>
                        <a href="dashboard.php">
                            <i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="attendance_record.php">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>Attendance Log</a>
                    </li>
                    <li>
                        <a href="manage_users.php">
                            <i class="fa fa-group"></i> Employee</a>
                    </li>
                    <li>
                        <a href="manage_admin.php">
                            <i class="fa fa-user"></i> Admin</a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-file" aria-hidden="true"></i>Report</a>
                    </li>
                </ul>
            </div>


        </section>

        <section class="main">
            <div class="admin">
                <div class="date">
                    <p><span> Today's Date :</span> <span id="todays_date">  </span></p>
                    <p><span> Time :</span> <span id="current_time"></span></p>
                </div>
                <div class="dropdown">
                    <button class="dropbtn"><?php
                    echo ($_SESSION["admin_email"]);
                    ?>
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
            
            <div class="count">
                <div class="count-1 red">
                    <p> Users</p>
                    <p class="number"> <?php echo $rowcount ?></p>
                </div>
                <div class="count-1 orange">
                    <p> Admin</p>
                    <p class="number"> <?php echo $Admincount ?></p>
                </div>
                <div class="count-1 green">
                    <p> Signed in Users </p>
                    <p class="number"> <?php echo $countClockin ?></p>
                </div>
                <div class="count-1 purple">
                    <p> Signed Out Users </p>
                    <p class="number"> 2000</p>
                </div>
            </div>

            <div class="users-profile">

            </div>
        </section>
    </section>
<script>
    // On Dashboard code to Display Current Date and Time
var today = new Date();
var todays_date = document.getElementById('todays_date');
var current_time = document.getElementById('current_time');

// get the date as a string
todays_date.textContent = today.toDateString();
current_time.textContent = today.toLocaleTimeString();
console.log(todays_date);
console.log(current_time)

   
</script>
</body>