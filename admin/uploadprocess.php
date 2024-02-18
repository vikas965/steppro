
<!DOCTYPE html>
<html lang="en">

<body>
    <style>
        * {
  font-family: sans-serif; /* Change your font family */
}
    
    
    .content-table {
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 0.9em;
  min-width: 400px;
  border-radius: 5px 5px 0 0;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.content-table thead tr {
  background-color: #009879;
  color: #ffffff;
  text-align: left;
  font-weight: bold;
}

.content-table th,
.content-table td {
  padding: 12px 15px;
}

.content-table tbody tr {
  border-bottom: 1px solid #dddddd;
}

.content-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.content-table tbody tr:last-of-type {
  border-bottom: 2px solid #009879;
}

.content-table tbody tr.active-row {
  font-weight: bold;
  color: #009879;
}

</style>

<?php 


require 'vendor/autoload.php';
include('db.php');

use PhpOffice\PhpSpreadsheet\IOFactory;


function displayTableData($sheetData) {
    echo '<h2>Table Data</h2>';
    echo '<table border="1">';
    foreach ($sheetData as $row) {
        echo '<tr>';
        foreach ($row as $cell) {
            echo '<td>' . $cell . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}








function storeInDatabase($sheetData) {
    $servername = "localhost";
    $username = "root";
    $password = "vikas9652021978";
    $database = "stepcone";
    $con = mysqli_connect($servername,$username,$password,$database);

        
    foreach ($sheetData as $row) {
       
        
        $column1 = mysqli_real_escape_string($con, $row['A']);
        $column2 = mysqli_real_escape_string($con, $row['B']);
        $column3 = mysqli_real_escape_string($con, $row['C']);
        $column4 = mysqli_real_escape_string($con, $row['D']);
        $column5 = mysqli_real_escape_string($con, $row['E']);

        
        $sql = "INSERT INTO  std_details(jntu,std_year,sem,email,branch) VALUES('$column1',$column2,$column3,'$column4','$column5')";

        $insert_que = mysqli_query($con,$sql);
        
    }

    

    echo "<script>alert('Data Uploaded succesfully')</script>";

   
}










if(isset($_POST['addques']))
{   

    
   
    

    if ($_FILES['que']['name']) {
        $filename = explode('.', $_FILES['que']['name']);
        if ($filename[1] == 'xls' || $filename[1] == 'xlsx') {
            $spreadsheet = IOFactory::load($_FILES['que']['tmp_name']);
            // $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $sheetData = $spreadsheet->getActiveSheet()->rangeToArray('A2:' . $spreadsheet->getActiveSheet()->getHighestColumn() . $spreadsheet->getActiveSheet()->getHighestRow(), null, true, true, true);

            
            storeInDatabase($sheetData);
        } else {
            echo "Invalid file format. Please upload an Excel file.";
        }
    } else {
        echo "Please choose a file";
    }

    

}


?>

</body>
</html>
