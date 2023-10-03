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
    if (isset($_GET['user']) && !empty($_GET['user'])) {
        $userid = (int) $_GET['user'];
        $stmt = "SELECT * FROM users WHERE id = $userid";
        $query = mysqli_query($conn, $stmt);
        $numrow = mysqli_num_rows($query);
        if ($numrow > 0) {
            $user = mysqli_fetch_assoc($query);
        } else {
            header('location:fetch.php');
        }

        ?>

                    <!-- NEW PAGE -->
                    <h3><?= $user['firstname'] . " " . $user['lastname']; ?></h3>
                    <img src="uploads/<?= $user['upload']; ?>" alt="profile image" width="300px">
                    <p><?= $user['email']; ?></p>
                    <p><?= $user['phone_number']; ?></p>
                    <a href="?edit=<?= $userid; ?>">Edit</a> <br>
                    <a href="password.php?updatepwd=<?= $user['id']; ?>">Update Password</a>
                    <br> <a href="?delete=<?= $user['id']; ?>">Delete</a>

                    <!-- EDIT BUTTON -->
        <?php
    } elseif (isset($_GET['edit']) && !empty($_GET['edit'])) {
        $userid = (int) $_GET['edit'];
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
                <input type="text" name="firstname" placeholder="Firstname" value="<?= $user['firstname']; ?>">
                <span class="error">* <?php echo $error_fname; ?></span>
                </div>
                <br>

                <div>
                <input type="text" name="lastname" placeholder="Lastname" value="<?= $user['lastname']; ?>">
                <span class="error">* <?php echo $error_lname; ?></span>
            </div> <br>
                <div>
                <input type="text" name="email" placeholder="E-mail" value="<?= $user['email']; ?>">
                <span class="error">* <?php echo $error_email; ?></span>
            </div> <br>
                <div>
                <input type="text" name="phone_number" placeholder="Phone Number" value="<?= $user['phone_number']; ?>">
                <span class="error">* <?php echo $error_number; ?></span>
            </div><br>
                <div>
                <input type="hidden" name="userid" value="<?= $userid; ?>">
                </div>
                <button type="submit" name="edit">Update</button>
            </form>

            <?php
    }
    ?>
</body>
</html>