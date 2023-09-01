<?php
  $servername = "localhost";
  $username = "root";
  $password = "1234";
  $dbname = "SalesDatabase";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve invoice data from the database
$sql = "SELECT i.InvoiceNumber, i.DateOfSale, i.GrandTotal, c.CustomerName 
        FROM Invoices i
        JOIN Customers c ON i.CustomerID = c.CustomerID"; 

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>invoice List</title>
</head>
<body>
    <div class="invoice-list">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="invoice-item">
                <div class="invoice-sender"><?php echo $row["CustomerName"]; ?></div>
                <div class="invoice-subject"><?php echo "Invoice #" . $row["InvoiceNumber"]; ?></div>
                <div class="invoice-date"><?php echo "Date: " . $row["DateOfSale"]; ?></div>
                <div class="invoice-total"><?php echo "Total: $" . $row["GrandTotal"]; ?></div>
            </div>
        <?php } ?>
    </div>
    <a href="forum_invoice.php" class="button">Go to Form</a>
</body>
</html>

<?php
// Close the connection
$conn->close();

?>
