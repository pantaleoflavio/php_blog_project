<form action='includes/login.php' method='post'>
    <h4>Log in</h4>
    <div class='form-group'>
        <div class='form-group'>
            <label for='email'>Email</label>
            <input type='email' class='form-control' id='email' name='email' required>
        </div>
        <div class='form-group'>
            <label for='password'>Password</label>
            <input autocomplete="off" type='password' class='form-control' id='password' name='password' required>
        </div>
        <div class='form-group'>
            <input type='submit' class='btn btn-primary' name='login' value='Log in'>
        </div>
    </div>
</form>
<!-- form login -->