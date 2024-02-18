<?php

if (isset($_GET["sem"])) {
    // $sem = 6;
    $servername = "localhost";
    $username = "root";
    $password = "vikas9652021978";
    $database = "stepcone";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    $sem=$_GET['sem'];
    // $result = mysqli_query($conn, "");

    $seats_data = array();
    $students_data = array();
    $restricted_data = array();
    $result = mysqli_query($conn, "SELECT * FROM `electives` WHERE `semester` = '$sem'");
    foreach ($result as $item) {
        $seats_data[$item['branch_id']] = $item['no_seats'];
        $students_data[$item['branch_id']] = $item['std_count_branch'];
        $restricted_data[$item['branch_id']] = explode(",", $item['refined_branch']);
    }
    $total_students = array_sum($students_data);
    $total_seats = array_sum($seats_data);
    if ($total_students != $total_seats) {
        echo "The students data is not going to match";
        die("go to the edit page");
    }
    print_r($seats_data);

    function remove_seats($a, $b)
    {
        $temp = 0;
        foreach ($a as $item) {
            $temp = $temp + $b[$item];
        }
        return $temp;
    }

    $final = array();

    foreach ($students_data as $branch => $students) {
        $remove_seats = remove_seats($restricted_data[$branch], $seats_data);
        $remain = $total_seats - $remove_seats;
        $temp = $restricted_data[$branch];
        $temp2 = $students;
        $temp_array = array();
        foreach ($seats_data as $bran => $seats) {
            if (!in_array($bran, $temp)) {
                $x = round(($seats / $remain) * $students);
                $temp_array[$bran] = $x;
                $temp2 = $temp2 - $x;
                $seats_data[$bran] = $seats_data[$bran] - $x;
            }
        }
        if ($temp2 > 0) {
            asort($temp_array);
            foreach ($temp_array as $bran => $all) {
                if ($temp2 > 0) {
                    $seats_data[$bran] = $seats_data[$bran] - 1;
                    $temp_array[$bran] = $temp_array[$bran] + 1;
                    $temp2 = $temp2 - 1;
                } else {
                    break;
                }
                if($temp2  < 0){
                    $seats_data[$bran] = $seats_data[$bran] + 1;
                    $temp_array[$bran] = $temp_array[$bran] - 1;
                    $temp2 = $temp2 + 1;
                }
                else{
                    break;
                }

            }
        }
        $final[$branch] = $temp_array;
        $total_seats = $total_seats - $students;
    }

    foreach ($final as $branch => $arr) {
        foreach ($arr as $item => $avl) {
            $result = mysqli_query($conn, "INSERT INTO working (branch,elect_branch,avl_seats) VALUES('$branch','$item','$avl')");
        }
    }
} 
?>
