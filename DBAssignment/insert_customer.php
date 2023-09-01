<?php
$servername = "localhost"; // Database server name
$username = "root"; // Database username
$password = "1234"; // Database password
$dbname = "SalesDatabase"; // Name of the database

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection to the database was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Print an error message and exit if the connection fails
}

$customerName = $_POST["customerName"]; // Get the customer's name address and phone number from a form submitted via POST
$customerAddress = $_POST["customerAddress"]; 
$customerPhoneNumber = $_POST["customerPhoneNumber"];

// SQL query to check if a customer with the same name and phone number already exists
$checkDuplicateQuery = "SELECT CustomerID FROM Customers WHERE CustomerName = '$customerName' AND CustomerPhoneNumber = '$customerPhoneNumber'";

// Execute the query to check for duplicates
$result = $conn->query($checkDuplicateQuery);

if ($result->num_rows > 0) {
    echo "Error: Customer with the same name or phone number already exists."; // Print an error message in duplicate
} else {
    // If no duplicate customer is found, insert the new customer into the database
    $sql = "INSERT INTO Customers (CustomerName, CustomerAddress, CustomerPhoneNumber) 
            VALUES ('$customerName', '$customerAddress', '$customerPhoneNumber')"; // SQL query to insert the new customer

    // Execute the SQL query to insert the new customer into the database
    if ($conn->query($sql) === TRUE) {
        echo "Customer added successfully!"; // Print a success message if successful
    } else {
        echo "Error adding customer: " . $sql . "<br>" . $conn->error; // Print an error message if failed
    }
}

$conn->close(); // Close the database connection
?>
