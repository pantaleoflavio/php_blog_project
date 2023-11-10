<?php

function redirect($location)
{
    header("Location:" . $location);
    exit;
}

function ifItIsMethod($method = false)
{
    if ($_SERVER["REQUEST_METHOD"] == strtoupper($method)) {
        return true;
    }

    return false;
}

//valid alternative for to print login with if stat
function isLoggedIn()
{
    if (isset($_SESSION['role'])) {
        return true;
    }

    return false;
}

//for to redirect admin login
function checkIfLoggedInAndRedirect($redirectLoc = false)
{
    if (isLoggedIn()) {
        redirect($redirectLoc);
    }
}

function confirmQuery($sendet_query)
{
    global $connection;
    if (!$sendet_query) {
        die("Query failed" . mysqli_error($connection));
    }
}

function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, @trim(strip_tags($string)));
}

function insertCategories()
{
    global $connection;
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'admin') {

            if (isset($_POST['submit'])) {
                $cat_title = escape($_POST['cat_title']);
                if ($cat_title == " " || empty($cat_title)) {
                    echo "This file cannot be empty";
                } else {
                    $query = "INSERT INTO categories (`title`) ";
                    $query .= "VALUES ('{$cat_title}')";

                    $create_cat_query = mysqli_query($connection, $query);
                    confirmQuery($create_cat_query);
                }
            }
        } else {
            header("Location: ../index.php");
        }
    }
}

function deleteCategory()
{
    global $connection;
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'admin') {
            if (isset($_GET['delete'])) {
                $id_to_delete = escape($_GET['delete']);
                $query ="delete from categories where id = {$id_to_delete}";
                $delete_id_query = mysqli_query($connection, $query);
                header("Location: categories.php"); //function che refresha la pag all'istante
                confirmQuery($delete_id_query);

            }

        } else {
            header("Location: ../index.php");
        }
    }
}

function findAllCategories()
{
    global $connection;
    $query = "SELECT * from categories";
    $select_category = mysqli_query( $connection, $query);
        while ($row = mysqli_fetch_assoc($select_category)) {
            $cat_id = escape($row['id']);
            $cat_name = escape($row['title']);
            echo "<tr>
                    <td>{$cat_id}</td>
                    <td>{$cat_name}</td>
                    <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
                    <td><a href='categories.php?edit={$cat_id}'>Edit</a></td>
                </tr>";
        }
}

function insertComment()
{
    global $connection;

    if ( isset( $_POST['create_comment'])) {
        $comment_author = escape($_POST['comment_author']);
        $author_email = escape($_POST['author_email']);
        $comment_content = escape($_POST['comment_content']);
        //$comment_date = $_POST['comment_date'];
        $selected_post_id = escape($_GET['p_id']);
        
        if ( $author_email == " " || $comment_author == " " || empty($comment_author) || empty($author_email)) {
            echo "<script>alert('This field cannot be empty')</script>";
        } else {
            $query = "INSERT INTO comments (`comment_id_post`, `comment_author`, `author_email`,";
            $query .= " `comment_content`, `comment_date`) VALUES ('{$selected_post_id}',";
            $query .= "'{$comment_author}', '{$author_email}', '{$comment_content}', now())";
            $create_comment_query = mysqli_query($connection, $query);
            echo "<script>alert('Comment postet succesfully')</script>";
            if ( !$create_comment_query ) {
                die("Query failed" . mysqli_error($connection));
            }

        }
        
    }
}

function users_online()
{
    if (isset($_GET['onlineusers'])) {

        global $connection;

        if (!$connection) {
            session_start();
            include_once "../../includes/dbconnection.php";
                
            $session = session_id();
            $time = time();
            $timeout_in_sec = 05;
            $timeout = $time - $timeout_in_sec;

            $query = "SELECT * FROM users_online WHERE session = 'session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

                if ($count == null) {
                    $query1 = "INSERT INTO users_online (`session`, `time`) VALUES ('$session', '$time')";
                    mysqli_query($connection, $query1);
                } else {
                    $query2 = "UPDATE users_online SET tiem = '$time' WHERE session = '$session'";
                    mysqli_query($connection, $query2);
                }
            $users_online = "SELECT * FROm users_online WHERE time > '$timeout'";
            $users_online_query = mysqli_query($connection, $users_online);
            echo $count_user = mysqli_num_rows($users_online_query);

        }

    } //get request isset  

}

users_online();

function widgetCounter($table)
{
    global $connection;
    $query = "SELECT * FROM " . $table;
    $result = mysqli_query($connection, $query);

    confirmQuery($result);
    return mysqli_num_rows($result);
}

function widgetCheckStatus($table,$column,$status)
{
    global $connection;
    
    $query = "SELECT * FROM $table WHERE $column = '$status' ";
    $result = mysqli_query($connection, $query);

    confirmQuery($result);

    return mysqli_num_rows($result);

}

/*
function for convalidate admin
function is_admin($username = "")
{
    global $connection;
    $query = "SELECT role FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    $row = mysqli_fetch_array($result);

    if ($row['role' == 'admin']) {
        return true;
    } else {
        return false;
    }

}
*/

function username_exists($username)
{
    global $connection;
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
    
}

function email_exists($email)
{
    global $connection;
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
    

}

?>