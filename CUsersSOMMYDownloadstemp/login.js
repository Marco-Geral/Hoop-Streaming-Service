const  submit = document.getElementById('submit');
console.log(submit); 
submit.addEventListener('click', function(){
	var email = document.getElementById("login-email");
	var password = document.getElementById("login-password");
	var emailValue = email.value;
	var passwordValue = password.value;
	
	if(emailValue === ''){
		alert("Please enter an email address");
		return;
	}
	
	if(passwordValue === ''){
		alert("Please enter a password");
		return;
	}
	
	login(emailValue,passwordValue);
});

function login(email, password){
    var req = new XMLHttpRequest();
    req.open("POST", "https://wheatley.cs.up.ac.za/u23533693/COS221/221edited-api.php", true);
    var info = [];
    req.onreadystatechange = function () {
        if (req.readyState == 4 ){
                info = JSON.parse(req.responseText);
                processInfo(info);
        }
    };
    var load = JSON.stringify({
        "action": "Login",
        "email": email,
        "password": password
    });
    req.send(load);
}

function processInfo(info){
	if(info.status === "success"){
		window.location.href = "profile.php";
	}else{
		alert(info.data);
	}
}
