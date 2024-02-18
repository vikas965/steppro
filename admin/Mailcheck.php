<?php

include('db.php');
$conn= new mysqli($servername,$username,$password,$database);


$val=1;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'php_mailer/PHPMailer/src/Exception.php';
require 'php_mailer/PHPMailer/src/PHPMailer.php';
require 'php_mailer/PHPMailer/src/SMTP.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];
   

    $fetch_details_query = "SELECT * FROM std_details where email='user2@gmail.com' ";
    $execute_fetch = mysqli_query($conn, $fetch_details_query);
    $user_data = mysqli_fetch_assoc($execute_fetch);
    // $user_email = $user_data['email'];
    $user_email = '';
    $user_pass = $user_data['std_password'];
    

    $mail = new PHPMailer();


    try {
        //Server settings
        $mail->SMTPDebug = false;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Mailer = 'smtp';
        $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'registrations.stepcone@gmrit.edu.in';                     //SMTP username
        $mail->Password   = 'Rajam@2023';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       =  587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        //Recipients
        $mail->setFrom('registrations.stepcone@gmrit.edu.in', 'Openelective');
        $mail->addAddress($user_email);     //Add a recipient
        
    
        // $mail->addAttachment('../assets/mainpage/poster.jpg', 'poster.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Registration Details';
        $mail->Body    = "<b>Open elective registrations</b><br><br>Your Login Details : <br><br><b>Username : $user_email</b><br><br><b>Password : $user_pass</b><br>";
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->AltBody = 'USER Registration Details Openelective registration';
    
        $mail->send();
        // $updateResponse =  "UPDATE gmrit_users set `status`=$val where gmrit_email='$id' ";
        // $executeUpdate = mysqli_query($conn, $updateResponse);
       
        //echo 'Message has been sent';
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    if( $mail)
    {

        echo "<script>alert('sent')</script>";
        // header('Location:index.php');
    }
    else{
        echo "<script>alert('Mail Not sent')</script>";
    }

}



