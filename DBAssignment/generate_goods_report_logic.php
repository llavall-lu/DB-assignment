<?php
$servername = "localhost"; // Database server name 
$username = "root"; // Database username
$password = "1234"; // Database password
$dbname = "SalesDatabase"; // Name of the database

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check if the connection to the database was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);// Print an error message and exit if the connection fails
}

$startDate = $_POST["startDate"];// Get the start and end date from a form submitted via POST
$endDate = $_POST["endDate"];
// SQL query to retrieve data from the database
$sql = "SELECT
            g.GoodsDescription,
            SUM(ii.Quantity) AS TotalQuantitySold,
            SUM(ii.TotalPriceOfOneItem) AS TotalRevenue
        FROM
            Invoices i
        JOIN
            Invoice_Items ii ON i.InvoiceNumber = ii.InvoiceNumber
        JOIN
            Goods g ON ii.GoodsID = g.GoodsID
        WHERE
            i.DateOfSale BETWEEN '$startDate' AND '$endDate'
        GROUP BY
            g.GoodsDescription
        ORDER BY
            TotalRevenue DESC"; // Order the results by TotalRevenue in descending order

$result = $conn->query($sql); // Execute the SQL query and store the result

$conn->close(); // Close the database connection
?>