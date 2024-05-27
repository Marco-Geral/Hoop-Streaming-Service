<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>HOOP</title>
      <link rel="stylesheet" href="css/login.css">
      <script type="text/javascript" src="js/login.js"></script>
   </head>
   <body>

 
      <div class="wrapper">
        <div class="showcase-top">
            <img src="img\hoopLogo.png" alt="" />
        </div>
         <div class="title">
            Login Form
         </div>
         <form action="#">
            <div class="field">
               <input type="text" required; id = "login-email">
               <label>Email Address</label>
            </div>
            <div class="field">
               <input type="password" required; id = "login-password">
               <label>Password</label>
            </div>
            <div class="content">
               <div class="checkbox">
                  <input type="checkbox" id="remember-me">
                  <label for="remember-me">Remember me</label>
               </div>
               <!-- <div class="pass-link">
                  <a href="#">Forgot password?</a>
               </div> -->
            </div>
            <div class="field">
               <input type="submit" value="Login" id = "submit">
            </div>
            <div class="signup-link">
               Not a member? <a href="register.php">Signup now</a>
            </div>
         </form>
      </div>
   </body>
</html>