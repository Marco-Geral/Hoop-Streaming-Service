document.addEventListener('DOMContentLoaded', function () {
	const  regis = document.getElementById('signup');
	console.log(regis); 
	regis.addEventListener('click', function(){//add an event listener to the register button to listen for when to begin registration process
		var name = document.getElementById("name");
		var surname = document.getElementById("surname");
		var email = document.getElementById("signup-email");
		var password = document.getElementById("signup-password");
		var confirm = document.getElementById("confirm-password");
		var phone = document.getElementById("phone");
		var nameValue = name.value;
		var surnameValue = surname.value;
		var emailValue = email.value;
		var passwordValue = password.value;
		var confirmValue = confirm.value;
		var phoneValue = phone.value;
	
		if(emailValue === ''){
			alert("Please enter an email address");//user input validation
			return;
		}
	
		if(passwordValue === ''){
			alert("Please enter a password");//user input validation
			return;
		}
	
		if(nameValue === ''){
			alert("Please enter your name");//user input validation
			return;
		}
	
		if(surnameValue === ''){
			alert("Please enter your surname");//user input validation
			return;
		}
		
		if(confirmValue === ''){
			alert("Please confirm your password");//user input validation
			return;
		}
		
		if(phoneValue === ''){
			alert("Please enter your phone number");//user input validation
			return;
		}
		
		if(confirmValue !== passwordValue){
			alert("Passwords do not match!");//make sure the passwords match
			return;
		}
		
		signup(nameValue,surnameValue,emailValue,passwordValue, phoneValue);//begin sign up process
});

function signup(name, surname, email, password, phone){
    var req = new XMLHttpRequest();
    req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true);//send request to API
    var info = [];
    req.onreadystatechange = function () {
        if (req.readyState == 4 ){
                info = JSON.parse(req.responseText);
                processSign(info);
        }
    };
    var load = JSON.stringify({
        "action": "Register",
        "F_name": name,
        "L_Name": surname,
        "email": email,
        "phone": phone,
        "password": password
    });
    var basicAuth = btoa("u23584565:2023Tukkies2023");
    req.setRequestHeader("Authorization", "Basic " + basicAuth);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(load);
}

function processSign(info){
	if(info.status === "success"){
		window.location.href = "profile.php";//if login is successful, take user to the next page
	}else{
		alert(info.message);
	}
}

});
