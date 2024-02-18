<?php
session_start();
if(isset($_POST["data"])){
    $sem = 6;
    $servername = "localhost";
    $username = "root";
    $password = "vikas9652021978";
    $database = "stepcone";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    $email = $_SESSION["user"];
    $data = mysqli_query($conn,"SELECT * FROM std_details WHERE email ='$email'");
    $data = mysqli_fetch_array($data)["branch"];
    $data = mysqli_query($conn,"SELECT * FROM `working` WHERE `branch` = '$data'");
    
    $return = "";
    $ano = "";
    foreach($data as $item){
        $temp = "<tr>".  "<td>" . $item["elect_branch"] ." </td>" . "<td>" . $item["avl_seats"] .  "</td>" ."</tr>"; 
        $return = $return . $temp;
        if($item["avl_seats"] != 0){
            $ano = $ano . "<option>". $item["elect_branch"] . "</option>";
        }
    }
    
    echo json_encode(array("main_data" => $return, "sub_data" => $ano));
}

?>