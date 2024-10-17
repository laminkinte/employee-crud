<?php 
// Include functions file for CRUD operations
include 'C:/xampp/htdocs/employee-crud/functions.php';

// Fetch all employees
$employees = getEmployees();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> <!-- Ensure this path is correct -->
    <title>Employee Management</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Employee List</h1>
        <a href="create.php" class="btn btn-success mb-2">Add New Employee</a>
        
        <!-- Check if $employees is a valid result -->
        <?php if ($employees && $employees->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Hire Date</th>
                        <th>Job Title</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $employees->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['phone_number']); ?></td>
                            <td><?= htmlspecialchars($row['hire_date']); ?></td>
                            <td><?= htmlspecialchars($row['job_title']); ?></td>
                            <td><?= htmlspecialchars($row['status']); ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning">No employees found.</div>
        <?php endif; ?>
    </div>

    <!-- Optionally include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
