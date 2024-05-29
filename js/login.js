function log(){
        var email = document.getElementById("login-email");
        var password = document.getElementById("login-password");
        var emailValue = email.value;
        var passwordValue = password.value;

        if (emailValue === '') {
            alert("Please enter an email address"); // Validate user input
            return;
        }

        if (passwordValue === '') {
            alert("Please enter a password"); // Validate user input
            return;
        }
		
		localStorage.setItem('username', emailValue);
        login(emailValue, passwordValue); // Log user in
        
    }

    function login(email, password) {
        var req = new XMLHttpRequest();
        req.open("POST", "https://wheatley.cs.up.ac.za/u23584565/COS221/221api.php", true); // Send a request to the API

        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    var info = JSON.parse(req.responseText);
                    processInfo(info);
                } else {
                    alert("Error: " + req.status + " - " + req.statusText);
                }
            }
        };

        var load = JSON.stringify({
            "action": "Login",
            "email": email,
            "password": password
        });

        var basicAuth = btoa("u23584565:2023Tukkies2023");
        req.setRequestHeader("Authorization", "Basic " + basicAuth);
        req.setRequestHeader("Content-Type", "application/json");
        req.send(load);
    }

    function processInfo(info) {
        if (info.status === "success") {
            window.location.href = "profile.php"; // Open page if user credentials correct
            localStorage.setItem("phone", info.data.phone);
            localStorage.setItem("Name", info.data.F_name + ' ' + info.data.L_Name);
            localStorage.setItem("isAdmin", info.data.isAdmin);
            localStorage.setItem("ID", info.data.id);
        } else {
            alert(info.data); // Display error message if incorrect credentials provided.
        }
 }
