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
                if (isset($_GET['page'])) {
                    $page = (int)$_GET['page'];
                }else{
                    $page = 1;
                }
                $limit = 2;
                $offset = ($page - 1) * $limit;
                $stmt = "SELECT * FROM users ORDER BY id DESC LIMIT $offset, $limit";
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
    <?php
         $stmt = "SELECT * FROM users ORDER BY id DESC";
         $query = mysqli_query($conn, $stmt);
         $numrow = mysqli_num_rows($query);
         if ($numrow > 0) {
            $total_page = ceil($numrow / $limit);
    ?>
    <ul style="display:flex;list-style-type:none;justify-content:center;gap:20px;">
      
        <li><a href="?page=<?=$page-1;?>" <?=$page == 1 ? "hidden" : "";?>>Prev</a></li>
        <?php
        for ($i=1; $i < $total_page; $i++) { 
            echo '<li><a href="?page='.$i.'">'.$i.'</a></li>';
        }
        ?>
        <li><a href="?page=<?=$page+1;?>" <?=$page < $total_page ? "" : "hidden";?>>Next</a></li>
    </ul>
    <?php
        }
    ?>
    
</body>
</html>