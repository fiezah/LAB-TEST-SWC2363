<?php
include 'db_connect.php';  // Ensure the database connection is included

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values and sanitize them
    $name = htmlspecialchars(trim($_POST['name']));
    $month = htmlspecialchars(trim($_POST['month']));
    $sales = trim($_POST['sales']);  // Sales should be sanitized and validated separately

    // Initialize the commission variable
    $commission = 0;

    // Validate and calculate commission based on sales amount
    if (!empty($sales) && is_numeric($sales) && $sales >= 0) {
        $sales = floatval($sales);  // Convert sales amount to a floating-point number

        // Apply the commission rate based on the sales amount
        if ($sales >= 1 && $sales <= 2000) {
            $commission = $sales * 0.03;  // 3% commission
        } elseif ($sales >= 2001 && $sales <= 5000) {
            $commission = $sales * 0.04;  // 4% commission
        } elseif ($sales >= 5001 && $sales <= 7000) {
            $commission = $sales * 0.07;  // 7% commission
        } elseif ($sales >= 7001) {
            $commission = $sales * 0.10;  // 10% commission
        }
    } else {
        // Display error message if sales input is invalid
        echo "<p>Please enter a valid numeric sales amount.</p>";
        exit;
    }

    // Display the result
    echo "<div class='result-container'>";
    echo "<h2>Sales Commission</h2>";
    echo "<p>Name: " . $name . "</p>";
    echo "<p>Month: " . $month . "</p>";
    echo "<p>Sales Amount: RM " . number_format($sales, 2) . "</p>";
    echo "<p>Commission: RM " . number_format($commission, 2) . "</p>";
    echo "</div>";
}
?>
