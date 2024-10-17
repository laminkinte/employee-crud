<?php
include 'C:/xampp/htdocs/employee-crud/functions.php';

// Get the employee ID from the URL and ensure it's valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $employee = getEmployeeById($id);

    if (!$employee) {
        // Handle the case where the employee does not exist
        echo "Employee not found!";
        exit();
    }

    // Handle the form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $hire_date = $_POST['hire_date'];
        $job_title = $_POST['job_title'];
        $status = $_POST['status'];

        // Update the employee details with validation
        if (updateEmployee($id, $name, $email, $phone_number, $hire_date, $job_title, $status)) {
            header('Location: index.php'); // Redirect to index after success
            exit(); // Always exit after redirection to stop further execution
        } else {
            echo "Failed to update employee.";
        }
    }
} else {
    echo "Invalid Employee ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap.min.css" rel="stylesheet">
    <title>Edit Employee</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Edit Employee</h1>
        <form action="edit.php?id=<?= htmlspecialchars($employee['id']); ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($employee['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($employee['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= htmlspecialchars($employee['phone_number']); ?>">
            </div>
            <div class="mb-3">
                <label for="hire_date" class="form-label">Hire Date</label>
                <input type="date" class="form-control" id="hire_date" name="hire_date" value="<?= htmlspecialchars($employee['hire_date']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="job_title" class="form-label">Job Title</label>
                <input type="text" class="form-control" id="job_title" name="job_title" value="<?= htmlspecialchars($employee['job_title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="active" <?= $employee['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                    <option value="inactive" <?= $employee['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Employee</button>
        </form>
    </div>
</body>
</html>
