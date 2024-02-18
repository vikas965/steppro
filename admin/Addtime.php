<?php

include('db.php');
if(isset($_POST["submit"])){
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];
    $result = mysqli_query($conn,"UPDATE admin SET start_time ='$start_time' ,end_time = '$end_time' WHERE id = '1'");
    if($result){
        echo "Time updated succesfully";
    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>time adding</title>
    </head>
    <body>
        <form method='post'>
            start_time<input type='text' name='start_time'>
            end_time<input type= 'text' name='end_time'>
            <input type='submit' name='submit'>
        </form>
    </body>
</html>