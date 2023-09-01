<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "SalesDatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$salesOrderNumber = $_POST["salesOrderNumber"];
$dateOfSale = $_POST["dateOfSale"];
$customerID = $_POST["customerID"];
$goodsID = $_POST["goodsID"]; 
$quantity = $_POST["quantity"];


$sql_price = "SELECT GoodsPrice FROM Goods WHERE GoodsID = '$goodsID'";
$result_price = $conn->query($sql_price);
$row_price = $result_price->fetch_assoc();
$goodsPrice = $row_price["GoodsPrice"];

// Calculate TotalPriceOfOneItem for the current goods
$totalPriceOfOneItem = $goodsPrice * $quantity;

$sql = "INSERT INTO Invoices (SalesOrderNumber, DateOfSale, CustomerID) 
        VALUES ('$salesOrderNumber', '$dateOfSale', '$customerID')";

if ($conn->query($sql) === TRUE) {
    $invoiceID = $conn->insert_id; // Get the InvoiceNumber
    
    // Insert data into Invoice_Items
    $sql_invoice_items = "INSERT INTO Invoice_Items (InvoiceNumber, GoodsID, Quantity, TotalPriceOfOneItem)
                          VALUES ('$invoiceID', '$goodsID', '$quantity', '$totalPriceOfOneItem')";
    
    if ($conn->query($sql_invoice_items) === TRUE) {
        echo "Invoice and Invoice Items created successfully!";
    } else {
        echo "Error inserting Invoice Items: " . $sql_invoice_items . "<br>" . $conn->error;
    }
} else {
    echo "Error creating Invoice: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
