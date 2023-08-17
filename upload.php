<?php

// FILE UPLOAD
$filedir = "uploads/";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $file = $_FILES['fileupload']['name'];
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $exttype = ['jpg', 'png', 'jpeg', 'gif'];

    if (empty($file)) {
        echo "Select a file to upload";
    } elseif (!in_array($ext, $exttype)) {
        echo "Invalid file type only jpg,png,jpeg and gif are allowed";
    } elseif ($_FILES['fileupload']['size'] > 2000000) {
        echo "File is too large (max 2mb)";
    } else {
        $filename = rand(0000, 9999) . "." . $ext;
        $target_file = $filedir . $filename;
        if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_file)) {
            echo "file uploads successfully";
        } else {
            echo "error";
        }
    }
}
?>