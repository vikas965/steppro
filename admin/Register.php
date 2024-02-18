<?php
// Connection parameters
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $mail = $_POST["mail"];
    $number = $_POST["number"];
    $password = $_POST["password"];

    // Insert data into the 'admin' table
    $sql = "INSERT INTO admin (name, mail, number, password) VALUES ('$name', '$mail', $number, '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
</head>
<body>

<h2>Admin Registration</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="mail" required><br>
    Number: <input type="number" name="number" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Register">
</form>

</body>
</html>
