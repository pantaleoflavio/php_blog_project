<?php  include "includes/dbconnection.php"; ?>
<?php  include "includes/header.php"; ?>

<!-- Navigation -->
    
<?php  include "includes/navigation.php"; ?>
    
<?php
if(isset($_POST['send_email'])) {
    $to = escape("flavio.pantaleo@yahoo.com");
    $subject = escape(wordwrap($_POST['subject'], 30));
    $message = escape($_POST['message']);
    $email = escape($_POST['email']);
    $headers = 'From: ' . $email;

    mail($to, $subject, $message, $headers);
    echo "<h2 class='text-center text-uppercase bg-success'>Message sendet</h2>";

}
?>


<!-- Page Content -->
<div class="container">
    
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
    <h1>Contact Me</h1>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="email">Your Email</label>
        <input type="email" class="form-control" id="mail" name="email" required>
    </div>
    <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" class="form-control" id="subject" name="subject" required>
    </div>
    <div class="form-group">
        <label for="message">Your message</label>
        <textarea type="text" class="form-control" id="message" rows="3" name="message" required></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="send_email" value="send message">
    </div>
</form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


    <hr>


<?php include "includes/footer.php";?>
