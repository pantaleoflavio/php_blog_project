<?php include_once "dbconnection.php" ?>
<?php include_once "../admin/includes/functions.php" ?>
<?php session_start(); ?>

<?php
if (isset($_POST['login'])) {
    $sub_email = escape($_POST['email']);
    $sub_password = escape($_POST['password']);

    $sub_email = escape($sub_email);
    $sub_password = escape($sub_password);

    $query = "SELECT * FROM users WHERE email = '{$sub_email}'";
    $login_query = mysqli_query($connection, $query);
    confirmQuery($login_query);

    while ($row = mysqli_fetch_assoc($login_query)) {
        $user_id = escape($row['id']);
        $user_email = escape($row['email']);
        $user_password = escape($row['password']);
        $user_username = escape($row['username']);
        $user_role = escape($row['role']);
    }

    if (password_verify($sub_password, $user_password) || $sub_password === $user_password ) { //2nd cond just for test
        $_SESSION['user_id'] = $user_id;
        $_SESSION['sub_email'] = $sub_email;
        $_SESSION['sub_password'] = $sub_password;
        $_SESSION['username'] = $user_username;
        $_SESSION['role'] = $user_role;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_password'] = $user_password;

        if ($sub_email === $user_email) {
            header("Location: ../index.php?u_id={$user_id}");
        } elseif ($sub_email === $user_email && password_verify($sub_password, $user_password) && $user_role === 'admin') {
            header("Location: ../admin/admin_index.php");
        } elseif ($user_email !== $sub_email) {
            header("Location: ../login_failed.php");
        }
    } else if ( !password_verify($sub_password, $user_password) || $sub_password !== $user_password) {
        header("Location: ../login_failed.php");
    }
}
?>