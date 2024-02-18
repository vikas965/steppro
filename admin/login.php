

<?php 
include('db.php');
session_start();
if(isset($_POST['login']))
{
    $mail = $_POST['usermail'];
    $pass = $_POST['userpass'];


    $fetch_user = "SELECT * from `admin` where mail='$mail' and `password` ='$pass'";
    $exe_fetch = mysqli_query($conn,$fetch_user);
    if(mysqli_num_rows($exe_fetch)>0)
    {
        $_SESSION['admin'] = $mail;
        echo "<script>window.open('index.php','_self')</script>";
    }
    else{
        echo "<script>window.alert('Wrong credentials')</script>";
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        *,
*:before,
*:after {
    margin: 0;
    padding: 0;
    font-family: inherit;
    box-sizing: border-box;
}
#main {
    margin-top: 20%;
    width: max-content;
    margin: 40px auto;
    font-family: "Segoe UI", sans-serif;
    padding: 25px 28px;
    background: #151414;
    border-radius: 4px;
    border: 1px solid #302d2d;
    
}

h2 {
    text-align: center;
    font-size: 28px;
    margin-bottom: 20px;
    font-weight: 400;
    color: white;
}
.input-parent {
    display: block;
    margin-bottom: 20px;
}
label {
    display: block;
    font-size: 16px;
    margin-bottom: 8px;
    color: #a4a4a4;
}
.input-parent input {
    padding: 10px 8px;
    width: 100%;
    font-size: 16px;
    background: #323131;
    border: none;
    color: #c7c7c7;
    border-radius: 4px;
    outline: none;
    transition: all 0.2s ease;
}
.input-parent input:hover {
    background: #404040;
}
.input-parent input:focus {
    box-shadow: 0px 0px 0px 1px #0087ff;
}
button {
    padding: 10px 18px;
    font-size: 15px;
    background: #1a3969;
    width: 100%;
    border: none;
    border-radius: 4px;
    color: #f4f4f4;
    transition: all 0.2s ease;
}
button:hover {
    opacity: 0.9;
}
button:focus {
    box-shadow: 0px 0px 0px 3px black;
}
body {
    background: #ccc2c2;
}
.container{

    align-items: center;
    justify-content: center;
    display: grid;
    grid-template-columns: 1fr 1fr;

}
.form{
    margin-top: 15%;
    margin-left: 20%;
}
.stu-img img{
    margin-left: 20%;
    margin-top: 15%;
    border-radius: 90%;
    width: 400px;
    height: 400px;
}
.form form{
    height: 400px;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="form">
            
            <form action="" id="main" method="post" >
                <h2>Login to your account..!!</h2>
                
            
                <div class="input-parent">
                  <label for="username">Email</label>
                  <input name="usermail" type="text" id="username">
                </div>
            
                <div class="input-parent">
                  <label for="password">Password</label>
                  <input name="userpass" type="password" id="password">
                </div><br>
            
                <input name="login" type="submit">Login</input>
              </form>
            </div>
        <div class="stu-img">
            <img src="../assets/img1.jpg" alt="">
        </div>
       
    </div>
</body>
</html>