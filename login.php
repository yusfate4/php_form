<?php
require 'form.php';
// require 'upload.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
 
    <title>PHP Registration Form</title>
    <style>
      .error {
       color: #ff0000;
}

    </style>
  </head>
  <body>
    <form method="post" enctype="multipart/form-data">
  <!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> -->
  <div class="container">
        <div class="title">Login Form</div>
      <h4><?=$msg;?></h4>
      <h4><?=$_SESSION['user'];?></h4>
        <div class="sub-container">

          <div class="form">
            <label class="label">Email :</label>
            <input type="text" class="input" name="email" value="<?php echo $email; ?>"/>
            <span class="error">* <?php echo $error_email; ?></span>
          </div>

          <div class="form">
            <label class="label">Password :</label>
            <input type="password" class="input" name="password" value="<?php echo $password; ?>"/>
            <span class="error">* <?php echo $error_password; ?></span>
          </div>
        
          <input class="btn" type="submit" name="login" value="Submit">
        </div>
      </div>
    </form>

  
  </body>
</html>
