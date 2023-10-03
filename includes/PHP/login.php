<?php
require 'form.php';
// require 'upload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="CSS/login.css">

  <title>PHP Registration Form</title>
  <style>
    .error {
      color: #ff0000;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      padding: 100px;
    }

    /* Overall container styles */
    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f9f9f9;
    }

    /* Form title */
    .title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
      text-align: center;
    }

    /* Error message styles */
    .error {
      color: red;
      font-size: 12px;
    }

    /* Form label styles */
    .label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    /* Form input styles */
    .input {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    /* Submit button styles */
    .btn {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    /* Submit button hover effect */
    .btn:hover {
      background-color: #0056b3;
    }

    /* Sub-container styles */
    .sub-container {
      margin-top: 20px;
    }

    /* Additional styling for messages */
    h4 {
      font-size: 16px;
      margin-bottom: 10px;
      text-align: center;
    }
  </style>
</head>

<body>
  <form method="post" enctype="multipart/form-data">
    <!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> -->
    <div class="container">
      <div class="title">Login Form</div>
      <h4><?= $msg; ?></h4>
      <h4><?= $_SESSION['user']; ?></h4>
      <div class="sub-container">

        <div class="form">
          <label class="label">Email :</label>
          <input type="text" class="input" name="email" value="<?php echo $email; ?>" />
          <span class="error">* <?php echo $error_email; ?></span>
        </div>

        <div class="form">
          <label class="label">Password :</label>
          <input type="password" class="input" name="password" value="<?php echo $password; ?>" />
          <span class="error">* <?php echo $error_password; ?></span>
        </div>

        <input class="btn" type="submit" name="login" value="Submit">
      </div>
    </div>
  </form>


</body>

</html>