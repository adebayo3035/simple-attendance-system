<?php
// session_start();
// if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
//     header("Location:login.php");
//     die();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>St Micheal Hospital Website</title>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Roboto&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/register.css"> -->
    <style>
        body{
            font-family: 'Nunito', sans-serif;
            max-height: 100vh;
            color: var(--white);
            background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)), url(https://images.unsplash.com/photo-1657405826726-ac52271d3bb1?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=967&q=80);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        h2{
            text-align: center;
            margin-top: 10px;
            font-size: 40px;
            color: #fff;
            width: 80%;
            margin: auto;
            line-height: 50px;
        }
    
    </style>
</head>

<body>
    <?php include ('admin-header.php');?>
    <h2> Welcome to Plusone Technology Staff Attendance Management System</h2>
</body>

</html>