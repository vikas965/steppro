<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Details</title>
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

        input[type="password"],
        input[type="email"] {
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
        $new_jntu = test_input($_POST["new_jntu"]);
        $new_std_year = test_input($_POST["new_std_year"]);
        $new_sem = test_input($_POST["new_sem"]);
        $new_email = test_input($_POST["new_email"]);
        
        
        $new_branch = test_input($_POST["new_branch"]);

        // Update data in the 'std_details' table
        $sql_update = "UPDATE std_details SET 
                        jntu = '$new_jntu', 
                        std_year = $new_std_year, 
                        sem = $new_sem, 
                        email = '$new_email', 
                         
                       
                        branch = '$new_branch' 
                        WHERE id = $id";

        if ($conn->query($sql_update) === TRUE) {
            echo "Record updated successfully!";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    // Fetch data for editing
    if (isset($_GET["id"])) {
        $id = test_input($_GET["id"]);

        $sql_select = "SELECT * FROM std_details WHERE id = $id";
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

    <div class="container" style="display: flex; flex-direction: column; padding-top: 40px;">

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">

        <label for="new_jntu">JNTU:</label>
        <input type="text" id="new_jntu" name="new_jntu" value="<?php echo $row["jntu"]; ?>" required>

        <label for="new_std_year">Year:</label>
        <input type="number" id="new_std_year" name="new_std_year" value="<?php echo $row["std_year"]; ?>" required>

        <label for="new_sem">Semester:</label>
        <input type="number" id="new_sem" name="new_sem" value="<?php echo $row["sem"]; ?>" required>

        <label for="new_email">Email:</label>
        <input type="email" id="new_email" name="new_email" value="<?php echo $row["email"]; ?>" required>

        

       

        <label for="new_branch">Branch:</label>
        <input type="text" id="new_branch" name="new_branch" value="<?php echo $row["branch"]; ?>" required>

        <input type="submit" value="Update">
    </form>

    </div>
</body>

</html>
