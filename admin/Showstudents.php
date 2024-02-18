<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>

    <div class="container">
<button id="btn-download" style="margin: 30px;" class="btn btn-success">Download</button>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "vikas9652021978";
    $database = "stepcone";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to sanitize and validate form data
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Handle edit and delete operations
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["edit"])) {
            // Redirect to an edit page or handle the edit operation
            header("Location: edit_std_details.php?id=" . $_POST["edit"]);
            exit();
        } elseif (isset($_POST["delete"])) {
            $id = test_input($_POST["delete"]);

            // Perform delete operation
            $sql_delete = "DELETE FROM std_details WHERE id = $id";

            if ($conn->query($sql_delete) === TRUE) {
                echo "Record deleted successfully!";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }
    }
  
    // Fetch data from the 'std_details' table
    $sql_select = "SELECT * FROM std_details";
    $result = $conn->query($sql_select);

    // Display data in a Bootstrap table
    echo "<table id='table' class='table table-bordered'>";
    echo "<thead class='thead-dark'><tr><th>ID</th><th>JNTU</th><th>Year</th><th>Semester</th><th>Email</th><th>Selected Branch</th><th>Branch</th><th>Edit</th><th>Delete</th></tr></thead>";
    echo "<tbody>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["jntu"] . "</td>";
            echo "<td>" . $row["std_year"] . "</td>";
            echo "<td>" . $row["sem"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["selected_branch"] . "</td>";
            
            echo "<td>" . $row["branch"] . "</td>";
            echo "<td>
                <form method='post'>
                    <input type='hidden' name='edit' value='" . $row["id"] . "'>
                    <button type='submit' class='btn btn-warning'>Edit</button>
                </form>
              </td>";
            echo "<td>
                <form method='post'>
                    <input type='hidden' name='delete' value='" . $row["id"] . "'>
                    <button type='submit' class='btn btn-danger'>Delete</button>
                </form>
              </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No records found</td></tr>";
    }

    echo "</tbody></table>";

    // Close the connection
    $conn->close();
    ?>
</div>
   
    <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

    <script>
        var currentdate = new Date();
        var datetime = currentdate.getDate() + "-" +
            (currentdate.getMonth() + 1) + "-" +
            currentdate.getFullYear() + " " +
            currentdate.getHours() + "_" +
            currentdate.getMinutes() + "_" +
            currentdate.getSeconds();
        $('#btn-download').click(function () {
            $("#table").table2excel({
                exclude: ".noExport",
                filename: "std_details " + datetime,
            });
        });
    </script>
</body>

</html>
