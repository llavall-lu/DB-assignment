<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date-Based Sales Report</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to the external CSS file -->
</head>
<body>
    <div class="container"> <!-- Apply the "container" class here -->
        <h2>Date-Based Sales Report</h2>
        <form action="" method="post"> <!-- Remove the action to submit to the same page -->
            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate" required><br>
            
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate" required><br>
            
            <input type="submit" name="generateReport" value="Generate Report">
        </form>
    </div>
    
    <!-- Display the report data here -->
    <div class="invoice-list"> <!-- Apply the "invoice-list" class here -->
        <?php
        if (isset($_POST["generateReport"])) {
            include 'generate_report_logic.php'; 
            if ($result !== false && $result->num_rows > 0) {
                include 'report.php'; 
            } else {
                echo '<p>No results found.</p>';
            }
        }
        ?>
    </div>
</body>
</html>
