<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> HOOP</title>
    <link rel="stylesheet" href="css/register.css">
     <script type="text/javascript" src="js/register.js"></script>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>

  <div class="container">
    <div class="showcase-top">
        <img src="img\hoopLogo.png" alt="" />

      </div>
    <div class="title">Registration</div>
    <div class="content">
      <form action="#">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Name</span>
            <input type="text" placeholder="Enter your name" required; id="name">
          </div>
          <div class="input-box">
            <span class="details">Surname</span>
            <input type="text" placeholder="Enter your surname" required; id="surname">
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" placeholder="Enter your email" required; id="signup-email">
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" required; id="phone">
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="text" placeholder="Enter your password" required; id="signup-password">
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="text" placeholder="Confirm your password" required; id="confirm-password">
          </div>
        </div>
       
        <div class="button">
          <input type="submit" value="Register" id ="signup">
        </div>
      </form>
    </div>
  </div>

</body>
</html>

