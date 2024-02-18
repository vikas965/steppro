<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location:login.php");
}
include('admin/db.php');
$conn = mysqli_connect("localhost","root","vikas9652021978","stepcone") or die();
$time = mysqli_query($conn,"SELECT * FROM admin");
$email =$_SESSION["user"];
$fetch_det = "SELECT * from std_details where email='$email'";
$exe_update_std12 = mysqli_query($conn, $fetch_det);
$exe_update_std12 = mysqli_fetch_array($exe_update_std12)['selected_branch'];
if(strlen($exe_update_std12)>0)
{
    die("You already Selected");
}

$time = mysqli_fetch_array($time)["start_time"];
?>


<?php 

if(isset($_POST['submit']))
{

    $email =$_SESSION["user"];
    $selected_branch = $_POST['branch_se'];
    $update_std = "UPDATE std_details set selected_branch='$selected_branch' where email='$email'";
    $exe_update_std = mysqli_query($conn, $update_std);
    // $data = mysqli_query($conn,"SELECT * FROM `std_details` WHERE `email` = '$email'");
    // $data = mysqli_fetch_array($data)["branch"];
    // $exe_update_std = mysqli_fetch_array($conn,"UPDATE `working` SET `avl_seats` = ")
    if($exe_update_std)
    {
        die("login successfull");
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Document</title>
    <style>
        .container {
            display: grid;
            grid-template-columns: 1fr;
        }

        .form-data form {
            margin-top: 100px;
            margin-left: 50px;
            width: 500px;
            height: 500px;
        }
        button{
            width: 100px;
            height: 30px;
            margin-top: 20px;
            margin-left: 150px;
        }
        .courses{
            margin-left: 100px;
            margin-top: 100px;
            width: 500px;
            height: 500px;
        }
        .courses table{
            border: 1px solid gray;
            border-collapse: collapse;
        }
        .courses table td{
            width: 200px;
            text-align: center;
            border: 1px solid gray;
        }

        label {
            display: block;
            font-size: 16px;
            /* margin-bottom: 5px; */

        }

        input {
            /* margin-bottom: 10px;
            width: 200px;
            padding: 10px 8px; */
            margin-bottom: 20px;
            width: 400px;
            height: 30px;
            font-size: 16px;
            border: 1px solid gray;
            border-radius: 4px;
        }
        select{
            width: 400px;
            height: 30px;
        }
        .time{
            margin-top: 50vh;
            text-align: center;
            font-size: 32px;
        }
        .nottime{
            width : 100vw;
            height: 100vh;
        }
    </style>
</head>

<body  onload="exe('<?php echo $time ?>')">
    <div class="container">
        <a href='logout.php'>logout</a>
        <div class='nottime'>
            <p class='time'></p>
        </div>
        <div class="form-data afr_time">
            <form method="post">
                <h1>User Details</h1>
                <label>Name</label>
                <input type="text" id="name" name="name" value="Lavanya"><br>
                <label>JNTU Number</label>
                <input type="text" id="jntu" name="jntu" value="21341A0569"><br>
                <label>Branch</label>
                <input type="text" id="branch" name="branch" value="Computer Science and Engineering"><br>
                <label>Section</label>
                <input type="text" id="section" name="section" value="B"><br>
                <label>Select a course</label>
                <select name='branch_se' class='sele'>
                    <option></option>
                    <option>CSE</option>
                    <option>ECE</option>
                    <option>Civil</option>
                    <option>Mech</option>
                    <option>EEE</option>
                </select><br>
                <input type="submit" name="submit">
            </form>
            <div class="courses">
            <table border="1" class='rt'>
                <tr>
                    <th>Course Name</th>
                    <th>Total Seats</th>
                    <th>Available Seats</th>
                </tr>
                <tr>
                    <td>CSE</td>
                    <td>60</td>
                    <td>40</td>
                </tr>
                <tr>
                    <td>ECE</td>
                    <td>60</td>
                    <td>50</td>

                </tr>
                <tr>
                    <td>EEE</td>
                    <td>60</td>
                    <td>60</td>

                </tr>
                <tr>
                    <td>Mech</td>
                    <td>60</td>
                    <td>48</td>

                </tr>
                <tr>
                    <td>Civil</td>
                    <td>60</td>
                    <td>30</td>

                </tr>
                <tr>
                    <td>BSH</td>
                    <td>90</td>
                    <td>80</td>

                </tr>

            </table>
        </div>
        </div>
    </div>
    <script>
    function exe(a){
            li = a.split(":");
            let te = new Date();
            te.setHours(li[0])
            te.setMinutes(li[1]);
            let date = new Date();
            if(te - date > 0){
                document.querySelector(".nottime").style.display ="block";
                document.querySelector(".afr_time").style.display ="none";
                interval = setInterval(function(){
                        let date = new Date();
                        var diffInMilliseconds = (te - date);
                        var hours = Math.floor(diffInMilliseconds / (1000 * 60 * 60));
                        var minutes = Math.floor((diffInMilliseconds % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((diffInMilliseconds % (1000 * 60)) / 1000);
                        document.querySelector(".time").innerHTML = hours +":"  +minutes + ":" +seconds;
                    if(te - date <= 0){
                        document.querySelector(".afr_time").style.display ="block";
                        document.querySelector(".nottime").style.display ="none";
                        clearInterval(interval);
                    }
                },1000);
            }
            else{
                document.querySelector(".afr_time").style.display ="block";
                document.querySelector(".nottime").style.display ="none";
            }
        }
        setInterval(() => {
            $.ajax({
    type: 'POST',
    url: "./ajs.php",
    dataType: 'json',
    data: {"data": "verified"},
    success: function (a) {
        // Assuming "a.main_data" and "a.sub_data" are arrays of course data
        let mainData = a.main_data;
        let subData = a.sub_data;

        console.log(mainData);
        document.querySelector(".rt").innerHTML = mainData;
        document.querySelector(".sele").innerHTML = a.sub_data;

    }
});

        }, 5000);
    </script>
</body>

</html>
