<?php ob_start(); ?>
<?php session_start(); ?>
<?php 
    $_SESSION['sub_email'] = null;
    $_SESSION['username'] = null;
    $_SESSION['role'] = null;
    $_SESSION['email'] = null;
    header("Location: http://localhost/cms_project/index.php");
?>

