<?php
require 'config.php';
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

}

$error_fname = $error_lname = $error_email = $error_password = $error_cpassword = $error_number = $error_form = "";
$fname = $lname = $email = $password = $cpassword = $number = $msg = "";


// FIRST NAME
if (isset($_POST['submit'])) {
    if (empty($_POST["fname"])) {
        $error_fname = "First name is required";
    } else {
        $fname = test_input($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
            $error_fname = "Only letters and white space allowed";
        }
    }

    // LAST NAME
    if (empty($_POST["lname"])) {
        $error_lname = "Last name is required";
    } else {
        $lname = test_input($_POST["lname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
            $error_lname = "Only letters and white space allowed";
        }
    }

    // EMAIL
    if (empty($_POST["email"])) {
        $error_email = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_email = "Invalid email format";
        } else {
            $stmt = "SELECT email FROM users WHERE email = '$email'";
            $query = mysqli_query($conn, $stmt);
            $numrow = mysqli_num_rows($query);
            if ($numrow > 0) {
                $error_email = "Email already exist";
            }
        }
    }

    // PASSWORD
    $password = $_POST['password'];
    if (empty($password)) {
        $error_password = "Password required";
    } elseif (!preg_match("@[^\W]@", $password) || !preg_match('@[0-9]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[A-Z]@', $password) || strlen($password) < 8) {
        $error_password = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    } else {
        $password = test_input($password);
    }
    // CONFIRM PASSWORD
    $cpassword = $_POST['cpassword'];
    if (empty($cpassword)) {
        $error_cpassword = 'Confirm password required';
    } elseif ($cpassword !== $password) {
        $error_cpassword = "Confirm password don't match";
    } else {
        $error_cpassword = '';
    }


    // PHONE NUMBER
    $number = $_POST['number'];
    if (empty($number)) {
        $error_number = "Phone number is required";
    } elseif (!preg_match('@[0-9]@', $number)) {
        $error_number = "Only letters and white space allowed";
    } else {
        $number = test_input($number);
        $newst = "SELECT phone_number FROM users WHERE phone_number = '$number'";
        $query = mysqli_query($conn, $newst);
        $numrow = mysqli_num_rows($query);
        if ($numrow > 0) {
            $error_number = "Number already exist";
        }

    }

    // FILE UPLOAD
    $filedir = "uploads/";
    $file = $_FILES['fileupload']['name'];
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $exttype = ['jpg', 'png', 'jpeg', 'gif'];

    if (empty($file)) {
        $error_form = "Select a file to upload";
    } elseif (!in_array($ext, $exttype)) {
        $error_form = "Invalid file type only jpg,png,jpeg and gif are allowed";
    } elseif ($_FILES['fileupload']['size'] > 2000000) {
        $error_form = "File is too large (max 2mb)";
    } else {
        $filename = rand(0000, 9999) . "." . $ext;
        $target_file = $filedir . $filename;
    }


    $clear = $error_fname . $error_lname . $error_email . $error_password . $error_cpassword . $error_number . $error_form;
    if (empty($clear)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = "INSERT INTO users(firstname, lastname, email, phone_number, password, upload)
        VALUES('$fname', '$lname', '$email', '$number', '$password', '$filename')";
        $query = mysqli_query($conn, $stmt);
        if ($query) {

            if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_file)) {
                $msg = "Account created successfully";
                $fname = $lname = $email = $password = $number = "";
            } else {
                $msg = "something went wrong";
            }
        } else {
            $msg = "something went wrong " . mysqli_error($conn);
        }

    }

}




if (isset($_POST['edit'])) {
    $fname = $_POST["firstname"];
    if (empty($_POST["firstname"])) {
        $error_fname = "First name is required";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
        $error_fname = "Only letters and white space allowed";
    } else {
        $fname = test_input($_POST['firstname']);
    }

    $lname = $_POST['lastname'];
    // LAST NAME
    if (empty($_POST["lastname"])) {
        $error_lname = "Last name is required";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
        $error_lname = "Only letters and white space allowed";
    } else {
        $lname = test_input($_POST["lastname"]);
    }



    // EMAIL
    $email = $_POST['email'];
    if (empty($_POST["email"])) {
        $error_email = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Invalid email format";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
    }


    // PHONE NUMBER
    $number = $_POST['phone_number'];
    if (empty($_POST['phone_number'])) {
        $error_number = "Phone number is required";
    } else {
        $number = test_input($number);
    }


    // edit 
    $userid = (int) $_POST['userid'];
    $stmt = "UPDATE users SET firstname = '$fname', lastname = '$lname', email = '$email', phone_number = '$number' WHERE id = $userid";
    $query = mysqli_query($conn, $stmt);
    if ($query) {
        echo "Data updated successfully";
        $firstname = $lastname = $email = $phone_number = "";

    } else {
        echo "Something Went Wrong";
    }

}

// delete
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $userid = (int) $_GET['delete'];
    $stmt = "DELETE FROM users WHERE id = $userid";
    $query = mysqli_query($conn, $stmt);
    header('location:fetch.php');
}

$error_newpassword = $error_confirmpwd = "";
// edit update password
if (isset($_POST['updatepwd'])) {
    $cpassword = $_POST['cpassword'];
    $password = $_POST['password'];
    if (empty($password)) {
        $error_password = "Required";
    } elseif (!password_verify($password, $cpassword)) {
        $error_password = "Password don't match";
    } else {
        $password = test_input($password);
    }
    $newpassword = $_POST['newpwd'];
    if (empty($newpassword)) {
        $error_newpassword = "Password required";
    } elseif (!preg_match("@[^\W]@", $newpassword) || !preg_match('@[0-9]@', $newpassword) || !preg_match('@[a-z]@', $newpassword) || !preg_match('@[A-Z]@', $newpassword) || strlen($newpassword) < 8) {
        $error_newpassword = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    } else {
        $newpassword = test_input($newpassword);
    }
    $confirmpwd = $_POST['confirmpwd'];
    // CONFIRM PASSWORD
    if (empty($confirmpwd)) {
        $error_confirmpwd = 'Confirm password required';
    } elseif ($confirmpwd !== $newpassword) {
        $error_confirmpwd = "Confirm password don't match";
    } else {
        $error_confirmpwd = '';
    }

    $error = $error_password . $error_newpassword . $error_confirmpwd;
    if (empty($error)) {
        $userid = (int) $_POST['userid'];
        $password = password_hash($newpassword, PASSWORD_DEFAULT);
        $stmt = "UPDATE users SET password = '$password' WHERE id = $userid";
        $query = mysqli_query($conn, $stmt);
        if ($query) {
            echo "Password changed successfully";
            $password = $confirmpwd = $newpwd = "";
        } else {
            echo "Something Went Wrong";
        }
    }

}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($email) || empty($password)) {
        $msg = "Fill the required field";
    } else {
        $stmt = "SELECT * FROM users WHERE email = '$email'";
        $query = mysqli_query($conn, $stmt);
        $numrow = mysqli_num_rows($query);
        if ($numrow > 0) {
            $user = mysqli_fetch_assoc($query);
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user'] = $user['id'];
                header('location:welcome.php');
            }else{
                $msg = "Email or Password is invalid";
            }
        } else {
            $msg = "Email or Password is invalid";
        }
    }

}
?>