<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include_once("../LoginRegisterAuthentication/connection.php");
include_once("functions.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher's Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }

        header {
            background-color: #007bff;
            padding: 20px;
            text-align: center;
            color: #fff;
            font-size: 24px;
            width: 100%;
        }

        .sidebar {
            width: 60px; /* Initial sidebar width showing only icons */
            background-color: #333;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            transition: width 0.3s; /* Smooth transition for expansion */
            overflow-x: hidden;
            white-space: nowrap;
        }

        .sidebar:hover {
            width: 250px; /* Expand sidebar on hover */
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .sidebar a span {
            display: none; /* Hide text initially */
            margin-left: 10px;
        }

        .sidebar:hover a span {
            display: inline; /* Show text on hover */
        }

        .main-content {
            margin-left: 60px; /* Adjust based on sidebar's initial width */
            padding: 20px;
            width: calc(100% - 60px); /* Adjust width based on sidebar */
            transition: margin-left 0.3s, width 0.3s; /* Smooth transition */
        }

        .sidebar:hover ~ .main-content {
            margin-left: 250px; /* Shift content when sidebar expands */
            width: calc(100% - 250px);
        }

        .dashboard-header {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            font-size: 32px;
        }

        .form-links {
            position: fixed;
            top: 20px;
            right: 20px;
        }

        .form-links a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <header>
        Teacher's Portal
    </header>
    <div class="sidebar">
        <a href="homepage.php">
            <img src="Images/home-icon.png" alt="Home" style="width:30px;">
            <span>Dashboard</span>
        </a>
        <a href="../crud/Crud.php">
            <img src="Images/students-icon.png" alt="Masterlist" style="width:30px;">
            <span>Masterlist</span>
        </a>
        <a href="grades.php">
            <img src="Images/grades-icon.png" alt="Grades" style="width:30px;">
            <span>Grades</span>
        </a>
        <a href="view_activities.php">
            <img src="Images/activity-icon.png" alt="Activities" style="width:30px;">
            <span>Activities</span>
        </a>
        <a href="manage_user.php">
            <img src="Images/manage-user-icon.png" alt="Manage Users" style="width:30px;">
            <span>Manage Users</span>
        </a>
        <a href="#">
            <img src="Images/files-icon.png" alt="File Server" style="width:30px;">
            <span>File Server</span>
        </a>
        <a href="#">
            <img src="Images/schedule-icon.png" alt="Schedule" style="width:30px;">
            <span>Schedule</span>
        </a>
        <a href="logout.php">
            <span>Logout</span>
        </a>
    </div>
    <div class="main-content">
        <div class="dashboard-header">
            <h2>Welcome Admin</h2>
            <div class="form-links">
                <a href="view_activities.php" class="btn btn-primary">View Activities</a>
                <a href="manage_user.php" class="btn btn-secondary">Manage Users</a>
            </div>
            <!-- Additional content can be added here -->
        </div>
    </div>
</body>
</html>
