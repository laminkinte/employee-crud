Employee CRUD Management System

This project is a PHP-based Employee Management System that allows users to Create, Read, Update, and Delete (CRUD) employee records. The system efficiently manages employee information such as full name, email, phone number, hire date, job title, and employment status. 

Tools & Technologies Used:
- PHP: Server-side scripting language for handling CRUD operations.
- Bootstrap 5: For creating a responsive and visually appealing form layout.
- MySQL: Database used to store and manage employee records.
- XAMPP: Development environment for PHP and MySQL.
- HTML5/CSS3: For structuring the form and adding custom styles.
- **JavaScript**: Used for client-side form validation and Bootstrap interactivity.

Features:
- Add Employee: Create new employee entries with validation checks for required fields and uniqueness for email and phone number.
- Update Employee: Edit existing employee details.
- **Delete Employee: Remove employee records from the system.
- Employee List: View a list of all employees with search and filter options.
  
Setup Instructions:
1. Clone the repository using `git clone <repository_link>`.
2. Place the project in your XAMPP `htdocs` folder.
3. Create a database in MySQL workbench and import the provided SQL file.
4. Modify the **database connection** settings in the `functions.php` file.
5. Run the project using `localhost/employee-crud` in your browser.

Folder Structure:
- `/assets`: Contains Bootstrap and other front-end assets.
- `/functions.php`: PHP logic for database interactions and validation.
- `/create.php`: Page for adding a new employee.
