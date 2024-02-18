<?php
// Connection parameters
include('db.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for form data and error messages
$branch_id = $branch_name = "";
$branch_idErr = $branch_nameErr = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and validate form data
    $branch_id = test_input($_POST["branch_id"]);
    $branch_name = test_input($_POST["branch_name"]);

    // Validate branch_id
    if (empty($branch_id)) {
        $branch_idErr = "Branch ID is required";
    }

    // Validate branch_name
    if (empty($branch_name)) {
        $branch_nameErr = "Branch Name is required";
    }

    // If no errors, insert data into the 'branch' table
    if (empty($branch_idErr) && empty($branch_nameErr)) {
        $sql = "INSERT INTO branch (branch_id, branch_name) VALUES ($branch_id, '$branch_name')";

        if ($conn->query($sql) === TRUE) {
            echo "Data inserted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the connection
$conn->close();

// Function to sanitize and validate form data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data into 'branch' Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            text-align: center;
        }

        input {
            margin-bottom: 10px;
        }

        span {
            color: red;
        }

        .container{
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            text-align: start;
        }
    </style>
</head>

<body>

    <div class="container" style=" padding: 20px; ">
    <h2>ADD BRANCH</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Branch ID: <input type="text" name="branch_id" required>
    <span><?php echo $branch_idErr; ?></span><br>

    Branch Name: <input type="text" name="branch_name" required>
    <span><?php echo $branch_nameErr; ?></span><br>

    <input type="submit" value="ADD BRANCH">
</form>
    </div>

</body>

</html>
