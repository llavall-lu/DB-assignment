<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
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
        <h2>Add Customer</h2>
        <form action="insert_customer.php" method="post"> <!-- Form to add a new customer -->
            <label for="customerName">Customer Name:</label> 
            <input type="text" id="customerName" name="customerName" required><br><br> <!-- Input field for customer name -->
            
            <label for="customerAddress">Customer Address:</label> 
            <input type="text" id="customerAddress" name="customerAddress" required><br><br> <!-- Input field for customer address -->
            
            <label for="customerPhoneNumber">Customer Phone Number:</label> 
            <input type="text" id="customerPhoneNumber" name="customerPhoneNumber" required><br><br> <!-- Input field for customer phone number -->
            
            <input type="submit" value="Add Customer"> <!-- Submit button to add the customer -->
            <a href="forum_invoice.php" class="addCustomerBtn">Back to invoice</a> <!-- Button to go back to the invoice page -->
        </form>
    </div>
    
    <a href="index.php" class="button">Back to main page</a> <!-- Button to go back to the main page -->
</body>
</html>
