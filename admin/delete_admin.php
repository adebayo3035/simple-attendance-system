<?php
	$id=$_GET['id'];
    include('../config.php');
            $delete_sql = "DELETE FROM admin_tbl WHERE id='$id'";
                if(mysqli_query($conn, $delete_sql)){
                    echo "<script>location.replace('delete_success.php');</script>";
                }
                else{
                    echo "<script>alert('Error Deleting Employee Record') </script>" . $delete_sql. "<br>" . mysqli_error($conn);
                }

?>