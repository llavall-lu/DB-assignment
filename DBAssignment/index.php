<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date-Based Sales Report</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to the external CSS file -->

     <!-- Sticky dropdown menu for database navigation -->
    <div class="sticky-dropdown">
        <div class="dropdown">
            <button class="dropdown-button">DB Navigation</button>
            <div class="dropdown-content">
                 <a href="index.php">DB Sales report</a> <!-- Form to generate sales report -->
                <a href="forum_customer.php">Add Customer</a>
                <a href="forum_invoice.php">Invoices Creation</a>
                <a href="search_records.php">User lookup</a>
            </div>
        </div>
    </div>
</head>
<body>
    <div class="container"> 
        <h2>Date-Based Sales Report</h2>
        <form action="index.php" method="post"> 
            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate" required><br>
            
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate" required><br>
            
            <input type="submit" name="generateReport" value="Generate Report">  <!-- Button to submit report -->
        </form>
    </div>
    
    <!-- Goods Sales Report -->
    <div class="report-section">
        <?php
        if (isset($_POST["generateReport"])) {
            include 'generate_goods_report_logic.php'; // link to external file
            if ($result !== false && $result->num_rows > 0) {
                echo '<div class="invoice-list">';
                echo '<h3>Goods Sales Analyst Report</h3>';
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="invoice-item">';
                    echo '<div class="invoice-subject">' . $row["GoodsDescription"] . '</div>';
                    echo '<div class="invoice-subject">Total Quantity Sold: ' . $row["TotalQuantitySold"] . '</div>';
                    echo '<div class="invoice-subject">Total Revenue: £' . $row["TotalRevenue"] . '</div>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo '<p>No results found.</p>';
            }
        }
        ?>
    </div>
     <!-- Invoice Sales Report -->
    <div class="report-section"> 
        <?php
        if (isset($_POST["generateReport"])) {
            include 'generate_report_logic.php'; // link to external file
            if ($result !== false && $result->num_rows > 0) {
                echo '<div class="invoice-list">';
                echo '<h3>Invoice Sales Report</h3>';
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="invoice-item">';
                    echo '<div class="invoice-sender">' . $row["CustomerName"] . '</div>';
                    echo '<div class="invoice-subject">Invoice Number: ' . $row["InvoiceNumber"] . '</div>';
                    echo '<div class="invoice-date">Date of Sale: ' . $row["DateOfSale"] . '</div>';
                    echo '<div class="invoice-subject">Subtotal: £' . $row["Subtotal"] . '</div>';
                    echo '<div class="invoice-subject">VAT: £' . $row["VAT"] . '</div>';
                    echo '<div class="invoice-subject">Postage and Packaging: £' . $row["PostageAndPackaging"] . '</div>';
                    echo '<div class="invoice-subject">Grand Total: £' . $row["GrandTotal"] . '</div>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo '<p>No results found.</p>';
            }
        }
        ?>
    </div>
</body>
</html>
