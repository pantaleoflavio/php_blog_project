<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>

<?php include "includes/dbconnection.php"; ?>
<?php include "includes/header.php"; ?>
<!-- Navigation -->  
<?php  include "includes/navigation.php"; ?>

<?php

require 'vendor/autoload.php';

if (!isset($_GET['forgot'])) {
    redirect('index.php');
}

if (ifItIsMethod('post')) {
    if (isset($_POST['forgot_email'])) {
        $forgot_email = $_POST['forgot_email'];
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));

        if (email_exists($forgot_email)) {

            if ($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE email= ?")) {
                mysqli_stmt_bind_param($stmt, "s", $forgot_email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);


            //configure PHPMAILER
            
                $mail = new PHPMailer();

                ///Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host       = Config::SMTP_HOST;
                $mail->SMTPAuth   = true;
                $mail->Username   = Config::SMTP_USER;
                $mail->Password   = Config::SMTP_PASSWORD;
                $mail->SMTPSecure = 'tls';
                $mail->Port       = Config::SMTP_PORT;
                $mail->CharSet = 'UTF=8';

                //Recipients
                $mail->setFrom('flavio.pantaleo@yahoo.com', 'vito');
                $mail->addAddress($forgot_email);

                //Content
                $mail->isHTML(true); 
                $mail->Subject = '<b>reset password<b>';
                $mail->Body = '<p>Please click to reset your password
                <a href="http://localhost/cms_project/reset.php?email='.$forgot_email.'&token='.$token.' ">http://localhost/cms_project/reset.php?email='.$forgot_email.'&token='.$token.'</a>
                </p>';
        
                
                if ($mail->send()){

                    $emailSent = true;

                } else {
                    echo "STATESMENT WRONG";
                }

            } else {
                echo "STATESMENT WRONG";
            }
            
            
        }else {
            echo "<h2 class='text-center bg-warning'>Sorry the email is not registered</h2>";
        }
    }
}

?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <?php if(!isset($emailSent)): ?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">
                                    <form id="forgot-email" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="forgot_email" name="forgot_email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>
                                
                            <?php else: ?>

                                <h2>Please check your email</h2>

                            <?php endIf; ?>

                                </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

