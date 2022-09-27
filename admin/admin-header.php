<?php
session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location:login.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/header.css">
</head>

<body>
    <nav class="navbar">
        <a href="admin-index.php"> <img src="../resources/images/logo-white.png" alt="logo" class="nav-logo"></a>
        <ul class="navlist">
            <li>
                <a href="manage_users.php">Manage Users</a>
            </li>
            <li>
                <a href="manage_admin.php">Manage Admin</a>
            </li>
            
            <li>
                <a href="attendance_record.php">Attendance</a>
            </li>
            <li>
                <a href="../clockin.php">Clock In</a>
            </li>
            <li>
                <a href="../clockout.php">Clock Out</a>
            </li>

            <li>
                <div class="dropdown">
                    <button class="dropbtn">
                        
                    <?php
                    echo ($_SESSION["admin_email"]);
                    ?>
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="logout.php">Logout</a>
                    </div>
                </div> 
            </li>

            <!-- <li>
                <a href="home.php">Home</a>
            </li>
                        
            <li>
                <a href="attendance_record.php">Attendance Record</a>
            </li> -->

        </ul>

    </nav>

                    
</body>
</html>