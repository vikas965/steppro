<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
<style>
    .container{
        padding: 30px;
    }
</style>
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
            header("Location: edit_electives.php?id=" . $_POST["edit"]);
            exit();
        } elseif (isset($_POST["delete"])) {
            $id = test_input($_POST["delete"]);

            // Perform delete operation
            $sql_delete = "DELETE FROM electives WHERE id = $id";

            if ($conn->query($sql_delete) === TRUE) {
                echo "Record deleted successfully!";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }
    }

    // Fetch data from the 'electives' table
    $sql_select = "SELECT * FROM electives";
    $result = $conn->query($sql_select);

    // Display data in a Bootstrap table
    echo "<table id='table' class='table table-bordered'>";
    echo "<thead class='thead-dark'><tr><th>ID</th><th>Course ID</th><th>Branch ID</th><th>Course Name</th><th>Semester</th><th>No of Seats</th><th>Refined Branch</th><th>Student Count Branch</th><th>Edit</th><th>Delete</th></tr></thead>";
    echo "<tbody>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["course_id"] . "</td>";
            echo "<td>" . $row["branch_id"] . "</td>";
            echo "<td>" . $row["course_name"] . "</td>";
            echo "<td>" . $row["semester"] . "</td>";
            echo "<td>" . $row["no_seats"] . "</td>";
            echo "<td>" . $row["refined_branch"] . "</td>";
            echo "<td>" . $row["std_count_branch"] . "</td>";
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
                filename: "electives " + datetime,
            });
        });
    </script>
</body>

</html>
