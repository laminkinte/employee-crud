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
        // Check if email or phone number is already in use
        if (emailExists($email)) {
            echo "<div class='alert alert-danger'>Error: Email is already in use!</div>";
        } elseif (!empty($phone_number) && phoneNumberExists($phone_number)) {
            echo "<div class='alert alert-danger'>Error: Phone number is already in use!</div>";
        } else {
            // Create new employee
            if (createEmployee($name, $email, $phone_number, $hire_date, $job_title, $status)) {
                header('Location: index.php');
                exit();
            } else {
                echo "<div class='alert alert-danger'>Error: Employee creation failed!</div>";
            }
        }
    }
}

function emailExists($email) {
    return false; // Replace with actual check
}

function phoneNumberExists($phone_number) {
    return false; // Replace with actual check
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Full Bootstrap CDN for CSS and JS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Employee</title>

    <style>
        body {
            background-color: #e9ecef; /* Soft background color */
            padding-top: 40px;
        }

        .form-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }

        h1 {
            color: #343a40;
            font-size: 32px;s
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
            padding-top: 3px;
            color: blue;
        }

        label {
            font-size: 20px; /* Increased font size for labels */
            color: #495057;
        }

        input, select {
            font-size: 20px; /* Larger input font */
            padding: 12px;   /* Increased padding for inputs */
            width:  93%;     /* Set inputs to full width */
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            font-size: 20px;
            padding: 12px 20px;
            width: 100%;
            color:whitesmoke;

        }

        .btn-primary:hover {
            background-color: #0056b3;

        }

        .form-select {
            padding: 12px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add New Employee</h1>
        <form action="create.php" method="POST" class="needs-validation" novalidate>
            <label for="name" class="form-label">Full Name:</label> <div></div>
            <input type="text" class="form-control" id="name" name="name" required>
            <div></div>
            <label for="email" class="form-label">Email:</label> <div></div>
            <input type="email" class="form-control" id="email" name="email" required>
            
            <div></div>
            <label for="phone_number" class="form-label">Phone Number:</label> <div></div>
            <input type="text" class="form-control" id="phone_number" name="phone_number">
             <div></div>
            <label for="hire_date" class="form-label">Hire Date:</label>  <div></div>
            <input type="date" class="form-control" id="hire_date" name="hire_date" required>
             <div></div>

            <label for="job_title" class="form-label">Job Title:</label> <div></div>
            <input type="text" class="form-control" id="job_title" name="job_title" required>
             <div></div>

            <label for="status" class="form-label">Status:</label>  <div></div>
            <select class="form-select" id="status" name="status" required>
                <option value="">Choose...</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            

            <button type="submit" class="btn btn-primary"><b>Add Employee</b></button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js for interactivity -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

    <!-- Bootstrap form validation script -->
    <script>
        (function () {
            'use strict'

            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>

