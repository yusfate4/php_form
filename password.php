<?php require 'form.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
    if (isset($_GET['updatepwd']) && !empty($_GET['updatepwd'])) {
        $userid = (int) $_GET['updatepwd'];
        $stmt = "SELECT * FROM users WHERE id = $userid";
        $query = mysqli_query($conn, $stmt);
        $numrow = mysqli_num_rows($query);
        if ($numrow > 0) {
            $user = mysqli_fetch_assoc($query);
        } else {
            header('location:fetch.php');
        }
        ?>

        <form method="post">
            <div>
            <input type="password" name="password" placeholder="Old Password">
            <span class="error">* <?php echo $error_password; ?></span>
            </div>
            <br>

            <div>
            <input type="password" name="newpwd" placeholder="New Password">
            <span class="error">* <?php echo $error_newpassword; ?></span>
        </div> <br>
            <div>
            <input type="password" name="confirmpwd" placeholder="Confirm Password">
            <span class="error">* <?php echo $error_confirmpwd; ?></span>
        </div> <br>
            
            <div>
            <input type="hidden" name="userid" value="<?=$userid; ?>">
            <input type="hidden" name="cpassword" value="<?=$user['password']; ?>">
            </div>
            <button type="submit" name="updatepwd">Update Password</button>
        </form>



     <?php
    }
    ?>
</body>
</html>