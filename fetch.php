<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1px" width="80%" align="center">
        <thead>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>profile</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
                $stmt = "SELECT * FROM users ORDER BY id DESC";
                $query = mysqli_query($conn, $stmt);
                while ($user = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?=$user['firstname'];?></td>
                    <td><?=$user['lastname'];?></td>
                    <td><?=$user['email'];?></td>
                    <td><?=$user['phone_number'];?></td>
                    <td><img src="uploads/<?=$user['upload'];?>" alt="" width="200px"></td>
                    <td>
                        <a href="view.php?user=<?=$user['id'];?>">View Info</a>
                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    
</body>
</html>