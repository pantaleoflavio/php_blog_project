<?php
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        if(isset($_GET['delete'])) {
            $user_id_todelete = escape($_GET['delete']);
            $query = "DELETE FROM `users` WHERE id = {$user_id_todelete}";
            $delete_query_user = mysqli_query($connection, $query);
            echo "<h2 class='text-center text-uppercase bg-success'>user deleted</h2>";
            //header("Location: users.php");
        
            if (!$delete_query_user) {
                die("Query failed" . mysqli_error($connection));
            }
        }
    } else {
        echo "<h2 class='text-center text-uppercase bg-danger'>you are not an admin</h2>";
    }
}
?>

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th >Id</th>
            <th >First Name</th>
            <th >Last Name</th>
            <th >Birth Date</th>
            <th >Username</th>
            <th >Email</th>
            <th >Picture</th>
            <th >role</th>
            <th >registered Data</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $query = "SELECT * from users";
        $users = mysqli_query( $connection, $query);
            while ($row = mysqli_fetch_assoc($users)) {
                $user_id = escape($row['id']);
                $user_first_name = escape($row['first_name']);
                $user_last_name = escape($row['last_name']);
                $user_birthday = escape($row['birth_date']);
                $username = escape($row['username']);
                $user_email = escape($row['email']);
                $user_pic = escape($row['user_pic']);
                $user_role = escape($row['role']);
                $user_registration = escape($row['registered_date']);
                echo "<tr><td>{$user_id}</td>";
                echo "<td>{$user_first_name}</td>";
                echo "<td>{$user_last_name}</td>";
                echo "<td>{$user_birthday}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$user_email}</td>";
                echo "<td><img src='../images/{$user_pic}' alt='' width='100' height='50'></td>";
                echo "<td>{$user_role}</td>";
                echo "<td>{$user_registration}</td>";
                echo "<td><a class='btn btn-warning' href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";
                echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Are u sure?');\" href='users.php?delete={$user_id}'>Delete</a></td></tr>";
                
            }
        ?>
    </tbody>
</table>