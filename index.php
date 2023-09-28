<?php
require 'form.php';
// require 'upload.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="includes/CSS/style.css" />
 
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
        <div class="title">Registration Form</div>
      <h3><?=$msg;?></h3>
        <div class="sub-container">
          <div class="form">
            <label class="label">First Name :</label>
            <input type="text" class="input" name="fname"  value="<?php echo $fname; ?>"/>
            <span class="error">* <?php echo $error_fname; ?></span>
          </div>

          <div class="form">
            <label class="label">Last Name :</label>
            <input type="text" class="input" name="lname" value="<?php echo $lname; ?>"/>
            <span class="error">* <?php echo $error_lname; ?></span>

          </div>

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

          <div class="form">
            <label class="label">Confirm Password :</label>
            <input type="password" class="input" name="cpassword" value="<?php echo $cpassword; ?>"/>
            <span class="error">* <?php echo $error_cpassword; ?></span>

          </div>

          <div class="form">
            <label class="label">Phone Number :</label>
            <input type="number" class="input number" name="number" value="<?php echo $number; ?>"/>
            <span class="error">* <?php echo $error_number; ?></span>

          </div>

          <!-- FIle upload -->
          <div class="form">
          <label class="label">Upload your file</label>
          <input type="file" name="fileupload">
          <span class="error"> <?php echo $error_form; ?></span>  
        </div>
        
        
          <input class="btn" type="submit" name="submit" value="Submit">
        </div>
      </div>
    </form>

  
  </body>
</html>
