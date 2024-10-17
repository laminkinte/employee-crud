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
