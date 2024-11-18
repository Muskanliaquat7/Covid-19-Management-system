<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "covid_hospital_search";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get city from AJAX request
$city = $_POST['city'];

// Query to search hospitals by city
$sql = "SELECT * FROM hospitals WHERE city LIKE ?";
$stmt = $conn->prepare($sql);
$search_city = "%$city%";
$stmt->bind_param("s", $search_city);
$stmt->execute();
$result = $stmt->get_result();

// Display results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='result-item'>";
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p><strong>Address:</strong> " . $row['address'] . "</p>";
        echo "<p><strong>Phone:</strong> " . $row['phone'] . "</p>";
        echo "<p><strong>Type:</strong> " . $row['type'] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No hospitals found for the specified city.</p>";
}

// Close connection
$stmt->close();
$conn->close();
?>
