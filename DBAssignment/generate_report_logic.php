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

$startDate = $_POST["startDate"]; // Get the start ad end date from a form submitted via POST
$endDate = $_POST["endDate"];
// SQL query to retrieve data from the database
$sql = "SELECT
            i.InvoiceNumber,
            i.DateOfSale,
            c.CustomerName,
            SUM(ii.TotalPriceOfOneItem) AS Subtotal,
            i.VAT,
            i.PostageAndPackaging,
            i.GrandTotal
        FROM
            Invoices i
        JOIN
            Customers c ON i.CustomerID = c.CustomerID
        JOIN
            Invoice_Items ii ON i.InvoiceNumber = ii.InvoiceNumber
        WHERE
            i.DateOfSale BETWEEN '$startDate' AND '$endDate'
        GROUP BY
            i.InvoiceNumber, i.DateOfSale, c.CustomerName, i.VAT, i.PostageAndPackaging, i.GrandTotal
        ORDER BY
            i.DateOfSale";// Order the results by DateOfSale

$result = $conn->query($sql); // Execute the SQL query and store the result

$conn->close(); // Close the database connection
?>