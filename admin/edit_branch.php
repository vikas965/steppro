<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Branch</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
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
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = test_input($_POST["id"]);
        $new_branch_id = test_input($_POST["new_branch_id"]);
        $new_branch_name = test_input($_POST["new_branch_name"]);

        // Update data in the 'branch' table
        $sql_update = "UPDATE branch SET branch_id = '$new_branch_id', branch_name = '$new_branch_name' WHERE id = $id";

        if ($conn->query($sql_update) === TRUE) {
            echo "Record updated successfully!";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    // Fetch branch data for editing
    if (isset($_GET["id"])) {
        $id = test_input($_GET["id"]);

        $sql_select = "SELECT * FROM branch WHERE id = $id";
        $result = $conn->query($sql_select);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "No record found with the given ID.";
            exit();
        }
    } else {
        echo "No ID specified for editing.";
        exit();
    }

    // Close the connection
    $conn->close();
    ?>
<div class="container" style="display: flex;flex-direction: column;">
    <h2>Edit Branch</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">

        <label for="new_branch_id">Branch ID:</label>
        <input type="text" id="new_branch_id" name="new_branch_id" value="<?php echo $row["branch_id"]; ?>" required>

        <label for="new_branch_name">Branch Name:</label>
        <input type="text" id="new_branch_name" name="new_branch_name" value="<?php echo $row["branch_name"]; ?>" required>

        <input type="submit" value="Update">
    </form>
    </div>
</body>

</html>
