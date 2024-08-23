<?php
session_start(); // Start the session at the very top

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<?php include('headerforreports.php'); ?>
<?php include("../LoginRegisterAuthentication/connection.php"); ?>

<?php
// Get the student ID from the query string
$student_id = isset($_GET['id']) ? intval($_GET['id']) : '';

// SQL query to fetch student details and grades
$query = "SELECT s.*, sg.*
          FROM students s 
          JOIN student_grades sg ON s.id = sg.student_id
          WHERE s.id = '$student_id'";

$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

// Fetch the student details
$student = mysqli_fetch_assoc($result);
?>

<div class="container mt-5">
    <h2 class="text-center"></h2>
    <p class="text-center"><strong>REGION VII SCHOOL NAME: LANAO NATIONAL HIGHSCHOOL DIVISION CEBU PROVINCE SCHOOL ID: <?php echo htmlspecialchars($student['school_id']); ?> SCHOOL YEAR: <?php echo htmlspecialchars($student['school_year']); ?></strong></p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Learners Full Name</th>
                <th>Grade & Section</th>
                <th>Teacher</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo htmlspecialchars($student['id']); ?></td>
                <td><?php echo htmlspecialchars($student['learners_name']); ?></td>
                <td><?php echo htmlspecialchars($student['grade'] . ' - ' . $student['section']); ?></td>
                <td><?php // Display teacher name if applicable; otherwise leave blank or handle as needed ?></td>
            </tr>
        </tbody>
    </table>

    <h4>Subject Grades:</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Written Exam</th>
                <th>Performance Task</th>
                <th>Quarterly Exam</th>
                <th>Final Grade</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo htmlspecialchars($student['subject']); ?></td>
                <td><?php echo htmlspecialchars($student['written_exam']); ?></td>
                <td><?php echo htmlspecialchars($student['performance_task']); ?></td>
                <td><?php echo htmlspecialchars($student['quarterly_exam']); ?></td>
                <td><?php echo htmlspecialchars($student['final_grade']); ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Buttons -->
    <div class="text-center mt-4">
        <a href="javascript:window.print()" class="btn btn-primary print-btn">Print Form</a>
        <a href="r.php" class="btn btn-secondary">Back to Report</a>
    </div>
</div>

<!-- CSS to hide buttons in print view -->
<style>
@media print {
    .print-btn,
    .btn-success,
    .btn-secondary {
        display: none;
    }
}
</style>

<?php include('../crud/footer.php'); ?>
