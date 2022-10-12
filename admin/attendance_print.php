<?php
session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location:login.php");
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
    <!-- <link rel="stylesheet" href="../css/attendance_record.css"> -->
    <link rel="icon" type="image/x-icon" href="../resources/images/logo-colored.png">
    <title> Print Attendance Here</title>
    <style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
.print_data{
    height: 30px;
    width: 50px;
    border: none;
    text-align: center;
    cursor: pointer;
    font-size: 14px;
    color: #fff;
    background: #1e90ff;
    padding: 5px;
    border-radius: 4px;
}
.data-list label{
    font-size: 18px;
    font-weight: 900;
}
.data-list input{
    padding: 7px;
    font-size: 16px;
    border-radius: 4px;
    border: 1px #ccc solid;
    outline:none;
    width: 50%;
}
.data-list button{
    height: 40px;
    width: 100px;
    border: none;
    text-align: center;
    cursor: pointer;
    font-size: 18px;
    color: var(--white);
    background: #2bff00;
    padding: 10px;
    border-radius: 4px;
}
.prepared_by{
    font-size: 16px;
}
</style>
    </head>
<body>

    <?php 
        include ('../config.php');
        
        // Retrive all Employee Attendance Record from Employee and Attendance Table  
        if(isset($_POST['searchEmployee'])){
            $emp_email = $_POST['emp_email'];
            $sql = "SELECT * FROM employee_tbl INNER JOIN attendance ON employee_tbl.emp_id = attendance.emp_id WHERE employee_tbl.emp_email = '$emp_email' ORDER BY attendance_id DESC";
            $result = $conn->query($sql) or die($conn->error);
        
        }else{
            $sql = " SELECT * FROM employee_tbl INNER JOIN attendance ON employee_tbl.emp_id = attendance.emp_id ORDER BY attendance_id DESC ";
            $result = $conn->query($sql) or die ($conn->error);
        }
            
        
        // Retrieve Admin firstname and lastname and display
        $admin_email = $_SESSION["admin_email"];
        $sqlAdmin = "SELECT emp_firstname, emp_lastname FROM employee_tbl WHERE emp_email = '$admin_email'";
        $resultAdmin = $conn->query($sqlAdmin) or die($conn->error);
        $fetch = mysqli_fetch_array($resultAdmin);	
            if ($resultAdmin->num_rows > 0) {
                $admin_firstname = $fetch['emp_firstname'];
                $admin_lastname =  $fetch['emp_lastname'];
            }
        $conn->close();

    ?>

<button type="submit" id="print" onclick="printPage()" class="print_data">Print </button> <span class="prepared_by"> Prepared by : <?php //session_start();
echo $admin_lastname . " ". $admin_firstname ?> 
</span>
    <form action="" class="data-list" method="post">
        
        <div class="filter-container" id="filter-container">
            <label for="filter-input"> Enter Employee E-mail:</label>
            <input type="email" name="emp_email" id="filter-input" required>
            <button type="submit"name="searchEmployee"> Search</button>
        </div>
    </form> 


<div style="overflow-x:auto;">
  <table id="customers">
    <tr>
      <th>Last Name</th>
      <th>First Name</th>
      <th> E-mail</th>
      <th>Position</th>
      <th> Date </th>
      <th>Clock in Time</th>
      <th>Clock Out Time</th>
      <th>Clock Out Reason</th>
    </tr>


    <!-- PHP CODE TO FETCH DATA FROM ROWS -->
                <!-- // LOOP TILL END OF DATA -->
    <?php
        while($rows=$result->fetch_assoc()){
                
    ?>
        <tr>
    
            <td><?php echo $rows['emp_lastname'] ?></td>
            <td><?php echo $rows['emp_firstname'] ?></td>
            <td><?php echo $rows['emp_email'] ?></td>
            <td><?php echo $rows['emp_position'] ?></td>

    
            <td><?php echo $rows['attendance_date'] ?></td>                 
            <td><?php echo $rows['clock_in_time'] ?></td>
            <td><?php echo $rows['clock_out_time'] ?></td>
            <td><?php echo $rows['clock_out_reason'] ?></td>
        </tr>
<?php
        }//end while
    
?>
</table>
</div>
<script>
    //check select option
function getOption() {
        selectElement = document.querySelector('#filter');
        filterContainer = document.querySelector('#filter-container');
        output = selectElement.value;
        // console.log(output);
        if ((selectElement.selectedIndex) > -1){
            filterContainer.style.display ="flex";
        }
        event.preventDefault();
        // document.querySelector('.output').textContent = output;
}
function printPage(){
    window.print();
}
setTimeout(function(){
   document.location.reload();
}, 30000);

</script>

</body>
</html>
