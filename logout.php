
<!doctype html>

<html lang = "en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogOut</title>
    <link rel="stylesheet" href="css/logout.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

<style>

body {
            font-family: Arial, sans-serif;
            background-image:linear-gradient(153deg, rgb(0, 0, 0) 10%, rgba(255,49,49,1) 20%, rgb(27, 4, 4) 50%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            height: 40vh;
            width: 50vh;
            
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
         
        }

        h1 {
            margin-top: 80px;
            color: white;
            font-weight: 900;
            /* margin-bottom: 20px; */
        }

        p {
            color: white;
            margin-bottom: 10px;
            font-weight: 700;
        }

        a {
           color: rgb(255,49,49);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: white;
        }


</style>


  </head>

  

<body >
 
        <div class="container">
        <h1>Log out</h1>
        <p>You have successfully logged out.</p>
        <p>If you want to log back in, click <a href="login.php">here</a>.</p>
    </div>

</body>


</html>

=======
<?php
// Start the session
session_start();

// Unset the session variable
unset($_SESSION['apikey']);

// Destroy the session
session_destroy();

// Redirect to the login_register.php page
header('Location: login_register.php');
exit;
?>

