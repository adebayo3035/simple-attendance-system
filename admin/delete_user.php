<?php
	$id=$_GET['id'];
    include('../config.php');
    $getEmployee_query=mysqli_query($conn,"select emp_email from `employee_tbl` where emp_id='$id'");

    $row=mysqli_fetch_array($getEmployee_query);

    if ($getEmployee_query->num_rows > 0) {
        $emp_email = $row['emp_email'];

        //check admin table if the User is an Admin
        $getAdmin_query=mysqli_query($conn,"select admin_email from `admin_tbl` where admin_email='$emp_email'");
        if($getAdmin_query->num_rows > 0){
            $delete_sql = "DELETE FROM admin_tbl WHERE admin_email='$emp_email'";
            if(mysqli_query($conn, $delete_sql)){
                $delete_sql2 = "DELETE FROM employee_tbl WHERE emp_email='$emp_email'";
                if(mysqli_query($conn, $delete_sql2)){
                    echo "<script>location.replace('delete_success.php');</script>";
                }
                else{
                    echo "<script>alert('Error Deleting Employee Record') </script>" . $delete_sql2. "<br>" . mysqli_error($conn);
                }
            }
            else{
                echo "<script>alert('Error Deleting Employee Record') </script>" . $delete_sql. "<br>" . mysqli_error($conn);
            }
        }
        //Else if the person is not an admin, then delete from employee table only
        else{
            $delete_sql2 = "DELETE FROM employee_tbl WHERE emp_email='$emp_email'";
                if(mysqli_query($conn, $delete_sql2)){
                    echo "<script>location.replace('delete_success.php');</script>";
                }
                else{
                    echo "<script>alert('Error Deleting Employee Record') </script>" . $delete_sql2. "<br>" . mysqli_error($conn);
                }
        }

        //echo $emp_email;
        // $delete_sql = "DELETE  FROM employee_tbl, admin_tbl WHERE employee_tbl.emp_email ='$emp_email' AND admin_tbl.admin_email = '$emp_email'";

        // $delete_sql = " DELETE FROM p, i
        // USING employee_tbl p, admin_tbl i
        // WHERE p.emp_email = $emp_email'
        //   AND p.emp_email = i.admin_email";
       
        //     if(mysqli_query($conn, $delete_sql)) {
        //         echo "<script>location.replace('delete_success.php');</script>";
        //     } 
        //     else {
        //         echo "<script>alert('Error Deleting Employee Record') </script>" . $delete_sql. "<br>" . mysqli_error($conn);
        //     }
   }
?>