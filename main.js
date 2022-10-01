// Get Current Date and Time
var today = new Date();
let timeNow = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
let dateNow = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var myDate = document.getElementById('date');
var myTime = document.getElementById('time');
myDate.value = timeNow;
myTime.value = dateNow;


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
    window.location.replace("admin-index.php");
}
function closeModal4(){
    window.location.replace("attendance_record.php");
}

// On Dashboard code to Display Current Date and Time
var today = new Date();
var todays_date = document.getElementById('todays_date');
var current_time = document.getElementById('current_time');

// get the date as a string
todays_date.textContent = today.toDateString();
current_time.textContent = today.toLocaleTimeString();
console.log(todays_date);
console.log(current_time)



