// Get Current Date and Time
var today = new Date();
let timeNow = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
let dateNow = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var myDate = document.getElementById('date');
var myTime = document.getElementById('time');
// myDate.value = dateNow;
myTime.value = timeNow;


// form validation
// var time = document.getElementById('time');
// var date = document.getElementById('date');
// var emp_email = document.getElementById('emp_email');

//span to close modal
var close_Clockin = document.getElementById('close_Clockin');
var clockinModal =  document.getElementById('clockinModal');
function closeModal(){
     window.location.replace("clockin.php");
}
function closeModal2(){
    window.location.replace("clockout.php");
}
function closeModal3(){
    window.location.replace("../dashboard.php");
}
function closeModal4(){
    window.location.replace("attendance_record.php");
}
function closeModal5(){
    window.location.replace("dashboard.php");
}
function closeModal6(){
    window.location.replace("login.php");
}




