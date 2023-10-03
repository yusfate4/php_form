<?php require 'form.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Center-align the form */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        /* Style input fields */
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Style error messages */
        .error {
            color: red;
            font-size: 12px;
        }

        /* Style the submit button */
        button[type="submit"] {
            background-color: #007bff;
            /* Button-like background color */
            color: #fff;
            /* Text color */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            /* Add a subtle hover effect */
        }

        /* Hover effect for the submit button */
        button[type="submit"]:hover {
            background-color: #0056b3;
            /* Darker background color on hover */
        }
    </style>

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
                <input type="hidden" name="userid" value="<?= $userid; ?>">
                <input type="hidden" name="cpassword" value="<?= $user['password']; ?>">
            </div>
            <button type="submit" name="updatepwd">Update Password</button>
        </form>



    <?php
    }
    ?>
</body>

</html>