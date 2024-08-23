<?php
session_start(); // Start the session at the very beginning

include_once("../LoginRegisterAuthentication/connection.php");
include_once("functions.php");
include_once("../crud/header.php");



// Handle Update Request
if (isset($_POST['update'])) {
    $userid = $_POST['userid'];
    $data = [
        'name' => $_POST['name'],
        'username' => $_POST['username'],
        
        'address' => $_POST['address'],
        'role' => $_POST['role']
    ];
    updateUserData($connection, $userid, $data);
}

// Handle Delete Request
if (isset($_POST['delete'])) {
    $userid = $_POST['userid'];
    deleteUser($connection, $userid);
    header("Location: manage_user.php"); // Redirect after deletion
    exit();
}

// Fetch all users
$query = "SELECT * FROM user";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        .form-container {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Users</h1>

        <!-- User Management Form -->
        <div class="form-container">
            <h2>Edit User</h2>
            <?php if (isset($_GET['user_id'])): ?>
                <?php
                $userid = $_GET['user_id'];
                $userQuery = "SELECT * FROM user WHERE userid = ?";
                $stmt = $connection->prepare($userQuery);
                $stmt->bind_param("i", $userid);
                $stmt->execute();
                $userData = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                ?>
                <?php if ($userData): ?>
                    <form method="POST">
                        <input type="hidden" name="userid" value="<?php echo htmlspecialchars($userData['userid']); ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($userData['name']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($userData['username']); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($userData['address']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role:</label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="user" <?php if ($userData['role'] === 'user') echo 'selected'; ?>>User</option>
                                <option value="admin" <?php if ($userData['role'] === 'admin') echo 'selected'; ?>>Admin</option>
                            </select>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary">Update User</button>
                    </form>
                    <form method="POST" class="mt-3">
                        <input type="hidden" name="userid" value="<?php echo htmlspecialchars($userData['userid']); ?>">
                        <button type="submit" name="delete" class="btn btn-danger">Delete User</button>
                    </form>
                <?php else: ?>
                    <p>User not found.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- User Table -->
        <div class="table-container">
            <h2>User List</h2>
            <table id="userTable" class="display">
                <thead>
                    <tr>
                        <th>Userid</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['userid']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                         
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                            <td>
                                <a href="manage_user.php?user_id=<?php echo htmlspecialchars($row['userid']); ?>" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable();
        });
    </script>
</body>
</html>
<?php include_once("../crud/footer.php"); ?>
