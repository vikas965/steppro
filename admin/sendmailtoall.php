<?php

include('db.php');
$conn = new mysqli($servername, $username, $password, $database);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php_mailer/PHPMailer/src/Exception.php';
require 'php_mailer/PHPMailer/src/PHPMailer.php';
require 'php_mailer/PHPMailer/src/SMTP.php';

$val = 1;

if (isset($_POST['send_emails'])) {

    function generatePassword() {
        $specialChars = array('@', '#', '$'); // Array of special characters
    
        
        $password = rand(1, 9); // 1st character: random number from 1 to 9
        $password .= chr(rand(65, 90)); // 2nd character: random capital alphabet
        $password .= chr(rand(97, 122)); // 3rd character: random small alphabet
        $password .= $specialChars[array_rand($specialChars)]; // 4th character: random special character from array
        $password .= chr(rand(65, 90)); // 5th character: random capital alphabet
        $password .= chr(rand(97, 122)); // 6th character: random small alphabet
        $password .= rand(1, 9); // 7th character: random number from 1 to 9
        $password .= rand(1, 9); // 8th character: random number from 1 to 9
    
        return $password;
    }
    
    
    // Fetch all user details from std_details table
    $fetch_details_query = "SELECT * FROM std_details order by id desc limit 1";
    $execute_fetch = mysqli_query($conn, $fetch_details_query);

    $mail = new PHPMailer(); // Initialize $mail before the loop

    while ($user_data = mysqli_fetch_assoc($execute_fetch)) {
        $user_email = $user_data['email'];

        // Generate a password based on half the length of the email
        $user_pass = generatePassword();
        
        // Hash the password before storing it in the database
        $hashed_password = password_hash($user_pass, PASSWORD_DEFAULT);

        try {
            // Server settings
            $mail->SMTPDebug = false;
            $mail->isSMTP();
            $mail->Mailer = 'smtp';
            $mail->Host = 'smtp-mail.outlook.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'registrations.stepcone@gmrit.edu.in';
            $mail->Password = 'Rajam@2023';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('registrations.stepcone@gmrit.edu.in', 'Openelective');
            $mail->addAddress($user_email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Registration Details';
            $mail->Body = "<b>Open elective registrations</b><br><br>Your Login Details : <br><br><b>Username : $user_email</b><br><br><b>Password : $user_pass</b><br>";
            $mail->AltBody = 'USER Registration Details Openelective registration';

            $mail->send();

            // Update the database with the hashed password
            $update_query = "UPDATE std_details SET std_password = '$hashed_password' WHERE email = '$user_email'";
            mysqli_query($conn, $update_query);

        } catch (Exception $e) {
            // Handle exception if needed
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    // Check if all emails were sent successfully
    if ($mail->send()) {
        echo "<script>alert('Emails sent successfully!')</script>";
    } else {
        echo "<script>alert('Mail Not sent')</script>";
    }
}

?>

<!-- Add this form to your HTML with a button to trigger the email sending -->
<form action="" method="post">
    <input type="submit" name="send_emails" value="Send Emails to All">
</form>
