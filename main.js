// const dateInput = document.getElementById('date');

// ✅ Using the visitor's timezone
// dateInput.value = formatDate();

// console.log(formatDate());

// function padTo2Digits(num) {
//   return num.toString().padStart(2, '0');
// }

// function formatDate(date = new Date()) {
//   return [
//     date.getFullYear(),
//     padTo2Digits(date.getMonth() + 1),
//     padTo2Digits(date.getDate()),
//   ].join('-');
// }

// ✅ Using UTC (universal coordinated time)
// dateInput.value = new Date().toISOString().split('T')[0];

// console.log(new Date().toISOString().split('T')[0]);

// var dateNow = new Date();
// var currentTime = dateNow.getHours() + ':' + dateNow.getMinutes() + ':' + dateNow.getSeconds();
// document.getElementById('time').value = currentTime;

// Get Current Date and Time
var today = new Date();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
document.getElementById('time').value = time;
document.getElementById('date').value = date;


// form validation
var time = document.getElementById('time');
var date = document.getElementById('date');
var emp_email = document.getElementById('emp_email');

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
    window.location.replace("index.php");
}
