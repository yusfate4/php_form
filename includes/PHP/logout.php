<?php
require 'session.php';
if (session_destroy()) {
    header('location:login.php');
}

?>