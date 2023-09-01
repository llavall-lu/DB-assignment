<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Records</title>
    <link rel="stylesheet" href="style.css"> <!-- external CSS file -->
    <div class="sticky-dropdown">
        <div class="dropdown"><!-- sticky Dropdown menu -->
            <button class="dropdown-button">DB Navigation</button>
            <div class="dropdown-content">
                 <a href="index.php">DB Sales report</a>
                <a href="forum_customer.php">Add Customer</a>
                <a href="forum_invoice.php">Invoices Creation</a>
                <a href="search_records.php">User lookup</a>
            </div>
        </div>
    </div>
</head>
<body>
    <div class="container"><!-- Container for the main content -->
        <h2>Search Records</h2>
        <form action="search_results.php" method="post"><!-- Form to submit search parameters to search_results.php -->
            <label for="searchTerm">Search CustomerID:</label>
            <input type="text" id="searchTerm" name="searchTerm" required><br><!-- Input for entering the search term -->

            <label for="tableToSearch">Select Table:</label>
            <select id="tableToSearch" name="tableToSearch"><!-- Dropdown menu for selecting the table to search -->
                <option value="Customers">Customers</option>
                <option value="Invoices">Invoices</option>
            </select><br>

            <input type="submit" name="search" value="Search"><!-- Submit button to start the search -->
        </form>
    </div>
</body>
</html>
