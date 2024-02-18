<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Elective Course</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Add Elective Course</h2>

        <!-- Bootstrap Form for Data Entry -->
        <form action="" method="post">
            <div class="form-group">
                <label for="courseId">Course ID:</label>
                <input type="text" class="form-control" name="courseId" required>
            </div>

            <div class="form-group">
                <label for="branchId">Branch ID:</label>
                <input type="text" class="form-control" name="branchId" required>
            </div>

            <div class="form-group">
                <label for="courseName">Course Name:</label>
                <input type="text" class="form-control" name="courseName" required>
            </div>

            <div class="form-group">
                <label for="semester">Semester:</label>
                <input type="number" class="form-control" name="semester" required>
            </div>

            <div class="form-group">
                <label for="noSeats">Number of Seats:</label>
                <input type="number" class="form-control" name="noSeats" required>
            </div>

            <div class="form-group">
                <label for="refinedBranch">Refined Branch:</label>
                <input type="text" class="form-control" name="refinedBranch" required>
            </div>

            <div class="form-group">
                <label for="stdCountBranch">Student Count Branch:</label>
                <input type="number" class="form-control" name="stdCountBranch" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Add Course</button>
        </form>
    </div>

    <?php
    // Include your database connection file (db.php)
    include('db.php');

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get form data
        $courseId = $_POST['courseId'];
        $branchId = $_POST['branchId'];
        $courseName = $_POST['courseName'];
        $semester = $_POST['semester'];
        $noSeats = $_POST['noSeats'];
        $refinedBranch = $_POST['refinedBranch'];
        $stdCountBranch = $_POST['stdCountBranch'];

        // Insert data into 'electives' table
        $sql = "INSERT INTO electives (course_id, branch_id, course_name, semester, no_seats, refined_branch, std_count_branch) 
                VALUES ('$courseId', '$branchId', '$courseName', $semester, $noSeats, '$refinedBranch', $stdCountBranch)";

        // Perform the query
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Course added successfully!')</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "')</script>";
        }
    }
    ?>

</body>

</html>
