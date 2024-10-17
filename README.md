Employee CRUD Management System

This project is a PHP-based Employee Management System that allows users to Create, Read, Update, and Delete (CRUD) employee records. The system efficiently manages employee information such as full name, email, phone number, hire date, job title, and employment status.

Tools & Technologies Used:

PHP: Server-side scripting language for handling CRUD operations.
Bootstrap 5: For creating a responsive and visually appealing form layout.
MySQL: Database used to store and manage employee records.
XAMPP: Development environment for PHP and MySQL.
HTML5/CSS3: For structuring the form and adding custom styles.
JavaScript: Used for client-side form validation and Bootstrap interactivity.
Features:

Add Employee: Create new employee entries with validation checks for required fields and uniqueness for email and phone number.
Update Employee: Edit existing employee details.
Delete Employee: Remove employee records from the system.
Employee List: View a list of all employees with search and filter options.
Setup Instructions:

Clone the repository using git clone <repository_link>.
Place the project in your XAMPP htdocs folder.
Create a database in MySQL workbench and import the provided SQL file.
Modify the database connection settings in the functions.php file.
Run the project using localhost/employee-crud in your browser.
Folder Structure:

/assets: Contains Bootstrap and other front-end assets.
/functions.php: PHP logic for database interactions and validation.
/create.php: Page for adding a new employee.
Setting Up the Database Step 1: Create the Database To set up the database for the Employee Management System, execute the following SQL queries in your MySQL environment (e.g., phpMyAdmin or MySQL command line):

CREATE DATABASE hrm_demo;
USE hrm_demo;

CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone_number VARCHAR(20) UNIQUE,
    hire_date DATE NOT NULL,
    job_title VARCHAR(100) NOT NULL,
    status ENUM('active', 'inactive') NOT NULL
);
This creates a database named hrm_demo and a table named employees with the following columns:

id: Auto-incrementing integer, primary key.
name: Employee's name (not nullable).
mail: Employee's email (not nullable, must be unique).
phone_number: Employee's phone number (optional, must be unique).
hire_date: Date of hire (not nullable).
job_title: Job title of the employee (not nullable).
status: Employment status (can be either 'active' or 'inactive').
File Structure

employee-crud/ ├── assets/ │ └── bootstrap.min.css ├── create.php ├── delete.php ├── edit.php ├── index.php ├── functions.php ├── db.php └── includes/ └── functions.php


---
---

## Database Configuration

### db.php
This file establishes a connection to the MySQL database.

```php
<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root"; // Database username
$password = "Yh3@Wp7#Vc9&Lm1!"; // Database password
$dbname = "hrm_demo"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Don't close the connection here. Keep it open for further use in functions.php
?>
Functionality
1. CRUD Operations
functions.php
This file contains all the functions related to employee operations.

<?php 
include_once 'db.php';

// Get all employees
function getEmployees() {
    global $conn;
    $sql = "SELECT * FROM employees";
    $result = $conn->query($sql);
    if ($result === false) {
        error_log("Error fetching employees: " . $conn->error);  // Log error
        return false;
    }
    return $result;
}

// Create a new employee
function createEmployee($name, $email, $phone_number, $hire_date, $job_title, $status) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO employees (name, email, phone_number, hire_date, job_title, status) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        error_log("Error preparing statement for createEmployee: " . $conn->error);  // Log error
        return false;
    }
    $stmt->bind_param("ssssss", $name, $email, $phone_number, $hire_date, $job_title, $status);
    if ($stmt->execute()) {
        return true;
    } else {
        error_log("Error creating employee: " . $stmt->error);  // Log error
        return false;
    }
}

// Get a specific employee by ID
function getEmployeeById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
    if (!$stmt) {
        error_log("Error preparing statement for getEmployeeById: " . $conn->error);  // Log error
        return false;
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;  // Return false if no employee found
    }
}

// Update employee details
function updateEmployee($id, $name, $email, $phone_number, $hire_date, $job_title, $status) {
    global $conn;
    $stmt = $conn->prepare("UPDATE employees SET name = ?, email = ?, phone_number = ?, hire_date = ?, job_title = ?, status = ? WHERE id = ?");
    if (!$stmt) {
        error_log("Error preparing statement for updateEmployee: " . $conn->error);  // Log error
        return false;
    }
    $stmt->bind_param("ssssssi", $name, $email, $phone_number, $hire_date, $job_title, $status, $id);
    if ($stmt->execute()) {
        return true;
    } else {
        error_log("Error updating employee: " . $stmt->error);  // Log error
        return false;
    }
}

// Delete an employee
function deleteEmployee($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
    if (!$stmt) {
        error_log("Error preparing statement for deleteEmployee: " . $conn->error);  // Log error
        return false;
    }
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        return true;
    } else {
        error_log("Error deleting employee: " . $stmt->error);  // Log error
        return false;
    }
}
?>
2. User Interfaces
index.php
This file displays the list of all employees.

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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
create.php
This file allows users to add new employees.

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
        echo "<div class='alert alert-danger'>All required fields must be filled!</div>";
    } else {
        // Create employee
        if (createEmployee($name, $email, $phone_number, $hire_date, $job_title, $status)) {
            header('Location: index.php');
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error: Employee creation failed!</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Employee</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Add New Employee</h1>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number">
            </div>
            <div class="form-group">
                <label for="hire_date">Hire Date</label>
                <input type="date" class="form-control" id="hire_date" name="hire_date" required>
            </div>
            <div class="form-group">
                <label for="job_title">Job Title</label>
                <input type="text" class="form-control" id="job_title" name="job_title" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Add Employee</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
edit.php
This file allows users to edit existing employee details.

<?php  
include 'C:/xampp/htdocs/employee-crud/functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $employee = getEmployeeById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $hire_date = $_POST['hire_date'];
    $job_title = $_POST['job_title'];
    $status = $_POST['status'];

    // Input validation
    if (empty($name) || empty($email) || empty($hire_date) || empty($job_title) || empty($status)) {
        echo "<div class='alert alert-danger'>All required fields must be filled!</div>";
    } else {
        // Update employee
        if (updateEmployee($id, $name, $email, $phone_number, $hire_date, $job_title, $status)) {
            header('Location: index.php');
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error: Employee update failed!</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Employee</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Edit Employee</h1>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($employee['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($employee['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= htmlspecialchars($employee['phone_number']); ?>">
            </div>
            <div class="form-group">
                <label for="hire_date">Hire Date</label>
                <input type="date" class="form-control" id="hire_date" name="hire_date" value="<?= htmlspecialchars($employee['hire_date']); ?>" required>
            </div>
            <div class="form-group">
                <label for="job_title">Job Title</label>
                <input type="text" class="form-control" id="job_title" name="job_title" value="<?= htmlspecialchars($employee['job_title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Active" <?= $employee['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
                    <option value="Inactive" <?= $employee['status'] == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update Employee</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
delete.php
This file handles the deletion of an employee.

<?php  
include 'C:/xampp/htdocs/employee-crud/functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (deleteEmployee($id)) {
        header('Location: index.php');
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error: Employee deletion failed!</div>";
    }
}
?>
