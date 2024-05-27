
const  submit = document.getElementById('submit');

submit.addEventListener('click', function(){//add an event listener to the submit button to start process of loggin in
	var email = document.getElementById("login-email");
	var password = document.getElementById("login-password");
	var emailValue = email.value;
	var passwordValue = password.value;
	
	if(emailValue === ''){
		alert("Please enter an email address");//validate user input
		return;
	}
	
	if(passwordValue === ''){
		alert("Please enter a password");//validate user input
		return;
	}
	
	login(emailValue,passwordValue);//log user in
});

function login(email, password){
    var req = new XMLHttpRequest();
    req.open("POST", "https://wheatley.cs.up.ac.za/u23533693/COS221/221edited-api.php", true);//send a request to the api
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
		window.location.href = "profile.php";//open page if user credentials correct
	}else{
		alert(info.data);////display error message if incorrect credentials provided.
	}
}
