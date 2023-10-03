<?php
require 'session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Center-align the content */
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        /* Style the user's name */
        h3 {
            font-size: 24px;
            margin-top: 20px;
            color: #333;
            /* Choose an appropriate text color */
        }

        /* Style the profile image */
        img {
            max-width: 300px;
            border-radius: 5%;
            margin-top: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            /* Add a subtle box shadow */
        }

        /* Style the user's details */
        p {
            font-size: 16px;
            margin: 10px 0;
            color: #666;
            /* Choose an appropriate text color */
        }

        /* Style the "Edit" link */
        a {
            text-decoration: none;
            background-color: #007bff;
            /* Button-like background color */
            color: #fff;
            /* Text color */
            padding: 5px 10px;
            margin-top: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            /* Add a subtle hover effect */
        }

        /* Hover effect for links */
        a:hover {
            background-color: #0056b3;
            /* Darker background color on hover */
        }
    </style>

</head>

<body>
    <!-- NEW PAGE -->
    <h3><?= $user['firstname'] . " " . $user['lastname']; ?></h3>
    <img src="./uploads/<?= $user['upload']; ?>" alt="profile image" width="300px">
    <p><?= $user['email']; ?></p>
    <p><?= $user['phone_number']; ?></p>
    <a href="?edit=<?= $userid; ?>">Edit</a> <br>
    <a href="password.php?updatepwd=<?= $user['id']; ?>">Update Password</a>
    <a href="logout.php">Logout</a>
</body>

</html>