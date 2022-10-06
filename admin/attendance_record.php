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
    <link rel="stylesheet" href="../css/attendance_record.css">
    <link rel="icon" type="image/x-icon" href="../resources/images/logo-colored.png">
    <title> Employee Attendance Record</title>
    </head>
<body>

    <?php 
        include ('admin-header.php'); 
        include ('../config.php');
        //define total number of results you want per page  
    $results_per_page = 10;  
  
    //find the total number of results stored in the database  
    $query = "SELECT * FROM employee_tbl INNER JOIN attendance ON employee_tbl.emp_id = attendance.emp_id ORDER BY attendance_id DESC";  
    $result = mysqli_query($conn, $query);  
    $number_of_result = mysqli_num_rows($result);  
  
    //determine the total number of pages available  
    $number_of_page = ceil ($number_of_result / $results_per_page);  
  
    //determine which page number visitor is currently on  
    if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }  
  
    //determine the sql LIMIT starting number for the results on the displaying page  
    $page_first_result = ($page-1) * $results_per_page;  
  
    //retrieve the selected results from database   
    if(isset($_POST['search'])){
        $emp_email = $_POST['filter_email'];
        $sql = "SELECT * FROM employee_tbl INNER JOIN attendance ON employee_tbl.emp_id = attendance.emp_id WHERE employee_tbl.emp_email = '$emp_email' ORDER BY attendance_id DESC";
        $result = $conn->query($sql) or die($conn->error);
    
    }else{
        $query = "SELECT * FROM employee_tbl INNER JOIN attendance ON employee_tbl.emp_id = attendance.emp_id LIMIT " . $page_first_result . ',' . $results_per_page;  
        $result = mysqli_query($conn, $query);  
    }

    
    ?>
    <h2>Employee Attendance Record</h2>

<form action="" class="data-list" method="post">
    
    <div class="filter-container" id="filter-container">
        <label for="filter-input"> Enter Employee E-mail:</label>
        <input type="email" name="filter_email" id="filter-input" required>
        <button type="submit"name="search" onclick="hidePagination()"> Search</button>
    </div>
</form>

<!-- Button to Print Data -->
<form method="post" action="attendance_print.php" target="_new" class="form-inline">
          <div class="form-group">
          <button type="submit" name="search"class="print_data">Print Data</button>
          </div>
</form>


<div style="overflow-x:auto;">
<table>
<tr>
  <th>Last Name</th>
  <th>First Name</th>
  <th> E-mail</th>
  <th>Position</th>
  <th> Date </th>
  <th>Clock in Time</th>
  <th>Clock Out Time</th>
  <th>Reason for Clocking Out</th>
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
 <!-- Pagination Section  -->
 <section class="pagination" id="pagination">
    <?php   
        echo ' <div class="pagination_page"> <a href = "pagination.php?page=' . 1 . '" class="pagination_number"> First Page  </a> </div>';
        for($page = 1; $page<= $number_of_page; $page++) {  
            echo ' <div class="pagination_page"> <a href = "pagination.php?page=' . $page . '" class="pagination_number"> ' . $page . '  </a> </div> ';
        }
        echo ' <div class="pagination_page"> <a href = "pagination.php?page=' . $number_of_page . '" class="pagination_number"> Last Page  </a> </div>';
    ?>
 </section>
 <?php
      
     //echo '<a href = "pagination.php?page=' . 1 . '" class="pagination_number"> Previous Page  </a>';
     //for($page = 1; $page<= $number_of_page; $page++) {  
        //echo '<a href = "pagination.php?page=' . $page . '" class="pagination_number">' . $page . ' </a>';  
    //}  
    //echo '<a href = "pagination.php?page=' . $number_of_page . '" class="pagination_number">Last Page </a>';
?>

<script>
    function hidePagination(){
        var pagination = document.getElementById('pagination');
        if(pagination.style.display === "flex"){
            pagination.style.display ="none";
            alert("You clicked me");
        }else{
            pagination.style.display ="flex";
        }
        
    }
</script>
</body>
</html>