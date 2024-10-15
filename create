<?php 
include 'C:/xampp/htdocs/employee-crud/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $hire_date = $_POST['hire_date'];
    $job_title = $_POST['job_title'];
    $status = $_POST['status'];

    // Input validation
    if (empty($name) || empty($email) || empty($hire_date) || empty($job_title) || empty($status)) {
        echo "All required fields must be filled!";
    } else {
        // Check if email or phone number is already in use
        if (emailExists($email)) {
            echo "Error: Email is already in use!";
        } elseif (!empty($phone_number) && phoneNumberExists($phone_number)) {
            echo "Error: Phone number is already in use!";
        } else {
            // Create new employee
            if (createEmployee($name, $email, $phone_number, $hire_date, $job_title, $status)) {
                header('Location: index.php');
                exit();
            } else {
                echo "Error: Employee creation failed!";
            }
        }
    }
}

// Function to check if email already exists
function emailExists($email) {
    // Add your SQL query to check for existing emails
    // Example: SELECT COUNT(*) FROM employees WHERE email = :email
    return false; // Replace with actual check
}

// Function to check if phone number already exists
function phoneNumberExists($phone_number) {
    // Add your SQL query to check for existing phone numbers
    return false; // Replace with actual check
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap.min.css" rel="stylesheet">
    <title>Add Employee</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Add New Employee</h1>
        <form action="create.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number">
            </div>
            <div class="mb-3">
                <label for="hire_date" class="form-label">Hire Date</label>
                <input type="date" class="form-control" id="hire_date" name="hire_date" required>
            </div>
            <div class="mb-3">
                <label for="job_title" class="form-label">Job Title</label>
                <input type="text" class="form-control" id="job_title" name="job_title" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Employee</button>
        </form>
    </div>
</body>
</html>
