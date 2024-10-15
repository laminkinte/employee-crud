<?php
include 'C:/xampp/htdocs/employee-crud/functions.php';

// Get the employee ID from the URL
$id = $_GET['id'];

// Delete the employee
if (deleteEmployee($id)) {
    header('Location: index.php');
}
?><?php
include '../includes/functions.php';

// Check if 'id' parameter is set and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Get the employee ID from the URL
    $id = intval($_GET['id']); // Sanitize input to ensure it's an integer
    
    // Delete the employee
    if (deleteEmployee($id)) {
        // Redirect to index.php after successful deletion
        header('Location: index.php');
        exit(); // Make sure to exit after redirection
    } else {
        echo "Error: Failed to delete employee.";
    }
} else {
    echo "Invalid employee ID.";
}
?>

