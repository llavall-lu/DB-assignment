<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="style.css"> <!-- external CSS file -->
</head>
<body>
    <div class="">
        <?php
      $servername = "localhost"; // Database server name
      $username = "root"; // Database username
      $password = "1234"; // Database password
      $dbname = "SalesDatabase"; // Database name

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {// Check if the connection to the database failed
            die("Connection failed: " . $conn->connect_error);
        }

        $searchTerm = $conn->real_escape_string($_POST["searchTerm"]); // this is to stop SQL injections
        $tableToSearch = $_POST["tableToSearch"];

        $tablesToSearch = array(
            "Customers" => array("CustomerID"),
            "Invoices" => array("CustomerID"),
        );

        if (isset($tablesToSearch[$tableToSearch])) { // Check if the selected table is valid
            $columnsToSearch = implode(", ", $tablesToSearch[$tableToSearch]);
            
            $sql = "SELECT * FROM $tableToSearch WHERE $columnsToSearch = '$searchTerm'"; // SQL query to search the selected table
            $result = $conn->query($sql);

            if ($result !== false && $result->num_rows > 0) {
                echo '<div class="invoice-list">';  // Check if results were found
                echo '<h3>Search Results for ' . $tableToSearch . ':</h3>';

                while ($row = $result->fetch_assoc()) {
                    echo '<div class="invoice-item">';
                    foreach ($row as $columnName => $value) {
                        echo '<p><strong>' . $columnName . ':</strong> ' . $value . '</p>';
                    }
                    echo '</div>';
                }

                echo '</div>'; 
            } else {
                echo '<p>No results found for ' . $tableToSearch . '.</p>'; // Display a message when no results were found
            }
        } else {
            echo '<p>Invalid table selection.</p>';
        }

        $conn->close(); // Close the database connection
        ?>
    </div>
     <a href="search_records.php" class="button">Back to Search</a> 
</body>
</html>
