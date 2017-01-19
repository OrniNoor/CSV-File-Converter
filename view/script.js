
function checkForm() {

var name = document.getElementById("username1").value;
var password = document.getElementById("password1").value;
var email = document.getElementById("email1").value;
//var cpass = document.getElementById("cpassword1").value;

if (name == '' || password == '' || email == '') {
alert("Fill All Fields!");
} else {
//error fields
var username1 = document.getElementById("username");
var password1 = document.getElementById("password");
var email1 = document.getElementById("email");
//var cpass1 = document.getElementById("cpassword");

if (username1.innerHTML == 'Must be 3+ letters' || password1.innerHTML == 'Password too short' || email1.innerHTML == 'Invalid email') {
alert("Fill Valid Information");
} else {

document.getElementById("myForm").submit();
}
}
}
// AJAX code to check input field values when onblur event triggerd.
function validate(field, query) {
var xmlhttp;
if (window.XMLHttpRequest) { 
xmlhttp = new XMLHttpRequest();
} else { // for IE6, IE5
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState == 2 && xmlhttp.status == 200) {
document.getElementById(field).innerHTML = "Validating..";
} else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
document.getElementById(field).innerHTML = xmlhttp.responseText;
} else {
document.getElementById(field).innerHTML = "Error Occurred. <a href='index.php'>Reload Or Try Again</a> the page.";
}
}
xmlhttp.open("GET", "validation.php?field=" + field + "&query=" + query, false);
xmlhttp.send();
}

