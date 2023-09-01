<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Invoice</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to the external CSS file -->
    
    <!-- Sticky dropdown menu for navigation -->
    <div class="sticky-dropdown">
        <div class="dropdown">
            <button class="dropdown-button">DB Navigation</button> <!-- Dropdown button -->
            <div class="dropdown-content">
                 <a href="index.php">DB Sales report</a> <!-- Links to other pages -->
                <a href="forum_customer.php">Add Customer</a>
                <a href="forum_invoice.php">Invoices Creation</a>
                <a href="search_records.php">User lookup</a>
            </div>
        </div>
    </div>
</head>
<body>
    
    <div class="container">
        <h2>Create Invoice</h2>
        <form action="insert_invoice.php" method="post"> <!-- Form to create a new invoice -->
            
            <!-- Input for Sales Order Number -->
            <label for="salesOrderNumber">Sales Order Number:</label>
            <input type="text" id="salesOrderNumber" name="salesOrderNumber" required><br><br>
            
            <!-- Input for Date of Sale -->
            <label for="dateOfSale">Date of Sale:</label>
            <input type="date" id="dateOfSale" name="dateOfSale" required><br><br>
            
            <!-- Select dropdown to choose a customer from the database -->
            <label for="customerID">Select Customer:</label>
            <select id="customerID" name="customerID">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "1234";
                $dbname = "SalesDatabase";
                 
                $conn = new mysqli($servername, $username, $password, $dbname);
    
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
    
                $sql = "SELECT CustomerID, CustomerName FROM Customers";
                $result = $conn->query($sql);
    
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["CustomerID"] . "'>" . $row["CustomerName"] . "</option>";
                }
    
                $conn->close();
                ?>
            </select><br><br>
            
            <!-- Select dropdown to choose goods from the database -->
            <label for="goodsID">Select Goods:</label>
            <select id="goodsID" name="goodsID">
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);
    
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
    
                $sql = "SELECT GoodsID, GoodsDescription FROM Goods";
                $result = $conn->query($sql);
    
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["GoodsID"] . "'>" . $row["GoodsDescription"] . "</option>";
                }
    
                $conn->close();
                ?>
            </select><br><br>
            
            <!-- Input for quantity -->
            <label for="quantity">Quantity:</label>
            <input type="text" id="quantity" name="quantity" required><br><br>
            
            <input type="submit" value="Create Invoice"> <!-- Submit button to create the invoice -->
            <a href="forum_customer.php" class="addCustomerBtn">Add Customer to DB</a> <!-- Button to add a customer to the database -->
        </form>
    </div>
    <a href="Index.php" class="button">Back to main page</a> <!-- Button to go back to the main page -->
</body>
</html>
