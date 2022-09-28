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
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/attendance_record.css">
    <link rel="icon" type="image/x-icon" href="../resources/images/logo-colored.png">
    <title> Admin Record</title>

    <style>
        #password{
            border: none;
            outline: none;
            font-size: 18px;
            background-color:inherit;
            color: inherit;
        }
        #togglePassword{
            cursor: pointer;
        }
    </style>
    </head>
<body>

    <?php 
        include ('admin-header.php'); 
        include ('../config.php');
        if (isset($_POST['search'])){
            $emp_id = $_POST['filter_email'];
            // $sql = "SELECT * FROM employee_tbl INNER JOIN attendance ON employee_tbl.emp_id = attendance.emp_id WHERE attendance.emp_id = '".$_POST["filter_email"]."'";

            $sql = "SELECT * FROM admin_tbl  WHERE admin_tbl.admin_email = '".$_POST["admin_email"]."'";

            $result = $conn->query($sql) or die($conn->error);
        }
        else{
            $sql = " SELECT * FROM admin_tbl  ORDER BY id DESC ";
            $result = $conn->query($sql);

        }
        $conn->close();

    ?>

<h2>Manage Admin Records</h2>
<a href="create_admin.php" class="addNewEmployee"> Add New Admin </a>
    <form action="" class="data-list" method="post">
        
        <div class="filter-container" id="filter-container">
            <label for="filter-input"> Enter Admin E-mail:</label>
            <input type="email" name="filter_email" id="filter-input" required>
            <button type="submit"name="search"> Search</button>
        </div>
    </form>


<div style="overflow-x:auto;">
  <table>
    <tr>
      <th>E-mail</th>
      <th>Username</th>
      <th>Password</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>


    <!-- PHP CODE TO FETCH DATA FROM ROWS -->
                <!-- // LOOP TILL END OF DATA -->
    <?php
        while($rows=$result->fetch_assoc()){
                
    ?>
        <tr>
    
            <td><?php echo $rows['admin_email'] ?></td>
            <td><?php echo $rows['admin_username'] ?></td>
            <td><input type="password" name="password" value="<?php echo md5($rows['admin_password']) ?>" id="password" class="password" readonly><i class="fa fa-eye" aria-hidden="true" id="togglePassword" class="togglePassword"></i></i></td>                
            <td><a href="edit.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
            <td><a href="delete.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
