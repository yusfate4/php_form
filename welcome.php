<?php
require 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <!-- NEW PAGE -->
     <h3><?= $user['firstname'] . " " . $user['lastname']; ?></h3>
    <img src="uploads/<?= $user['upload']; ?>" alt="profile image" width="300px">
    <p><?= $user['email']; ?></p>
    <p><?= $user['phone_number']; ?></p>
    <a href="?edit=<?= $userid; ?>">Edit</a> <br>
    <a href="password.php?updatepwd=<?= $user['id']; ?>">Update Password</a>
    <a href="logout.php">Logout</a>
</body>
</html>